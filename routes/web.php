<?php

use App\Models\Club;
use App\Models\Employee;
use App\Models\JobType;
use App\Models\StaffAuthorization;
use App\Models\User;
use App\Models\UserActivity;
use App\Http\Controllers\ActivityLogsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\GrantsNominationController;
use App\Http\Controllers\LocalCoursController;
use App\Http\Controllers\UserController;
use Illuminate\Console\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect('/login');
// });
Route::get('testing', function (Request $request) {
    $mobile_nos = "0300 5741882, 0306 5228669";
    // $str_arr = explode(",", $mobile_nos);
    $mobile_nos = array_map('trim', explode(",", $mobile_nos));
    $mobile_nos = array_filter($mobile_nos, fn ($value) => !is_null($value) && $value !== '');
    $count = count($mobile_nos);

    // return $mobile_nos;
    $html = '';
    $html .= '<div>';
    // foreach ($mobile_nos as $mobile_no) {
    //     dump($mobile_no);
    //     $html .= '<i class="fas fa-mobile-alt"></i> ' . $mobile_no . '<br />';
    // }

    echo "print here";
    foreach ($mobile_nos as $key => $value) {
        echo "$key => $value<br />";
        $html .= '<i class="fas fa-mobile-alt"></i> ' . $value;
        if ($key != ($count - 1)) $html .= '<br />';
        // if ($key == 0) echo "first:" . $value;
        // elseif ($key == ($count - 1)) echo "last:" . $value;
    }
    $html .= '</div>';
    return $html;
    // factory(App\User::class)->create();
    // $user = User::find(23);
    // $user->name = 'Bitfumes 6';
    // $user->type = 1;
    // $user->password = 'Password@1';
    // $user->club_id = 1;
    // $user->save();
    // return $user;

    // $all_act = Activity::with(['causer', 'subject'])->where('causer_id', '=', 7)->get();
    // $all_act = UserActivity::with('user')->get();
    // activity()->causedBy($user)->log('Look mum, I logged something');
    // $all_act = User::with('activities')->where('id', 1)->first();
    // return Activity::all()->last();


    // return JobType::with('employees')->get();
    // return Employee::with('images')
    //     ->with('jobType')
    //     ->with('department')
    //     ->with('club')
    //     ->with('education')
    //     ->with('workHistory')
    //     ->with('interview')
    //     ->get();
    // return StaffAuthorization::with('club')->with('jobType')->get();
    // return Club::with('authStaff')->get();
    // return JobType::with('authStaff')->get();
    // return User::all();
    abort(404);
});

Route::get('/test', function () {

    $results = [
        ['id' => '1', 'name' => 'Usman 1'],
        ['id' => '2', 'name' => 'Usman 2'],
        ['id' => '3', 'name' => 'Usman 3'],
        ['id' => '4', 'name' => 'Usman 4'],
        ['id' => '5', 'name' => 'Usman 5'],
        ['id' => '6', 'name' => 'Usman 6'],
        ['id' => '7', 'name' => 'Usman 7'],
    ];
    // return $results;
    foreach ($results as $data) {
        // foreach ($data as $row) {
        //     print_r($row);
        // };
        echo $data['id'] . " = " . $data['name'];
        echo "<br />";
    }
    return;
    echo "<pre>";
    $stars = "*";
    for ($a = 1; $a <= 10; $a++) {
        $spaces = "";
        for ($b = (11 - $a); $b > 1; $b--) {
            $spaces .= " ";
        }
        echo $spaces . $stars . $spaces;
        $stars .= " *";
        echo "<br/>";
    }
    echo "</pre>";
    return;

    for ($i = 0; $i <= 5; $i++) {
        for ($j = 0; $j <= $i; $j++) {
            echo "* ";
        }
        echo "<br />";
    }
    // echo "<hr />";
    // for ($i = 5; $i >= 0; $i--) {
    //     for ($j = 5; $j >= $i; $j--) {
    //         echo "* ";
    //     }
    //     echo "<br>";
    // }

    for ($i = 0; $i <= 5; $i++) {
        for ($j = 5 - $i; $j >= 1; $j--) {
            echo "* ";
        }
        echo "<br>";
    }
    for ($i = 0; $i <= 6; $i++) {
        for ($k = 6; $k >= $i; $k--) {
            echo "  ";
        }
        for ($j = 1; $j <= $i; $j++) {
            echo "*  ";
        }
        echo "<br>";
    }
    for ($i = 5; $i >= 1; $i--) {
        for ($k = 6; $k >= $i; $k--) {
            echo "  ";
        }
        for ($j = 1; $j <= $i; $j++) {
            echo "*  ";
        }
        echo "<br>";
    }
});

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
// Route::post('login', function () {
//     dd('recived');
// });
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'registerUser']);
// Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('listUsers')->middleware('auth');

