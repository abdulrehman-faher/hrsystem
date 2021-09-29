<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {

        $this->validateUser();


        // if (request()->ajax()) {
        //     $users = [];
        //     if (request()->user()->type <= config('constants.roles.super_admin')) {
        //         $users = User::select('id', 'name', 'email', 'active', 'type', 'club_id', 'employee_id', 'created_by')
        //             ->where('id', '!=', 1)
        //             ->with(['club:id,title', 'creator:id,name'])
        //             ->orderBy('id', 'DESC')
        //             ->get();
        //     } else if (request()->user()->type == config('constants.roles.admin')) {
        //         $users = User::select('id', 'name', 'email', 'active', 'type', 'club_id', 'employee_id', 'created_by')
        //             ->where('id', '!=', 1)
        //             ->where('club_id', request()->user()->club_id)
        //             ->with(['club:id,title', 'creator:id,name'])
        //             ->orderBy('id', 'DESC')
        //             ->get();
        //     }
        //     return DataTables::of($users)
        //         ->addIndexColumn()
        //         ->editColumn('club_id', function (User $user) {
        //             // return $user->date_of_offence ? Helper::parseDate($user->date_of_offence, 'd/m/Y') : '';
        //             return $user->club ? $user->club->title : '';
        //         })
        //         ->editColumn('type', function (User $user) {
        //             foreach (config('constants.roles') as $key => $value) {
        //                 if ($value == $user->type) return Helper::normalCase($key);
        //             }
        //             return '';
        //         })
        //         ->editColumn('active', function (User $user) {
        //             return $user->active ? '<i class="fas fa-check"></i>' : '<i class="far fa-times-circle"></i>';
        //         })
        //         ->editColumn('created_by', function (User $user) {
        //             return $user->creator ? $user->creator->name : '';
        //         })
        //         ->addColumn('action', function (User $user) {
        //             // $html = '<button onclick="editMedical(' . json_decode($user) . ', "' . $user->employee_id . '", "' . $user->employee->folder_name . '")" class="btn btn-primary edit btn-sm">Edit</button>';
        //             $html = "<button class='btn btn-warning edit btn-sm mr-3'><i class='fa fa-pencil'></i> Edit</button>";
        //             $html .= '<a href="" class="view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
        //             return $html;
        //         })
        //         ->rawColumns(['action', 'active'])
        //         ->make(true);
        // }

        return view('users.index');
    }

    public function show(User $user)
    {
        return $user;
    }

    public function activeUsers()
    {
        $this->validateUser();
        if (request()->ajax()) {
            $users = [];
            if (request()->user()->type <= config('constants.roles.super_admin')) {
                $users = User::select('id', 'name', 'email', 'active', 'type', 'club_id', 'employee_id', 'created_by')
                    ->where('id', '!=', 1)
                    ->where('active', '=', 1)
                    ->with(['club:id,title', 'creator:id,name'])
                    ->orderBy('id', 'DESC')
                    ->get();
            } else if (request()->user()->type == config('constants.roles.admin')) {
                $users = User::select('id', 'name', 'email', 'active', 'type', 'club_id', 'employee_id', 'created_by')
                    ->where('id', '!=', 1)
                    ->where('active', '=', 1)
                    ->where('club_id', request()->user()->club_id)
                    ->with(['club:id,title', 'creator:id,name'])
                    ->orderBy('id', 'DESC')
                    ->get();
            }
            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('club_id', function (User $user) {
                    // return $user->date_of_offence ? Helper::parseDate($user->date_of_offence, 'd/m/Y') : '';
                    return $user->club ? $user->club->title : '';
                })
                ->editColumn('type', function (User $user) {
                    foreach (config('constants.roles') as $key => $value) {
                        if ($value == $user->type) return Helper::normalCase($key);
                    }
                    return '';
                })
                ->editColumn('active', function (User $user) {
                    // return $user->active ? '<i class="fas fa-check"></i>' : '<i class="far fa-times-circle"></i>';
                    return '<div class="form-check"><input type="checkbox" class="form-check-input" checked value="' . $user->id . '" id="active_' . $user->id . '" name="active"></div>';
                })
                ->editColumn('created_by', function (User $user) {
                    return $user->creator ? $user->creator->name : '';
                })
                ->addColumn('action', function (User $user) {
                    $html = "<button class='btn btn-warning edit btn-sm mr-3'><i class='fa fa-pencil'></i> Edit</button>";
                    $html .= '<a href="' . route('users.show', ['user' => $user]) . '" class="view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $html;
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
        }
    }

    public function inactiveUsers()
    {
        $this->validateUser();
        if (request()->ajax()) {
            $users = [];
            if (request()->user()->type <= config('constants.roles.super_admin')) {
                $users = User::select('id', 'name', 'email', 'active', 'type', 'club_id', 'employee_id', 'created_by')
                    ->where('id', '!=', 1)
                    ->where('active', '=', 0)
                    ->with(['club:id,title', 'creator:id,name'])
                    ->orderBy('id', 'DESC')
                    ->get();
            } else if (request()->user()->type == config('constants.roles.admin')) {
                $users = User::select('id', 'name', 'email', 'active', 'type', 'club_id', 'employee_id', 'created_by')
                    ->where('id', '!=', 1)
                    ->where('active', '=', 0)
                    ->where('club_id', request()->user()->club_id)
                    ->with(['club:id,title', 'creator:id,name'])
                    ->orderBy('id', 'DESC')
                    ->get();
            }
            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('club_id', function (User $user) {
                    return $user->club ? $user->club->title : '';
                })
                ->editColumn('type', function (User $user) {
                    foreach (config('constants.roles') as $key => $value) {
                        if ($value == $user->type) return Helper::normalCase($key);
                    }
                    return '';
                })
                ->editColumn('active', function (User $user) {
                    // return $user->active ? '<i class="fas fa-check"></i>' : '<i class="far fa-times-circle"></i>';
                    return '<div class="form-check"><input type="checkbox" class="form-check-input" value="' . $user->id . '" id="active_' . $user->id . '" name="active"></div>';
                })
                ->editColumn('created_by', function (User $user) {
                    return $user->creator ? $user->creator->name : '';
                })
                ->addColumn('action', function (User $user) {
                    // $html = '<button onclick="editMedical(' . json_decode($user) . ', "' . $user->employee_id . '", "' . $user->employee->folder_name . '")" class="btn btn-primary edit btn-sm">Edit</button>';
                    $html = "<button class='btn btn-warning edit btn-sm mr-3'><i class='fa fa-pencil'></i> Edit</button>";
                    $html .= '<a href="' . route('users.show', ['user' => $user]) . '" class="view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $html;
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
        }
    }

    public function allUsers()
    {
        $this->validateUser();
        if (request()->ajax()) {
            $users = [];
            if (request()->user()->type <= config('constants.roles.super_admin')) {
                $users = User::select('id', 'name', 'email', 'active', 'type', 'club_id', 'employee_id', 'created_by')
                    ->where('id', '!=', 1)
                    ->with(['club:id,title', 'creator:id,name'])
                    ->orderBy('id', 'DESC')
                    ->get();
            } else if (request()->user()->type == config('constants.roles.admin')) {
                $users = User::select('id', 'name', 'email', 'active', 'type', 'club_id', 'employee_id', 'created_by')
                    ->where('id', '!=', 1)
                    ->where('club_id', request()->user()->club_id)
                    ->with(['club:id,title', 'creator:id,name'])
                    ->orderBy('id', 'DESC')
                    ->get();
            }
            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('club_id', function (User $user) {
                    // return $user->date_of_offence ? Helper::parseDate($user->date_of_offence, 'd/m/Y') : '';
                    return $user->club ? $user->club->title : '';
                })
                ->editColumn('type', function (User $user) {
                    foreach (config('constants.roles') as $key => $value) {
                        if ($value == $user->type) return Helper::normalCase($key);
                    }
                    return '';
                })
                ->editColumn('active', function (User $user) {
                    // return $user->active ? '<i class="fas fa-check"></i>' : '<i class="far fa-times-circle"></i>';
                    $checked = $user->active ? 'checked' : '';
                    return '<div class="form-check"><input type="checkbox" class="form-check-input" ' . $checked . ' value="' . $user->id . '" id="active_' . $user->id . '" name="active"></div>';
                })
                ->editColumn('created_by', function (User $user) {
                    return $user->creator ? $user->creator->name : '';
                })
                ->addColumn('action', function (User $user) {
                    // $html = '<button onclick="editMedical(' . json_decode($user) . ', "' . $user->employee_id . '", "' . $user->employee->folder_name . '")" class="btn btn-primary edit btn-sm">Edit</button>';
                    $html = "<button class='btn btn-warning edit btn-sm mr-3'><i class='fa fa-pencil'></i> Edit</button>";
                    $html .= '<a href="' . route('users.show', ['user' => $user]) . '" class="view btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>';
                    return $html;
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
        }
    }


    public function validateUser()
    {
        if (auth()->user()->type == config('constants.roles.user')) {
            return redirect('home')->with('error', 'Not allowed to visit this page');
        }
    }
}
