@extends('layouts.master', ['title'=> 'Upload Data', 'active' => 'application', 'activeChild' => ''])

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

        <form method="POST" id="applications_create_form" action="{{route('applications.uploadApplicants.post')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="file" class="col-sm-2 col-form-label">Upload File</label>
                <div class="col-sm-3">
                    <input type="file" class="form-control {{ $errors->has('file') ? 'is-invalid' : ''}}" id="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                    @error('file')
                    <div class="invalid-feedback">
                        {{$errors->first('file')}}
                    </div>
                    @enderror
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-block" id="btnSubmit">Upload</button>
                </div>
                <div class="col-2">
                    <a href="{{route('applications.index')}}" class="btn btn-outline-danger btn-block">Cancel</a>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <h3>You can have following columns in your csv file, ordered in same manner </h3>
                </div>
                <div>
                    <a href="{{route('applications.downloadSampleFile')}}">Download sample file</a>
                </div>
            </div>

            <ol>
                <li>CNIC</li>
                <li>Applicant name</li>
                <li>Father name</li>
                <li>Education</li>
                <li>Years of experience</li>
                <li>Phone no</li>
                <li>Mobile no</li>
                <li>Email</li>
                <li>Referee name</li>
                <li>Address</li>
            </ol>

            <!-- <div class="row mt-5">
                <div class="col-9">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btnSubmit">Upload</button>
                </div>
                <div class="col-3">
                    <a href="{{route('applications.index')}}" class="btn btn-outline-danger btn-lg btn-block">Cancel</a>
                </div>
            </div> -->

        </form>
    </div>
</section>

@include('partials.modalalert', ['title' => 'Add Row', 'message' => 'Title is required.'])
@endsection

@section('scripts')
@endsection