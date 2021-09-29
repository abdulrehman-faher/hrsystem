<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Employee;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
        $attributes = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => (int) $data['type'],
            'club_id' => (int) $data['club_id'],
            'employee_id' => (int) $data['employee_id'],
            'active' => 1,
            'created_by' => auth()->user()->id,
        ];
        return User::create($attributes);
    }

    public function showRegistrationForm()
    {
        if (auth()->user()->type == 1 || auth()->user()->type == 2) {
            $employees = Employee::select('id', 'name', 'email', 'club_id')->get();
            $clubs = Club::select('id', 'title', 'number')->get();
            return view('auth.register', compact('employees', 'clubs'));
        }
        return redirect('home')->with('error', 'Not allowed to visit this page');
    }

    function registerUser(Request $request)
    {
        if (auth()->user()->type == 1 || auth()->user()->type == 2) {
            $attributes = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'type' => ['required', Rule::in([1, 2, 3, 4])],
                'club_id' => 'nullable|exists:clubs,id',
                'employee_id' => 'nullable|exists:employees,id',
            ]);

            $attributes['active'] = 1;
            $attributes['created_by'] = auth()->user()->id;
            $attributes['password'] = Hash::make($attributes['password']);


            // $this->create($attributes);
            User::create($attributes);
        }
        return redirect('home')->with('success', 'User created Successfully!');
    }
}
