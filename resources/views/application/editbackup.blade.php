@extends('layouts.master', ['title'=> 'New Application', 'active' => 'application', 'activeChild' => ''])



@section('breadcrumb')

<ol class="breadcrumb float-sm-right">

    <li class="breadcrumb-item"><a href="#">Home</a></li>

    <li class="breadcrumb-item"><a href="{{route('applications.index')}}">Applications</a></li>

    <li class="breadcrumb-item active">{{$application->name}}</li>

</ol>

@endsection



@section('content')

<section class="content">

    <div class="container-fluid">

        <form method="POST" action="/applications/{{$application->id}}" enctype="multipart/form-data">

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



            <div class="card card-info">

                <div class="card-header">

                    <h3 class="card-title">Personal Information</h3>



                    <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                    </div>

                </div>

                <!-- /.card-header -->

                <div class="card-body">

                    <div class="row">



                        <div class="col-md-12">

                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="name">Applicant Name</label>

                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" value="{{ $application->name }}" name="name" required autofocus />

                                    @error('name')

                                    <div class="invalid-feedback">

                                        {{$errors->first('name')}}

                                    </div>

                                    @enderror

                                </div>



                                <div class="form-group col-md-3">

                                    <label for="cnic">Applicant CNIC</label>

                                    <input type="text" class="form-control {{ $errors->has('cnic') ? 'is-invalid' : ''}}" id="cnic" value="{{ old('cnic', $application->cnic) }}" name="cnic" placeholder="00000-0000000-0" data-inputmask="'mask': ['99999-9999999-9', '999999-999999-9']" data-mask required />

                                    @error('cnic')

                                    <div class="invalid-feedback">

                                        {{$errors->first('cnic')}}

                                    </div>

                                    @enderror

                                </div>



                                <div class="form-group col-md-3">

                                    <label for="job_type_id">Position Applied For</label>

                                    <select id="job_type_id" name="job_type_id" class="form-control {{ $errors->has('job_type_id') ? 'is-invalid' : ''}}" required>

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



                                <div class="form-group col-md-3">

                                    <label for="type_of_contract_id">Contract Type</label>

                                    <select id="type_of_contract_id" name="type_of_contract_id" class="form-control {{ $errors->has('type_of_contract_id') ? 'is-invalid' : ''}}" required>

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



                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-3">

                                    <label for="years_of_experience">Years of Experience </label>

                                    <input type="text" class="form-control" id="years_of_experience" value="{{ old('years_of_experience', $application->years_of_experience) }}" name="years_of_experience" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="dob">Date of Birth </label>

                                    <input type="date" class="form-control" id="dob" value="{{ $application->dob ? Carbon\Carbon::parse($application->dob)->format('Y-m-d') : null }}" name="dob" />

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

                                <div class="form-group col-md-3">

                                    <label for="email">Email</label>

                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="email" value="{{ old('email', $application->email) }}" name="email" />

                                    @error('email')

                                    <div class="invalid-feedback">

                                        {{$errors->first('email')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="phone_number">Phone Number</label>

                                    <input type="text" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : ''}}" id="phone_number" value="{{ old('phone_number', $application->phone_number) }}" name="phone_number" data-inputmask="'mask': ['999-999[9]-9999 [x99999]', '+99 999 999-9999']" data-mask />

                                    @error('phone_number')

                                    <div class="invalid-feedback">

                                        {{$errors->first('phone_number')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="father_name">Father’s Name</label>

                                    <input type="text" class="form-control" id="father_name" value="{{ old('father_name', $application->father_name) }}" name="father_name" />

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="father_profession">Father’s Profession</label>

                                    <input type="text" class="form-control" id="father_profession" value="{{ old('father_profession', $application->father_profession) }}" name="father_profession" />

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



                            <div class="form-row">

                                <div class="form-group col-md-4">

                                    <label for="referee_name">Name of Referee</label>

                                    <input type="text" class="form-control" id="referee_name" value="{{ old('referee_name', $application->referee_name)  }}" name="referee_name" />

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="referee_address">Address of Referee</label>

                                    <input type="text" class="form-control" id="referee_address" value="{{ old('referee_address', $application->referee_address)  }}" name="referee_address" />

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- /.row -->

                </div>

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

                            <input type="text" class="form-control {{ $errors->has('post') ? 'is-invalid' : ''}}" id="post" value="{{ old('post', $application->post) }}" name="post" />

                            @error('post')

                            <div class="invalid-feedback">

                                {{$errors->first('post')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-4">

                            <label for="rank">Rank </label>

                            <input type="text" class="form-control {{ $errors->has('rank') ? 'is-invalid' : ''}}" id="rank" value="{{ old('rank', $application->rank) }}" name="rank" />

                            @error('rank')

                            <div class="invalid-feedback">

                                {{$errors->first('rank')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-4">

                            <label for="arm">ARM </label>

                            <input type="text" class="form-control {{ $errors->has('arm') ? 'is-invalid' : ''}}" id="arm" value="{{ old('arm', $application->arm) }}" name="arm" />

                            @error('arm')

                            <div class="invalid-feedback">

                                {{$errors->first('arm')}}

                            </div>

                            @enderror

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-3">

                            <label for="last_appointment">Last Appointment</label>

                            <input type="text" class="form-control {{ $errors->has('last_appointment') ? 'is-invalid' : ''}}" id="last_appointment" value="{{ old('last_appointment', $application->last_appointment) }}" name="last_appointment" />

                            @error('last_appointment')

                            <div class="invalid-feedback">

                                {{$errors->first('last_appointment')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="enrollment_date">Enrollment Date</label>

                            <input type="date" class="form-control {{ $errors->has('enrollment_date') ? 'is-invalid' : ''}}" id="enrollment_date" value="{{ old('enrollment_date', $application->enrollment_date ? Carbon\Carbon::parse($application->enrollment_date)->format('Y-m-d') : null) }}" name="enrollment_date" />

                            @error('enrollment_date')

                            <div class="invalid-feedback">

                                {{$errors->first('enrollment_date')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="sos_date">SOS Date</label>

                            <input type="date" class="form-control {{ $errors->has('sos_date') ? 'is-invalid' : ''}}" id="sos_date" value="{{ old('sos_date', $application->sos_date ? Carbon\Carbon::parse($application->sos_date)->format('Y-m-d') : null) }}" name="sos_date" />

                            @error('sos_date')

                            <div class="invalid-feedback">

                                {{$errors->first('sos_date')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="sod_date">SOD Date</label>

                            <input type="date" class="form-control {{ $errors->has('sod_date') ? 'is-invalid' : ''}}" id="sod_date" value="{{ old('sod_date', $application->sod_date ? Carbon\Carbon::parse($application->sod_date)->format('Y-m-d') : null) }}" name="sod_date" />

                            @error('sod_date')

                            <div class="invalid-feedback">

                                {{$errors->first('sod_date')}}

                            </div>

                            @enderror

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

                            <input type="text" class="form-control {{ $errors->has('street_mohallah') ? 'is-invalid' : ''}}" id="street_mohallah" value="{{ old('street_mohallah', $application->street_mohallah) }}" name="street_mohallah" />

                            @error('street_mohallah')

                            <div class="invalid-feedback">

                                {{$errors->first('street_mohallah')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="address01">Village / Town</label>

                            <input type="text" class="form-control {{ $errors->has('address01') ? 'is-invalid' : ''}}" id="address01" value="{{ old('address01', $application->address01) }}" name="address01" />

                            @error('address01')

                            <div class="invalid-feedback">

                                {{$errors->first('address01')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-2">

                            <label for="city">City </label>

                            <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : ''}}" id="city" value="{{ old('city', $application->city) }}" name="city" />

                            @error('city')

                            <div class="invalid-feedback">

                                {{$errors->first('city')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-2">

                            <label for="tehsil">Tehsil </label>

                            <input type="text" class="form-control {{ $errors->has('tehsil') ? 'is-invalid' : ''}}" id="tehsil" value="{{ old('tehsil', $application->tehsil) }}" name="tehsil" />

                            @error('tehsil')

                            <div class="invalid-feedback">

                                {{$errors->first('tehsil')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-2">

                            <label for="district">District / Political Agency </label>

                            <input type="text" class="form-control {{ $errors->has('district') ? 'is-invalid' : ''}}" id="district" value="{{ old('district', $application->district) }}" name="district" />

                            @error('district')

                            <div class="invalid-feedback">

                                {{$errors->first('district')}}

                            </div>

                            @enderror

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-3">

                            <label for="post_office">Post Office </label>

                            <input type="text" class="form-control {{ $errors->has('post_office') ? 'is-invalid' : ''}}" id="post_office" value="{{ old('post_office', $application->post_office) }}" name="post_office" />

                            @error('post_office')

                            <div class="invalid-feedback">

                                {{$errors->first('post_office')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="police_station">Police Station </label>

                            <input type="text" class="form-control {{ $errors->has('police_station') ? 'is-invalid' : ''}}" id="police_station" value="{{ old('police_station', $application->police_station) }}" name="police_station" />

                            @error('police_station')

                            <div class="invalid-feedback">

                                {{$errors->first('police_station')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-4">

                            <label for="railway_station">Railway Station and Distance from residence</label>

                            <input type="text" class="form-control {{ $errors->has('railway_station') ? 'is-invalid' : ''}}" id="railway_station" value="{{ old('railway_station', $application->railway_station) }}" name="railway_station" />

                            @error('railway_station')

                            <div class="invalid-feedback">

                                {{$errors->first('railway_station')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-2">

                            <label for="bus_stop">Nearest Bus Stop </label>

                            <input type="text" class="form-control {{ $errors->has('bus_stop') ? 'is-invalid' : ''}}" id="bus_stop" value="{{ old('bus_stop', $application->bus_stop) }}" name="bus_stop" />

                            @error('bus_stop')

                            <div class="invalid-feedback">

                                {{$errors->first('bus_stop')}}

                            </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>





            <div class="row mb-5">

                <div class="col-md-9"><button type="submit" id="btnSubmit" class="btn btn-primary btn-lg btn-block mt-5">Update</button></div>

                <div class="col-md-3"><a href="{{route('application.show', ['application' => $application->id])}}" class="btn btn-secondary btn-lg btn-block mt-5">Cancel</a></div>

            </div>

        </form>







        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">Education Details</h3>

                <div class="card-tools">

                    <button type="button" onclick="addEducation()" class="btn btn-primary btn-sm">Add Education</button>

                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                </div>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

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

                                    <th>Action</th>

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

                                    <td width="9%">

                                        <button onclick="editEdu({{$education}})" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button>

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>



        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">Previous Work History</h3>

                <div class="card-tools">

                    <button type="button" onclick="addWorkHistory()" class="btn btn-primary btn-sm">Add Work history</button>

                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                </div>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

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

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($workHistories as $work_history)

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

                                            <img src="{{ asset('storage/images/applications/' . $application->folder_name    . '/' . $work_history->attachment)}}" class="img-fluid" width="50px" alt="{{$work_history->job_title}}">

                                        </a>

                                        @elseif($work_history->attachment)

                                        <a href="/storage/images/applications/{{$application->folder_name}}/{{$work_history->attachment}}" target="_blank">{{ substr($work_history->attachment, -9,5)}}</a>

                                        @else

                                        <p>No file</p>

                                        @endif

                                    </td>

                                    <td width="9%">

                                        <button onclick="editWorkHistory({{$work_history}})" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button>

                                    </td>

                                </tr>

                                @endforeach



                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<div class="modal" tabindex="-1" role="dialog" id="addEducationModal">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header" style="cursor: pointer;">

                <h5 class="modal-title" id="modal_title">Add New Education</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="addEduModalBody">

            </div>

        </div>

    </div>

</div>

@endsection



@section('scripts')
<script>
    const application = <?php echo json_encode($application) ?>;
</script>

<script src="{{ asset('js/applications/edit.js') }}"></script>


@endsection