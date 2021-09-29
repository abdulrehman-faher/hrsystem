@extends('layouts.master', ['title'=> 'Interviews', 'active' => 'interview', 'activeChild' => ''])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('interviews.index')}}">Interviews</a></li>
    <li class="breadcrumb-item active">{{$interview->title}}</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">

        <form method="post" action="{{ route('interviews.interviewUpdate', ['interview' => $interview->id])}}" id="addInterviewForm">
            @csrf
            @method('patch')

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
                    <h3 class="card-title">Interview Details</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control-plaintext text-primary" value="{{ $interview->title }}" id="title" name="title" />
                        </div>
                        <label for="interview_date" class="col-sm-2 col-form-label">Date of Interview</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control-plaintext text-primary" value="{{ Carbon\Carbon::parse($interview->interview_date)->format('D, dS F, Y') }}" id="interview_date" name="interview_date" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="candidates_required" class="col-sm-2 col-form-label">Candidates Required</label>
                        <div class="col-sm-4">
                            <input type="text" readonly id="candidates_required" value="{{ $interview->candidates_required }}" name="candidates_required" class="form-control-plaintext text-primary" />
                        </div>
                        <label for="salary_range" class="col-sm-2 col-form-label">Salary Range</label>
                        <div class="col-sm-4">
                            <input type="text" readonly id="salary_range" value="{{ $interview->salary_range }}" name="salary_range" class="form-control-plaintext text-primary" />
                        </div>
                    </div>
                </div>

            </div>

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Candidates</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="interview_data" class="table table-bordered dt-responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th width="1px">#</th>

                                <th>Name</th>

                                @if($interview->job_type_id == 0)

                                <th>Job Title</th>

                                @endif

                                <th>Experience</th>

                                <th>Remarks</th>

                                <th>Hired</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($candidates as $candidate)

                            <input type="hidden" name="application_id[]" value="{{ $candidate->application_id }}" />

                            <tr>

                                <td>{{$loop->iteration}}</td>

                                <td>{{$candidate->application->name}}</td>

                                @if($interview->job_type_id == 0)

                                <td>{{$candidate->application->job_type_id ? $candidate->application->jobType->title : ''}}</td>

                                @endif

                                <td>{{$candidate->application->years_of_experience}}</td>

                                <td><textarea class="form-control" id="remarks{{$candidate->application_id}}" name="remarks[]" rows="3"></textarea></td>

                                <td>

                                    <select id="selected{{$candidate->application_id}}" name="selected[]" class="form-control">

                                        <option value="">Choose...</option>

                                        <option value="1">Yes</option>

                                        <option value="0" selected>No</option>

                                        <!-- <option value="2">Not Decided</option> -->

                                    </select>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>

            <div class="form-row mt-5">
                <div class="form-group col-md-2 offset-6">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                </div>
                <div class="form-group col-md-2">
                    <button type="reset" class="btn btn-info btn-lg btn-block">Reset</button>
                </div>
                <div class="form-group col-md-2">
                    <a href="{{route('interviews.index')}}" class="btn btn-secondary btn-lg btn-block">Cancel</a>
                </div>
            </div>

        </form>

    </div>
</section>
@endsection