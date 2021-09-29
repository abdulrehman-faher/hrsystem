<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Interview;
use App\Models\InterviewCandidate;
use App\Models\JobType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use DataTables;
use Yajra\DataTables\DataTables;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Interview::select('id', 'title', 'salary_range', 'candidates_required', 'job_type_id', 'interview_date', 'created_at')
                ->whereNull('is_conducted')
                ->orderBy('id', 'desc')
                ->with('jobType:id,title')
                ->get();
            return DataTables::of($data)
                ->editColumn('job_type_id', function (Interview $interview) {
                    if ($interview->job_type_id > 0) {
                        return $interview->jobType ? $interview->jobType->title : '';
                    }
                    return 'All type of Jobs';
                })
                ->editColumn('interview_date', function (Interview $interview) {
                    return Carbon::parse($interview->interview_date)->format('d/m/Y');
                })
                ->editColumn('created_at', function (Interview $interview) {
                    return $interview->created_at->diffForHumans();
                })
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    // $interview_date = date('d-m-Y', $data->interview_date);
                    $button = '<a href="/interviews/' . $id . '/edit" name="edit" class="btn btn-primary edit btn-sm">Edit</a>';
                    $button .= '&nbsp;&nbsp;<a href="/interviews/by-date/' . $id . '" class="view btn btn-success btn-sm">By Date</a>';
                    $button .= '&nbsp;&nbsp<a href="/interviews/' . $id . '/interview" class="view btn btn-secondary btn-sm">Interview</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('interviews.index');
    }

    public function interviewsConducted(Request $request)
    {
        if ($request->ajax()) {
            $data = Interview::select('id', 'title', 'salary_range', 'candidates_required', 'job_type_id', 'interview_date', 'created_at')
                // $data = Interview::select('id', 'title', 'job_type_id', 'interview_date', 'created_at')
                ->where('is_conducted', '=', '1')
                ->orderBy('id', 'desc')
                ->with('jobType:id,title')
                ->get();
            return DataTables::of($data)
                ->editColumn('job_type_id', function (Interview $interview) {
                    if ($interview->job_type_id > 0) {
                        return $interview->jobType ? $interview->jobType->title : '';
                    }
                    return 'All type of Jobs';
                })
                ->editColumn('interview_date', function (Interview $interview) {
                    return Carbon::parse($interview->interview_date)->format('d/m/Y');
                })
                ->editColumn('created_at', function (Interview $interview) {
                    return $interview->created_at->diffForHumans();
                })
                ->addColumn('action', function ($data) {
                    $id = $data->id;
                    $button = '';
                    $button = '<a href="/interviews/' . $id . '/edit" name="edit" id="' . $id . '" class="btn btn-primary edit btn-sm">Edit</a>';
                    $button .= '&nbsp;&nbsp;<a href="/interviews/' . $id . '/show-selected-candidates" id="' . $id . '" class="view btn btn-success btn-sm">Show Candidates</a>';
                    // $button .= '&nbsp;&nbsp<a href="/interviews/' . $id . '/interview" id="' . $id . '" class="view btn btn-secondary btn-sm">Interview</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $data =  Application::select('id', 'name', 'job_type_id', 'years_of_experience', 'created_at', 'referee_name')
                ->where('is_employeed', '=', 0)
                ->where('short_listed', '=', 0)
                ->with('jobType:id,title')
                ->orderBy('id', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('job_type_id', function (Application $application) {
                    return $application->jobType ? $application->jobType->title : '';
                })
                ->editColumn('created_at', function (Application $application) {
                    return $application->created_at->diffForHumans();
                })
                ->addColumn('shortlist', function ($data) {
                    $id = $data->id;
                    return '<div class="form-check"><input type="checkbox" class="form-check-input" value="' . $id . '" id="shortlisted' . $id . '" name="shortlisted[]"></div>';
                    // return $html;
                })
                ->rawColumns(['shortlist'])
                ->make(true);
        }
        // dd('home controller for applications');
        $jobTypes = JobType::latest()->pluck('title', 'id');
        return view('interviews.create', compact('jobTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $validatedAttributes = $this->validateFields();
            $user_id = auth()->user()->id;
            $validatedAttributes['user_id'] = $user_id;
            unset($validatedAttributes['shortlisted']);

            $interview = Interview::create($validatedAttributes);

            foreach ($request->shortlisted as $shortlisted) {
                InterviewCandidate::create([
                    'interview_id' => $interview->id,
                    'application_id' => $shortlisted,
                    'user_id' => $user_id,
                ]);
                Application::where('id', $shortlisted)->update(['short_listed' => 1]);
            }

            DB::commit();
            return redirect()->route('interviews.index')->with('success', 'Interview created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('interviews.index')->with('error', 'Interview creation failed!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function show(Interview $interview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function edit(Interview $interview)
    {
        abort(404);
        // return $interview;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interview $interview)
    {
        //
    }

    public function interview(Interview $interview)
    {

        // $jobType = JobType::where('id', $interview->job_type_id)->pluck('title');
        $jobType = ['All job types'];
        if ($interview->job_type_id > 0) {
            $jobType = JobType::where('id', $interview->job_type_id)->pluck('title');
        }
        $candidates = InterviewCandidate::select('id', 'application_id')
            ->where('interview_id', '=', $interview->id)
            ->with(['application' => function ($query) {
                $query->select('id', 'name', 'years_of_experience', 'job_type_id')->with('jobType:id,title');
            }])
            ->get();
        // return $candidates;
        // return $interview;

        return view('interviews.interview', compact('interview', 'jobType', 'candidates'));
    }

    public function interviewUpdate(Request $request, Interview $interview)
    {
        foreach ($request->application_id as $key => $application_id) {
            $candidate = InterviewCandidate::where('interview_id', '=', $interview->id)
                ->where('application_id', '=', $application_id)
                ->first();
            $candidate->remarks = $request->remarks[$key];
            $candidate->selected = $request->selected[$key];
            $candidate->user_id = auth()->user()->id;
            $candidate->save();
        }

        $interview->is_conducted = 1;
        $interview->save();

        return redirect()->route('interviews.index')
            ->with('success', 'Applicant selected successfully.');
    }

    public function showSelected()
    {
        // $data = InterviewCandidate::select('id', 'interview_id', 'application_id')
        //     ->where('selected', '=', '1')
        //     ->whereNull('is_employeed')
        //     ->with('interview:id,title,interview_date')
        //     ->with('application', function ($query) {
        //         $query->select('id', 'name', 'email', 'phone_number', 'job_type_id')->with('JobType:id,title');
        //     })
        //     ->orderBy('id', 'desc')
        //     // ->groupBy('application_id')
        //     ->distinct()
        //     ->get();
        // return $data;
        if (request()->ajax()) {
            $data = InterviewCandidate::select('id', 'interview_id', 'application_id')
                ->where('selected', '=', '1')
                ->whereNull('is_employeed')
                ->with('interview:id,title,interview_date')
                ->with('application', function ($query) {
                    $query->select('id', 'name', 'email', 'phone_number', 'job_type_id')->with('JobType:id,title');
                })
                ->orderBy('id', 'desc')
                ->groupBy('application_id')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function (InterviewCandidate $candidate) {
                    return $candidate->application->name;
                })
                ->editColumn('email', function (InterviewCandidate $candidate) {
                    return $candidate->application->email;
                })
                ->editColumn('phone_number', function (InterviewCandidate $candidate) {
                    return $candidate->application->phone_number;
                })
                ->editColumn('job_type_id', function (InterviewCandidate $candidate) {
                    return $candidate->application->job_type_id ? $candidate->application->jobType->title : '';
                })
                ->editColumn('title', function (InterviewCandidate $candidate) {
                    return $candidate->interview->title;
                })
                ->editColumn('interview_date', function (InterviewCandidate $candidate) {
                    $interview_date = $candidate->interview->interview_date ? Carbon::parse($candidate->interview->interview_date)->format('d/m/Y') : null;
                    return $interview_date;
                })
                ->addColumn('action', function (InterviewCandidate $candidate) {
                    $id = $candidate->id;
                    $button = '<a href="' . route("getApplicantToEmployee", $candidate->application->id) . '" name="edit" id="edit_' . $id . '" class="btn btn-primary edit btn-sm">Mark Employee</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('interviews.selected');
    }

    public function selectedCount()
    {
        if (request()->ajax()) {
            return InterviewCandidate::where('selected', '1')->whereNull('is_employeed')->count();
        }

        abort(404);
    }

    public function showSelectedCandidates(Interview $interview)
    {
        $interview = Interview::where('id', $interview->id)
            ->with('candidates', function ($query) {
                // $query->select('id', 'application_id', 'selected', 'is_employeed'); //->with('jobType:id,title');
                $query->select('id', 'interview_id', 'application_id', 'is_employeed', 'selected', 'remarks')
                    ->with(['application' => function ($query) {
                        $query->select('id', 'name', 'years_of_experience', 'job_type_id')->with('jobType:id,title');
                    }]);
            })
            ->first();
        // return $interview;
        $jobType = ['All job types'];
        if ($interview->job_type_id > 0) {
            $jobType = JobType::where('id', $interview->job_type_id)->pluck('title');
        }
        // $candidates = InterviewCandidate::select('id', 'application_id')
        //     ->where('interview_id', '=', $interview->id)
        //     ->with(['application' => function ($query) {
        //         $query->select('id', 'name', 'years_of_experience', 'job_type_id')->with('jobType:id,title');
        //     }])
        //     ->get();
        // return $candidates;
        // return $interview;

        return view('interviews.showSelectedCandidates', compact('interview', 'jobType'));
        // return view('interviews.showSelectedCandidates', compact('interview'));
    }

    private function validateFields()
    {
        return  request()->validate([
            'title' => 'nullable',
            'job_type_id' => 'required',
            'candidates_required' => 'nullable|max:255',
            'salary_range' => 'nullable|max:255',
            'interview_date' => ['required', 'date'],
            'shortlisted' => ['required', 'min:1'],
        ]);
    }

    public function byDate(Request $request, Interview $interview)
    {
        $interviews = Interview::select('id', 'job_type_id', 'interview_date', 'candidates_required', 'salary_range')
            ->where('interview_date', '=', $interview->interview_date)
            ->with(['candidates' => function ($query) {
                $query->select('id', 'application_id', 'remarks', 'interview_id')
                    ->with('application:id,name,father_name,education,years_of_experience,phone_number,mobile_no,referee_name');
                // ->with('application');
            }])
            ->with('jobType:id,title')
            ->orderBy('id', 'desc')
            ->get();

        // return $interviews;
        if ($request->exists('print')) {
            return view('interviews.bydateprint', compact('interviews'));
        }
        return view('interviews.bydate', compact('interviews'));
    }
}