// Password Reset Routes...
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/members', 'UserInfoController@index')->name('memberList')->middleware('auth');
// Route::get('/add-member', 'UserInfoController@create')->name('addMemberGet')->middleware('auth');
// Route::post('/add-member', 'UserInfoController@store')->name('addMemberPost')->middleware('auth');
// Route::view('/datatable', 'members.datatable');

// Route::get('/applications', function () {
//     return view('application.index');
// });

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/active', [UserController::class, 'activeUsers'])->name('users.active')->middleware('auth');
Route::get('/users/inactive', [UserController::class, 'inactiveUsers'])->name('users.inactive')->middleware('auth');
Route::get('/users/all', [UserController::class, 'allUsers'])->name('users.all')->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('auth');


Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'index'])->name('applications.index')->middleware('auth');
Route::get('/applications/download-sampfile', [App\Http\Controllers\ApplicationController::class, 'downloadSampleFile'])->name('applications.downloadSampleFile')->middleware('auth');
Route::post('/applications', [App\Http\Controllers\ApplicationController::class, 'store'])->name('applications.store')->middleware('auth');
Route::get('/applications/upload-applicants', [App\Http\Controllers\ApplicationController::class, 'uploadApplicantsGet'])->name('applications.uploadApplicants.get')->middleware('auth');
Route::post('/applications/upload-applicants', [App\Http\Controllers\ApplicationController::class, 'uploadApplicantsPost'])->name('applications.uploadApplicants.post')->middleware('auth');
Route::get('/applications/create', [App\Http\Controllers\ApplicationController::class, 'create'])->name('applications.create')->middleware('auth');
Route::get('/applications/search', [App\Http\Controllers\ApplicationController::class, 'search'])->name('applications.search')->middleware('auth');
Route::get('/applications/{application}/edit', [App\Http\Controllers\ApplicationController::class, 'edit'])->name('application.edit')->middleware('auth');

Route::get('/apis/applications/all', [ApplicationController::class, 'allApplicants'])->name('api.applications.all')->middleware('auth');
Route::get('/apis/applications/short-listed', [ApplicationController::class, 'shortListed'])->name('api.applications.shortListed')->middleware('auth');
Route::get('/apis/applications/employeed', [ApplicationController::class, 'employeed'])->name('api.applications.employeed')->middleware('auth');
Route::get('/apis/applications/remaining', [ApplicationController::class, 'remaining'])->name('api.applications.remaining')->middleware('auth');

