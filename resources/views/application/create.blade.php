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
        <form method="POST" id="application_create_form" action="{{route('applications.store')}}" class="needs-validation" enctype="multipart/form-data">
            @csrf

            @if(count($errors))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                You have errors in the form.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="form-group row">
                <label for="cnic" class="col-sm-2 col-form-label">Applicant CNIC</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control {{ $errors->has('cnic') ? 'is-invalid' : ''}}" id="cnic" name="cnic" value="{{ old('cnic')}}" data-inputmask="'mask': ['99999-9999999-9', '999999-999999-9']" data-mask oninvalid="this.setCustomValidity('CNIC is required')" oninput="this.setCustomValidity('')" required />
                    @error('cnic')
                    <div class="invalid-feedback">
                        {{$errors->first('cnic')}}
                    </div>
                    @enderror
                </div>

                <label for="name" class="col-sm-2 col-form-label">Applicant Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="{{ old('name')}}" oninvalid="this.setCustomValidity('Applicant name is required')" oninput="this.setCustomValidity('')" required />
                    @error('name')
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="education" class="col-sm-2 col-form-label">Education</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control {{ $errors->has('education') ? 'is-invalid' : ''}}" id="education" value="{{ old('education')}}" name="education" />
                    @error('education')
                    <div class="invalid-feedback">
                        {{$errors->first('education')}}
                    </div>
                    @enderror
                </div>

                <label for="job_type_id" class="col-sm-2 col-form-label">Position Applied For</label>
                <div class="col-sm-4">
                    <select id="job_type_id" name="job_type_id" class="form-control {{ $errors->has('job_type_id') ? 'is-invalid' : ''}}" oninvalid="this.setCustomValidity('Position applied for is required')" oninput="this.setCustomValidity('')" required>
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
            </div>

            <div class="form-group row">
                <label for="years_of_experience" class="col-sm-2 col-form-label">Years of Experience</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control {{ $errors->has('years_of_experience') ? 'is-invalid' : ''}}" id="years_of_experience" value="{{ old('years_of_experience') }}" name="years_of_experience" />
                    @error('years_of_experience')
                    <div class="invalid-feedback">
                        {{$errors->first('years_of_experience')}}
                    </div>
                    @enderror
                </div>

                <label for="referee_name" class="col-sm-2 col-form-label">Name of Referee</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control {{ $errors->has('referee_name') ? 'is-invalid' : ''}}" id="referee_name" value="{{ old('referee_name') }}" name="referee_name" />
                    @error('referee_name')
                    <div class="invalid-feedback">
                        {{$errors->first('referee_name')}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="mobile_no" class="col-sm-2 col-form-label">Mobile Number</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control {{ $errors->has('mobile_no') ? 'is-invalid' : ''}}" id="mobile_no" value="{{ old('mobile_no') }}" name="mobile_no" />
                    @error('mobile_no')
                    <div class="invalid-feedback">
                        {{$errors->first('mobile_no')}}
                    </div>
                    @enderror
                </div>
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="email" value="{{ old('email') }}" name="email" accept="image/*, application/pdf" />
                    @error('email')
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="cv" class="col-sm-2 col-form-label">CV</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control {{ $errors->has('cv') ? 'is-invalid' : ''}}" id="cv" value="{{ old('cv') }}" name="cv" accept="image/*, application/pdf" />
                    @error('cv')
                    <div class="invalid-feedback">
                        {{$errors->first('cv')}}
                    </div>
                    @enderror
                </div>


            </div>

            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-4">
                    <textarea class="form-control  {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address" placeholder="Address">{{old('address')}}</textarea>
                    @error('address')
                    <div class="invalid-feedback">
                        {{$errors->first('address')}}
                    </div>
                    @enderror
                </div>
                <label for="remarks" class="col-sm-2 col-form-label">remarks</label>
                <div class="col-sm-4">
                    <textarea class="form-control  {{ $errors->has('remarks') ? 'is-invalid' : '' }}" id="remarks" name="remarks" placeholder="Remarks">{{old('remarks')}}</textarea>
                    @error('remarks')
                    <div class="invalid-feedback">
                        {{$errors->first('remarks')}}
                    </div>
                    @enderror
                </div>
            </div>


            <div class="row mt-5">
                <div class="col-7">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btnSubmit">Submit</button>
                </div>
                <div class="col-3">
                    <button type="reset" class="btn btn-outline-info btn-lg btn-block">Reset</button>
                </div>
                <div class="col-2">
                    <a href="{{route('applications.index')}}" class="btn btn-outline-danger btn-lg btn-block">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</section>

@include('partials.modalalert', ['title' => 'Add Row', 'message' => 'Title is required.'])
@endsection

@section('scripts')
<script src="{{ asset('js/applications/create.js') }}"></script>
@endsection