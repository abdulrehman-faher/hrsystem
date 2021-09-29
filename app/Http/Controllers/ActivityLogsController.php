<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogsController extends Controller
{
    public function index()
    {
        // dump(auth()->user()->type);
        // dd(config('constants.roles.user'));

        if (auth()->user()->type == config('constants.roles.user')) {
            return redirect('home')->with('error', 'Not allowed to visit this page');
        }
        $activities = Activity::where('causer_id', 2)
            ->where('description', 'updated')
            ->where('log_name', '!=', 'interviewCandidate')
            ->with('causer', function ($query) {
                return $query->select('id', 'name', 'club_id')
                    ->with('club', function ($query) {
                        $query->select('id', 'title');
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate();
        // return $activities;
        return view('logs.index', compact('activities'));

        if (request()->ajax()) {

            $data = Activity::where('causer_id', 3)
                ->where('description', 'updated')
                ->with('causer', function ($query) {
                    return $query->select('id', 'name', 'club_id')
                        ->with('club', function ($query) {
                            $query->select('id', 'title');
                        });
                })
                ->orderBy('id', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('club', function (Activity $activity) {
                    if ($activity->causer && $activity->causer->club) {
                        return $activity->causer->club->title;
                    }
                    return '';
                    // return  $activity->causer ? 
                })
                ->editColumn('properties_old', function (Activity $activity) {
                    return json_encode($activity->properties['old']);
                })
                ->editColumn('properties_new', function (Activity $activity) {
                    return json_encode($activity->properties['attributes']);
                })
                ->editColumn('causer_id', function (Activity $activity) {
                    return $activity->causer ? $$activity->causer->name : '';
                })
                ->editColumn('club_id', function (Activity $activity) {
                    return $activity->club ? $activity->club->title : '';
                })
                // ->editColumn('created_at', function (Employee $activity) {
                //     return $activity->created_at->format('d/m/Y');
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
        return view('logs.index');
    }
}
