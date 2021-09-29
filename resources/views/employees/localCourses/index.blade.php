@extends('layouts.master', ['title'=> 'Employees', 'active' => 'employee', 'activeChild' => ''])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="/employees">Employees</a></li>
    <li class="breadcrumb-item"><a href="/employees/{{$employee->id}}">{{$employee->name}}</a></li>
    <li class="breadcrumb-item active">Local Courses</li>
</ol>
@endsection

@section('content')
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('employees.partials.empInfo')
            </div>
            <!-- /.col -->
        </div>
        <div class="card card-info">
            <div class="card-header clearfix">
                <h3 class="card-title float-left mt-1">Local Courses</h3>
                <div class="float-right">
                    <button type="button" onclick="addLocalCourse('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm">Add New</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="employee_localCourse_data" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2" width="1px">#</th>
                                    <th rowspan="2">Course Title</th>
                                    <th colspan="2">Date</th>
                                    <th rowspan="2">Held At (Place)</th>
                                    <th rowspan="2">Grade</th>
                                    <th rowspan="2">Marks</th>
                                    <th colspan="2">Authentication</th>
                                    <th rowspan="2">Attachment</th>
                                    <th rowspan="2">Action</th>

                                </tr>
                                <tr class="text-center">
                                    <th>From</th>
                                    <th>To</th>
                                    <th>By</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

</section>
@include('employees.partials.modal')
@endsection


@section('scripts')
<script>
    const url = "{{ route('employees_local_course.index', ['employee' => $employee->id]) }}";
    // const reloadInPage = false;
    let table = $('#employee_localCourse_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
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
                data: 'title',
                name: 'title'
            },
            {
                data: 'date_from',
                name: 'date_from'
            },
            {
                data: 'date_to',
                name: 'date_to'
            },
            {
                data: 'held_at_place',
                name: 'held_at_place'
            },
            {
                data: 'grade',
                name: 'grade'
            },
            {
                data: 'marks',
                name: 'marks'
            },
            {
                data: 'authorized_by',
                name: 'authorized_by'
            },
            {
                data: 'authorized_by_date',
                name: 'authorized_by_date'
            },
            {
                data: 'attachment',
                name: 'attachment'
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

    setInterval(function() {
        table.draw();
    }, 1800000);
</script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/emp_localCourse.js') }}"></script>
@endsection