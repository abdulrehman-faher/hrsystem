@extends('layouts.master', ['title'=> 'Successful Candidates', 'active' => 'successfulCandidates', 'activeChild' => ''])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Successful Candidates</li>
</ol>
@endsection


@section('content')
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-12">

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
                                        <tr align="center">
                                            <th rowspan="2" width="1px">#</th>
                                            <th colspan="4">Applicant</th>
                                            <th colspan="3">Interview</th>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Job Type</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script>
    $('#interview_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('interviews.showSelected') }}"
        },
        order: [],
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false

            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'phone_number',
                name: 'phone_number'
            },
            {
                data: 'job_type_id',
                name: 'job_type_id'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'interview_date',
                name: 'interview_date'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
    });
</script>
@endsection