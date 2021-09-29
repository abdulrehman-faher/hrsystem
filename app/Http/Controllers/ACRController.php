<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\ACR;
use App\Models\Employee;
use App\Models\PerformanceAppraisal;
use App\Models\TypeOfContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ACRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Employee $employee)
    {
        if ($request->ajax()) {

            $data =   ACR::where('employee_id', $employee->id)
                ->with(['authenticatedBy' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->orderBy('id', 'desc')
                ->get();

            return DataTables::of($data)
                ->editColumn('period_from', function (ACR $acr) {
                    return $acr->period_from ?  Helper::parseDate($acr->period_from, 'Y') : '';
                })
                ->editColumn('promotion_recomended', function (ACR $acr) {
                    return 'NO';
                })
                ->editColumn('authorized_by', function (ACR $acr) {
                    return $acr->authenticatedBy ? $acr->authenticatedBy->name : '';
                })
                ->addColumn('action', function ($acr) use ($employee) {
                    // $html = '<button onclick="editMedical(' . json_decode($acr) . ', "' . $acr->employee_id . '", "' . $acr->employee->folder_name . '")" class="btn btn-primary edit btn-sm">Edit</button>';
                    $html = "<a href='" . route('employees_acrs.edit', ['employee' => $employee->id, 'acr' => $acr->id]) . "' class='btn btn-warning edit btn-sm'><i class='fa fa-pencil'></i> Edit</button>";
                    $html .= '<a href="' . route('employees_acrs.show', ['employee' => $employee->id, 'acr' => $acr->id]) . '" class="ml-3 view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $html;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        return view('employees.acrs.index', compact('employee', 'typeOfContract'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Employee $employee)
    {
        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        $performance_appraisals = PerformanceAppraisal::where('active', true)->select('id', 'title', 'abbr', 'score')->get();
        return view('employees.acrs.create', compact('employee', 'performance_appraisals', 'typeOfContract'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employee $employee)
    {
        $fields = $this->validateFields();
        $this->validateAttachments();

        DB::beginTransaction();
        try {
            $performance_appraisals = PerformanceAppraisal::pluck('score', 'id');

            $user_id = auth()->user()->id;

            $fields['employee_id'] = $employee->id;
            $fields['io_performance_appraisal_score'] = $request->io_performance_appraisal_id ? $performance_appraisals[$request->io_performance_appraisal_id] : 0;
            $fields['sro_performance_appraisal_score'] = $request->sro_performance_appraisal_id ? $performance_appraisals[$request->sro_performance_appraisal_id] : 0;
            $fields['user_id'] = $user_id;

            $acr = ACR::create($fields);

            Helper::attachImage($request, $employee->folder_name, $acr, 'ACR Application Form');

            DB::commit();
            return redirect()->route('employees.show', ['employee' => $employee->id])->with('success', 'ACR Created Successfully!');
        } catch (\Exception $ex) {
            DB::rollBack();
            // Log::error($ex->errorInfo);
            return redirect()->back()->with('error', 'Error occured, ACR did not save to the database.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ACR  $acr
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, ACR $acr)
    {
        $performance_appraisals = PerformanceAppraisal::whereIn('id', [$acr->io_performance_appraisal_id, $acr->sro_performance_appraisal_id])->select('id', 'title', 'abbr', 'score')->get();
        return view('employees.acrs.show', compact('employee', 'acr', 'performance_appraisals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @param  \App\ACR  $acr
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee, ACR $acr)
    {
        $performance_appraisals = PerformanceAppraisal::where('active', true)->select('id', 'title', 'abbr', 'score')->get();
        return view('employees.acrs.edit', compact('employee', 'acr', 'performance_appraisals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ACR  $acr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee, ACR $acr)
    {
        $fields = $this->validateFields();
        $this->validateAttachments();

        $performance_appraisals = PerformanceAppraisal::pluck('score', 'id');

        $fields['io_performance_appraisal_score'] = $request->io_performance_appraisal_id ? $performance_appraisals[$request->io_performance_appraisal_id] : 0;
        $fields['sro_performance_appraisal_score'] = $request->sro_performance_appraisal_id ? $performance_appraisals[$request->sro_performance_appraisal_id] : 0;

        Helper::attachImage($request, $employee->folder_name, $acr, 'ACR Application Form');


        return $acr->update($fields) ?
            redirect()->route('employees_acrs.show', ['employee' => $employee->id, 'acr' => $acr->id])->with('success', $employee->name . ' ACR Updated successfully!') :
            redirect()->route('employees_acrs.edit', ['employee' => $employee->id, 'acr' => $acr->id])->with('error', $employee->name . ' ACR Updation Failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ACR  $acr
     * @return \Illuminate\Http\Response
     */
    public function destroy(ACR $acr)
    {
        //
    }

    public function validateAttachments()
    {
        if (request()->hasFile('attachments')) {
            request()->validate(['attachments.*' => 'nullable|mimes:' . Helper::allowedMimesTypes() . '|max:' . Helper::allowedFileSize()]);
        }
    }

    public function validateFields()
    {

        $rules = [
            'period_from' => 'required|date_format:Y-m-d',
            'period_to' => 'nullable|date_format:Y-m-d',
            'appointment' => 'nullable|max:255',
            'appointment_date' => 'nullable|date_format:Y-m-d',
            'grade' => 'nullable|max:255',

            'period_served_io_from' => 'nullable|date_format:Y-m-d',
            'period_served_io_to' => 'nullable|date_format:Y-m-d',
            'period_served_sro_from' => 'nullable|date_format:Y-m-d',
            'period_served_sro_to' => 'nullable|date_format:Y-m-d',

            'io_remarks_strong_points' => 'nullable|max:65500',
            'io_remarks_weak_area' => 'nullable|max:65500',
            'io_remarks_demo_performance' => 'nullable|max:65500',
            'special_achievements' => 'nullable|max:65500',
            'io_performance_appraisal_id' => 'nullable|exists:performance_appraisals,id',
            'io_employee_id' => 'nullable|max:255',
            'io_name' => 'nullable|max:255',
            'io_appointment' => 'nullable|max:255',
            'io_sign_date' => 'nullable|max:255',
            'io_emp_sign_date' => 'nullable|max:255',

            'sro_remarks' => 'nullable|max:255',
            'sro_performance_appraisal_id' => 'nullable|exists:performance_appraisals,id',
            'sro_employee_id' => 'nullable|exists:employees,id',
            'sro_name' => 'nullable|max:255',
            'sro_appointment' => 'nullable|max:255',
            'sro_sign_date' => 'nullable|date_format:Y-m-d',
            'sro_emp_sign_date' => 'nullable|date_format:Y-m-d',
            'authorized_by' => 'nullable|exists:employees,id',
            'authorized_by_date' => 'nullable|date_format:Y-m-d',
        ];

        return request()->validate($rules, ['date_format' => 'Invalid date',]);
    }
}
