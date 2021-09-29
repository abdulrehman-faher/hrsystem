@extends('layouts.master', ['title'=> 'Activity Logs', 'active' => 'logs', 'activeChild' => ''])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Logs</li>
</ol>
@endsection


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header clearfix">
                        <h3 class="card-title float-left">User Activity Log</h3>
                        <a href="#" class="btn btn-sm btn-primary float-right"><i class="fas fa-cog"></i> Action</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="logs_datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="1px">#</th>
                                    <th>Club</th>
                                    <th>Log Name</th>
                                    <th>Action</th>
                                    <th>Old Values</th>
                                    <th>New Values</th>
                                    <th>Amended By</th>
                                    <th>Amended Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activity)
                                <tr>
                                    <td width="1px">{{$loop->iteration}}</td>
                                    <td>{{ ucwords($activity->causer->club->title) }}</td>
                                    <td>{{ Helper::normalCase( $activity->log_name) }}</td>
                                    <td>{{ ucwords($activity->description) }}</td>
                                    <td>
                                        <ul>
                                            @if(isset($activity->properties['old']))
                                            @foreach($activity->properties['old'] as $key => $property)
                                            <li>{{ Helper::normalCase($key) }} => {{ $property ? Helper::normalCase($property) : 'null' }}</li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($activity->properties['attributes'] as $key => $property)
                                            <li>{{ Helper::normalCase($key) }} => {{ $property ? Helper::normalCase($property) : 'null'  }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{$activity->causer->name}}</td>
                                    <td>{{$activity->created_at ? Helper::parseDate($activity->created_at, 'd/m/Y H:i:s') : ''}}</td>
                                    <td>Actions</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script>
    const initialSearchTerm = "{{ app('request')->filled('search') ? app('request')->input('search')  : '' }}"
    // let initialSearchTerm = '';
    // $(document).ready(function() {
    const url = "{{ route('logs.index') }}";
    var table = $('#logs_datatabless').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url
        },
        order: [],
        // dom: 'lBfrtip',
        // lengthMenu: [
        //     [10, 25, 50, 100, 200, 500, 1000, -1],
        //     ['10', '25', '50', '100', '200', '500', '1000', 'Show all']
        // ],
        // buttons: [
        //     'copy', 'excelHtml5', 'pdfHtml5', 'print',
        //     {
        //         text: '<i class="fas fa-sync-alt"></i> Reload',
        //         action: function(e, dt, node, config) {
        //             dt.ajax.reload();
        //         }
        //     },
        // ],
        // buttons: [
        //     'copy',
        //     {
        //         extend: 'excelHtml5',
        //         // text: '<i class="fas fa-file-excel"></i> Export to Excel',
        //         // titleAttr: 'Export to Excel',
        //         // title: 'Insurance Companies',
        //         exportOptions: {
        //             columns: ':not(:first-child)',
        //         }
        //     },
        //     {
        //         extend: 'pdfHtml5',
        //         // text: '<i class="far fa-file-pdf"></i> Export to PDF',
        //         exportOptions: {
        //             columns: ':not(:first-child)',
        //         }
        //     },
        //     {
        //         text: '<i class="fas fa-sync-alt"></i> Reload',
        //         action: function(e, dt, node, config) {
        //             dt.ajax.reload();
        //         }
        //     },
        //     // 'colvis'
        // ],
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false

            },
            {
                data: 'club',
                name: 'club'
            },
            {
                data: 'log_name',
                name: 'log_name'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'properties_old',
                name: 'properties_old'
            },
            {
                data: 'properties_new',
                name: 'properties_new'
            },
            {
                data: 'causer_id',
                name: 'causer_id'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function() {
                        column.search($(this).val(), false, false, true).draw();
                    });
            });
        }
    });
</script>
@endsection