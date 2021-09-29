<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\EducationDetail;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EducationDetailController extends Controller
{
    public function getEmployeeEducationDetail(Employee $employee)
    {

        // return $educationDetails;
        if (request()->ajax()) {
            $educationDetails = EducationDetail::where('employee_id', $employee->id)->get();
            $folder_name  = $employee->folder_name;
            return DataTables::of($educationDetails)
                ->addIndexColumn()
                ->editColumn('attachment', function (EducationDetail $educationDetail) use ($folder_name) {
                    if (!$educationDetail->attachment) {
                        return '';
                    }

                    $storage_path = Helper::imgStoragePath($folder_name, $educationDetail->attachment);
                    $html  = "<a href=\"{$storage_path}\" target=\"_blank\"><img src=\"{$storage_path}\" class=\"img-fluid modal-img\" width=\"50px\" alt=\"{$educationDetail->title}\" /></a>";
                    return  $html;
                })
                ->addColumn('action', function (EducationDetail $educationDetail) {
                    $html = "<button onclick='editEducationDT({$educationDetail->id}, {$educationDetail->employee_id})' class='btn btn-warning edit btn-sm mr-3'><i class='fa fa-pencil'></i> Edit</button>";
                    // $html .= '<a href="" class="view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $html;
                })
                ->rawColumns(['action', 'attachment'])
                ->make(true);
        }
        return $employee;
    }

    public function getEducationDetails(Request $request, Employee $employee)
    {
        if (!$request->id) {
            abort(404);
        }

        if ($request->ajax()) {

            $educationDetail = EducationDetail::select('id', 'employee_id', "title", "institute_name", "marks_obtained", "division_grade", "year_completed", "campus_address", "attachment")
                ->where('id', $request->id)
                ->where('employee_id', $employee->id)
                ->with('employee:id,folder_name')
                ->first();

            if (!$educationDetail) {
                return Helper::jsonResponse(false, $educationDetail);
            }

            return Helper::jsonResponse(true, $educationDetail);
        } else {
            abort(404);
        }
    }
}
