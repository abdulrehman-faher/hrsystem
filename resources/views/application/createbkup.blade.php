@extends('layouts.master', ['title'=> 'New Application', 'active' => 'application', 'activeChild' => 'applicationAddNew'])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('applications.index')}}">Applications</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <form method="POST" action="{{route('applications.store')}}" enctype="multipart/form-data">
            @csrf

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
                                    <label for="cnic">Applicant CNIC</label>
                                    <input type="text" class="form-control {{ $errors->has('cnic') ? 'is-invalid' : ''}}" id="cnic" value="{{ old('cnic')}}" name="cnic" placeholder="00000-0000000-0" data-inputmask="'mask': ['99999-9999999-9', '999999-999999-9']" data-mask required />
                                    @error('cnic')
                                    <div class="invalid-feedback">
                                        {{$errors->first('cnic')}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="name">Applicant Name</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" value="{{ old('name')}}" name="name" required />
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$errors->first('name')}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="referred_by_name">Referred By</label>
                                    <input type="hidden" id="referred_by_id" value="{{ old('referred_by_id')}}" name="referred_by_id" />
                                    <input type="text" class="form-control {{ $errors->has('referred_by_name') ? 'is-invalid' : ''}}" id="referred_by_name" value="{{ old('referred_by_name')}}" name="referred_by_name" required />
                                    @error('referred_by_name')
                                    <div class="invalid-feedback">
                                        {{$errors->first('referred_by_name')}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="job_type_id">Position Applied For</label>
                                    <select id="job_type_id" name="job_type_id" class="form-control {{ $errors->has('job_type_id') ? 'is-invalid' : ''}}" required>
                                        <option value="">Choose...</option>
                                        @foreach($jobTypes as $key => $value)
                                        <option value="{{$key}}" {{ (old("job_type_id") == $key ? "selected":"") }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('job_type_id')
                                    <div class="invalid-feedback">
                                        {{$errors->first('job_type_id')}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="type_of_contract_id">Contract Type</label>
                                    <select id="type_of_contract_id" name="type_of_contract_id" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach($typeOfContract as $key => $value)
                                        <option value="{{$key}}" {{ (old("type_of_contract_id") == $key ? "selected":"") }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('type_of_contract_id')
                                    <div class="invalid-feedback">
                                        {{$errors->first('type_of_contract_id')}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row hideThis">
                                <div class="form-group col-md-3">
                                    <label for="cv">CV </label>
                                    <input type="file" class="form-control {{ $errors->has('cv') ? 'is-invalid' : ''}}" id="cv" value="{{ old('cv') }}" name="cv" accept="image/*, application/pdf" />
                                    @error('cv')
                                    <div class="invalid-feedback">
                                        {{$errors->first('cv')}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">

                                    <label for="years_of_experience">Years of Experience </label>

                                    <input type="text" class="form-control {{ $errors->has('years_of_experience') ? 'is-invalid' : ''}}" id="years_of_experience" value="{{ old('years_of_experience') }}" name="years_of_experience" />

                                    @error('years_of_experience')

                                    <div class="invalid-feedback">

                                        {{$errors->first('years_of_experience')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="dob">Date of Birth </label>

                                    <input type="date" class="form-control {{ $errors->has('dob') ? 'is-invalid' : ''}}" id="dob" value="{{ old('dob') }}" name="dob" />

                                    @error('dob')

                                    <div class="invalid-feedback">

                                        {{$errors->first('dob')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="dob_in_words">Date of Birth (in words)</label>

                                    <input type="text" class="form-control {{ $errors->has('dob_in_words') ? 'is-invalid' : ''}}" id="dob_in_words" value="{{ old('dob_in_words') }}" name="dob_in_words" />

                                    @error('dob_in_words')

                                    <div class="invalid-feedback">

                                        {{$errors->first('dob_in_words')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="place_of_birth">Place of Birth</label>

                                    <input type="text" class="form-control {{ $errors->has('place_of_birth') ? 'is-invalid' : ''}}" id="place_of_birth" value="{{ old('place_of_birth') }}" name="place_of_birth" />

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

                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="email" value="{{ old('email') }}" name="email" />

                                    @error('email')

                                    <div class="invalid-feedback">

                                        {{$errors->first('email')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="phone_number">Phone Number</label>

                                    <input type="text" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : ''}}" id="phone_number" value="{{ old('phone_number') }}" name="phone_number" data-inputmask="'mask': ['999-999[9]-9999 [x99999]', '+99 99 999[9]-9999']" data-mask>

                                    @error('phone_number')

                                    <div class="invalid-feedback">

                                        {{$errors->first('phone_number')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-2">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="text" class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : ''}}" id="mobile_number" value="{{ old('mobile_number') }}" name="mobile_number" data-inputmask="'mask': ['9999-999-9999', '+99 999 999-9999']" data-mask>
                                    @error('mobile_number')
                                    <div class="invalid-feedback">
                                        {{$errors->first('mobile_number')}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">

                                    <label for="father_name">Father’s Name</label>

                                    <input type="text" class="form-control {{ $errors->has('father_name') ? 'is-invalid' : ''}}" id="father_name" value="{{ old('father_name') }}" name="father_name" />

                                    @error('father_name')

                                    <div class="invalid-feedback">

                                        {{$errors->first('father_name')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="father_profession">Father’s Profession</label>

                                    <input type="text" class="form-control {{ $errors->has('father_profession') ? 'is-invalid' : ''}}" id="father_profession" value="{{ old('father_profession') }}" name="father_profession" />

                                    @error('father_profession')

                                    <div class="invalid-feedback">

                                        {{$errors->first('father_profession')}}

                                    </div>

                                    @enderror

                                </div>

                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-2">

                                    <label for="gender">Gender</label>

                                    <select id="gender" name="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : ''}}">

                                        <option value="">Choose...</option>

                                        @foreach($genders as $key => $value)

                                        <option value="{{$key}}" {{ (old("gender") == $key ? "selected":"") }}>{{$value}}</option>

                                        @endforeach

                                    </select>

                                    @error('gender')

                                    <div class="invalid-feedback">

                                        {{$errors->first('gender')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="height">Height</label>

                                    <input type="text" class="form-control {{ $errors->has('height') ? 'is-invalid' : ''}}" id="height" value="{{ old('height') }}" name="height" />

                                    @error('height')

                                    <div class="invalid-feedback">

                                        {{$errors->first('height')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-2">

                                    <label for="religion">Religion </label>

                                    <input type="text" class="form-control {{ $errors->has('religion') ? 'is-invalid' : ''}}" id="religion" value="{{ old('religion') }}" name="religion" />

                                    @error('religion')

                                    <div class="invalid-feedback">

                                        {{$errors->first('religion')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sect">Sect </label>

                                    <input type="text" class="form-control {{ $errors->has('sect') ? 'is-invalid' : ''}}" id="sect" value="{{ old('sect') }}" name="sect" />

                                    @error('sect')

                                    <div class="invalid-feedback">

                                        {{$errors->first('sect')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="caste">Caste </label>

                                    <input type="text" class="form-control {{ $errors->has('caste') ? 'is-invalid' : ''}}" id="caste" value="{{ old('caste') }}" name="caste" />

                                    @error('caste')

                                    <div class="invalid-feedback">

                                        {{$errors->first('caste')}}

                                    </div>

                                    @enderror

                                </div>

                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-4">

                                    <label for="referee_name">Name of Referee</label>

                                    <input type="text" class="form-control {{ $errors->has('referee_name') ? 'is-invalid' : ''}}" id="referee_name" value="{{ old('referee_name') }}" name="referee_name" />

                                    @error('referee_name')

                                    <div class="invalid-feedback">

                                        {{$errors->first('referee_name')}}

                                    </div>

                                    @enderror

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="referee_address">Address of Referee</label>

                                    <input type="text" class="form-control {{ $errors->has('referee_address') ? 'is-invalid' : ''}}" id="referee_address" value="{{ old('referee_address') }}" name="referee_address" />

                                    @error('referee_address')

                                    <div class="invalid-feedback">

                                        {{$errors->first('referee_address')}}

                                    </div>

                                    @enderror

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

                            <input type="text" class="form-control {{ $errors->has('post') ? 'is-invalid' : ''}}" id="post" value="{{ old('post') }}" name="post" />

                            @error('post')

                            <div class="invalid-feedback">

                                {{$errors->first('post')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-4">

                            <label for="rank">Rank </label>

                            <input type="text" class="form-control {{ $errors->has('rank') ? 'is-invalid' : ''}}" id="rank" value="{{ old('rank') }}" name="rank" />

                            @error('rank')

                            <div class="invalid-feedback">

                                {{$errors->first('rank')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-4">

                            <label for="arm">ARM </label>

                            <input type="text" class="form-control {{ $errors->has('arm') ? 'is-invalid' : ''}}" id="arm" value="{{ old('arm') }}" name="arm" />

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

                            <input type="text" class="form-control {{ $errors->has('last_appointment') ? 'is-invalid' : ''}}" id="last_appointment" value="{{ old('last_appointment') }}" name="last_appointment" />

                            @error('last_appointment')

                            <div class="invalid-feedback">

                                {{$errors->first('last_appointment')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="enrollment_date">Enrollment Date</label>

                            <input type="text" class="form-control {{ $errors->has('enrollment_date') ? 'is-invalid' : ''}}" id="enrollment_date" value="{{ old('enrollment_date') }}" name="enrollment_date" />

                            @error('enrollment_date')

                            <div class="invalid-feedback">

                                {{$errors->first('enrollment_date')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="sos_date">SOS Date</label>

                            <input type="text" class="form-control {{ $errors->has('sos_date') ? 'is-invalid' : ''}}" id="sos_date" value="{{ old('sos_date') }}" name="sos_date" />

                            @error('sos_date')

                            <div class="invalid-feedback">

                                {{$errors->first('sos_date')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="sod_date">SOD Date</label>

                            <input type="text" class="form-control {{ $errors->has('sod_date') ? 'is-invalid' : ''}}" id="sod_date" value="{{ old('sod_date') }}" name="sod_date" />

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

                            <input type="text" class="form-control {{ $errors->has('street_mohallah') ? 'is-invalid' : ''}}" id="street_mohallah" value="{{ old('street_mohallah') }}" name="street_mohallah" />

                            @error('street_mohallah')

                            <div class="invalid-feedback">

                                {{$errors->first('street_mohallah')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="address01">Village / Town</label>

                            <input type="text" class="form-control {{ $errors->has('address01') ? 'is-invalid' : ''}}" id="address01" value="{{ old('address01') }}" name="address01" />

                            @error('address01')

                            <div class="invalid-feedback">

                                {{$errors->first('address01')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-2">

                            <label for="city">City </label>

                            <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : ''}}" id="city" value="{{ old('city') }}" name="city" />

                            @error('city')

                            <div class="invalid-feedback">

                                {{$errors->first('city')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-2">

                            <label for="tehsil">Tehsil </label>

                            <input type="text" class="form-control {{ $errors->has('tehsil') ? 'is-invalid' : ''}}" id="tehsil" value="{{ old('tehsil') }}" name="tehsil" />

                            @error('tehsil')

                            <div class="invalid-feedback">

                                {{$errors->first('tehsil')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-2">

                            <label for="district">District / Political Agency </label>

                            <input type="text" class="form-control {{ $errors->has('district') ? 'is-invalid' : ''}}" id="district" value="{{ old('district') }}" name="district" />

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

                            <input type="text" class="form-control {{ $errors->has('post_office') ? 'is-invalid' : ''}}" id="post_office" value="{{ old('post_office') }}" name="post_office" />

                            @error('post_office')

                            <div class="invalid-feedback">

                                {{$errors->first('post_office')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-3">

                            <label for="police_station">Police Station </label>

                            <input type="text" class="form-control {{ $errors->has('police_station') ? 'is-invalid' : ''}}" id="police_station" value="{{ old('police_station') }}" name="police_station" />

                            @error('police_station')

                            <div class="invalid-feedback">

                                {{$errors->first('police_station')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-4">

                            <label for="railway_station">Railway Station and Distance from residence</label>

                            <input type="text" class="form-control {{ $errors->has('railway_station') ? 'is-invalid' : ''}}" id="railway_station" value="{{ old('railway_station') }}" name="railway_station" />

                            @error('railway_station')

                            <div class="invalid-feedback">

                                {{$errors->first('railway_station')}}

                            </div>

                            @enderror

                        </div>

                        <div class="form-group col-md-2">

                            <label for="bus_stop">Nearest Bus Stop </label>

                            <input type="text" class="form-control {{ $errors->has('bus_stop') ? 'is-invalid' : ''}}" id="bus_stop" value="{{ old('bus_stop') }}" name="bus_stop" />

                            @error('bus_stop')

                            <div class="invalid-feedback">

                                {{$errors->first('bus_stop')}}

                            </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block" id="btnSubmit" disabled>Submit</button>

        </form>

    </div>

</section>

@include('partials.modalalert', ['title' => 'Add Row', 'message' => 'Title is required.'])
@endsection

@section('scripts')
<script src="{{ asset('js/applications/create.js') }}" ></script>
@endsection