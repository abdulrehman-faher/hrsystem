@extends('layouts.master', ['title'=> 'Users', 'active' => 'user', 'activeChild' => 'userViewAll'])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Users</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">

        <div class="card ">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="activeUsers-tab" data-toggle="pill" href="#activeUsers" role="tab" aria-controls="activeUsers" aria-selected="true">Active</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="inactiveUsers-tab" data-toggle="pill" href="#inactiveUsers" role="tab" aria-controls="inactiveUsers" aria-selected="false">Inactive</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="allUsers-tab" data-toggle="pill" href="#allUsers" role="tab" aria-controls="allUsers" aria-selected="false">All</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="activeUsers" role="tabpanel" aria-labelledby="activeUsers-tab">
                                <h3 class="mb-3">Active Users</h3>
                                <table id="users_data_active" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="1px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Club</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="inactiveUsers" role="tabpanel" aria-labelledby="inactiveUsers-tab">
                                <h3 class="mb-3">In-Active Users</h3>
                                <table id="users_data_inactive" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="1px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Club</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="allUsers" role="tabpanel" aria-labelledby="allUsers-tab">
                                <h3 class="mb-3">All Users</h3>
                                <table id="users_data_all" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="1px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Club</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection

@section("scripts")
<script>
    const activeUsersDT = $('#users_data_active').DataTable(dtOptions("{{ route('users.active') }}", getDTColumns()));
    const inactiveUsersDT = $('#users_data_inactive').DataTable(dtOptions("{{ route('users.inactive') }}", getDTColumns()));
    const allUsersDT = $('#users_data_all').DataTable(dtOptions("{{ route('users.all') }}", getDTColumns()));

    function getDTColumns() {
        return [{
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
                data: 'club_id',
                name: 'club_id'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'active',
                name: 'active'
            },
            {
                data: 'created_by',
                name: 'created_by'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    }
</script>
@endsection