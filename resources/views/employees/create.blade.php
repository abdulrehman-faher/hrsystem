@extends('layouts.master', ['title'=> 'Add New Employee', 'active' => 'employee', 'activeChild' => 'employeeAddNew'])



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

        <form method="POST" action="{{ route('employees.store')}}" enctype="multipart/form-data" id="employeeCreateForm">

            @csrf



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

                        <div class="card-header">

                            <h3 class="card-title">Personal Information</h3>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-3">

                                    @include('partials.imageDragDrop', ['name' => 'photograph', 'dropMessage' => 'Drop and drag image here, or click to upload'])

                                </div>

                                <div class="col-md-9">

                                    <div class="form-group row">

                                        <label for="cnic" class="col-sm-2 col-form-label">CNIC *</label>

                                        <div class="col-sm-4">

                                            <input type="text" autofocus class="form-control {{ $errors->has('cnic') ? 'is-invalid' : ''}}" id="cnic" value="{{ old('cnic')}}" name="cnic" placeholder="00000-0000000-0" data-inputmask="'mask': ['99999-9999999-9', '999999-999999-9']" data-mask required />

                                            @error('cnic')

                                            <div class="invalid-feedback">

                                                {{$errors->first('cnic')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="employee_number" class="col-sm-2 col-form-label">Employee No.</label>

                                        <div class="col-sm-4">

                                            <input type="text" class="form-control readonly {{ $errors->has('employee_number') ? 'is-invalid' : ''}}" id="employee_number" value="{{ old('employee_number') }}" name="employee_number" required />

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

                                            <input type="text" class="form-control readonly {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" value="{{ old('name') }}" name="name" required />

                                            @error('name')

                                            <div class="invalid-feedback">

                                                {{$errors->first('name')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="current_salary" class="col-sm-2 col-form-label">Salary</label>

                                        <div class="col-sm-4">

                                            <input type="text" class="form-control readonly {{ $errors->has('current_salary') ? 'is-invalid' : ''}}" id="current_salary" value="{{ old('current_salary') }}" name="current_salary" />

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

                                            <select id="job_type_id" name="job_type_id" class="form-control readonly {{ $errors->has('job_type_id') ? 'is-invalid' : ''}} js-example-basic-single" required>

                                                <option value="">Choose...</option>

                                                @foreach($jobTypes as $key => $value)

                                                <option value="{{$key}}" {{ old('job_type_id') == $key ? "selected":"" }}>{{$value}}</option>

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

                                                <select id="club_id" name="club_id" class="form-control readonly {{ $errors->has('club_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                    <option value="">Choose...</option>

                                                    @foreach($clubs as $key => $value)

                                                    <option value="{{$key}}" {{ auth()->user()->club_id == $key || old('club_id') == $key ? "selected":"" }}>{{$value}}</option>

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

                                            <select id="type_of_contract_id" name="type_of_contract_id" class="form-control readonly {{ $errors->has('type_of_contract_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                <option value="">Choose...</option>

                                                @foreach($typeOfContract as $key => $value)

                                                <option value="{{$key}}" {{ old('type_of_contract_id') == $key ? "selected":"" }}>{{$value}}</option>

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

                                            <select id="department_id" name="department_id" class="form-control readonly {{ $errors->has('department_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                <option value="">Choose...</option>

                                                @foreach($departments as $key => $value)

                                                <option value="{{$key}}" {{ old('department_id') == $key ? "selected":"" }}>{{$value}}</option>

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

                                            <select id="group_id" name="group_id" class="form-control readonly {{ $errors->has('group_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                <option value="">Choose...</option>

                                                @foreach($groups as $group)

                                                <option value="{{$group->id}}" {{ old('group_id') == $group->id ? "selected":"" }}>{{$group->title}}</option>

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

                                            <input type="text" class="form-control readonly {{ $errors->has('grade') ? 'is-invalid' : ''}}" id="grade" value="{{ old('grade') }}" name="grade" />

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

                                            <input type="text" class="form-control readonly {{ $errors->has('appointment') ? 'is-invalid' : ''}}" id="appointment" value="{{ old('appointment') }}" name="appointment" />

                                            @error('appointment')

                                            <div class="invalid-feedback">

                                                {{$errors->first('appointment')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="appointment_date" class="col-sm-2 col-form-label">Appt Date</label>

                                        <div class="col-sm-4">

                                            <input type="date" class="form-control readonly {{ $errors->has('appointment_date') ? 'is-invalid' : ''}}" id="appointment_date" value="{{ old('appointment_date') }}" name="appointment_date" />

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

                                    <input type="text" class="form-control readonly {{ $errors->has('phone_number') ? 'is-invalid' : ''}}" id="phone_number" value="{{ old('phone_number') }}" name="phone_number" data-inputmask="'mask': ['9999-99[9]-9999', '+99 99 999[9]-9999']" data-mask>

                                    @error('phone_number')

                                    <div class="invalid-feedback">

                                        {{$errors->first('phone_number')}}

                                    </div>

                                    @enderror



                                </div>



                                <div class="form-group col-md-4">

                                    <label for="email">Email</label>

                                    <input type="email" class="form-control readonly {{ $errors->has('email') ? 'is-invalid' : ''}}" id="email" value="{{ old('email') }}" />

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

                                    <input type="date" class="form-control readonly {{ $errors->has('joining_date') ? 'is-invalid' : ''}}" id="joining_date" value="{{ old('joining_date') }}" name="joining_date" />

                                    @error('joining_date')

                                    <div class="invalid-feedback">

                                        {{$errors->first('joining_date')}}

                                    </div>

                                    @enderror

                                </div>



                                <div class="form-group col-md-4">

                                    <label for="contract_end_date">Contract End Date</label>

                                    <input type="date" class="form-control readonly {{ $errors->has('contract_end_date') ? 'is-invalid' : ''}}" id="contract_end_date" value="{{ old('contract_end_date') }}" />

                                    @error('contract_end_date')

                                    <div class="invalid-feedback">

                                        {{$errors->first('contract_end_date')}}

                                    </div>

                                    @enderror



                                </div>



                                <div class="form-group col-md-4">

                                    <label for="retirement_date">Retirement Date</label>

                                    <input type="date" class="form-control readonly {{ $errors->has('retirement_date') ? 'is-invalid' : ''}}" id="retirement_date" value="{{ old('retirement_date') }}" />

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

                                    <input type="text" class="form-control readonly" id="years_of_experience" value="{{ old('years_of_experience') }}" name="years_of_experience" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="dob">Date of Birth </label>

                                    <input type="date" class="form-control readonly {{ $errors->has('dob') ? 'is-invalid' : ''}}" id="dob" value="{{ old('dob') }}" name="dob" />

                                    @error('dob')

                                    <div class="invalid-feedback">

                                        {{$errors->first('dob')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="dob_in_words">Date of Birth (in words)</label>

                                    <input type="text" class="form-control readonly" id="dob_in_words" value="{{ old('dob_in_words') }}" name="dob_in_words" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="place_of_birth">Place of Birth</label>

                                    <input type="text" class="form-control readonly {{ $errors->has('place_of_birth') ? 'is-invalid' : ''}}" id="place_of_birth" value="{{ old('place_of_birth') }}" name="place_of_birth" />

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

                                    <input type="text" class="form-control readonly" id="father_name" value="{{ old('father_name') }}" name="father_name" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="father_profession">Father’s Profession</label>

                                    <input type="text" class="form-control readonly" id="father_profession" value="{{ old('father_profession') }}" name="father_profession" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="referee_name">Name of Referee</label>

                                    <input type="text" class="form-control readonly" id="referee_name" value="{{ old('referee_name')  }}" name="referee_name" />

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="referee_address">Address of Referee</label>

                                    <input type="text" class="form-control readonly" id="referee_address" value="{{ old('referee_address')  }}" name="referee_address" />

                                </div>

                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-2">

                                    <label for="gender">Gender</label>

                                    <select id="gender" name="gender" class="form-control readonly">

                                        <option value="">Choose...</option>

                                        @foreach($genders as $key => $value)

                                        <option value="{{$key}}" {{ old('gender') == $key ? "selected":"" }}>{{$value}}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="height">Height</label>

                                    <input type="text" class="form-control readonly" id="height" value="{{ old('height') }}" name="height" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="religion">Religion </label>

                                    <input type="text" class="form-control readonly" id="religion" value="{{ old('religion') }}" name="religion" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sect">Sect </label>

                                    <input type="text" class="form-control readonly" id="sect" value="{{ old('sect') }}" name="sect" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="caste">Caste </label>

                                    <input type="text" class="form-control readonly" id="caste" value="{{ old('caste') }}" name="caste" />

                                </div>

                            </div>

                        </div>

                        <!-- /.card-body -->

                    </div>



                    <div class="card card-info collapsed-card">

                        <div class="card-header">

                            <h3 class="card-title">Armed Forces History</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>

                            </div>

                        </div>

                        <div class="card-body">

                            <div class="form-row">

                                <div class="form-group col-md-4">

                                    <label for="post">Post</label>

                                    <input type="text" class="form-control readonly" id="post" value="{{ old('post') }}" name="post" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="rank">Rank </label>

                                    <input type="text" class="form-control readonly" id="rank" value="{{ old('rank') }}" name="rank" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="arm">ARM </label>

                                    <input type="text" class="form-control readonly" id="arm" value="{{ old('arm') }}" name="arm" />

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="last_appointment">Last Appointment</label>

                                    <input type="text" class="form-control readonly" id="last_appointment" value="{{ old('last_appointment') }}" name="last_appointment" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="enrollment_date">Enrollment Date</label>

                                    <input type="date" class="form-control readonly" id="enrollment_date" value="{{ old('enrollment_date') }}" name="enrollment_date" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sos_date">SOS Date</label>

                                    <input type="date" class="form-control readonly" id="sos_date" value="{{ old('sos_date') }}" name="sos_date" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sod_date">SOD Date</label>

                                    <input type="date" class="form-control readonly" id="sod_date" value="{{ old('sod_date') }}" name="sod_date" />

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="card card-info collapsed-card">

                        <div class="card-header">

                            <h3 class="card-title">Address</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>

                            </div>

                        </div>

                        <div class="card-body">

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="street_mohallah">Street / Mohallah</label>

                                    <input type="text" class="form-control readonly" id="street_mohallah" value="{{ old('street_mohallah') }}" name="street_mohallah" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="address01">Village / Town</label>

                                    <input type="text" class="form-control readonly" id="address01" value="{{ old('address01') }}" name="address01" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="city">City </label>

                                    <input type="text" class="form-control readonly" id="city" value="{{ old('city') }}" name="city" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="tehsil">Tehsil </label>

                                    <input type="text" class="form-control readonly" id="tehsil" value="{{ old('tehsil') }}" name="tehsil" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="district">District / Political Agency </label>

                                    <input type="text" class="form-control readonly" id="district" value="{{ old('district') }}" name="district" />

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="post_office">Post Office </label>

                                    <input type="text" class="form-control readonly" id="post_office" value="{{ old('post_office') }}" name="post_office" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="police_station">Police Station </label>

                                    <input type="text" class="form-control readonly" id="police_station" value="{{ old('police_station') }}" name="police_station" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="railway_station">Railway Station and Distance from residence</label>

                                    <input type="text" class="form-control readonly" id="railway_station" value="{{ old('railway_station') }}" name="railway_station" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="bus_stop">Nearest Bus Stop </label>

                                    <input type="text" class="form-control readonly" id="bus_stop" value="{{ old('bus_stop') }}" name="bus_stop" />

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="card card-info collapsed-card">

                        <div class="card-header">

                            <h3 class="card-title">Education Details</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>

                            </div>

                        </div>

                        <div class="card-body">

                            <table class="table table-striped table-hover" id="educationTable">

                                <thead>

                                    <tr>

                                        <th>Degree *</th>

                                        <th>Institute</th>

                                        <th>Marks Obt</th>

                                        <th>Grade</th>

                                        <th>Year Comp</th>

                                        <th>Address</th>

                                        <th>Image</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td><input placeholder="Degree Title" type="text" class="form-control eduTitle readonly" id="title_1" value="{{ old('title') }}" name="title[]" /></td>

                                        <td><input placeholder="Institute Name" type="text" class="form-control readonly" id="institute_name_1" value="{{ old('institute_name') }}" name="institute_name[]" /></td>

                                        <td><input placeholder="Marks Obtained" type="text" class="form-control readonly" id="marks_obtained_1" value="{{ old('marks_obtained') }}" name="marks_obtained[]" /></td>

                                        <td><input placeholder="Grade" type="text" class="form-control readonly" id="division_grade_1" value="{{ old('division_grade') }}" name="division_grade[]" /></td>

                                        <td><input placeholder="Year Completed" type="text" class="form-control readonly" id="year_completed_1" value="{{ old('year_completed') }}" name="year_completed[]" /></td>

                                        <td><input placeholder="Campus Address" type="text" class="form-control readonly" id="campus_address_1" value="{{ old('campus_address') }}" name="campus_address[]" /></td>

                                        <td><input placeholder="Image" type="file" class="form-control readonly" id="education_images_1" name="education_images[]" accept=".doc,.docx, image/*, application/pdf" /></td>

                                        <td id="tdAddEdu_1"><button type="button" disabled id="addEducation_1" class="addEducation btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>



                    <div class="card card-info collapsed-card">

                        <div class="card-header">

                            <h3 class="card-title">Previous Work History</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>

                            </div>

                        </div>

                        <div class="card-body">

                            <table class="table table-striped table-hover" id="tblWorkHistory">

                                <thead>

                                    <tr>

                                        <th>Job Title *</th>

                                        <th>Company Name</th>

                                        <th>Address</th>

                                        <th>Start Date</th>

                                        <th>End Date</th>

                                        <th>Image</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td><input placeholder="Job Title" type="text" class="form-control readonly" id="job_title_1" value="{{ old('job_title') }}" name="job_title[]" /></td>

                                        <td><input placeholder="Institute Name" type="text" class="form-control readonly" id="company_name_1" value="{{ old('company_name') }}" name="company_name[]" /></td>

                                        <td><input placeholder="Marks Obtained" type="text" class="form-control readonly" id="company_address_1" value="{{ old('company_address') }}" name="company_address[]" /></td>

                                        <td><input placeholder="Grade" type="text" class="form-control readonly" id="start_date_1" value="{{ old('start_date') }}" name="start_date[]" /></td>

                                        <td><input placeholder="Year Completed" type="text" class="form-control readonly" id="end_date_1" value="{{ old('end_date') }}" name="end_date[]" /></td>

                                        <td><input placeholder="Image" type="file" class="form-control readonly" id="workhistory_images_1" name="workhistory_images[]" accept=".doc,.docx, image/*, application/pdf" /></td>

                                        <td id="tdAddworkHistory_1"><button id="addWorkHistory_1" type="button" disabled class="addWorkHistory btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>



            <button type="submit" id="btnSubmit" class="btn btn-primary btn-lg btn-block mb-5" disabled>Submit</button>

        </form>

    </div>

</section>

@include('partials.modalalert', ['title' => 'Add Row', 'message' => 'Title is required.'])

@endsection



@section('scripts')

<script>

    let eduIDs = 1;

    let workHistoryIDs = 1;

    let submitForm = false;



    $('.readonly').prop('disabled', true);



    $(document).on('submit', '#employeeCreateForm', function(event) {



        if (submitForm) {

            return;

        }

        event.preventDefault();

        const job_type_id = $("#job_type_id").val();

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



                        // $('#employeeCreateForm').submit();

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

    });



    $(document).on('blur', 'input[id^="title_"]', function(event) {

        const $this = $(this);

        const id = $this.prop('id').slice(-1)[0];



        // $(`#addEducation_${id}`).prop('disabled', $this.val().trim().length > 0 ? false :  true);

        if ($this.val().trim().length > 0) {

            $(`#addEducation_${id}`).prop('disabled', false);

        } else {

            $(`#addEducation_${id}`).prop('disabled', true);

            $this.val('');

        }

    });



    $(document).on('blur', 'input[id^="job_title_"]', function() {

        const $this = $(this);

        const id = $this.prop('id').slice(-1)[0];



        if ($this.val().trim().length > 0) {

            $(`#addWorkHistory_${id}`).prop('disabled', false);

        } else {

            $(`#addWorkHistory_${id}`).prop('disabled', true);

            $this.val('');

        }

    })



    $(document).on('blur', '#dob', function() {

        const $this = $(this);

        const dob_in_words = $('#dob_in_words');

        // if (!dob_in_words.val().trim())

        dob_in_words.val(moment($this.val()).format('dddd, MMMM DD, YYYY'));

    });



    $(document).on('blur', '#cnic', function() {

        const cnic = $(this).val();

        if (cnic.trim().length) {

            axios.get(`/employees/search?cnic=${cnic}`).then(function(response) {

                const data = response.data;

                if (data.success && data.data) {

                    alert(`Applicant already exists \n\n Applicant Name: ${data.data.name}`);

                    $('.readonly').prop('disabled', true);

                    $('#btnSubmit').prop('disabled', true);

                    $('#cnic').focus();

                } else {

                    $('#btnSubmit').prop('disabled', false);

                    $('.readonly').prop('disabled', false);

                    $('#employee_number').focus();

                }

            }).catch(err => console.log(err));

        }

    });



    // Delete a row from educatin details table

    $('#educationTable').on('click', '.delete-row', function() {

        if (confirm('Are you sure, you want to delete this?')) {

            $(this).closest('tr').remove();

        }

    });



    $('#tblWorkHistory').on('click', '.delete-wh-row', function() {

        if (confirm('Are you sure, you want to delete this?')) {

            $(this).closest('tr').remove();

        }

    });



    // add a row to education details table

    $(document).on('click', '.addEducation', function(e) {

        const title = $('#title_' + eduIDs).val();

        if (title.trim() == '') {

            $('#errorModal').modal('show');

            return false;

        }

        $('#tdAddEdu_' + eduIDs).html('<button type="button" class="delete-row btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>');

        eduIDs++;

        $('#educationTable tbody>tr:last').after(`<tr>

            <td><input placeholder="Degree Title" type="text" class="form-control" id="title_${eduIDs}" value="{{ old('title') }}" name="title[]" /></td>

            <td><input placeholder="Institute Name" type="text" class="form-control" id="institute_name_${eduIDs}" value="{{ old('institute_name') }}" name="institute_name[]" /></td>

            <td><input placeholder="Marks Obtained" type="text" class="form-control" id="marks_obtained_${eduIDs}" value="{{ old('marks_obtained') }}" name="marks_obtained[]" /></td>

            <td><input placeholder="Grade" type="text" class="form-control" id="division_grade_${eduIDs}" value="{{ old('division_grade') }}" name="division_grade[]" /></td>

            <td><input placeholder="Year Completed" type="text" class="form-control" id="year_completed_${eduIDs}" value="{{ old('year_completed') }}" name="year_completed[]" /></td>

            <td><input placeholder="Campus Address" type="text" class="form-control" id="campus_address_${eduIDs}" value="{{ old('campus_address') }}" name="campus_address[]" /></td>

            <td><input placeholder="Image" type="file" class="form-control" id="education_images_${eduIDs}" name="education_images[]" accept=".doc,.docx, image/*, application/pdf" /></td>

            <td id="tdAddEdu_${eduIDs}"><button type="button" disabled id="addEducation_${eduIDs}" class="addEducation btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></td>

        </tr>`);



        $('#title' + eduIDs).focus();



        return false;

    });



    // add a row to education details table

    $(document).on('click', '.addWorkHistory', function(e) {

        const title = $('#job_title_' + workHistoryIDs).val();

        if (title.trim() == '') {

            $('#errorModal').modal('show');

            return false;

        }

        $('#tdAddworkHistory_' + workHistoryIDs).html('<button type="button" class="delete-wh-row btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>');

        workHistoryIDs++;

        $('#tblWorkHistory tbody>tr:last').after(`<tr>

            <td><input placeholder="Job Title" type="text" class="form-control" id="job_title_${workHistoryIDs}" value="{{ old('job_title') }}" name="job_title[]" /></td>

            <td><input placeholder="Institute Name" type="text" class="form-control" id="company_name_${workHistoryIDs}" value="{{ old('company_name') }}" name="company_name[]" /></td>

            <td><input placeholder="Marks Obtained" type="text" class="form-control" id="company_address_${workHistoryIDs}" value="{{ old('company_address') }}" name="company_address[]" /></td>

            <td><input placeholder="Grade" type="text" class="form-control" id="start_date_${workHistoryIDs}" value="{{ old('start_date') }}" name="start_date[]" /></td>

            <td><input placeholder="Year Completed" type="text" class="form-control" id="end_date_${workHistoryIDs}" value="{{ old('end_date') }}" name="end_date[]" /></td>

            <td><input placeholder="Image" type="file" class="form-control" id="workhistory_images_${workHistoryIDs}" name="workhistory_images[]" accept=".doc,.docx, image/*, application/pdf" /></td>

            <td id="tdAddworkHistory_${workHistoryIDs}"><button type="button" disabled id="addWorkHistory_${workHistoryIDs}"class="addWorkHistory btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></td>

        </tr>`);



        $('#job_title' + workHistoryIDs).focus();



        return false;

    });



    $(function() {

        $('[data-mask]').inputmask();

    });

</script>

<script src="{{ asset('js/imageDragDrop.js') }}"></script>

@endsection