<?php

namespace App\Http\Controllers;

use App\Models\ACR;
use App\Models\Application;
use App\Models\Club;
use App\Models\Department;
use App\Models\EducationDetail;
use App\Models\Employee;
use App\Models\EmployeeConduct;
use App\Models\Group;
use App\Models\InterviewCandidate;
use App\Models\JobType;
use App\Models\Kindered;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Medical;
use App\Models\StaffAuthorization;
use App\Models\TypeOfContract;
use App\Models\WorkHistory;
use App\Helpers\Helper;
use App\Models\LocalCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // \Debugbar::startMeasure('DataTables', 'employees datatables Time');

            $data =  Employee::orderBy('id', 'desc')
                ->select('id', 'name', 'employee_number', 'phone_number', 'cnic', 'job_type_id', 'department_id', 'appointment', 'club_id', 'email', 'created_at')
                ->with('department:id,name')
                ->with('club:id,title')
                ->with('jobType:id,title')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function (Employee $employee) {
                    return '<a href="/employees/' . $employee->id . '">' . $employee->name . '</a>';
                })
                ->editColumn('job_type_id', function (Employee $employee) {
                    return $employee->jobType ? $employee->jobType->title : '';
                })
                ->editColumn('department_id', function (Employee $employee) {
                    return $employee->department ? $employee->department->name : '';
                })
                ->editColumn('club_id', function (Employee $employee) {
                    return $employee->club ? $employee->club->title : '';
                })
                // ->editColumn('created_at', function (Employee $employee) {
                //     return $employee->created_at->format('d/m/Y');
                // })
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    // $button = '<a href="/employees/' . $id . '/edit" name="edit" id="' . $id . '" class="btn btn-primary edit btn-sm">Edit</a>';
                    // $button .= '&nbsp;&nbsp;&nbsp;<a href="/employees/' . $id . '" id="' . $id . '" class="view btn btn-success btn-sm">View</a>';
                    $html = '<div class="dropdown">
                            <button role="button" type="button" class="btn" data-toggle="dropdown">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-primary" href="/employees/' . $id . '/edit"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item text-primary" href="/employees/' . $id . '"><i class="fas fa-eye"></i> View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-success" href="/employees/' . $id . '/medicals"><i class="fas fa-procedures"></i> Medical</a>
                                <a class="dropdown-item text-success" href="/employees/' . $id . '/conducts"><i class="fas fa-award"></i> Conduct</a>
                                <a class="dropdown-item" href="/employees/' . $id . '/service-data"><i class="fas fa-chart-bar"></i> Service Data</a>
                                <a class="dropdown-item text-success" href="/employees/' . $id . '/local-courses"><i class="fas fa-user-graduate"></i> Local Courses</a>
                                <a class="dropdown-item text-success" href="/employees/' . $id . '/acrs"><i class="fas fa-chart-bar"></i> ACR</a>
                                <a class="dropdown-item text-success" href="/employees/' . $id . '/kindereds"><i class="fas fa-users"></i> Kindered Roll and Names</a>
                                <a class="dropdown-item text-success" href="/employees/' . $id . '/grants"><i class="fas fa-home"></i> Nomination for Misc Grants</a>
                                <a class="dropdown-item text-success" href="/employees/' . $id . '/leaves"><i class="fas fa-sleigh"></i> Leaves Record</a>
                            </div>
                        </div>';
                    // \Debugbar::stopMeasure('DataTables');
                    return $html;
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'];
        $jobTypes = JobType::latest()->pluck('title', 'id');
        $typeOfContract = TypeOfContract::latest()->pluck('title', 'id');
        $clubs = Club::latest()->pluck('title', 'id');
        $departments = Department::latest()->pluck('name', 'id');
        $groups = Group::select('id', 'title')->orderBy('id', 'desc')->get();

        return view('employees.create', compact('genders', 'jobTypes', 'typeOfContract', 'clubs', 'departments', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateFields($request);

        if ($request->has('interview_candidate_id')) {
            return $this->applicantToEmployeeStore($request);
        }

        $this->addNewEmployee($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        // $imageExtension = ['jpeg', 'gif', 'png', 'bmp', 'jpg', 'JPG'];
        $folder_name = $employee->folder_name;

        $dir = null;
        $imageFiles = [];
        $otherFiles = [];
        if (!$folder_name) {
            $folder_name = Helper::createFolderName($employee->id, $employee->name);
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $folder_name);
            File::makeDirectory($path, 0777, true, true);
            $employee->folder_name = $folder_name;
            $employee->save();
        }

        $dir = storage_path(DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR);


        if (file_exists($dir)) {
            foreach (array_diff(scandir($dir, 1), ['.', '..']) as $filename) {
                if (in_array(File::extension($filename), Helper::allowedExtensions())) {
                    $imageFiles[] = $filename;
                } else {
                    $otherFiles[] = $filename;
                }
            }
        }


        $jobType = JobType::where('id', '=', $employee->job_type_id)->pluck('title');
        $typeOfContract = TypeOfContract::where('id', '=', $employee->type_of_contract_id)->pluck('title');
        $leaveTypes = LeaveType::select('id', 'name')->get();

        $conducts = EmployeeConduct::where('employee_id', '=', $employee->id)
            ->with([
                'authenticatedBy' => function ($query) {
                    $query->select('id', 'name');
                },
                'creator' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->orderBy('id', 'desc')
            ->get();

        $medicals = Medical::where('employee_id', $employee->id)
            ->with(['authenticatedBy' => function ($query) {
                $query->select('id', 'name');
            }])
            ->orderBy('id', 'desc')
            ->get();

        $acrs = ACR::where('employee_id', $employee->id)
            ->with(['authenticatedBy' => function ($query) {
                $query->select('id', 'name');
            }])
            ->orderBy('id', 'desc')
            ->get();
        $kindereds = Kindered::where('employee_id', $employee->id)
            // ->where('relationship', '=', 'wife')
            ->with(['authenticatedBy' => function ($query) {
                $query->select('id', 'name');
            }])
            ->get();
        // ->orderBy('id', 'desc')
        // return $acrs;
        // return $acrs;

        $kindered_relations = Helper::getEnumValues('kindereds', 'relationship');

        $kindereds2 = array();
        $wife = [];
        $parents = [];
        $brothers = [];
        $sisters = [];
        $sons = [];
        $daughters = [];
        foreach ($kindereds as $kindered) {
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

            $kindereds2['wife'] = $wife;
            $kindereds2['parents'] = $parents;
            $kindereds2['brothers'] = $brothers;
            $kindereds2['sisters'] = $sisters;
            $kindereds2['sons'] = $sons;
            $kindereds2['daughters'] = $daughters;
        }

        // return $kindereds2;

        // foreach ($kindereds2 as $key => $k2) {
        //     dump($key);
        //     if ($k2) {
        //         foreach ($k2 as $k) {
        //             dump($k);
        //         }
        //     } else {
        //         dump('no k2');
        //     }
        // }

        $leaves = Leave::where('employee_id', '=', $employee->id)
            ->where('from', '>=', '2020-01-01')
            ->where('to', '<=', '2020-12-31')
            ->orderBy('id', 'desc')
            ->with([
                'authenticatedBy' => function ($query) {
                    $query->select('id', 'name');
                },
                'type' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->get();

        $localCourses = LocalCourse::where('employee_id', '=', $employee->id)
            ->orderBy('id', 'desc')
            ->with(['authenticatedBy' => function ($query) {
                $query->select('id', 'name');
            }])
            ->get();

        // $leaves = $employee->leaves()
        //     ->where('from', '>=', '2020-01-01')
        //     ->where('to', '<=', '2020-12-31')
        //     ->orderBy('id', 'desc')
        //     ->get();

        // return $leaves;

        return view(
            'employees.show',
            compact(
                'employee',
                'jobType',
                'leaveTypes',
                'typeOfContract',
                'imageFiles',
                'otherFiles',
                'conducts',
                'medicals',
                'acrs',
                'kindereds',
                'kindereds2',
                'kindered_relations',
                'leaves',
                'localCourses'
            )
        );
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $genders = ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'];
        $jobTypes = JobType::latest()->pluck('title', 'id');
        $typeOfContract = TypeOfContract::latest()->pluck('title', 'id');
        $clubs = Club::latest()->pluck('title', 'id');
        $departments = Department::latest()->pluck('name', 'id');
        $groups = Group::select('id', 'title')->orderBy('id', 'desc')->get();

        return view('employees.edit', compact('employee', 'genders', 'jobTypes', 'typeOfContract', 'clubs', 'departments', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $type = 'success';

        $attributes = $this->insertFields($request);

        try {
            if ($request->hasFile('photograph')) {
                $attributes['photograph'] = Helper::uploadImage($request, 'photograph', $employee->folder_name);
                if ($employee->photograph) {
                    Helper::deleteImage($employee->folder_name, $employee->photograph);
                }
            }

            $employee->update($attributes);
        } catch (\Exception $ex) {
            $type = 'error';
            Log::error($ex->errorInfo);
        }


        if ($type == 'error') {
            return redirect()->back()->with('error', 'Error occured, Employee did not save to the database.');
        }

        return redirect()->route('employees.index')->with('success', 'Employee \'' . $employee->name . '\' Updated successfully');
    }

    public function employeeNames(Request $request)
    {
        if ($request->ajax()) {
            if (!$request->name) {
                return [];
            }
            $nameStr = $request->name;
            $names = Employee::query()
                ->where('name', 'LIKE', "%{$nameStr}%")
                // ->orWhere('email', 'LIKE', "%{$nameStr}%")
                ->select('name', 'id', 'appointment')->get();
            return $names;
        }
    }

    public function applicantToEmployee(Request $request, Application $application)
    {

        $interview_candidate = InterviewCandidate::where('application_id', '=', $application->id)
            ->where('selected', '=', '1')
            ->first();

        // return $interview_candidate;

        // if someone is not selected from interview will be redirected back to selected page 
        if (!$interview_candidate) {
            return redirect()->route('interviews.showSelected')->with('error', 'Invalid Applicant.');
        }

        if ($interview_candidate->is_employeed) {
            return redirect()->route('interviews.showSelected')->with('error', 'Already an Employee.');
        }


        $genders = ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'];
        $jobTypes = JobType::latest()->pluck('title', 'id');
        $typeOfContract = TypeOfContract::latest()->pluck('title', 'id');
        $clubs = Club::latest()->pluck('title', 'id');
        $departments = Department::latest()->pluck('name', 'id');
        $groups = Group::select('id', 'title')->orderBy('id', 'desc')->get();
        // return $application->qualification;

        // return view('employees.applicant', compact('application'));
        // return compact('application', 'genders', 'jobTypes', 'typeOfContract', 'clubs', 'departments', 'interview_candidate', 'groups');
        return view('employees.applicant', compact('application', 'genders', 'jobTypes', 'typeOfContract', 'clubs', 'departments', 'interview_candidate', 'groups'));
    }

    public function applicantToEmployeeStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $interview_candidate = InterviewCandidate::where('id', '=', $request->interview_candidate_id)
                ->where('application_id', '=', $request->application_id)
                ->where('selected', '=', '1')
                ->first();

            if (!$interview_candidate) {
                return redirect()->route('interviews.showSelected')->with('error', 'Invalid Applicant!');
            }

            if ($interview_candidate->is_employeed) {
                return redirect()->route('interviews.showSelected')->with('error', 'Already an Employee!');
            }

            $application = Application::where('id', '=', $request->application_id)->first();

            $fields = $this->insertFields($request);
            $folder_name = isset($application->folder_name) ? $application->folder_name : Helper::createFolderName($application->id, $request->name);
            $fields['interview_id'] = $interview_candidate->interview_id;
            $fields['application_id'] = $application->id;
            $fields['user_id'] = auth()->user()->id;
            $fields['folder_name'] = $folder_name;

            $photograph_name = null;

            if ($request->hasFile('photograph')) {
                $current_timestamp = Carbon::now()->timestamp;
                $photograph_name = $current_timestamp . '-' . $request->photograph->getClientOriginalName();
                // $request->photograph->storeAs('images/applications/' . $folder_name, $photograph_name, 'public');
                $request->photograph->storeAs($this->storeAsPath($folder_name), $photograph_name, 'public');
            }

            $fields['photograph'] = $photograph_name;

            $employee = Employee::create($fields);

            $interview_candidate->is_employeed = true;
            $interview_candidate->save();
            $application->update(['is_employeed' => true]);

            foreach ($application->qualification as $qualification) {
                $qualification->update(['employee_id' => $employee->id]);
            }

            foreach ($application->workHistory as $workHistory) {
                $workHistory->update(['employee_id' => $employee->id]);
            }
            DB::commit();
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $application->folder_name);
            File::makeDirectory($path, 0777, true, true);
            return redirect()->route('employees.index')->with('success', 'Employee created successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
            // Log::error($ex->errorInfo);
            return redirect()->back()->with('error', 'Error occured, Employee did not save to the database.');
            // return redirect()->route('employees.index')->with('error', 'Error occured, Employee did not save to the database');
            //  view('employees.applicant', compact('application', 'genders', 'jobTypes', 'typeOfContract', 'clubs', 'departments', 'interview_candidate'));
        }

        // return $interview_candidate;
    }

    public function addNewEmployee($request)
    {
        $type = 'success';

        DB::beginTransaction();

        try {
            $fields = $this->insertFields($request);
            $user_id = auth()->user()->id;
            $fields['user_id'] = $user_id;

            $photograph_name = null;

            if ($request->hasFile('photograph')) {
                $current_timestamp = Carbon::now()->timestamp;
                $photograph_name = $current_timestamp . '-' . $request->photograph->getClientOriginalName();
            }

            $fields['photograph'] = $photograph_name;

            $employee = Employee::create($fields);


            $folder_name = Helper::createFolderName($employee->id, $employee->name); // $employee->id . '_' . Carbon::now()->timestamp  . '_' . Str::snake($request->name);
            $employee->folder_name = $folder_name;
            $employee->save();


            if ($request->hasFile('photograph')) {
                // $request->photograph->storeAs('images/applications/' . $folder_name, $photograph_name, 'public');
                $request->photograph->storeAs($this->storeAsPath($folder_name), $photograph_name, 'public');
            }

            foreach ($request->title as $key => $value) {
                if (trim($value)) {

                    $data = [
                        'employee_id' => $employee->id,
                        'title' => $value,
                        'institute_name' => $request->institute_name[$key],
                        'marks_obtained' => $request->marks_obtained[$key],
                        'division_grade' => $request->division_grade[$key],
                        'year_completed' => $request->year_completed[$key],
                        'campus_address' => $request->campus_address[$key],
                        'user_id' => $user_id,
                    ];

                    if (isset($request->file('education_images')[$key])) {
                        $file = $request->file('education_images')[$key];
                        if (in_array($file->getClientMimeType(), Helper::allowedMimeTypes())) {

                            $current_timestamp = Carbon::now()->timestamp;
                            $name = $current_timestamp . '-' . $file->getClientOriginalName();
                            // $file->storeAs('images/applications/' . $folder_name, $name, 'public');
                            $file->storeAs($this->storeAsPath($folder_name), $name, 'public');
                            $data['attachment'] = $name;
                            $data['file_ext'] = $file->getClientOriginalExtension();
                        }
                    }

                    EducationDetail::create($data);
                }
            }

            foreach ($request->job_title as $key => $value) {
                if (trim($value)) {
                    $data = [
                        'employee_id'     => $employee->id,
                        // 'job_title'       => $value,
                        'company_name'    => $request->company_name[$key],
                        'company_address' => $request->company_address[$key],
                        'start_date'      => $request->start_date[$key],
                        'end_date'        => $request->end_date[$key],
                        'user_id'         => $user_id,
                    ];

                    if (isset($request->file('workhistory_images')[$key])) {
                        $file = $request->file('workhistory_images')[$key];
                        if (in_array($file->getClientMimeType(), Helper::allowedMimeTypes())) {

                            $current_timestamp = Carbon::now()->timestamp;
                            $name = $current_timestamp . '-' . $file->getClientOriginalName();
                            // $file->storeAs('images/applications/' . $folder_name, $name, 'public');
                            $file->storeAs($this->storeAsPath($folder_name), $name, 'public');
                            $data['attachment'] = $name;
                            $data['file_ext'] = $file->getClientOriginalExtension();
                        }
                    }

                    WorkHistory::create($data);
                }
            }
            DB::commit();
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $folder_name);
            File::makeDirectory($path, 0777, true, true);


            // return redirect()->route('employees.index')->with('success', 'Employee added successfully');
        } catch (\Exception $ex) {
            $type = 'error';
            DB::rollBack();

            Log::error($ex->errorInfo);
            // return redirect()->back()->with('error', 'Error occured, Employee did not save to the database.');
        }


        if ($type == 'error') {
            return redirect()->back()->with('error', 'Error occured, Employee did not save to the database.');
        }

        return redirect()->route('employees.index')->with('success', 'Employee added successfully');
    }

    public function updateNewEmployee()
    {
    }

    private function validateFields($request, $employee = null)
    {
        return $request->validate([
            'cnic' => [
                'required',
                $employee ? Rule::unique('employees')->ignore($employee->id) : 'unique:employees'
            ],
            'name' => 'required',
            'job_type_id' => 'required',
            'employee_number' => ['required', 'min:4'],
            'email' => ['nullable', 'email'],
            'dob' => ['nullable', 'date_format:Y-m-d'],
            'appointment_date' => ['nullable', 'date_format:Y-m-d'],
            'joining_date' => ['nullable', 'date_format:Y-m-d'],
            'enrollment_date' => ['nullable', 'date_format:Y-m-d'],
            'sos_date' => ['nullable', 'date_format:Y-m-d'],
            'sod_date' => ['nullable', 'date_format:Y-m-d'],
            'contract_end_date' => ['nullable', 'date_format:Y-m-d'],
            'retirement_date' => ['nullable', 'date_format:Y-m-d'],
        ], [
            'date_format' => 'Invalid date',
        ]);
    }

    public function addEducation(Request $request, Employee $employee)
    {
        if ($request->hasFile('attachment')) {
            $request->validate([
                'title' => 'required|max:255',
                'attachment' => 'sometimes|nullable|mimes:jpeg,bmp,png,gif,pdf,jpg,docx|max:2048',
            ], ['title.required' => 'The degree title field is required.']);
        } else {
            $request->validate(['title' => 'required|max:255',], ['title.required' => 'The degree title field is required.']);
        }

        $user_id = auth()->user()->id;
        $data = [
            'employee_id' => $employee->id,
            'title' => $request->title,
            'institute_name' => $request->institute_name,
            'marks_obtained' => $request->marks_obtained,
            'division_grade' => $request->division_grade,
            'year_completed' => $request->year_completed,
            'campus_address' => $request->campus_address,
            'user_id' => $user_id,
        ];

        if ($request->hasFile('attachment') && in_array($request->attachment->getClientMimeType(), Helper::allowedMimeTypes())) {
            $current_timestamp = Carbon::now()->timestamp;
            $name = $current_timestamp . '-' . $request->attachment->getClientOriginalName();
            // $request->attachment->storeAs('images/applications/' . $employee->folder_name, $name, 'public');
            $request->attachment->storeAs($this->storeAsPath($employee->folder_name), $name, 'public');
            $data['attachment'] = $name;
            $data['file_ext'] = $request->attachment->getClientOriginalExtension();
        }

        return EducationDetail::create($data) ? 'success' : 'error';
    }

    public function updateEducation(Request $request, Employee $employee, EducationDetail $education)
    {
        if ($request->hasFile('attachment')) {
            $request->validate([
                'title' => 'required|max:255',
                'attachment' => 'sometimes|nullable|mimes:jpeg,bmp,png,gif,pdf,jpg,docx|max:2048',
            ], ['title.required' => 'The degree title field is required.']);
        } else {
            $request->validate(['title' => 'required|max:255',], ['title.required' => 'The degree title field is required.']);
        }
        $user_id = auth()->user()->id;

        $data = [
            'title' => $request->title,
            'institute_name' => $request->institute_name,
            'marks_obtained' => $request->marks_obtained,
            'division_grade' => $request->division_grade,
            'year_completed' => $request->year_completed,
            'campus_address' => $request->campus_address,
            'user_id' => $user_id,
        ];

        // if ($request->hasFile('attachment') && in_array($request->attachment->getClientMimeType(), Helper::allowedMimeTypes())) {
        //     $current_timestamp = Carbon::now()->timestamp;
        //     $name = $current_timestamp . '-' . $request->attachment->getClientOriginalName();
        //     // $request->attachment->storeAs('images/applications/' . $employee->folder_name, $name, 'public');
        //     $request->attachment->storeAs($this->storeAsPath($employee->folder_name), $name, 'public');
        //     $data['attachment'] = $name;
        //     $data['file_ext'] = $request->attachment->getClientOriginalExtension();

        //     if ($education->attachment) {
        //         Storage::delete(DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $employee->folder_name . DIRECTORY_SEPARATOR . $education->attachment);
        //     }
        // }

        if ($request->hasFile('attachment')) {
            $data['attachment'] = Helper::uploadImage($request, 'attachment', $employee->folder_name);
            if ($education->attachment) Helper::deleteImage($employee->folder_name, $education->attachment);
        }

        return $education->update($data) ? 'success' : 'error';
    }

    public function addWorkHistory(Request $request, Employee $employee)
    {
        if ($request->hasFile('attachment')) {
            $request->validate([
                'job_title' => 'required|max:255',
                'attachment' => 'sometimes|nullable|mimes:jpeg,bmp,png,gif,pdf,jpg,docx|max:' . Helper::allowedFileSize(),
            ]);
        } else {
            $request->validate(['job_title' => 'required|max:255',]);
        }

        $data = [
            'employee_id' => $employee->id,
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => auth()->user()->id,
        ];

        // if ($request->hasFile('attachment') && in_array($request->attachment->getClientMimeType(), Helper::allowedMimeTypes())) {
        //     $current_timestamp = Carbon::now()->timestamp;
        //     $name = $current_timestamp . '-' . $request->attachment->getClientOriginalName();
        //     // $request->attachment->storeAs('images/applications/' . $employee->folder_name, $name, 'public');
        //     $request->attachment->storeAs($this->storeAsPath($employee->folder_name), $name, 'public');
        //     $data['attachment'] = $name;
        //     $data['file_ext'] = $request->attachment->getClientOriginalExtension();
        // }

        $data['attachment'] = Helper::uploadImage($request, 'attachment', $employee->folder_name);

        return WorkHistory::create($data) ? 'success' : 'error';
    }

    public function updateWorkHistory(Request $request, Employee $employee, WorkHistory $workHistory)
    {
        if ($request->hasFile('attachment')) {
            $request->validate([
                'job_title' => 'required|max:255',
                'attachment' => 'sometimes|nullable|mimes:jpeg,bmp,png,gif,pdf,jpg,docx|max:' . Helper::allowedFileSize(),
            ]);
        } else {
            $request->validate(['job_title' => 'required|max:255',]);
        }

        $data = [
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => auth()->user()->id,
        ];

        // if ($request->hasFile('attachment') && in_array($request->attachment->getClientMimeType(), Helper::allowedMimeTypes())) {
        //     $current_timestamp = Carbon::now()->timestamp;
        //     $name = $current_timestamp . '-' . $request->attachment->getClientOriginalName();
        //     // $request->attachment->storeAs('images/applications/' . $employee->folder_name, $name, 'public');
        //     $request->attachment->storeAs($this->storeAsPath($employee->folder_name), $name, 'public');
        //     $data['attachment'] = $name;
        //     $data['file_ext'] = $request->attachment->getClientOriginalExtension();

        //     if ($workHistory->attachment) {
        //         Storage::delete(DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $employee->folder_name . DIRECTORY_SEPARATOR . $workHistory->attachment);
        //     }
        // }
        if ($request->hasFile('attachment')) {
            $data['attachment'] = Helper::uploadImage($request, 'attachment', $employee->folder_name);
            if ($workHistory->attachment) Helper::deleteImage($employee->folder_name, $workHistory->attachment);
        }

        return $workHistory->update($data) ? 'success' : 'error';
    }

    private function insertFields($request)
    {
        $club_id = auth()->user()->type < config('constants.roles.user') ? $request['club_id'] : auth()->user()->club_id;
        $validatedAttributes = [];
        $validatedAttributes['type_of_contract_id'] = $request['type_of_contract_id'];
        $validatedAttributes['group_id'] = $request['group_id']; // not in dom
        $validatedAttributes['club_id'] = $club_id;
        $validatedAttributes['department_id'] = $request['department_id'];
        $validatedAttributes['job_type_id'] = $request['job_type_id'];

        $validatedAttributes['name'] = $request['name'];
        $validatedAttributes['employee_number'] = $request['employee_number'];
        $validatedAttributes['grade'] = $request['grade']; // not in dom
        $validatedAttributes['cnic'] = $request['cnic'];
        $validatedAttributes['dob'] = $request['dob'];
        $validatedAttributes['dob_in_words'] = $request['dob_in_words'];
        $validatedAttributes['place_of_birth'] = $request['place_of_birth'];
        $validatedAttributes['father_name'] = $request['father_name'];
        $validatedAttributes['father_profession'] = $request['father_profession'];
        $validatedAttributes['email'] = $request['email'];
        $validatedAttributes['gender'] = $request['gender'];
        $validatedAttributes['years_of_experience'] = $request['years_of_experience'];
        $validatedAttributes['phone_number'] = $request['phone_number'];
        $validatedAttributes['photograph'] = $request['photograph'];
        $validatedAttributes['appointment_date'] = $request['appointment_date'];
        $validatedAttributes['appointment'] = $request['appointment'];

        $validatedAttributes['joining_date'] = $request['joining_date']; // not in dom
        $validatedAttributes['contract_end_date'] = $request['contract_end_date'];
        $validatedAttributes['retirement_date'] = $request['retirement_date'];
        $validatedAttributes['current_salary'] = $request['current_salary']; // not in dom
        $validatedAttributes['previous_salary'] = $request['previous_salary']; // not in dom

        // armed forces fields
        $validatedAttributes['post'] = $request['post'];
        $validatedAttributes['rank'] = $request['rank'];
        $validatedAttributes['arm'] = $request['arm'];
        $validatedAttributes['last_appointment'] = $request['last_appointment'];
        $validatedAttributes['enrollment_date'] = $request['enrollment_date'];
        $validatedAttributes['sos_date'] = $request['sos_date'];
        $validatedAttributes['sod_date'] = $request['sod_date'];
        // Misc fields
        $validatedAttributes['height'] = $request['height'];
        $validatedAttributes['religion'] = $request['religion'];
        $validatedAttributes['sect'] = $request['sect'];
        $validatedAttributes['caste'] = $request['caste'];
        $validatedAttributes['service_period'] = $request['service_period']; // not in dom
        $validatedAttributes['referee_name'] = $request['referee_name'];
        $validatedAttributes['referee_address'] = $request['referee_address'];
        // address fields
        $validatedAttributes['address01'] = $request['address01'];
        $validatedAttributes['street_mohallah'] = $request['street_mohallah'];
        $validatedAttributes['city'] = $request['city'];
        $validatedAttributes['tehsil'] = $request['tehsil'];
        $validatedAttributes['district'] = $request['district'];
        $validatedAttributes['post_office'] = $request['post_office'];
        $validatedAttributes['police_station'] = $request['police_station'];
        $validatedAttributes['railway_station'] = $request['railway_station'];
        $validatedAttributes['bus_stop'] = $request['bus_stop'];
        return $validatedAttributes;
    }

    public function validateStaffAuth($club_id, $job_type_id)
    {
        StaffAuthorization::where('club_id', '=', $club_id)
            ->where('job_type_id', '=', $job_type_id)
            ->get();
    }

    public function storeAsPath($folder_name)
    {
        return 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $folder_name;
    }


    public function search(Request $request)
    {
        $cnic = $request->cnic;
        $application = null;
        $success = false;
        $id = $request->id;

        if ($cnic && $id) {
            $application = Employee::where('cnic', '=', $cnic)
                ->where('id', '!=', $id)
                ->select('id', 'name')
                ->first();
        } else if ($cnic) {
            $application = Employee::where('cnic', '=', $cnic)
                ->select('id', 'name')
                ->first();
        }

        if ($application) $success = true;

        return Helper::jsonResponse($success, $application);
    }

    public function api(Employee $employee)
    {
        return $employee;
    }
}
