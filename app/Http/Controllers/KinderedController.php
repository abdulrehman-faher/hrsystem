<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Employee;
use App\Models\JobType;
use App\Models\Kindered;
use App\Models\LeaveType;
use App\Models\TypeOfContract;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KinderedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Employee $employee)
    {
        $kindereds1 = Kindered::where('employee_id', $employee->id)
            ->with(['authenticatedBy' => function ($query) {
                $query->select('id', 'name');
            }])
            ->get();

        $kindereds = array();
        $wife = [];
        $parents = [];
        $brothers = [];
        $sisters = [];
        $sons = [];
        $daughters = [];
        foreach ($kindereds1 as $kindered) {
            $wife_single = [];
            if ($kindered->relationship == 'wife') {
                $wife[] = $this->createKinderedObj($kindered);
            }
            if ($kindered->relationship == 'mother' || $kindered->relationship == 'father') {
                $parents[] = $this->createKinderedObj($kindered);
            }
            if ($kindered->relationship == 'brothers') {
                $brothers[] = $this->createKinderedObj($kindered);
            }
            if ($kindered->relationship == 'sisters') {
                $sisters[] = $this->createKinderedObj($kindered);
            }
            if ($kindered->relationship == 'sons') {
                $sons[] = $this->createKinderedObj($kindered);
            }
            if ($kindered->relationship == 'daughters') {
                $daughters[] = $this->createKinderedObj($kindered);
            }

            $kindereds['wife'] = $wife;
            $kindereds['parents'] = $parents;
            $kindereds['brothers'] = $brothers;
            $kindereds['sisters'] = $sisters;
            $kindereds['sons'] = $sons;
            $kindereds['daughters'] = $daughters;
        }
        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        $kindered_relations = Helper::getEnumValues('kindereds', 'relationship');

        return view('employees.kindred.index', compact('employee', 'kindereds', 'typeOfContract', 'kindered_relations'));
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
     * @param  \App\Employee  $employee
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Employee $employee, Request $request)
    {
        $attributes = $this->validatedAttributes(); // relationship relationship
        $attributes['employee_id'] = $employee->id;
        $attributes['user_id'] = auth()->user()->id;
        if ($request->relationship != 'wife') {
            $attributes['marriage_date'] = null;
        }

        return Kindered::create($attributes) ? 'success' : 'failure';
        // dump($attributes);
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kindered  $kindered
     * @return \Illuminate\Http\Response
     */
    public function show(Kindered $kindered)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kindered  $kindered
     * @return \Illuminate\Http\Response
     */
    public function edit(Kindered $kindered)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kindered  $kindered
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee, Kindered $kindered)
    {
        $validatedAttributes = $this->validatedAttributes();

        return $kindered->update($validatedAttributes) ? 'success' : 'failure';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kindered  $kindered
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kindered $kindered)
    {
        //
    }

    private function validatedAttributes()
    {
        $rules = [
            'relationship' => ['required', Rule::in(['wife', 'mother', 'father', 'sons', 'daughters', 'brothers', 'sisters'])],
            // 'relationship' => 'required|in:wife,mother,father,sons,daughters,brothers,sisters',
            'name' => 'required|max:20',
            'dob' => 'nullable|date_format:Y-m-d',
            'marriage_date' => 'nullable|date_format:Y-m-d',
            'next_of_kin' => 'nullable|max:200',
            'cnic' => 'nullable|max:20',
            'date_of_entry' => 'nullable|date_format:Y-m-d',
            'authorized_by' => 'nullable|exists:employees,id',
        ];
        return request()->validate($rules, ['date_format' => 'Invalid date format',]);
    }

    private function createKinderedObj($kindered)
    {
        $obj = [];
        $obj['id'] = $kindered->id;
        $obj['employee_id'] = $kindered->employee_id;
        $obj['relationship'] = $kindered->relationship;
        $obj['name'] = $kindered->name;
        $obj['dob'] = $kindered->dob;
        $obj['marriage_date'] = $kindered->marriage_date;
        $obj['next_of_kin'] = $kindered->next_of_kin;
        $obj['cnic'] = $kindered->cnic;
        $obj['date_of_entry'] = $kindered->date_of_entry;
        $obj['user_id'] = $kindered->user_id;
        $obj['authenticated_by'] = $kindered->authenticatedBy;
        return $obj;
    }
}
