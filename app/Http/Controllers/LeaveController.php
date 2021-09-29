<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use App\Helpers\Helper;
use App\Models\Leave;
use App\Models\JobType;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\TypeOfContract;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Employee $employee)
    {
        // $data =  Leave::where('employee_id', $employee->id)
        //     ->with(['authenticatedBy' => function ($query) {
        //         $query->select('id', 'name');
        //     }])
        //     ->with(['type' => function ($query) {
        //         $query->select('id', 'name');
        //     }])
        //     ->orderBy('id', 'desc')
        //     ->get();
        // return $data;

        if (request()->ajax()) {
            $data =  Leave::where('employee_id', $employee->id)
                ->with(['authenticatedBy' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->with(['type' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->orderBy('id', 'desc')
                ->get();

            return DataTables::of($data)
                ->editColumn('type', function (Leave $leave) {
                    return $leave->type ? $leave->type->name : '';
                })
                ->editColumn('from', function (Leave $leave) {
                    return $leave->from ? date("d/m/Y", strtotime($leave->from)) : '';
                })
                ->editColumn('to', function (Leave $leave) {
                    return $leave->to ? date("d/m/Y", strtotime($leave->to)) : '';
                })
                ->editColumn('authorized_by', function (Leave $leave) {
                    return $leave->authorized_by ? $leave->authenticatedBy->name : '';
                })
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    $button =  '<button onclick="editLeave(' . $data->id . ', ' . $data->employee_id . ')" id="edit_' . $id . '" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button>';
                    $button .= '&nbsp;&nbsp;<a href="#" id="view_' . $id . '" class="view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        $leaveTypes = LeaveType::select('id', 'name')->get();

        return view('employees.leaves.index', compact('employee', 'typeOfContract', 'leaveTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validatedAttributes = $this->validatedAttributes();
        $validatedAttributes['attachment'] = Helper::uploadImage($request, 'attachment', $employee->folder_name);

        $validatedAttributes['user_id'] = $request->user()->id;
        $validatedAttributes['employee_id'] = $employee->id;

        return Leave::create($validatedAttributes) ? 'success' : 'failure';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, Leave $leave)
    {
        $leave = Leave::where('id', $leave->id)
            ->with(['authenticatedBy' => function ($query) {
                $query->select('id', 'name');
            }])->first();
        return $leave;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee, Leave $leave)
    {
        // dd('here i am');
        $validatedAttributes = $this->validatedAttributes($request);

        if ($request->hasFile('attachment')) {
            $validatedAttributes['attachment'] = Helper::uploadImage($request, 'attachment', $employee->folder_name);
            if ($leave->attachment) Helper::deleteImage($employee->folder_name, $leave->attachment);
        }

        return $leave->update($validatedAttributes) ? 'success' : 'failure';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }

    /**
     * Get Yearly total of leave by employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function getYearlyLeaveBalance(Request $request, Employee $employee)
    {

        $current_year = date('Y', time());
        $year = $request->year && ($request->year >= 1980 && $request->year < $current_year) ? $request->year : $current_year;

        $start_date = $year . '-01-01';
        $end_date = $year . '-12-31';

        $data = DB::select("SELECT
                    `leave_types`.`id`,
                    `leave_types`.`name`, 
                    sum(`leaves`.`total_days` ) total_leaves 
                FROM
                    `leave_types`
                    INNER JOIN `leaves` ON `leaves`.`type_of_leave_id` = `leave_types`.`id` 
                WHERE
                    `leaves`.`employee_id` = $employee->id 
                    AND `leaves`.`from` >= '$start_date' 
                    AND `leaves`.`to` <= '$end_date' 
                GROUP BY `leaves`.type_of_leave_id");
        return $data;
    }


    private function validatedAttributes()
    {
        $rules = [
            'type_of_leave_id' => 'required|exists:leave_types,id',
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d',
            'total_days' => 'nullable|numeric|max:999',
            'purpose' => 'nullable|max:5000',
            'authorized_by' => 'nullable|exists:employees,id',
        ];
        if (request()->hasFile('attachment')) {
            $rules['attachment'] = 'nullable|mimes:' . Helper::allowedMimesTypes() . '|max:' . Helper::allowedFileSize();
        }
        return request()->validate($rules, ['date_format' => 'Invalid date',]);
    }
}
