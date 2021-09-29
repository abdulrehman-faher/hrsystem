@extends('layouts.master', ['title'=> 'Interviews', 'active' => 'interview', 'activeChild' => 'interviewViewAll'])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Interviews</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">

        <div class="card card-primary card-outline card-tabs">
            <div class="card-header pl-0 border-bottom-0 clearfix">
                <ul class="nav nav-tabs float-left" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" role="tab" href="#tabActiveInterviews">Active Interviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" role="tab" href="#tabConductedInterviews">Conducted Interviews</a>
                    </li>
                    </li>
                </ul>
                <a href="{{ route('interviews.create') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i> Add New</a>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div id="tabActiveInterviews" class="tab-pane fade show active">
                        <table id="interview_data_active" class="table table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Job Type</th>
                                    <th>Required</th>
                                    <th>Salary</th>
                                    <th>Date of Interview</th>
                                    <th width="10%">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div id="tabConductedInterviews" class="tab-pane fade">
                        <table id="interview_data_conducted" class="table table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Job Type</th>
                                    <th>Required</th>
                                    <th>Salary</th>
                                    <th>Date of Interview</th>
                                    <th width="10%">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('scripts')
<script>
    $('#interview_data_active').DataTable(tableOptions("{{ route('interviews.index') }}"));
    $('#interview_data_conducted').DataTable(tableOptions("{{ route('interviews.conducted') }}"));

    function tableOptions(url) {
        return {
            processing: true,
            serverSide: true,
            ajax: {
                url: url
            },
            order: [],
            // lengthMxx
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'job_type_id',
                    name: 'job_type_id'
                },
                {
                    data: 'candidates_required',
                    name: 'candidates_required'
                },
                {
                    data: 'salary_range',
                    name: 'salary_range'
                },
                {
                    data: 'interview_date',
                    name: 'interview_date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
        }
    }
</script>
@endsection
