@extends('layouts.master', ['title'=> 'Employees', 'active' => 'employee', 'activeChild' => 'employeeViewAll'])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Employees</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header clearfix">
                <h3 class="card-title float-left">All Employees</h3>
                <a href="{{route('employees.create')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i> Add New</a>
            </div>

            <div class="card-body">
                <table id="employee_data" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="1px">#</th>
                            <th>Name</th>
                            <th>Emp #</th>
                            <th>Job Type</th>
                            <th>Department</th>
                            <th>Appointment</th>
                            <th>Club</th>
                            <!-- <th>Email</th> -->
                            <th>Phone</th>
                            <th>CNIC</th>
                            <th width="1px">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection

@section('scripts')

<script>
    const initialSearchTerm = "{{ app('request')->filled('search') ? app('request')->input('search')  : '' }}"

    // let initialSearchTerm = '';

    // $(document).ready(function() {

    $('#employee_data').DataTable({

        processing: true,

        serverSide: true,

        ajax: {

            url: "{{ route('employees.index') }}"

        },

        order: [],

        search: {

            search: initialSearchTerm

        },



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

                data: 'name',

                name: 'name'

            },

            {

                data: 'employee_number',

                name: 'employee_number'

            },

            {

                data: 'job_type_id',

                name: 'job_type_id'

            },

            {

                data: 'department_id',

                name: 'department_id'

            },

            {

                data: 'appointment',

                name: 'appointment'

            },

            {

                data: 'club_id',

                name: 'club_id'

            },

            // {

            //     data: 'email',

            //     name: 'email'

            // },

            {

                data: 'phone_number',

                name: 'phone_number'

            },

            {

                data: 'cnic',

                name: 'cnic'

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