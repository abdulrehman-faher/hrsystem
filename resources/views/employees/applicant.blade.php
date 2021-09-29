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

        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data" id="employeeCreateForm">

            @csrf



            <input type="hidden" name="interview_candidate_id" value="{{ $interview_candidate->id }}" />

            <input type="hidden" name="application_id" value="{{ $application->id }}" />



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

                                        <label for="name" class="col-sm-2 col-form-label">Name</label>

                                        <div class="col-sm-4">

                                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" value="{{ old('name', $application->name) }}" name="name" required data-parsley-pattern="[a-zAZ ]+$" data-parsley-trigger="keyup" />

                                            @error('name')

                                            <div class="invalid-feedback">

                                                {{$errors->first('name')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="employee_number" class="col-sm-2 col-form-label">Employee No.</label>

                                        <div class="col-sm-4">

                                            <input type="text" class="form-control {{ $errors->has('employee_number') ? 'is-invalid' : ''}}" id="employee_number" value="{{ old('employee_number', $application->employee_number) }}" name="employee_number" required autofocus />

                                            @error('employee_number')

                                            <div class="invalid-feedback">

                                                {{$errors->first('employee_number')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label for="job_type_id" class="col-sm-2 col-form-label">Job / Position</label>

                                        <div class="col-sm-4">

                                            <select id="job_type_id" name="job_type_id" class="form-control {{ $errors->has('job_type_id') ? 'is-invalid' : ''}} js-example-basic-single" required>

                                                <option value="">Choose...</option>

                                                @foreach($jobTypes as $key => $value)

                                                <option value="{{$key}}" {{ $application->job_type_id == $key || old('job_type_id') == $key ? "selected":"" }}>{{$value}}</option>

                                                @endforeach



                                            </select>

                                            @error('job_type_id')

                                            <div class="invalid-feedback">

                                                {{$errors->first('job_type_id')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="club_id" class="col-sm-2 col-form-label">Club</label>

                                        <div class="col-sm-4">

                                            <select id="club_id" name="club_id" class="form-control {{ $errors->has('club_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                <option value="">Choose...</option>

                                                @foreach($clubs as $key => $value)

                                                <option value="{{$key}}" {{ $application->club_id == $key || old('club_id') == $key ? "selected":"" }}>{{$value}}</option>

                                                @endforeach



                                            </select>

                                            @error('club_id')

                                            <div class="invalid-feedback">

                                                {{$errors->first('club_id')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label for="type_of_contract_id" class="col-sm-2 col-form-label">Contract Type</label>

                                        <div class="col-sm-4">

                                            <select id="type_of_contract_id" name="type_of_contract_id" class="form-control {{ $errors->has('type_of_contract_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                <option value="">Choose...</option>

                                                @foreach($typeOfContract as $key => $value)

                                                <option value="{{$key}}" {{ $application->type_of_contract_id == $key || old('type_of_contract_id') == $key ? "selected":"" }}>{{$value}}</option>

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

                                            <select id="department_id" name="department_id" class="form-control {{ $errors->has('department_id') ? 'is-invalid' : ''}} js-example-basic-single">

                                                <option value="">Choose...</option>

                                                @foreach($departments as $key => $value)

                                                <option value="{{$key}}" {{ $application->department_id == $key || old('department_id') == $key ? "selected":"" }}>{{$value}}</option>

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

                                            <select id="group_id" name="group_id" class="form-control {{ $errors->has('group_id') ? 'is-invalid' : ''}} js-example-basic-single">

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

                                            <input type="text" class="form-control {{ $errors->has('grade') ? 'is-invalid' : ''}}" id="grade" value="{{ old('grade') }}" name="grade" />

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

                                            <input type="text" class="form-control {{ $errors->has('appointment') ? 'is-invalid' : ''}}" id="appointment" value="{{ old('appointment') }}" name="appointment" />

                                            @error('appointment')

                                            <div class="invalid-feedback">

                                                {{$errors->first('appointment')}}

                                            </div>

                                            @enderror

                                        </div>

                                        <label for="appointment_date" class="col-sm-2 col-form-label">Appt Date</label>

                                        <div class="col-sm-4">

                                            <input type="date" class="form-control {{ $errors->has('appointment_date') ? 'is-invalid' : ''}}" id="appointment_date" value="{{ old('appointment_date') }}" name="appointment_date" />

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

                                    <label for="cnic">CNIC *</label>

                                    <input type="text" autofocus class="form-control {{ $errors->has('cnic') ? 'is-invalid' : ''}}" id="cnic" value="{{ old('cnic', $application->cnic) }}" name="cnic" placeholder="00000-0000000-0" data-inputmask="'mask': ['99999-9999999-9', '999999-999999-9']" data-mask required />

                                    @error('cnic')

                                    <div class="invalid-feedback">

                                        {{$errors->first('cnic')}}

                                    </div>

                                    @enderror

                                </div>



                                <div class="form-group col-md-4">

                                    <label for="phone_number">Phone No.</label>

                                    <input type="text" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : ''}}" id="phone_number" value="{{ old('phone_number', $application->phone_number) }}" name="phone_number" data-inputmask="'mask': ['9999-99[9]-9999', '+99 99 999[9]-9999']" data-mask>

                                    @error('phone_number')

                                    <div class="invalid-feedback">

                                        {{$errors->first('phone_number')}}

                                    </div>

                                    @enderror



                                </div>



                                <div class="form-group col-md-4">

                                    <label for="email">Email</label>

                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="email" value="{{ old('email', $application->email) }}" name="email" />

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

                                    <input type="date" class="form-control {{ $errors->has('joining_date') ? 'is-invalid' : ''}}" id="joining_date" value="{{ old('joining_date') }}" />

                                    @error('joining_date')

                                    <div class="invalid-feedback">

                                        {{$errors->first('joining_date')}}

                                    </div>

                                    @enderror

                                </div>



                                <div class="form-group col-md-4">

                                    <label for="contract_end_date">Contract End Date</label>

                                    <input type="date" class="form-control {{ $errors->has('contract_end_date') ? 'is-invalid' : ''}}" id="contract_end_date" value="{{ old('contract_end_date') }}" />

                                    @error('contract_end_date')

                                    <div class="invalid-feedback">

                                        {{$errors->first('contract_end_date')}}

                                    </div>

                                    @enderror



                                </div>



                                <div class="form-group col-md-4">

                                    <label for="retirement_date">Retirement Date</label>

                                    <input type="date" class="form-control {{ $errors->has('retirement_date') ? 'is-invalid' : ''}}" id="retirement_date" value="{{ old('retirement_date') }}" />

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

                                    <input type="text" class="form-control" id="years_of_experience" value="{{ old('years_of_experience', $application->years_of_experience) }}" name="years_of_experience" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="dob">Date of Birth </label>

                                    <input type="date" class="form-control {{ $errors->has('dob') ? 'is-invalid' : ''}}" id="dob" value="{{ $application->dob ? Carbon\Carbon::parse($application->dob)->format('Y-m-d') : null }}" name="dob" />

                                    @error('dob')

                                    <div class="invalid-feedback">

                                        {{$errors->first('dob')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="dob_in_words">Date of Birth (in words)</label>

                                    <input type="text" class="form-control" id="dob_in_words" value="{{ old('dob_in_words', $application->dob_in_words) }}" name="dob_in_words" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="place_of_birth">Place of Birth</label>

                                    <input type="text" class="form-control {{ $errors->has('place_of_birth') ? 'is-invalid' : ''}}" id="place_of_birth" value="{{ old('place_of_birth', $application->place_of_birth) }}" name="place_of_birth" />

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

                                    <input type="text" class="form-control" id="father_name" value="{{ old('father_name', $application->father_name) }}" name="father_name" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="father_profession">Father’s Profession</label>

                                    <input type="text" class="form-control" id="father_profession" value="{{ old('father_profession', $application->father_profession) }}" name="father_profession" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="referee_name">Name of Referee</label>

                                    <input type="text" class="form-control" id="referee_name" value="{{ old('referee_name', $application->referee_name)  }}" name="referee_name" />

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="referee_address">Address of Referee</label>

                                    <input type="text" class="form-control" id="referee_address" value="{{ old('referee_address', $application->referee_address)  }}" name="referee_address" />

                                </div>

                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-2">

                                    <label for="gender">Gender</label>

                                    <select id="gender" name="gender" class="form-control">

                                        <option value="">Choose...</option>

                                        @foreach($genders as $key => $value)

                                        <option value="{{$key}}" {{ $application->gender == $key || old('gender') == $key ? "selected":"" }}>{{$value}}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="height">Height</label>

                                    <input type="text" class="form-control" id="height" value="{{ old('height', $application->height) }}" name="height" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="religion">Religion </label>

                                    <input type="text" class="form-control" id="religion" value="{{ old('religion', $application->religion) }}" name="religion" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sect">Sect </label>

                                    <input type="text" class="form-control" id="sect" value="{{ old('sect', $application->sect) }}" name="sect" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="caste">Caste </label>

                                    <input type="text" class="form-control" id="caste" value="{{ old('caste', $application->caste) }}" name="caste" />

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

                                    <input type="text" class="form-control" id="post" value="{{ old('post', $application->post) }}" name="post" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="rank">Rank </label>

                                    <input type="text" class="form-control" id="rank" value="{{ old('rank', $application->rank) }}" name="rank" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="arm">ARM </label>

                                    <input type="text" class="form-control" id="arm" value="{{ old('arm', $application->arm) }}" name="arm" />

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="last_appointment">Last Appointment</label>

                                    <input type="text" class="form-control" id="last_appointment" value="{{ old('last_appointment', $application->last_appointment) }}" name="last_appointment" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="enrollment_date">Enrollment Date</label>

                                    <input type="date" class="form-control" id="enrollment_date" value="{{ old('enrollment_date', $application->enrollment_date ? Carbon\Carbon::parse($application->enrollment_date)->format('Y-m-d') : null) }}" name="enrollment_date" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sos_date">SOS Date</label>

                                    <input type="date" class="form-control" id="sos_date" value="{{ old('enrollment_date', $application->sos_date ? Carbon\Carbon::parse($application->sos_date)->format('Y-m-d') : null) }}" name="sos_date" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sod_date">SOD Date</label>

                                    <input type="date" class="form-control" id="sod_date" value="{{ old('enrollment_date', $application->sod_date ? Carbon\Carbon::parse($application->sod_date)->format('Y-m-d') : null) }}" name="sod_date" />

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

                                    <input type="text" class="form-control" id="street_mohallah" value="{{ old('street_mohallah', $application->street_mohallah) }}" name="street_mohallah" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="address01">Village / Town</label>

                                    <input type="text" class="form-control" id="address01" value="{{ old('address01', $application->address01) }}" name="address01" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="city">City </label>

                                    <input type="text" class="form-control" id="city" value="{{ old('city', $application->city) }}" name="city" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="tehsil">Tehsil </label>

                                    <input type="text" class="form-control" id="tehsil" value="{{ old('tehsil', $application->tehsil) }}" name="tehsil" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="district">District / Political Agency </label>

                                    <input type="text" class="form-control" id="district" value="{{ old('district', $application->district) }}" name="district" />

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="post_office">Post Office </label>

                                    <input type="text" class="form-control" id="post_office" value="{{ old('post_office', $application->post_office) }}" name="post_office" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="police_station">Police Station </label>

                                    <input type="text" class="form-control" id="police_station" value="{{ old('police_station', $application->police_station) }}" name="police_station" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="railway_station">Railway Station and Distance from residence</label>

                                    <input type="text" class="form-control" id="railway_station" value="{{ old('railway_station', $application->railway_station) }}" name="railway_station" />

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="bus_stop">Nearest Bus Stop </label>

                                    <input type="text" class="form-control" id="bus_stop" value="{{ old('bus_stop', $application->bus_stop) }}" name="bus_stop" />

                                </div>

                            </div>

                        </div>

                    </div>

                    @if(count($application->qualification))

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Education Details</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Degree</th>
                                        <th>Institute</th>
                                        <th>Marks Obt</th>
                                        <th>Grade</th>
                                        <th>Year Comp</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($application->qualification as $education)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$education->title}}</td>
                                        <td>{{$education->institute_name}}</td>
                                        <td>{{$education->marks_obtained}}</td>
                                        <td>{{$education->division_grade}}</td>
                                        <td>{{$education->year_completed}}</td>
                                        <td>
                                            @if($education->attachment && in_array($education->file_ext, ['jpeg', 'gif', 'png', 'bmp', 'jpg']))
                                            <a href="/storage/images/applications/{{$application->folder_name}}/{{$education->attachment}}" target="_blank">
                                                <img src="{{ asset('storage/images/applications/' . $application->folder_name  . '/' . $education->attachment)}}" class="img-fluid" width="50px" alt="{{$education->title}}">
                                            </a>
                                            @elseif($education->attachment)
                                            <a href="/storage/images/applications/{{$application->folder_name}}/{{$education->attachment}}" target="_blank">{{ substr($education->attachment, -9,5)}}</a>
                                            @else
                                            <p>No file</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif



                    @if(count($application->workHistory))

                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title">Work History</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                            </div>

                        </div>

                        <div class="card-body">

                            <table class="table table-striped table-hover">

                                <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>Job Title</th>

                                        <th>Company Name</th>

                                        <th>Address</th>

                                        <th>Start Date</th>

                                        <th>End Date</th>

                                        <th>Image</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($application->workHistory as $work_history)

                                    <tr>

                                        <td>#</td>

                                        <td>{{$work_history->job_title}}</td>

                                        <td>{{$work_history->company_name}}</td>

                                        <td>{{$work_history->company_address}}</td>

                                        <td>{{$work_history->start_date}}</td>

                                        <td>{{$work_history->end_date}}</td>

                                        <td>

                                            @if($work_history->attachment && in_array($work_history->file_ext, ['jpeg', 'gif', 'png', 'bmp', 'jpg']))

                                            <a href="/storage/images/applications/{{$application->folder_name}}/{{$work_history->attachment}}" target="_blank">

                                                <img src="{{ asset('storage/images/applications/' . $application->folder_name    . '/' . $work_history->attachment)}}" class="img-fluid" width="50px" alt="{{$work_history->title}}">

                                            </a>

                                            @elseif($work_history->attachment)

                                            <a href="/storage/images/applications/{{$application->folder_name}}/{{$work_history->attachment}}" target="_blank">{{ substr($work_history->attachment, -9,5)}}</a>

                                            @else

                                            <p>No file</p>

                                            @endif

                                        </td>

                                    </tr>

                                    @endforeach



                                </tbody>

                            </table>

                        </div>

                    </div>

                    @endif

                </div>

            </div>



            <div class="row mb-5">

                <div class="col-md-9"><button type="submit" class="btn btn-primary btn-lg btn-block mt-5"><i class="fas fa-save"></i> Save</button></div>

                <div class="col-md-3"><a href="{{route('interviews.showSelected')}}" class="btn btn-secondary btn-lg btn-block mt-5">Cancel</a></div>

            </div>

        </form>

    </div>

</section>

@include('partials.modalalert', ['title' => 'Add Row', 'message' => 'Title is required.'])

@endsection



@section('scripts')

<script>

    let oldCNIC = '';

    let submitForm = false;



    $(document).on('submit', '#employeeCreateForm', function(event) {

        if (submitForm) {

            return;

        }

        event.preventDefault();

        const $this = $(this);

        const params = {

            params: {

                job_type_id: $('#job_type_id').val(),

                club_id: $('#club_id').val(),

            }

        }



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



    $(document).on('blur', '#dob', function() {

        const $this = $(this);

        $('#dob_in_words').val(moment($this.val()).format('dddd, MMMM DD, YYYY'));

    });





    $(document).on('focus', '#cnic', function() {

        oldCNIC = $(this).val();

    });



    $(document).on('blur', '#cnic', function() {

        const $this = $(this)

        const cnic = $this.val();

        if (cnic.trim().length) {

            axios.get(`/employees/search?cnic=${cnic}`).then(function(response) {

                const data = response.data;

                if (data.success && data.data) {

                    alert(`Applicant with the same CNIC, already exists \n\n Applicant Name: ${data.data.name}`);

                    $('#btnSubmit').prop('disabled', true);

                    $this.val(oldCNIC);

                } else {

                    $('#btnSubmit').prop('disabled', false);

                }

            }).catch(err => console.log(err));

        }

    });

</script>

<script src="{{ asset('js/imageDragDrop.js') }}"></script>

@endsection