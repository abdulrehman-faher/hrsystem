<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function employeeStrength(Request $request)
    {
        // if ($request->ajax()) {
        $clubs = Club::select('id', 'title')->get();
        $data = array();
        $club_titles = array();
        foreach ($clubs as $club) {
            $row = [
                'title' => $club->title,
                'id' => $club->id,
                'data' => new Collection($this->getEmployeeCountByClub($club->id))
            ];

            $club_titles[Str::snake($club->title) . '_' . $club->id] = $club->title;
            $data[] = collect($row);
        }
        // return $club_titles;
        $results = new Collection($data);

        // return $results;
        // }
        \Debugbar::info($club_titles);

        return view('reports.empoloyee_strength.index', compact('results', 'club_titles'));
    }


    public function getEmployeeCountByClub($club_id)
    {
        // $r1 = DB::table('employees')
        //     ->select('job_types.id', 'job_types.title', 'staff_authorizations.max_strength')
        //     ->count('employees.job_type_id AS total_employees')
        //     ->count('Count( employees.job_type_id ) - staff_authorizations.max_strength AS difference')
        //     ->join('job_types', 'job_types.id = employees.job_type_id')
        //     ->join('staff_authorizations', 'staff_authorizations.job_type_id = job_types.id')
        //     ->where('employees.club_id', '=', $club_id)
        //     ->where('staff_authorizations.club_id', '=', 'employees.club_id')
        //     ->groupBy('employees.job_type_id')
        //     ->get();

        // $r1 = Employee::join('job_types', 'job_types.id = employees.job_type_id')
        //     ->join('staff_authorizations', 'staff_authorizations.job_type_id = job_types.id')
        //     ->selectRaw('job_types.id, job_types.title, Count( employees.job_type_id ) AS total_employees, staff_authorizations.max_strength, Count( employees.job_type_id ) - staff_authorizations.max_strength AS difference')
        //     ->where('employees.club_id', '=', $club_id)
        //     ->where('staff_authorizations.club_id', '=', 'employees.club_id')
        //     ->groupBy('employees.job_type_id')
        //     ->get();

        $r1 = DB::select("SELECT
                job_types.id,
                job_types.title,
                Count( employees.job_type_id ) AS total_employees,
                staff_authorizations.max_strength,
                Count( employees.job_type_id ) - staff_authorizations.max_strength AS difference 
            FROM
                employees
                INNER JOIN job_types ON job_types.id = employees.job_type_id
                INNER JOIN staff_authorizations ON staff_authorizations.job_type_id = job_types.id 
            WHERE
                employees.club_id = $club_id 
                AND staff_authorizations.club_id = employees.club_id 
            GROUP BY
                employees.job_type_id");

        $r2 = DB::select("SELECT DISTINCT
                job_types.id,
                job_types.title,
                0 AS total_employees,
                staff_authorizations.max_strength,
                0 AS difference 
            FROM
                job_types
                INNER JOIN staff_authorizations ON staff_authorizations.job_type_id = job_types.id 
            WHERE
                job_types.id NOT IN ( SELECT employees.job_type_id FROM employees WHERE employees.club_id = $club_id GROUP BY employees.job_type_id )");

        $merged = new Collection(collect($r1)->merge(collect($r2)));
        $sorted = $merged->sortBy('id');
        return $sorted->values()->all();
    }
}
