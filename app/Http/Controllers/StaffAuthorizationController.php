<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\StaffAuthorization;
use Illuminate\Http\Request;

class StaffAuthorizationController extends Controller
{
    public function validateStrength(Request $request)
    {
        $authorization = StaffAuthorization::where('job_type_id', '=', $request->job_type_id)
            ->where('club_id', '=', $request->club_id)
            ->first();
        // return $authorization;
        $empStrength = Employee::where('job_type_id', $request->job_type_id)
            ->where('club_id', '=', $request->club_id)
            ->count();

        $difference = $empStrength - $authorization->max_strength;

        $data = [
            'success' => true,
            'max_strength' => $authorization->max_strength,
            'empStrength' => $empStrength,
            'difference' => $difference,
        ];

        return json_encode($data);
    }
}
