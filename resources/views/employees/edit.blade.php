@extends('layouts.master', ['title'=> 'Update Employee - ' . $employee->name, 'active' => 'employee', 'activeChild' => ''])



@section('breadcrumb')

<ol class="breadcrumb float-sm-right">

    <li class="breadcrumb-item"><a href="/home">Home</a></li>

    <li class="breadcrumb-item"><a href="/employees">Employees</a></li>

    <li class="breadcrumb-item active">Add New</li>

</ol>

@endsection



@section('styles')

<link rel="stylesheet" href="{{ asset('css/imageDragDrop.css') }}" />

@endsection



@section('content')

<section class="content">



    <div class="container-fluid">

        <form method="POST" action="{{ route('employees.update', ['employee' => $employee->id])}}" enctype="multipart/form-data" id="employeeEditForm">

            @csrf

            @method('put')

            @if(count($errors))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                You have errors in the form.

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            @endif



            <div class="row">

                <div class="col-12 col-sm-12">

                    <div class="card card-primary">

                        <div class="card-header clearfix">

                            <h3 class="card-title float-left mt-2">Personal Information</h3>



                            <a type="a" href="{{ route('employees.show', ['employee' => $employee->id]) }}" class="btn btn-success float-right"><i class='fa fa-eye'></i> View</a>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 img-div">

                                    <?php $common_path =  'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'applicant.jpg'; ?>

                                    <?php $profile_img_path =  'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR;  ?>

                                    @if($employee->photograph)

                                    <input type="file" class="form-control mb-3" name="photograph" id="photograph" />

                                    <img src="{{ asset($profile_img_path . $employee->folder_name . DIRECTORY_SEPARATOR . $employee->photograph) }}" class="rounded img-fluid" alt="{{$employee->name}}">

                                    @else

                                    @include('partials.imageDragDrop', ['name' => 'photograph', 'dropMessage' => 'Drop and drag image here, or click to upload'])

                                    @endif

                                </div>

                                <div class="col-md-9">

                                    <div class="form-group row">

                                        <label for="cnic" class="col-sm-2 col-form-label">CNIC *</label>

                                        <div class="col-sm-4">

                                            <input type="text" autofocus class="form-control {{ $errors->has('cnic') ? 'is-invalid' : ''}}" id="cnic" value="{{ old('cnic', $employee->cnic)}}" name="cnic" placeholder="00000-0000000-0" data-inputmask="'mask': ['99999-9999999-9', '999999-999999-9']" data-mask required />

                                            @error('cnic')

                                            <div class="invalid-feedback">

                                                {{$errors->first('cnic')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="employee_number" class="col-sm-2 col-form-label">Employee No.</label>

                                        <div class="col-sm-4">

                                            <input type="text" class="form-control  {{ $errors->has('employee_number') ? 'is-invalid' : ''}}" id="employee_number" value="{{ old('employee_number', $employee->employee_number) }}" name="employee_number" required />

                                            @error('employee_number')

                                            <div class="invalid-feedback">

                                                {{$errors->first('employee_number')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>



                                    <div class="form-group row">

                                        <label for="name" class="col-sm-2 col-form-label">Name</label>

                                        <div class="col-sm-4">

                                            <input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" value="{{ old('name', $employee->name) }}" name="name" required />

                                            @error('name')

                                            <div class="invalid-feedback">

                                                {{$errors->first('name')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="current_salary" class="col-sm-2 col-form-label">Salary</label>

                                        <div class="col-sm-4">

                                            <input type="text" class="form-control  {{ $errors->has('current_salary') ? 'is-invalid' : ''}}" id="current_salary" value="{{ old('current_salary', $employee->current_salary) }}" name="current_salary" />

                                            @error('current_salary')

                                            <div class="invalid-feedback">

                                                {{$errors->first('current_salary')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>



                                    <div class="form-group row">

                                        <label for="job_type_id" class="col-sm-2 col-form-label">Job / Position</label>

                                        <div class="col-sm-4">

                                            <select id="job_type_id" name="job_type_id" class="form-control  {{ $errors->has('job_type_id') ? 'is-invalid' : ''}} js-example-basic-single" required>

                                                <option value="">Choose...</option>

                                                @foreach($jobTypes as $key => $value)

                                                <option value="{{$key}}" {{ $employee->job_type_id == $key || old('job_type_id') == $key ? "selected":"" }}>{{$value}}</option>

                                                @endforeach



                                            </select>

                                            @error('job_type_id')

                                            <div class="invalid-feedback">

                                                {{$errors->first('job_type_id')}}

                                            </div>

                                            @enderror

                                        </div>

                                        @if(auth()->user()->type <= 3) <label for="club_id" class="col-sm-2 col-form-label">Club </label>

                                            <div class="col-sm-4">

                                                <select id="club_id" name="club_id" class="form-control  {{ $errors->has('club_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                    <option value="">Choose...</option>

                                                    @foreach($clubs as $key => $value)

                                                    <option value="{{$key}}" {{ $employee->club_id == $key || old('club_id') == $key ? "selected":"" }}>{{$value}}</option>

                                                    @endforeach



                                                </select>

                                                @error('club_id')

                                                <div class="invalid-feedback">

                                                    {{$errors->first('club_id')}}

                                                </div>

                                                @enderror

                                            </div>

                                            @endif

                                    </div>

                                    <div class="form-group row">

                                        <label for="type_of_contract_id" class="col-sm-2 col-form-label">Contract Type</label>

                                        <div class="col-sm-4">

                                            <select id="type_of_contract_id" name="type_of_contract_id" class="form-control  {{ $errors->has('type_of_contract_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                <option value="">Choose...</option>

                                                @foreach($typeOfContract as $key => $value)

                                                <option value="{{$key}}" {{ $employee->type_of_contract_id == $key || old('type_of_contract_id') == $key ? "selected":"" }}>{{$value}}</option>

                                                @endforeach



                                            </select>

                                            @error('type_of_contract_id')

                                            <div class="invalid-feedback">

                                                {{$errors->first('type_of_contract_id')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="department_id" class="col-sm-2 col-form-label">Department</label>

                                        <div class="col-sm-4">

                                            <select id="department_id" name="department_id" class="form-control  {{ $errors->has('department_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                <option value="">Choose...</option>

                                                @foreach($departments as $key => $value)

                                                <option value="{{$key}}" {{ $employee->department_id == $key || old('department_id') == $key ? "selected":"" }}>{{$value}}</option>

                                                @endforeach



                                            </select>

                                            @error('department_id')

                                            <div class="invalid-feedback">

                                                {{$errors->first('department_id')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label for="group_id" class="col-sm-2 col-form-label">Group</label>

                                        <div class="col-sm-4">

                                            <select id="group_id" name="group_id" class="form-control  {{ $errors->has('group_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                <option value="">Choose...</option>

                                                @foreach($groups as $group)

                                                <option value="{{$group->id}}" {{ $employee->group_id == $key || old('group_id') == $group->id ? "selected":"" }}>{{$group->title}}</option>

                                                @endforeach

                                            </select>

                                            @error('group')

                                            <div class="invalid-feedback">

                                                {{$errors->first('group')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="grade" class="col-sm-2 col-form-label">Grade.</label>

                                        <div class="col-sm-4">

                                            <input type="text" class="form-control  {{ $errors->has('grade') ? 'is-invalid' : ''}}" id="grade" value="{{ old('grade', $employee->grade) }}" name="grade" />

                                            @error('grade')

                                            <div class="invalid-feedback">

                                                {{$errors->first('grade')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>



                                    <div class="form-group row">

                                        <label for="appointment" class="col-sm-2 col-form-label">Appointment</label>

                                        <div class="col-sm-4">

                                            <input type="text" class="form-control  {{ $errors->has('appointment') ? 'is-invalid' : ''}}" id="appointment" value="{{ old('appointment', $employee->appointment) }}" name="appointment" />

                                            @error('appointment')

                                            <div class="invalid-feedback">

                                                {{$errors->first('appointment')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="appointment_date" class="col-sm-2 col-form-label">Appt Date</label>

                                        <div class="col-sm-4">

                                            <input type="date" class="form-control  {{ $errors->has('appointment_date') ? 'is-invalid' : ''}}" id="appointment_date" value="{{ old('appointment_date', $employee->appointment_date) }}" name="appointment_date" />

                                            @error('appointment_date')

                                            <div class="invalid-feedback">

                                                {{$errors->first('appointment_date')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>



                                </div>

                            </div>



                            <div class="form-row">



                                <div class="form-group col-md-4">

                                    <label for="phone_number">Phone No.</label>

                                    <input type="text" class="form-control  {{ $errors->has('phone_number') ? 'is-invalid' : ''}}" id="phone_number" value="{{ old('phone_number', $employee->phone_number) }}" name="phone_number" data-inputmask="'mask': ['9999-99[9]-9999', '+99 99 999[9]-9999']" data-mask>

                                    @error('phone_number')

                                    <div class="invalid-feedback">

                                        {{$errors->first('phone_number')}}

                                    </div>

                                    @enderror



                                </div>



                                <div class="form-group col-md-4">

                                    <label for="email">Email</label>

                                    <input type="email" class="form-control  {{ $errors->has('email') ? 'is-invalid' : ''}}" id="email" value="{{ old('email', $employee->email) }}" />

                                    @error('email')

                                    <div class="invalid-feedback">

                                        {{$errors->first('email')}}

                                    </div>

                                    @enderror

                                </div>



                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-4">

                                    <label for="joining_date">Joining Date</label>

                                    <input type="date" class="form-control  {{ $errors->has('joining_date') ? 'is-invalid' : ''}}" id="joining_date" value="{{ old('joining_date', $employee->joining_date) }}" name="joining_date" />

                                    @error('joining_date')

                                    <div class="invalid-feedback">

                                        {{$errors->first('joining_date')}}

                                    </div>

                                    @enderror

                                </div>



                                <div class="form-group col-md-4">

                                    <label for="contract_end_date">Contract End Date</label>

                                    <input type="date" class="form-control  {{ $errors->has('contract_end_date') ? 'is-invalid' : ''}}" id="contract_end_date" value="{{ old('contract_end_date', $employee->contract_end_date ? Carbon\Carbon::parse($employee->contract_end_date)->format('Y-m-d') : null) }}" />

                                    @error('contract_end_date')

                                    <div class="invalid-feedback">

                                        {{$errors->first('contract_end_date')}}

                                    </div>

                                    @enderror



                                </div>



                                <div class="form-group col-md-4">

                                    <label for="retirement_date">Retirement Date</label>

                                    <input type="date" class="form-control  {{ $errors->has('retirement_date') ? 'is-invalid' : ''}}" id="retirement_date" value="{{ old('retirement_date', $employee->retirement_date ? Carbon\Carbon::parse($employee->retirement_date)->format('Y-m-d') : null) }}" />

                                    @error('retirement_date')

                                    <div class="invalid-feedback">

                                        {{$errors->first('retirement_date')}}

                                    </div>

                                    @enderror

                                </div>



                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="years_of_experience">Years of Experience </label>

                                    <input type="text" class="form-control " id="years_of_experience" value="{{ old('years_of_experience', $employee->years_of_experience) }}" name="years_of_experience" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="dob">Date of Birth </label>

                                    <input type="date" class="form-control  {{ $errors->has('dob') ? 'is-invalid' : ''}}" id="dob" value="{{ old('dob', $employee->dob ? Carbon\Carbon::parse($employee->dob)->format('Y-m-d') : null) }}" name="dob" />

                                    @error('dob')

                                    <div class="invalid-feedback">

                                        {{$errors->first('dob')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="dob_in_words">Date of Birth (in words)</label>

                                    <input type="text" class="form-control " id="dob_in_words" value="{{ old('dob_in_words', $employee->dob_in_words) }}" name="dob_in_words" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="place_of_birth">Place of Birth</label>

                                    <input type="text" class="form-control  {{ $errors->has('place_of_birth') ? 'is-invalid' : ''}}" id="place_of_birth" value="{{ old('place_of_birth', $employee->place_of_birth) }}" name="place_of_birth" />

                                    @error('place_of_birth')

                                    <div class="invalid-feedback">

                                        {{$errors->first('place_of_birth')}}

                                    </div>

                                    @enderror

                                </div>

                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-2">

                                    <label for="father_name">Father’s Name</label>

                                    <input type="text" class="form-control " id="father_name" value="{{ old('father_name', $employee->father_name) }}" name="father_name" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="father_profession">Father’s Profession</label>

                                    <input type="text" class="form-control " id="father_profession" value="{{ old('father_profession', $employee->father_profession) }}" name="father_profession" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="referee_name">Name of Referee</label>

                                    <input type="text" class="form-control " id="referee_name" value="{{ old('referee_name', $employee->referee_name) }}" name="referee_name" />

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="referee_address">Address of Referee</label>

                                    <input type="text" class="form-control " id="referee_address" value="{{ old('referee_address', $employee->referee_address) }}" name="referee_address" />

                                </div>

                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-2">

                                    <label for="gender">Gender</label>

                                    <select id="gender" name="gender" class="form-control ">

                                        <option value="">Choose...</option>

                                        @foreach($genders as $key => $value)

                                        <option value="{{$key}}" {{ $employee->gender == $key || old('gender') == $key ? "selected":"" }}>{{$value}}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="height">Height</label>

                                    <input type="text" class="form-control " id="height" value="{{ old('height', $employee->height) }}" name="height" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="religion">Religion </label>

                                    <input type="text" class="form-control " id="religion" value="{{ old('religion', $employee->religion) }}" name="religion" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sect">Sect </label>

                                    <input type="text" class="form-control " id="sect" value="{{ old('sect', $employee->sect) }}" name="sect" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="caste">Caste </label>

                                    <input type="text" class="form-control " id="caste" value="{{ old('caste', $employee->caste) }}" name="caste" />

                                </div>

                            </div>

                        </div>

                        <!-- /.card-body -->

                    </div>



                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title">Armed Forces History</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                            </div>

                        </div>

                        <div class="card-body">

                            <div class="form-row">

                                <div class="form-group col-md-4">

                                    <label for="post">Post</label>

                                    <input type="text" class="form-control " id="post" value="{{ old('post', $employee->post) }}" name="post" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="rank">Rank </label>

                                    <input type="text" class="form-control " id="rank" value="{{ old('rank', $employee->rank) }}" name="rank" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="arm">ARM </label>

                                    <input type="text" class="form-control " id="arm" value="{{ old('arm', $employee->arm) }}" name="arm" />

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="last_appointment">Last Appointment</label>

                                    <input type="text" class="form-control " id="last_appointment" value="{{ old('last_appointment', $employee->last_appointment) }}" name="last_appointment" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="enrollment_date">Enrollment Date</label>

                                    <input type="date" class="form-control " id="enrollment_date" value="{{ old('enrollment_date', $employee->enrollment_date ? Carbon\Carbon::parse($employee->enrollment_date)->format('Y-m-d') : null) }}" name="enrollment_date" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sos_date">SOS Date</label>

                                    <input type="date" class="form-control " id="sos_date" value="{{ old('sos_date', $employee->sos_date ? Carbon\Carbon::parse($employee->sos_date)->format('Y-m-d') : null) }}" name="sos_date" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sod_date">SOD Date</label>

                                    <input type="date" class="form-control " id="sod_date" value="{{ old('sod_date', $employee->sod_date ? Carbon\Carbon::parse($employee->sod_date)->format('Y-m-d') : null) }}" name="sod_date" />

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title">Address</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                            </div>

                        </div>

                        <div class="card-body">

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="street_mohallah">Street / Mohallah</label>

                                    <input type="text" class="form-control " id="street_mohallah" value="{{ old('street_mohallah', $employee->street_mohallah) }}" name="street_mohallah" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="address01">Village / Town</label>

                                    <input type="text" class="form-control " id="address01" value="{{ old('address01', $employee->address01) }}" name="address01" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="city">City </label>

                                    <input type="text" class="form-control " id="city" value="{{ old('city', $employee->city) }}" name="city" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="tehsil">Tehsil </label>

                                    <input type="text" class="form-control " id="tehsil" value="{{ old('tehsil', $employee->tehsil) }}" name="tehsil" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="district">District / Political Agency </label>

                                    <input type="text" class="form-control " id="district" value="{{ old('district', $employee->district) }}" name="district" />

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="post_office">Post Office </label>

                                    <input type="text" class="form-control " id="post_office" value="{{ old('post_office', $employee->post_office) }}" name="post_office" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="police_station">Police Station </label>

                                    <input type="text" class="form-control " id="police_station" value="{{ old('police_station', $employee->police_station) }}" name="police_station" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="railway_station">Railway Station and Distance from residence</label>

                                    <input type="text" class="form-control " id="railway_station" value="{{ old('railway_station', $employee->railway_station) }}" name="railway_station" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="bus_stop">Nearest Bus Stop </label>

                                    <input type="text" class="form-control " id="bus_stop" value="{{ old('bus_stop', $employee->bus_stop) }}" name="bus_stop" />

                                </div>

                            </div>

                        </div>

                    </div>





                </div>

            </div>



            <button type="submit" id="btnSubmit" class="btn btn-primary btn-lg btn-block mb-5">Submit</button>

        </form>

        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">Education Details</h3>



                <div class="card-tools">

                    <button type="button" onclick="addEducation('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i> Add New</button>

                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                </div>

            </div>

            <div class="card-body">

                <table class="table table-striped table-hover" id="education_datatable">

                    <thead>

                        <tr>

                            <th width="1px">#</th>

                            <th>Degree</th>

                            <th>Institute</th>

                            <th>Marks Obt</th>

                            <th>Grade</th>

                            <th>Year Comp</th>

                            <th>Address</th>

                            <th>Image</th>

                            <th width="80px">Action</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>



        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">Previous Work History</h3>



                <div class="card-tools">

                    <button type="button" id="addWorkHistory" onclick="addWorkHistory('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i> Add New</button>

                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                </div>

            </div>

            <div class="card-body">

                <table class="table table-striped table-hover" id="workhistory_datatable">

                    <thead>

                        <tr>

                            <th width="1px">#</th>

                            <th>Job Title</th>

                            <th>Company Name</th>

                            <th>Address</th>

                            <th>Start Date</th>

                            <th>End Date</th>

                            <th>Image</th>

                            <th width="60px">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                </table>

            </div>

        </div>

    </div>

</section>

@include('employees.partials.modal')



@endsection



@section('scripts')

<script>
    let eduIDs = 1;

    let workHistoryIDs = 1;

    let submitForm = false;

    const employee = <?php echo json_encode($employee); ?>;



    $(document).on('submit', '#employeeEditForm', function(event) {



        const job_type_id = $("#job_type_id").val();

        if (employee.job_type_id != job_type_id) {

            console.log("job_type_id", job_type_id);

            console.log("employee.job_type_id", employee.job_type_id);

            if (submitForm) {

                return;

            }

            event.preventDefault();



            const club_id = $("#club_id").val();

            if (!job_type_id) {

                alert("Job Type is required");

                return;

            }

            if (!club_id) {

                alert("Club is required");

                return;

            }

            const $this = $(this);

            const params = {

                params: {

                    job_type_id,

                    club_id

                }

            };





            axios.get("{{route('staff_auth.validate')}}", params)

                .then(response => {

                    console.log('response', response.data);

                    if (response.data.difference >= 0) {

                        const message = `You are exceeding your Authorization by ${response.data.difference + 1}. \nAre you sure you want to continue?`;

                        if (confirm(message)) {

                            submitForm = true;

                            $this.submit();



                            // $('#employeeEditForm').submit();

                            console.log('submit form with a warning message ');

                        }

                    } else {

                        $this.submit();

                        submitForm = true;

                        console.log('submit form NO Warning ');

                    }

                })

                .catch(function(e) {

                    console.log(e)

                });



        }

    });



    $(document).on('blur', '#dob', function() {

        const $this = $(this);

        const dob_in_words = $('#dob_in_words');

        dob_in_words.val(moment($this.val()).format('dddd, MMMM DD, YYYY'));

    });



    $(document).on('blur', '#cnic', function() {

        const cnic = $(this).val();

        if (cnic.trim().length) {

            axios.get(`/employees/search?cnic=${cnic}&id=${employee.id}`).then(function(response) {

                const data = response.data;

                if (data.success && data.data) {

                    alert(`Applicant already exists \n\n Applicant Name: ${data.data.name}`);

                    $('#btnSubmit').prop('disabled', true);

                } else {

                    $('#btnSubmit').prop('disabled', false);

                }

            }).catch(err => console.log(err));

        }

    });



    $(function() {

        $('[data-mask]').inputmask();

    });



    const workhistory_datatable = $('#workhistory_datatable').DataTable(dtOptions("{{ route('employees.workHistory.getEmployeeWorkHistory', ['employee' => $employee->id]) }}", workHistoryDTColumns()));

    const education_datatable = $('#education_datatable').DataTable(dtOptions("{{ route('employees.educations.getEmployeeEducationDetail', ['employee' => $employee->id]) }}", educationDTColumns()));



    function workHistoryDTColumns() {

        return [{

                data: 'DT_RowIndex',

                name: 'DT_RowIndex',

                orderable: false,

                searchable: false

            },

            {

                data: 'job_title',

                name: 'job_title'

            },

            {

                data: 'company_name',

                name: 'company_name'

            },

            {

                data: 'company_address',

                name: 'company_address'

            },

            {

                data: 'start_date',

                name: 'start_date'

            },

            {

                data: 'end_date',

                name: 'end_date'

            },

            {

                data: 'attachment',

                name: 'attachment'

            },

            {

                data: 'action',

                name: 'action',

                orderable: false,

                searchable: false

            }

        ]

    }



    function educationDTColumns() {

        return [{

                data: 'DT_RowIndex',

                name: 'DT_RowIndex',

                orderable: false,

                searchable: false

            },

            {

                data: 'title',

                name: 'title'

            },

            {

                data: 'institute_name',

                name: 'institute_name'

            },

            {

                data: 'marks_obtained',

                name: 'marks_obtained'

            },

            {

                data: 'division_grade',

                name: 'division_grade'

            },

            {

                data: 'year_completed',

                name: 'year_completed'

            },

            {

                data: 'campus_address',

                name: 'campus_address'

            },

            {

                data: 'attachment',

                name: 'attachment'

            },

            {

                data: 'action',

                name: 'action',

                orderable: false,

                searchable: false

            }

        ]

    }
</script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/emp_workhistory_new.js') }}"></script>
<script src="{{ asset('js/emp_education_new.js') }}"></script>
@endsection