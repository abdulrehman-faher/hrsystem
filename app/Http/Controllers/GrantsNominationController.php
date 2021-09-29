<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TypeOfContract;
use Illuminate\Http\Request;

class GrantsNominationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Employee $employee)
    {
        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        return view('employees.grants.index', compact('employee', 'typeOfContract'));
    }
}