// Route::post('/applications', 'ApplicationController@store')->middleware('auth');
// Route::get('/applications/create', 'ApplicationController@create')->name('applications.create')->middleware('auth');
Route::get('/applications/{application}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('application.show')->middleware('auth');
Route::put('/applications/{application}', [App\Http\Controllers\ApplicationController::class, 'update'])->name('application.update')->middleware('auth');
Route::put('/applications/{application}/educations/{education}', [App\Http\Controllers\ApplicationController::class, 'updateEducation'])->name('application.education.update')->middleware('auth');
Route::post('/applications/{application}/educations/', [App\Http\Controllers\ApplicationController::class, 'addEducation'])->name('application.education.add')->middleware('auth');
Route::put('/applications/{application}/workhistory/{workHistory}', [App\Http\Controllers\ApplicationController::class, 'updateWorkHistory'])->name('application.workHistory.update')->middleware('auth');
Route::post('/applications/{application}/workhistory/', [App\Http\Controllers\ApplicationController::class, 'addWorkHistory'])->name('application.workhistory.add')->middleware('auth');
// Route::patch('/applications/{application}', 'ApplicationController@update')->name('application.update')->middleware('auth');


Route::get('/interviews', [App\Http\Controllers\InterviewController::class, 'index'])->name('interviews.index')->middleware('auth');
Route::get('/interviews-conducted', [App\Http\Controllers\InterviewController::class, 'interviewsConducted'])->name('interviews.conducted')->middleware('auth');
Route::post('/interviews', [App\Http\Controllers\InterviewController::class, 'store'])->name('interviews.store')->middleware('auth');
Route::get('/interviews/by-date/{interview}', [App\Http\Controllers\InterviewController::class, 'byDate'])->name('interviews.byDate')->middleware('auth');
Route::get('/interviews/create', [App\Http\Controllers\InterviewController::class, 'create'])->name('interviews.create')->middleware('auth');
Route::get('/interviews/selected', [App\Http\Controllers\InterviewController::class, 'showSelected'])->name('interviews.showSelected')->middleware('auth');
Route::get('/interviews/selected-count', [App\Http\Controllers\InterviewController::class, 'selectedCount'])->name('interviews.selectedCount')->middleware('auth');
Route::get('/interviews/{interview}/interview', [App\Http\Controllers\InterviewController::class, 'interview'])->name('interviews.interview')->middleware('auth');
Route::get('/interviews/{interview}/edit', [App\Http\Controllers\InterviewController::class, 'edit'])->name('interviews.edit')->middleware('auth');
Route::patch('/interviews/{interview}/interview', [App\Http\Controllers\InterviewController::class, 'interviewUpdate'])->name('interviews.interviewUpdate')->middleware('auth');
Route::get('/interviews/{interview}/show-selected-candidates', [App\Http\Controllers\InterviewController::class, 'showSelectedCandidates'])->name('interviews.showSelectedCandidates')->middleware('auth');


Route::get('/employees/names', [App\Http\Controllers\EmployeeController::class, 'employeeNames'])->name('employees.names')->middleware('auth');
Route::get('/employees/{employee}/api', [App\Http\Controllers\EmployeeController::class, 'api'])->name('employees.api')->middleware('auth');
Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees.index')->middleware('auth');
Route::get('/employees/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employees.create')->middleware('auth');
Route::get('/employees/search', [App\Http\Controllers\EmployeeController::class, 'search'])->name('employees.search')->middleware('auth');

Route::get('/employees/applications/{application}', [App\Http\Controllers\EmployeeController::class, 'applicantToEmployee'])->name('getApplicantToEmployee')->middleware('auth');
// Route::post('/employees/applications/{application}', 'EmployeeController@applicantToEmployeeStore')->name('postAplicantToEmployee')->middleware('auth');
Route::post('/employees', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employees.store')->middleware('auth');
Route::post('/employees/{employee}/educations/', [App\Http\Controllers\EmployeeController::class, 'addEducation'])->name('employees.education.add')->middleware('auth');
Route::put('/employees/{employee}/educations/{education}', [App\Http\Controllers\EmployeeController::class, 'updateEducation'])->name('employees.education.update')->middleware('auth');
Route::post('/employees/{employee}/workhistory/', [App\Http\Controllers\EmployeeController::class, 'addWorkHistory'])->name('employees.workhistory.add')->middleware('auth');
Route::put('/employees/{employee}/workhistory/{workHistory}', [App\Http\Controllers\EmployeeController::class, 'updateWorkHistory'])->name('employees.workHistory.update')->middleware('auth');
Route::get('/employees/{employee}/workhistory/getEmployeeWorkHistory', [App\Http\Controllers\WorkHistoryController::class, 'getEmployeeWorkHistory'])->name('employees.workHistory.getEmployeeWorkHistory')->middleware('auth');
Route::get('/employees/{employee}/getWorkHistory', [App\Http\Controllers\WorkHistoryController::class, 'getWorkHistory'])->name('employees.workhistory.getWorkHistory')->middleware('auth');
Route::get('/employees/{employee}/educations/getEmployeeEducationDetail', [App\Http\Controllers\EducationDetailController::class, 'getEmployeeEducationDetail'])->name('employees.educations.getEmployeeEducationDetail')->middleware('auth');
Route::get('/employees/{employee}/getEducationDetails', [App\Http\Controllers\EducationDetailController::class, 'getEducationDetails'])->name('employees.educations.getEducationDetails')->middleware('auth');

Route::get('/employees/{employee}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employees.show')->middleware('auth');
Route::get('/employees/{employee}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees.edit')->middleware('auth');
Route::put('/employees/{employee}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employees.update')->middleware('auth');
// Route::get('/search', [App\Http\Controllers\EmployeeController::class, 'employeeSearch'])->name('employees.employeeSearch')->middleware('auth');


Route::get('/staff-auth/validate-strength', [App\Http\Controllers\StaffAuthorizationController::class, 'validateStrength'])->name('staff_auth.validate')->middleware('auth');

Route::get('/employees/{employee}/conducts', [App\Http\Controllers\EmployeeConductController::class, 'index'])->name('employees_conduct.index')->middleware('auth');
Route::post('/employees/{employee}/conducts', [App\Http\Controllers\EmployeeConductController::class, 'store'])->name('employees_conduct.store')->middleware('auth');
Route::get('/employees/{employee}/conducts/{employeeConduct}', [App\Http\Controllers\EmployeeConductController::class, 'show'])->name('employees_conduct.show')->middleware('auth');
Route::put('/employees/{employee}/conducts/{employeeConduct}', [App\Http\Controllers\EmployeeConductController::class, 'update'])->name('employees_conduct.update')->middleware('auth');
Route::get('/employees/{employee}/getConduct', [App\Http\Controllers\EmployeeConductController::class, 'getConduct'])->name('employees_conduct.getConduct')->middleware('auth');

// Route::get('/employees/{employee}/medicals', 'MedicalController@index')->name('employees_medical.index')->middleware('auth');
Route::get('/employees/{employee}/medicals', [App\Http\Controllers\MedicalController::class, 'index'])->name('employees_medical.index')->middleware('auth');
Route::post('/employees/{employee}/medicals', [App\Http\Controllers\MedicalController::class, 'store'])->name('employees_medical.store')->middleware('auth');
Route::get('/employees/{employee}/medicals/{medical}', [App\Http\Controllers\MedicalController::class, 'show'])->name('employees_medical.show')->middleware('auth');
Route::put('/employees/{employee}/medicals/{medical}', [App\Http\Controllers\MedicalController::class, 'update'])->name('employees_medical.update')->middleware('auth');
Route::get('/employees/{employee}/getMedical', [App\Http\Controllers\MedicalController::class, 'getMedical'])->name('employees_medical.getMedical')->middleware('auth');


Route::get('/employees/{employee}/acrs', [App\Http\Controllers\ACRController::class, 'index'])->name('employees_acrs.index')->middleware('auth');
Route::post('/employees/{employee}/acrs', [App\Http\Controllers\ACRController::class, 'store'])->name('employees_acrs.store')->middleware('auth');
Route::get('/employees/{employee}/acrs/create', [App\Http\Controllers\ACRController::class, 'create'])->name('employees_acrs.create')->middleware('auth');
Route::get('/employees/{employee}/acrs/{acr}', [App\Http\Controllers\ACRController::class, 'show'])->name('employees_acrs.show')->middleware('auth');
Route::put('/employees/{employee}/acrs/{acr}', [App\Http\Controllers\ACRController::class, 'update'])->name('employees_acrs.update')->middleware('auth');
Route::get('/employees/{employee}/acrs/{acr}/edit', [App\Http\Controllers\ACRController::class, 'edit'])->name('employees_acrs.edit')->middleware('auth');

Route::get('/employees/{employee}/leaves', [App\Http\Controllers\LeaveController::class, 'index'])->name('employees_leaves.index')->middleware('auth');
Route::post('/employees/{employee}/leaves', [App\Http\Controllers\LeaveController::class, 'store'])->name('employees_leaves.store')->middleware('auth');
Route::get('/employees/{employee}/leaves/balance', [App\Http\Controllers\LeaveController::class, 'getYearlyLeaveBalance'])->name('employees_leaves.balance')->middleware('auth');
Route::get('/employees/{employee}/leaves/{leave}', [App\Http\Controllers\LeaveController::class, 'show'])->name('employees_leaves.show')->middleware('auth');
Route::put('/employees/{employee}/leaves/{leave}', [App\Http\Controllers\LeaveController::class, 'update'])->name('employees_leaves.update')->middleware('auth');

Route::get('/employees/{employee}/kindereds', [App\Http\Controllers\KinderedController::class, 'index'])->name('employees_kindereds.index')->middleware('auth');
Route::post('/employees/{employee}/kindereds', [App\Http\Controllers\KinderedController::class, 'store'])->name('employees_kindereds.store')->middleware('auth');
Route::put('/employees/{employee}/kindereds/{kindered}', [App\Http\Controllers\KinderedController::class, 'update'])->name('employees_kindereds.update')->middleware('auth');

Route::get('/employees/{employee}/grants', [GrantsNominationController::class, 'index'])->name('employees_grants.index')->middleware('auth');

Route::get('/employees/{employee}/local-courses', [LocalCoursController::class, 'index'])->name('employees_local_course.index')->middleware('auth');
Route::get('/employees/{employee}/local-courses/{localCourse}', [LocalCoursController::class, 'show'])->name('employees_local_course.show')->middleware('auth');
Route::post('/employees/{employee}/local-courses/', [LocalCoursController::class, 'store'])->name('employees_local_course.store')->middleware('auth');
Route::put('/employees/{employee}/local-courses/{localCourse}', [LocalCoursController::class, 'update'])->name('employees_local_course.update')->middleware('auth');
Route::get('/employees/{employee}/getLocalCourse', [LocalCoursController::class, 'getLocalCourse'])->name('employees_local_course.getLocalCourse')->middleware('auth');


/******************************** Miscellaneous ********************************/
Route::get('/clubs', [App\Http\Controllers\LeaveController::class, 'show'])->name('employees_leaves.show')->middleware('auth');


/*** Reports */
Route::get('/reports/employee-strength', [App\Http\Controllers\ReportController::class, 'employeeStrength'])->name('report.employee_strength')->middleware('auth');


Route::get('/logs', [ActivityLogsController::class, 'index'])->middleware('auth')->name('logs.index');
