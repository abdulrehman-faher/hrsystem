<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Employee;
use App\Models\LocalCourse;
use App\Models\TypeOfContract;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocalCoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Employee $employee)
    {
        if (request()->ajax()) {
            $data =  LocalCourse::where('employee_id', $employee->id)
                ->with(['authenticatedBy' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->orderBy('id', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('date_from', function (LocalCourse $localCourse) {
                    return $localCourse->date_from ? Helper::parseDate($localCourse->date_from, 'd/m/Y') : '';
                })
                ->editColumn('date_to', function (LocalCourse $localCourse) {
                    return $localCourse->date_to ? Helper::parseDate($localCourse->date_to, 'd/m/Y') : '';
                })
                ->editColumn('authorized_by_date', function (LocalCourse $localCourse) {
                    return $localCourse->authorized_by_date ? Helper::parseDate($localCourse->authorized_by_date, 'd/m/Y') : '';
                })
                ->editColumn('authorized_by', function (LocalCourse $localCourse) {
                    return $localCourse->authenticatedBy ? $localCourse->authenticatedBy->name : '';
                })
                ->editColumn('attachment', function (LocalCourse $localCourse) use ($employee) {
                    if (!$localCourse->attachment) {
                        return '';
                    }

                    $storage_path = Helper::imgStoragePath($employee->folder_name, $localCourse->attachment);
                    $html  = "<a href=\"{$storage_path}\" target=\"_blank\"><img src=\"{$storage_path}\" class=\"img-fluid modal-img\" width=\"100px\" alt=\"{$localCourse->title}\" /></a>";
                    return  $html;
                })
                ->addColumn('action', function ($localCourse) use ($employee) {
                    $html = "<button onclick=\"editConductDT(" . $localCourse->id . ", {$employee->id})\" class='btn btn-warning edit btn-sm'><i class='fa fa-pencil'></i> Edit</button>";
                    $html .= '&nbsp;&nbsp;&nbsp;<a href="/employees/' . $localCourse->employee_id . '/conducts/' . $localCourse->id . '" class="view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $html;
                })
                ->rawColumns(['action', 'attachment'])
                ->make(true);
        }
        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        return view('employees.localCourses.index', compact('employee', 'typeOfContract'));
    }

    public function show(Request $request, Employee $employee, LocalCourse $localCourse)
    {
        return $localCourse;
    }

    public function store(Request $request, Employee $employee)
    {
        $attributes = $this->validatedAttributes();
        $attributes['employee_id'] = $employee->id;
        $attributes['user_id'] = auth()->user()->id;
        $attributes['attachment'] = Helper::uploadImage($request, 'attachment', $employee->folder_name);

        return LocalCourse::create($attributes) ? 'success' : 'failure';
    }

    public function update(Request $request, Employee $employee, LocalCourse $localCourse)
    {
        $attributes = $this->validatedAttributes();

        if ($request->hasFile('attachment')) {
            $attributes['attachment'] = Helper::uploadImage($request, 'attachment', $employee->folder_name);
            if ($localCourse->attachment) Helper::deleteImage($employee->folder_name, $localCourse->attachment);
        }

        return $localCourse->update($attributes) ? 'success' : 'failure';
    }

    private function validatedAttributes()
    {
        $rules = [
            'title' => 'required|max:250',
            'date_from' => 'nullable|date_format:Y-m-d',
            'date_to' => 'nullable|date_format:Y-m-d',
            'held_at_place' => 'nullable|max:250',
            'grade' => 'nullable|max:50',
            'marks' => 'nullable|max:50',
            'authorized_by' => 'nullable|exists:employees,id',
            'authorized_by_date' => 'nullable|date_format:Y-m-d',
        ];
        if (request()->hasFile('attachment')) {
            $rules['attachment'] = 'nullable|mimes:' . Helper::allowedMimesTypes() . '|max:' . Helper::allowedFileSize();
        }
        return request()->validate($rules, ['date_format' => 'Invalid date',]);
    }

    public function getLocalCourse(Request $request, Employee $employee)
    {
        if (!$request->id) {
            abort(404);
        }

        if ($request->ajax()) {
            $localCourse = LocalCourse::where('id', '=', $request->id)
                ->where('employee_id', $employee->id)
                ->with(['employee' => function ($query) {
                    return $query->select('id', 'folder_name');
                }, 'authenticatedBy' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->first();

            if (!$localCourse) {
                return Helper::jsonResponse(false, $localCourse);
            }

            return Helper::jsonResponse(true, $localCourse);
        } else {
            abort(404);
        }
    }
}
