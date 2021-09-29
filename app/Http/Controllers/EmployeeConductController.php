<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Conduct;
use App\Models\Employee;
use App\Models\EmployeeConduct;
use App\Models\JobType;
use App\Models\TypeOfContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeConductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Employee $employee)
    {
        if ($request->ajax()) {

            $data =   EmployeeConduct::where('employee_id', $employee->id)
                ->with(['authenticatedBy' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->orderBy('id', 'desc')
                ->get();
            return DataTables::of($data)
                ->editColumn('date_of_offence', function (EmployeeConduct $conduct) {
                    return $conduct->date_of_offence ? Helper::parseDate($conduct->date_of_offence, 'd/m/Y') : '';
                })
                ->editColumn('offence_details', function (EmployeeConduct $conduct) {
                    // return Helper::showLessMoreText(nl2br($conduct->offence_details), '50');
                    return nl2br($conduct->offence_details);
                })
                ->editColumn('authority_letter_date', function (EmployeeConduct $conduct) {
                    return $conduct->authority_letter_date ? Helper::parseDate($conduct->authority_letter_date, 'd/m/Y') : '';
                })
                ->editColumn('authorized_by', function (EmployeeConduct $conduct) {
                    return $conduct->authenticatedBy ? $conduct->authenticatedBy->name : '';
                })
                ->addColumn('action', function ($conduct) use ($employee) {
                    // $html = '<button onclick="editMedical(' . json_decode($conduct) . ', "' . $conduct->employee_id . '", "' . $conduct->employee->folder_name . '")" class="btn btn-primary edit btn-sm">Edit</button>';
                    $html = "<button onclick=\"editConductDT(" . $conduct->id . ", {$employee->id})\" class='btn btn-warning edit btn-sm'><i class='fa fa-pencil'></i> Edit</button>";
                    $html .= '&nbsp;&nbsp;&nbsp;<a href="/employees/' . $conduct->employee_id . '/conducts/' . $conduct->id . '" class="view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $html;
                })
                ->rawColumns(['action', 'offence_details'])
                ->make(true);
        }

        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        $conducts = EmployeeConduct::where('employee_id', '=', $employee->id)->get();
        return view('employees.conduct.index', compact('employee', 'typeOfContract', 'conducts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Employee $employee, EmployeeConduct  $employeeConduct)
    {
        $jobType = JobType::where('id', '=', $employee->job_type_id)->pluck('title');
        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        $employeeConduct = EmployeeConduct::where('id', '=', $employeeConduct->id)
            ->with(['authenticatedBy' => function ($query) {
                $query->select('id', 'name');
            }])
            ->first();

        $conducts = EmployeeConduct::where('employee_id', $employee->id)->select('id', 'title')->get();

        return view('employees.conduct.show', compact('employee', 'employeeConduct', 'jobType', 'typeOfContract', 'conducts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employee $employee)
    {
        if ($request->ajax()) {
            $validatedAttributes = $this->validatedAttributes($request);

            $validatedAttributes['authority_letter_image'] = Helper::uploadImage($request, 'authority_letter_image', $employee->folder_name);

            $validatedAttributes['user_id'] = $request->user()->id;
            $validatedAttributes['employee_id'] = $employee->id;

            $employeeConduct = EmployeeConduct::create($validatedAttributes);
            return $employeeConduct ? 'success' : 'failure';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeConduct  $employeeConduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee, EmployeeConduct $employeeConduct)
    {
        if ($request->ajax()) {
            $validatedAttributes = $this->validatedAttributes($request);


            if ($request->hasFile('authority_letter_image')) {
                $validatedAttributes['authority_letter_image'] = Helper::uploadImage($request, 'authority_letter_image', $employee->folder_name);
                if ($employeeConduct->authority_letter_image) {
                    Helper::deleteImage($employee->folder_name, $employeeConduct->authority_letter_image);
                }
            }

            return $employeeConduct->update($validatedAttributes) ? 'success' : 'failure';
        }
    }

    private function validatedAttributes($request)
    {
        $rules = [
            'title' => 'required|max:255',
            'place_of_offence' => 'required|max:255',
            'date_of_offence' => 'required|date_format:Y-m-d',
            'authority_letter_date' => 'nullable|date_format:Y-m-d',
            'offence_details' => 'nullable|max:65500',
            'punishment' => 'nullable|max:255',
            'punishment_date' => 'nullable|date_format:Y-m-d',
            'authorized_by' => 'nullable|exists:employees,id',
            'score' => 'required|numeric|min:1|max:10',
        ];
        if ($request->hasFile('authority_letter_image')) {
            $rules['authority_letter_image'] = 'nullable|mimes:jpeg,bmp,png,gif,pdf,jpg,docx|max:2048';
        }
        return $request->validate($rules, ['date_format' => 'Invalid date',]);
    }

    public function getConduct(Request $request, Employee $employee)
    {
        if (!$request->conduct) {
            abort(404);
        }

        if ($request->ajax()) {

            $medical = EmployeeConduct::where('id', '=', $request->conduct)
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
