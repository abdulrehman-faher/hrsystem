<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Employee;
use App\Models\WorkHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WorkHistoryController extends Controller
{
    public function getEmployeeWorkHistory(Employee $employee)
    {
        if (request()->ajax()) {
            $workHistory = WorkHistory::where('employee_id', $employee->id)->get();
            $folder_name  = $employee->folder_name;
            return DataTables::of($workHistory)
                ->addIndexColumn()
                ->editColumn('attachment', function (WorkHistory $workHistory) use ($folder_name) {
                    if (!$workHistory->attachment) {
                        return '';
                    }

                    $storage_path = Helper::imgStoragePath($folder_name, $workHistory->attachment);
                    $html  = "<a href=\"{$storage_path}\" target=\"_blank\"><img src=\"{$storage_path}\" class=\"img-fluid modal-img\" width=\"50px\" alt=\"{$workHistory->job_title}\" /></a>";
                    return  $html;
                })
                ->addColumn('action', function (WorkHistory $workHistory) {
                    $html = "<button onclick='editWorkHistoryDT({$workHistory->id}, {$workHistory->employee_id})' class='btn btn-warning edit btn-sm'><i class='fa fa-pencil'></i> Edit</button>";
                    // $html .= '<a href="#" class="ml-3 view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $html;
                })
                ->rawColumns(['action', 'attachment'])
                ->make(true);
        }
        return $employee;
    }

    public function getWorkHistory(Request $request, Employee $employee)
    {
        // dd($employee->id);
        if (!$request->id) {
            abort(404);
        }

        if ($request->ajax()) {

            $workHistory = WorkHistory::select('id', 'employee_id', 'job_title', 'company_name', 'company_address', 'start_date', 'end_date', 'attachment')
                ->where('id', '=', $request->id)
                ->where('employee_id', $employee->id)
                ->with('employee', function ($query) {
                    return $query->select('id', 'folder_name');
                })
                ->first();

            if (!$workHistory) {
                return Helper::jsonResponse(false, $workHistory);
            }

            return Helper::jsonResponse(true, $workHistory);
        } else {
            abort(404);
        }
    }
}
