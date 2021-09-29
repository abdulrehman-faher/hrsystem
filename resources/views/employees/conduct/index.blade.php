@extends('layouts.master', ['title'=> 'Employees', 'active' => 'employee', 'activeChild' => ''])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="/employees">Employees</a></li>
    <li class="breadcrumb-item"><a href="/employees/{{$employee->id}}">{{$employee->name}}</a></li>
    <li class="breadcrumb-item active">Conducts</li>
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
                <h3 class="card-title float-left mt-1">Conducts</h3>
                <div class="float-right">
                    <button type="button" onclick="addConduct('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm">Add New</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="employee_conduct_data" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th width="13%">Title</th>
                                    <th>Place of Offence</th>
                                    <th>Date of Offence</th>
                                    <th width="30%">Particulars of Offence</th>
                                    <th width="10%">Punishment / Award</th>
                                    <th>Authority Ltr Date</th>
                                    <th>Authorized By</th>
                                    <th width="13%">Action</th>
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
    const url = "{{ route('employees_conduct.index', ['employee' => $employee->id]) }}";

    let table = $('#employee_conduct_data').DataTable({
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
                data: 'title',
                name: 'title'
            },
            {
                data: 'place_of_offence',
                name: 'place_of_offence'
            },
            {
                data: 'date_of_offence',
                name: 'date_of_offence'
            },
            {
                data: 'offence_details',
                name: 'offence_details'
            },
            {
                data: 'punishment',
                name: 'punishment'
            },
            {
                data: 'authority_letter_date',
                name: 'authority_letter_date'
            },
            {
                data: 'authorized_by',
                name: 'authorized_by'
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
        console.log('ran');
        table.draw();
    }, 30000);
</script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/emp_conduct.js') }}"></script>
@endsection