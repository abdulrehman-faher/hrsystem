<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\EducationDetail;
use App\Models\JobType;
use App\Models\Application;
use App\Models\Test;
use App\Models\TypeOfContract;
use App\Models\WorkHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {

        // $data =  Application::select('id', 'name', 'father_name', 'job_type_id', 'cnic', 'created_at')
        //     ->where('is_employeed', '=', '0')
        //     ->with('jobType', function ($query) {
        //         $query->select('id', 'title');
        //     })
        //     ->orderBy('id', 'desc')
        //     ->get();
        // return $data;

        if ($request->ajax()) {
            $data =  Application::select('id', 'name', 'father_name', 'job_type_id', 'cnic', 'created_at')
                ->where('is_employeed', '=', '0')
                ->with('jobType', function ($query) {
                    $query->select('id', 'title');
                })
                ->orderBy('id', 'desc')
                ->get();
            return DataTables::of($data)
                ->editColumn('job_type_id', function (Application $application) {
                    return $application->jobType ? $application->jobType->title : '';
                })
                ->editColumn('created_at', function (Application $application) {
                    return $application->created_at->format('d/m/Y');
                })
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    $html = '<div class="dropdown">
                            <button role="button" type="button" class="btn" data-toggle="dropdown">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/applications/' . $id . '/edit"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item" href="/applications/' . $id . '"><i class="fas fa-eye"></i> View</a>
                            </div>
                        </div>';
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('application.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $folder = Str::snake('Muhammad Usman Sharif');
        // $folder = 1 . '_' . $folder;
        // dd($folder);
        // $genders = ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'];
        $jobTypes = JobType::latest()->pluck('title', 'id');
        // $typeOfContract = TypeOfContract::latest()->pluck('title', 'id');
        // dd($jobTypes->toArray());
        // return view('application.create', compact('genders', 'jobTypes', 'typeOfContract'));
        return view('application.create', compact('jobTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fields = $this->validateApplicationFields();

        Application::createApplication($fields, $request);
        return redirect()->route('applications.index')
            ->with('success', 'Application created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        $imageExtension = ['jpeg', 'gif', 'png', 'bmp', 'jpg'];
        $folder_name = $application->folder_name;

        $dir = storage_path('/app/public/images/applications/' . $folder_name . '/');
        // dd($dir);
        $imageFiles = [];
        $otherFiles = [];
        if (file_exists($dir)) {
            foreach (array_diff(scandir($dir, 1), ['.', '..']) as $filename) {
                if (in_array(File::extension($filename), $imageExtension)) {
                    $imageFiles[] = $filename;
                } else {
                    $otherFiles[] = $filename;
                }
            }
        }


        // return $imageFiles;
        $workHistories = WorkHistory::where('application_id', $application->id)->orderBy('id', 'desc')->get();
        $jobType = JobType::where('id', '=', $application->job_type_id)->pluck('title');
        $typeOfContract = TypeOfContract::where('id', '=', $application->type_of_contract_id)->pluck('title');

        return view('application.show', compact('application', 'jobType', 'typeOfContract', 'imageFiles', 'otherFiles', 'workHistories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        $genders = ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'];
        $jobTypes = JobType::latest()->pluck('title', 'id');
        $typeOfContract = TypeOfContract::latest()->pluck('title', 'id');
        $workHistories = WorkHistory::where('application_id', $application->id)->orderBy('id', 'desc')->get();

        return view('application.edit', compact('application', 'genders', 'jobTypes', 'typeOfContract', 'workHistories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {

        // $validatedFields = $this->validateApplicationFields($application);
        // $fields = array_merge($validatedFields, $this->insertFields($request));
        $fields = $this->validateApplicationFields($application);

        return $application->update($fields) ? redirect()->route('applications.index')->with('success', $application->name . ' Updated successfully!') : redirect()->route('applications.index')->with('error', $application->name . ' Updated Failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }

    private function validateApplicationFields($application = null)
    {
        return request()->validate([
            'name' => 'required|max:250',
            'cnic' => [
                'required',
                'min:15',
                'max:255',
                $application ? Rule::unique('applications')->ignore($application->id) : 'unique:applications',
            ],
            'club_id' => 'nullable|exists:clubs,id',
            'job_type_id' => 'required|exists:job_types,id',
            'type_of_contract_id' => 'nullable|exists:type_of_contract,id',
            'years_of_experience' => 'nullable|max:255',
            'dob' => 'nullable|date_format:Y-m-d',
            'dob_in_words' => 'nullable|max:255',
            'place_of_birth' => 'nullable|max:255',
            'email' => 'nullable|email',
            'phone_number' => 'nullable|max:255',
            'mobile_no' => 'nullable|max:255',
            'cv' => 'nullable|max:1024',
            'referred_by_name' => 'nullable|max:255',
            'referred_by_id' => 'nullable|exists:employees,id',
            'father_name' => 'nullable|max:255',
            'father_profession' => 'nullable|max:255',
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'height' => 'nullable|max:255',
            'religion' => 'nullable|max:255',
            'sect' => 'nullable|max:255',
            'caste' => 'nullable|max:255',
            'referee_name' => 'nullable|max:255',
            'education' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            // 'service_period' => 'nullable|max:255',

            'post' => 'nullable|max:255',
            'rank' => 'nullable|max:255',
            'arm' => 'nullable|max:255',
            'last_appointment' => 'nullable|max:255',
            'enrollment_date' => 'nullable|date_format:Y-m-d',
            'sos_date' => 'nullable|date_format:Y-m-d',
            'sod_date' => 'nullable|date_format:Y-m-d',


            'street_mohallah' => 'nullable|max:255',
            'address01' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'tehsil' => 'nullable|max:255',
            'district' => 'nullable|max:255',
            'post_office' => 'nullable|max:255',
            'police_station' => 'nullable|max:255',
            'railway_station' => 'nullable|max:255',
            'bus_stop' => 'nullable|max:255',
            'remarks' => 'nullable|max:500',

        ], ['date_format' => 'Invalid date',]);
    }

    private function insertFields($request, $application = null)
    {
        // $validatedAttributes = [];
        // $validatedAttributes['place_of_birth'] = $request['place_of_birth'];
        // $validatedAttributes['father_name'] = $request['father_name'];
        // $validatedAttributes['father_profession'] = $request['father_profession'];
        // $validatedAttributes['email'] = $request['email'];
        // $validatedAttributes['gender'] = $request['gender'];
        // $validatedAttributes['dob'] = $request['dob'];
        // $validatedAttributes['dob_in_words'] = $request['dob_in_words'];
        // $validatedAttributes['job_type_id'] = $request['job_type_id'];
        // $validatedAttributes['years_of_experience'] = $request['years_of_experience'];
        // $validatedAttributes['phone_number'] = $request['phone_number'];
        // $validatedAttributes['type_of_contract_id'] = $request['type_of_contract_id'];
        // // armed forces fields
        // $validatedAttributes['post'] = $request['post'];
        // $validatedAttributes['rank'] = $request['rank'];
        // $validatedAttributes['arm'] = $request['arm'];
        // $validatedAttributes['last_appointment'] = $request['last_appointment'];
        // $validatedAttributes['enrollment_date'] = $request['enrollment_date'];
        // $validatedAttributes['sos_date'] = $request['sos_date'];
        // $validatedAttributes['sod_date'] = $request['sod_date'];
        // // Misc fields
        // $validatedAttributes['height'] = $request['height'];
        // $validatedAttributes['religion'] = $request['religion'];
        // $validatedAttributes['sect'] = $request['sect'];
        // $validatedAttributes['caste'] = $request['caste'];
        // $validatedAttributes['service_period'] = $request['service_period'];
        // $validatedAttributes['referee_name'] = $request['referee_name'];
        // $validatedAttributes['referee_address'] = $request['referee_address'];
        // // address fields
        // $validatedAttributes['address01'] = $request['address01'];
        // $validatedAttributes['street_mohallah'] = $request['street_mohallah'];
        // $validatedAttributes['city'] = $request['city'];
        // $validatedAttributes['tehsil'] = $request['tehsil'];
        // $validatedAttributes['district'] = $request['district'];
        // $validatedAttributes['post_office'] = $request['post_office'];
        // $validatedAttributes['police_station'] = $request['police_station'];
        // $validatedAttributes['railway_station'] = $request['railway_station'];
        // $validatedAttributes['bus_stop'] = $request['bus_stop'];
        // return $validatedAttributes;


    }



    // protected function allowedMimeTypes()
    // {
    //     return [
    //         'image/jpeg',
    //         'image/gif',
    //         'image/png',
    //         'image/bmp',
    //         'application/pdf',
    //         'application/msword',
    //         'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    //     ];
    // }

    public function addEducation(Request $request, Application $application)
    {
        $user_id = auth()->user()->id;

        $data = [
            'application_id' => $application->id,
            'title' => $request->title,
            'institute_name' => $request->institute_name,
            'marks_obtained' => $request->marks_obtained,
            'division_grade' => $request->division_grade,
            'year_completed' => $request->year_completed,
            'campus_address' => $request->campus_address,
            'user_id' => $user_id,
        ];

        if ($request->hasFile('education_image') && in_array($request->education_image->getClientMimeType(), Helper::allowedMimeTypes())) {
            $current_timestamp = Carbon::now()->timestamp;
            $name = $current_timestamp . '-' . $request->education_image->getClientOriginalName();
            $request->education_image->storeAs('images/applications/' . $application->folder_name, $name, 'public');
            $data['attachment'] = $name;
            $data['file_ext'] = $request->education_image->getClientOriginalExtension();
        }

        return EducationDetail::create($data) ? 'success' : 'error';
    }

    public function updateEducation(Request $request, Application $application, EducationDetail $education)
    {
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

        if ($request->hasFile('education_image') && in_array($request->education_image->getClientMimeType(), Helper::allowedMimeTypes())) {
            $current_timestamp = Carbon::now()->timestamp;
            $name = $current_timestamp . '-' . $request->education_image->getClientOriginalName();
            $request->education_image->storeAs('images/applications/' . $application->folder_name, $name, 'public');
            $data['attachment'] = $name;
            $data['file_ext'] = $request->education_image->getClientOriginalExtension();

            if ($education->attachment) {
                Storage::delete('/public/images/applications/' . $application->folder_name . '/' . $education->attachment);
            }
        }

        return $education->update($data) ? 'success' : 'error';
    }

    public function addWorkHistory(Request $request, Application $application)
    {
        $data = [
            'application_id' => $application->id,
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => auth()->user()->id,
        ];

        if ($request->hasFile('attachment') && in_array($request->attachment->getClientMimeType(), Helper::allowedMimeTypes())) {
            $current_timestamp = Carbon::now()->timestamp;
            $name = $current_timestamp . '-' . $request->attachment->getClientOriginalName();
            $request->attachment->storeAs('images/applications/' . $application->folder_name, $name, 'public');
            $data['attachment'] = $name;
            $data['file_ext'] = $request->attachment->getClientOriginalExtension();
        }

        return WorkHistory::create($data) ? 'success' : 'error';
    }

    public function updateWorkHistory(Request $request, Application $application, WorkHistory $workHistory)
    {

        $data = [
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => auth()->user()->id,
        ];

        if ($request->hasFile('attachment') && in_array($request->attachment->getClientMimeType(), Helper::allowedMimeTypes())) {
            $current_timestamp = Carbon::now()->timestamp;
            $name = $current_timestamp . '-' . $request->attachment->getClientOriginalName();
            $request->attachment->storeAs('images/applications/' . $application->folder_name, $name, 'public');
            $data['attachment'] = $name;
            $data['file_ext'] = $request->attachment->getClientOriginalExtension();

            if ($workHistory->attachment) {
                Storage::delete('/public/images/applications/' . $application->folder_name . '/' . $workHistory->attachment);
            }
        }

        return $workHistory->update($data) ? 'success' : 'error';
        // dump('reached updateWorkHistory');
        // dump($request->all());
        // dump($workHistory->toArray());
        // dd($application->toArray());
    }

    private function folderName($applicant_id, $applicant_name)
    {
        return $applicant_id . '_' . Carbon::now()->timestamp  . '_' . Str::snake($applicant_name);
    }

    public function search(Request $request)
    {
        $cnic = $request->cnic;
        $cnic_without_hashes = str_replace('-', '', $cnic);
        // return ['cnic' => $cnic, 'cnic_without_hashes' => $cnic_without_hashes];
        // $application = null;
        if ($cnic) {
            $application = Application::where('cnic', '=', $cnic)
                ->orWhere('cnic', $cnic_without_hashes)
                ->select('id', 'name')
                ->first();
        }
        return $application;
    }

    public function allApplicants()
    {
        if (request()->ajax()) {
            // $data =  Application::select('id', 'name', 'father_name', 'job_type_id', 'cnic', 'created_at')
            $data =  Application::select('id', 'name', 'father_name', 'education', 'job_type_id', 'cnic', 'years_of_experience', 'phone_number', 'mobile_no', 'referee_name', 'created_at')
                // ->where('is_employeed', '=', '0')
                ->with('jobType', function ($query) {
                    $query->select('id', 'title');
                })
                ->orderBy('id', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('job_type_id', function (Application $application) {
                    return $application->jobType ? $application->jobType->title : '';
                })
                ->editColumn('created_at', function (Application $application) {
                    return $application->created_at->format('d/m/Y');
                })
                ->editColumn('phone_number', function (Application $application) {
                    // $mobile_no = '42134123,243432';
                    $mobile_nos = array_map('trim', explode(",", $application->mobile_no));
                    $mobile_nos = array_filter($mobile_nos, fn ($value) => !is_null($value) && $value !== '');
                    $mobile_count = count($mobile_nos);

                    $phone_numbers = array_map('trim', explode(",", $application->phone_number));
                    $phone_numbers = array_filter($phone_numbers, fn ($value) => !is_null($value) && $value !== '');
                    $phone_count = count($phone_numbers);

                    $html = '';
                    foreach ($mobile_nos as $key => $value) {
                        $html .= '<i class="fas fa-mobile-alt text-pink"></i> ' . $value;
                        if ($key != ($mobile_count - 1)) $html .= '<br />';
                    }

                    if ($mobile_count) $html .= '<br />';

                    foreach ($phone_numbers as $key => $value) {
                        $html .= '<i class="fas fa-phone text-primary"></i> ' . $value;
                        if ($key != ($phone_count - 1)) $html .= '<br />';
                    }

                    return $html;
                })
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    $html = '<div class="dropdown">
                            <button role="button" type="button" class="btn text-gray" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/applications/' . $id . '/edit"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item" href="/applications/' . $id . '"><i class="fas fa-eye"></i> View</a>
                            </div>
                        </div>';
                    return $html;
                })
                ->rawColumns(['action', 'phone_number'])
                ->make(true);
        }

        return abort(404);
    }

    public function employeed()
    {
        if (request()->ajax()) {
            // $data =  Application::select('id', 'name', 'father_name', 'job_type_id', 'cnic', 'created_at')
            $data =  Application::select('id', 'name', 'father_name', 'education', 'job_type_id', 'cnic', 'years_of_experience', 'phone_number', 'mobile_no', 'referee_name', 'created_at')
                ->where('is_employeed', '=', '1')
                // ->where('short_listed', '1')
                ->with('jobType', function ($query) {
                    $query->select('id', 'title');
                })
                ->orderBy('id', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('job_type_id', function (Application $application) {
                    return $application->jobType ? $application->jobType->title : '';
                })
                ->editColumn('created_at', function (Application $application) {
                    return $application->created_at->format('d/m/Y');
                })
                ->editColumn('phone_number', function (Application $application) {
                    // $mobile_no = '42134123,243432';
                    $mobile_nos = array_map('trim', explode(",", $application->mobile_no));
                    $mobile_nos = array_filter($mobile_nos, fn ($value) => !is_null($value) && $value !== '');
                    $mobile_count = count($mobile_nos);

                    $phone_numbers = array_map('trim', explode(",", $application->phone_number));
                    $phone_numbers = array_filter($phone_numbers, fn ($value) => !is_null($value) && $value !== '');
                    $phone_count = count($phone_numbers);

                    $html = '';
                    foreach ($mobile_nos as $key => $value) {
                        $html .= '<i class="fas fa-mobile-alt text-pink"></i> ' . $value;
                        if ($key != ($mobile_count - 1)) $html .= '<br />';
                    }

                    if ($mobile_count) $html .= '<br />';

                    foreach ($phone_numbers as $key => $value) {
                        $html .= '<i class="fas fa-phone text-primary"></i> ' . $value;
                        if ($key != ($phone_count - 1)) $html .= '<br />';
                    }

                    return $html;
                })
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    $html = '<div class="dropdown">
                            <button role="button" type="button" class="btn text-gray" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/applications/' . $id . '/edit"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item" href="/applications/' . $id . '"><i class="fas fa-eye"></i> View</a>
                            </div>
                        </div>';
                    return $html;
                })
                ->rawColumns(['action', 'phone_number'])
                ->make(true);
        }

        return abort(404);
    }

    public function shortListed()
    {
        if (request()->ajax()) {
            // $data =  Application::select('id', 'name', 'father_name', 'job_type_id', 'cnic', 'created_at')
            $data =  Application::select('id', 'name', 'father_name', 'education', 'job_type_id', 'cnic', 'years_of_experience', 'phone_number', 'mobile_no', 'referee_name', 'created_at')
                // ->where('is_employeed', '=', '0')
                ->where('short_listed', '1')
                ->with('jobType', function ($query) {
                    $query->select('id', 'title');
                })
                ->orderBy('id', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('job_type_id', function (Application $application) {
                    return $application->jobType ? $application->jobType->title : '';
                })
                ->editColumn('created_at', function (Application $application) {
                    return $application->created_at->format('d/m/Y');
                })
                ->editColumn('phone_number', function (Application $application) {
                    // $mobile_no = '42134123,243432';
                    $mobile_nos = array_map('trim', explode(",", $application->mobile_no));
                    $mobile_nos = array_filter($mobile_nos, fn ($value) => !is_null($value) && $value !== '');
                    $mobile_count = count($mobile_nos);

                    $phone_numbers = array_map('trim', explode(",", $application->phone_number));
                    $phone_numbers = array_filter($phone_numbers, fn ($value) => !is_null($value) && $value !== '');
                    $phone_count = count($phone_numbers);

                    $html = '';
                    foreach ($mobile_nos as $key => $value) {
                        $html .= '<i class="fas fa-mobile-alt text-pink"></i> ' . $value;
                        if ($key != ($mobile_count - 1)) $html .= '<br />';
                    }

                    if ($mobile_count) $html .= '<br />';

                    foreach ($phone_numbers as $key => $value) {
                        $html .= '<i class="fas fa-phone text-primary"></i> ' . $value;
                        if ($key != ($phone_count - 1)) $html .= '<br />';
                    }

                    return $html;
                })
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    $html = '<div class="dropdown">
                            <button role="button" type="button" class="btn text-gray" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/applications/' . $id . '/edit"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item" href="/applications/' . $id . '"><i class="fas fa-eye"></i> View</a>
                            </div>
                        </div>';
                    return $html;
                })
                ->rawColumns(['action', 'phone_number'])
                ->make(true);
        }

        return abort(404);
    }

    public function remaining()
    {
        if (request()->ajax()) {
            $data =  Application::select('id', 'name', 'father_name', 'education', 'job_type_id', 'cnic', 'years_of_experience', 'phone_number', 'mobile_no', 'referee_name', 'created_at')
                ->where('is_employeed', '=', '0')
                ->where('short_listed', '0')
                ->where('is_employeed', '0')
                ->with('jobType', function ($query) {
                    $query->select('id', 'title');
                })
                ->orderBy('id', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('job_type_id', function (Application $application) {
                    return $application->jobType ? $application->jobType->title : '';
                })
                ->editColumn('created_at', function (Application $application) {
                    return $application->created_at->format('d/m/Y');
                })
                ->editColumn('phone_number', function (Application $application) {
                    // $mobile_no = '42134123,243432';
                    $mobile_nos = array_map('trim', explode(",", $application->mobile_no));
                    $mobile_nos = array_filter($mobile_nos, fn ($value) => !is_null($value) && $value !== '');
                    $mobile_count = count($mobile_nos);

                    $phone_numbers = array_map('trim', explode(",", $application->phone_number));
                    $phone_numbers = array_filter($phone_numbers, fn ($value) => !is_null($value) && $value !== '');
                    $phone_count = count($phone_numbers);

                    $html = '';
                    foreach ($mobile_nos as $key => $value) {
                        $html .= '<i class="fas fa-mobile-alt text-pink"></i> ' . $value;
                        if ($key != ($mobile_count - 1)) $html .= '<br />';
                    }

                    if ($mobile_count) $html .= '<br />';

                    foreach ($phone_numbers as $key => $value) {
                        $html .= '<i class="fas fa-phone text-primary"></i> ' . $value;
                        if ($key != ($phone_count - 1)) $html .= '<br />';
                    }

                    return $html;
                })
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    $html = '<div class="dropdown">
                            <button role="button" type="button" class="btn text-gray" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/applications/' . $id . '/edit"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item" href="/applications/' . $id . '"><i class="fas fa-eye"></i> View</a>
                            </div>
                        </div>';
                    return $html;
                })
                ->rawColumns(['action', 'phone_number'])
                ->make(true);
        }

        return abort(404);
    }

    public function uploadApplicantsGet(Request $request)
    {
        return view('application.uploadApplicants');
    }

    public function uploadApplicantsPost(Request $request)
    {
        set_time_limit(0);
        ini_set('max_execution_time', 600); //10 minutes

        $request->validate(
            ['file' => 'required|mimes:csv,txt'],
            ['file.mimes' => 'The file must be a file of type: csv or txt.']
        );

        $file = file($request->file->getRealPath());
        $data_with_headers = array_map('str_getcsv', $file);
        $data = array_slice($data_with_headers, 1);
        $no_of_records = count($data);

        // $input = array_map("unserialize", array_unique(array_map("serialize", $data)));
        // $d2 = array_unique($data, SORT_REGULAR);

        foreach ($data as $row) {
            $application = Application::updateOrCreate([
                'cnic' => $row[0],
            ], [
                'name' => trim($row[1]),
                'father_name' => trim($row[2]),
                'education' => trim($row[3]),
                'years_of_experience' => trim($row[4]),
                'phone_number' => trim($row[5]),
                'mobile_no' => trim($row[6]),
                'email' => trim($row[7]),
                'referee_name' => trim($row[8]),
                'address' => trim($row[9]),
            ]);
            // $application = Application::create([
            //     'cnic' => $row[0],
            //     'name' => trim($row[1]),
            //     'father_name' => trim($row[2]),
            //     'education' => trim($row[3]),
            //     'years_of_experience' => trim($row[4]),
            //     'phone_number' => trim($row[5]),
            //     'mobile_no' => trim($row[6]),
            //     'email' => trim($row[7]),
            //     'referee_name' => trim($row[8]),
            //     'address' => trim($row[9]),
            // ]);

            // update folder_name
            $folder_name = Helper::createFolderName($application->id, $application->name);
            $application->folder_name = $folder_name;
            $application->save();

            //create an empty folder
            $path = 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $folder_name;
            Storage::makeDirectory($path);
        }

        return redirect()->route('applications.index')
            ->with('success', $no_of_records . ' records added successfully!');
    }

    public function downloadSampleFile()
    {
        $file = storage_path('samples' . DIRECTORY_SEPARATOR . 'template_for_download.csv');
        if (!File::exists($file)) {
            return response()->json(['success' => false, 'message' => 'invalid file']);
        }

        return response()->download($file);
    }
}
