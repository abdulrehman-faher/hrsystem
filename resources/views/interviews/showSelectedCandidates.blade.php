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
        <div class="row">
            <div class="col-12 col-sm-12">
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext text-primary" value="{{ $interview->title }}" id="title" name="title" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="job_type_id" class="col-sm-2 col-form-label">Job Type</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext text-primary" value="{{ $jobType[0] }}" id="job_type_id" name="job_type_id" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="interview_date" class="col-sm-2 col-form-label">Date of Interview</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext text-primary" value="{{ Carbon\Carbon::parse($interview->interview_date)->format('D, dS F, Y') }}" id="interview_date" name="interview_date" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>



                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Candidates</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
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
                                                <th>Employeed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($interview->candidates as $candidate)
                                            <?php
                                            $className = '';
                                            if ($candidate->selected && $candidate->is_employeed) {
                                                $className = 'table-success';
                                            } else if ($candidate->selected) {
                                                $className = 'table-primary';
                                            }
                                            ?>
                                            <tr class="{{$className}}">
                                                <td width="1px">{{$loop->iteration}}</td>
                                                <td>{{$candidate->application_id ? $candidate->application->name : ''}}</td>
                                                @if($interview->job_type_id == 0)
                                                <td>Job Title</td>
                                                @endif
                                                <td>{{$candidate->application_id ? $candidate->application->years_of_experience : ''}}</td>
                                                <td>{{$candidate->remarks}}</td>
                                                <td>{{$candidate->selected ? 'Yes' : 'No'}}</td>
                                                <td>{{$candidate->is_employeed ? 'Yes' : 'No'}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
@endsection