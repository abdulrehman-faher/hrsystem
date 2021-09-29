<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\EducationDetail;
use App\Models\Employee;
use App\Models\Medical;
use App\Models\JobType;
use App\Models\TypeOfContract;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Employee $employee)
    {
        if ($request->ajax()) {

            $data =   Medical::where('employee_id', $employee->id)
                ->with(['authenticatedBy' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->orderBy('id', 'desc')
                ->get();

            return DataTables::of($data)
                ->editColumn('admission_date', function (Medical $medical) {
                    return $medical->admission_date ? Helper::parseDate($medical->admission_date, 'd/m/Y') : '';
                })
                ->editColumn('authorized_by', function (Medical $medical) {
                    return $medical->authenticatedBy ? $medical->authenticatedBy->name : '';
                })
                ->addColumn('action', function ($medical) use ($employee) {
                    // $html = '<button onclick="editMedical(' . json_decode($medical) . ', "' . $medical->employee_id . '", "' . $medical->employee->folder_name . '")" class="btn btn-primary edit btn-sm">Edit</button>';
                    $html = "<button onclick=\"editMedicalDT(" . $medical->id . ", {$employee->id})\" class='btn btn-primary edit btn-sm'><i class='fa fa-pencil'></i> Edit</button>";
                    $html .= '&nbsp;&nbsp;&nbsp;<a href="/employees/' . $medical->employee_id . '/medicals/' . $medical->id . '" class="view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $html;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        return view('employees.medical.index', compact('employee', 'typeOfContract'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Employee $employee, Medical  $medical)
    {
        $jobType = JobType::where('id', '=', $employee->job_type_id)->pluck('title');
        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        $medical = Medical::where('id', '=', $medical->id)
            ->with([
                'authenticatedBy' => function ($query) {
                    $query->select('id', 'name');
                },
                'createdBy' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            // ->with(['createdBy'])
            ->first();

        // return $medical;

        $medicals = Medical::where('employee_id', $employee->id)->select('id', 'title')->get();

        return view('employees.medical.show', compact('employee', 'jobType', 'typeOfContract', 'medical', 'medicals'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employee $employee)
    {
        $validatedAttributes = $this->validatedAttributes($request);
        $validatedAttributes['attachment'] = Helper::uploadImage($request, 'attachment', $employee->folder_name);

        $validatedAttributes['user_id'] = $request->user()->id;
        $validatedAttributes['employee_id'] = $employee->id;
        $validatedAttributes['club_id'] = $employee->club_id;
        $validatedAttributes['department_id'] = $employee->department_id;

        return Medical::create($validatedAttributes) ? 'success' : 'failure';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medical  $medical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee, Medical $medical)
    {
        $validatedAttributes = $this->validatedAttributes($request);

        if ($request->hasFile('attachment')) {
            $validatedAttributes['attachment'] = Helper::uploadImage($request, 'attachment', $employee->folder_name);
            if ($medical->attachment) Helper::deleteImage($employee->folder_name, $medical->attachment);
        }

        return $medical->update($validatedAttributes) ? 'success' : 'failure';
    }

    private function validatedAttributes($request)
    {
        $rules = [
            'title' => 'required|max:255',
            'score' => 'nullable|numeric|min:1|max:10',
            'hospital_name' => 'nullable|max:255',
            'appt' => 'nullable|max:255',
            'admission_date' => 'nullable|date_format:Y-m-d',
            'discharge_date' => 'nullable|date_format:Y-m-d',
            'ion_number' => 'nullable|max:255',
            'ion_date' => 'nullable|date_format:Y-m-d',
            'authorized_by' => 'nullable|exists:employees,id',
        ];
        if ($request->hasFile('attachment')) {
            $rules['attachment'] = 'nullable|mimes:jpeg,bmp,png,gif,pdf,jpg,docx|max:2048';
        }
        return $request->validate($rules, ['date_format' => 'Invalid date',]);
    }

    public function getMedical(Request $request, Employee $employee)
    {
        if (!$request->medical) {
            abort(404);
        }

        if ($request->ajax()) {

            $medical = Medical::where('id', '=', $request->medical)
                ->where('employee_id', $employee->id)
                ->with('employee', function ($query) {
                    return $query->select('id', 'folder_name');
                })
                ->first();

            if (!$medical) {
                return Helper::jsonResponse(false, $medical);
            }

            return Helper::jsonResponse(true, $medical);
        } else {
            abort(404);
        }
    }
}
