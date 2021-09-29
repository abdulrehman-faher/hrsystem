@extends('layouts.master', ['title'=> 'Interviews', 'active' => 'interview', 'activeChild' => ''])

<?php $date = $interviews ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $interviews[0]->interview_date)->format('d-m-Y') : ''; ?>
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('interviews.index')}}">Interviews</a></li>
    <li class="breadcrumb-item active">{{$date}}</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header">
                <div class="d-flex justify-content-between mb-1">
                    <h3 class="card-title">DHA HR CLUBS BRANCH</h3>
                    <h3 class="card-title">Copy For: <input id="copy_for_input" style="width: 173px" /> </h3>
                </div>
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">INTERVIEW FOR&nbsp;<Input id="club_name_input" style="width:" />&nbsp;CANDIDATES</h3>
                    <h3 class="card-title" p>Dated: <input id="dated_type_date" type="date" /> </h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr</th>
                            <th>Name</th>
                            <th>Father's Name</th>
                            <th>Education</th>
                            <th>Position Applied for</th>
                            <th>Experience</th>
                            <th>Contact #</th>
                            <th>Reference</th>
                            <th width="350px">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($interviews as $interview)
                        <tr>
                            <td colspan="4" class="border-left-0">
                                <h5 class="pl-5 font-weight-bolder">{{$interview->jobType->title}}</h5>
                            </td>
                            <td colspan="3">
                                <h5 class="font-weight-bolder">Required: {{$interview->candidates_required}}x {{$interview->jobType->title}}</h5>
                            </td>
                            <td colspan="2">
                                <div class="d-flex justify-content-between mb-1">
                                    <h5 class="font-weight-bolder">Salary: {{$interview->salary_range}}</h5>
                                    <div>
                                        <a href="{{route('interviews.interview', ['interview' => $interview])}}" class="btn btn-sm btn-secondary">Interview</a>
                                        <a href="{{ route('interviews.edit', ['interview' => $interview]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @foreach($interview->candidates as $applicant)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $applicant->application->name }}</td>
                            <td>{{ $applicant->application->father_name }}</td>
                            <td>{{ $applicant->application->education }}</td>
                            <td>{{ $interview->jobType->title }}</td>
                            <td>{{ $applicant->application->years_of_experience }}</td>
                            <td>{{ $applicant->application->phone_number }}</td>
                            <td>{{ $applicant->application->referee_name }}</td>
                            <td>{{ $interview->remarks }}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{route('interviews.byDate', ['interview' => $interviews[0]->id . '?print'])}}" target="_blank" class="btn btn-lg btn-outline-info">Printable version</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/interviews/bydate.js') }}"></script>
@endsection