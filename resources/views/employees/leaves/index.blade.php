@extends('layouts.master', ['title'=> 'Employees', 'active' => 'employee', 'activeChild' => ''])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Employees</a></li>
    <li class="breadcrumb-item active">{{$employee->name}}</li>
</ol>
@endsection


<?php $current_year = date('Y'); ?>
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('employees.partials.empInfo')

                <div class="card card-info">
                    <div class="card-header clearfix">
                        <h3 class="card-title float-left mt-1">Remaining Leaves</h3>
                        <div class="float-right">
                            <select id="years" class="form-control form-control-sm" onchange="getYearlyLeaveBalance(this.value);">
                                @foreach(array_reverse(range(1980, $current_year)) as $year)
                                <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-bordered table-hover" id="leave_balance_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Leave Title</th>
                                        <th>Allowed Leaves</th>
                                        <th>Leaves Taken</th>
                                        <th>Remaining Leaves</th>
                                    </tr>
                                </thead>
                                <tbody id="leave_balance_body"></tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="card card-info">
                    <div class="card-header clearfix">
                        <h3 class="card-title float-left mt-1">Leaves Record</h3>
                        <div class="float-right">
                            <button type="button" onclick="addLeave()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="leave_data" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Type</th>
                                            <th colspan="3" class="text-center">Leave Period</th>
                                            <th rowspan="2" width="30%">Purpose / Reason</th>
                                            <th rowspan="2">Authorized By</th>
                                            <th rowspan="2">Action</th>
                                        </tr>
                                        <tr>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Days</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@include('employees.partials.modal')
@endsection

@section('scripts')
<script>
    let fromDate = undefined;
    const employee_id = "{{$employee->id}}";
    let toDate = undefined;
    const folder_name = "{{$employee->folder_name}}";
    const leaveTypes = <?php echo $leaveTypes; ?>

    var table = $('#leave_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('employees_leaves.index', ['employee' => $employee->id]) }}"
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
        columns: [
            // {
            //     data: 'iteration',
            //     name: 'iteration'
            // },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'from',
                name: 'from'
            },
            {
                data: 'to',
                name: 'to'
            },
            {
                data: 'total_days',
                name: 'total_days'
            },
            {
                data: 'purpose',
                name: 'purpose'
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
        },
        // fnRowCallback: function(row, data, index) {
        //     $('td', row).eq(0).html(index + 1);
        // }
    });

    function closeModal() {
        $('#formModalBody').html('');
        $('#formModal').hide();
    }

    function addLeave() {
        fromDate = undefined;
        toDate = undefined;
        $('#modal_title').html('Add Leave(s)');
        $('#modalDialog').addClass('modal-lg');
        $('#formModalBody').html(leaveModalHtml())
        $('#formModal').show();
    }

    function editLeave(leave_id, employee_id) {
        const url = `/employees/${employee_id}/leaves/${leave_id}`;
        const formModalBody = $('#formModalBody');
        $('#modal_title').html('Update Leave');
        $('#modalDialog').addClass('modal-lg');
        formModalBody.html(`<div align="center"><div align="center" class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status"><span class="sr-only">Loading...</span></div></div>`);
        $('#formModal').show();

        axios.get(url, {
            params: {
                id: leave_id,
                employee_id
            }
        }).then(response => {
            const leave = response.data;
            if (!leave) {
                alert('Invalid Leave');
                return;
            }
            fromDate = leave.from;
            toDate = leave.to;
            // $('#modal_title').html('Update Leave');
            // $('#modalDialog').addClass('modal-lg');
            formModalBody.html(leaveModalHtml(leave))
            // $('#formModal').show();

        }).catch(err => {
            alert('error');
            closeModal();
            console.log('err', err)
        });
    }

    function leaveModalHtml(leave = undefined) {
        let htmlLeaveTypes = '';

        leaveTypes.forEach(leaveType => {
            htmlLeaveTypes += `<option value="${leaveType.id}" ${leave && leave.type_of_leave_id === leaveType.id ? 'selected' : ''}>${leaveType.name}</option>`;
        });

        let form = '';
        if (leave) {
            form += `<form method="POST" action="/employees/${employee_id}/leaves/${leave.id}" id="editLeaveForm" name="editLeaveForm" enctype="multipart/form-data">`;
        } else {
            form += `<form method="POST" action="/employees/${employee_id}/leaves/" id="addLeaveForm" name="addLeaveForm" enctype="multipart/form-data">`;
        }
        form += `<div class="form-row">
                <div class="form-group col-md-4">
                    <label for="type_of_leave_id">Leave Type</label>
                    <select id="type_of_leave_id" name="type_of_leave_id" class="form-control" required>
                        <option value="">Choose...</option>
                        ${htmlLeaveTypes}
                    </select>
                    <div class="invalid-feedback" id="type_of_leave_id_error"></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="from">Leave from</label>
                    <input type="date" class="form-control" value="${leave && leave.from ? moment(leave.from).format('YYYY-MM-DD') : ''}" name="from" id="from" required oninvalid="this.setCustomValidity('Leave from is required')" oninput="this.setCustomValidity('')" />
                    <div class="invalid-feedback" id="from_error"></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="to">Leave to</label>
                    <input type="date" class="form-control" value="${leave && leave.to ? moment(leave.to).format('YYYY-MM-DD') : ''}" name="to" id="to" required oninvalid="this.setCustomValidity('Leave to is required')" oninput="this.setCustomValidity('')" />
                    <div class="invalid-feedback" id="to_error"></div>
                </div>
                <div class="form-group col-md-2">
                    <label for="total_days">Total days</label>
                    <input type="text" class="form-control" value="${leave && leave.total_days ? leave.total_days : ''}" name="total_days" id="total_days"  />
                    <div class="invalid-feedback" id="total_days_error"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="purpose">Purpose / Reason</label>
                    <textarea class="form-control" name="purpose" id="purpose" rows="4">${leave && leave.purpose ? leave.purpose : ''}</textarea>
                    <div class="invalid-feedback" id="purpose_error"></div>
                </div>
            </div>`;

        if (leave && leave.attachment && ['jpeg', 'gif', 'png', 'bmp', 'jpg', 'JPG'].includes(leave.attachment.split('.').pop())) {
            form += `<div class="form-group row">
                <label for="Image" class="col-sm-6 col-form-label"></label>
                <div class="col-sm-6 d-flex justify-content-center">
                    <a href="/storage/images/applications/${folder_name}/${leave.attachment}" target="_blank">
                        <img src="/storage/images/applications/${folder_name}/${leave.attachment}" class="img-fluid modal-img" width="100px" alt="Image for edu">
                    </a>
                </div>
            </div>`
        } else if (leave && leave.attachment) {
            form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                    <a href="/storage/images/applications/${folder_name}/${leave.attachment}" target="_blank">${leave.attachment.slice(-7)}</a>
                </div>
            </div>`
        }
        form += `


            <div class="form-row">
                <div class="col-sm-6">
                    <label for="authorized_by_name">Authorized by</label>
                    <input type="text" class="form-control" name="authorized_by_name" id="authorized_by_name" value="${leave && leave.authenticated_by ? leave.authenticated_by.name : ''}" />
                    <input type="hidden" class="form-control" name="authorized_by" id="authorized_by" value="${leave && leave.authenticated_by ? leave.authenticated_by.id : ''}" />
                    <div id="usersList" class="usersList"></div>
                    <div class="invalid-feedback" id="authorized_by_error"></div>
                </div>
                <div class="col-sm-6">
                    <label for="attachment">Attachment</label>
                    <input type="file" class="form-control" name="attachment" id="attachment" />
                    <div class="invalid-feedback" id="attachment_error"></div>
                </div>
            </div>

            <hr />
            <div class="form-group row">
                <div class="col-sm-4">
                    <button type="button" onclick="closeModal();" class="btn btn-secondary btn-lg btn-block">Close</button>
                </div>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btnSubmitLeave">Save</button>
                </div>
            </div>
        </form>`;

        return form;
    }

    $(document).on('submit', '#editLeaveForm', function(event) {
        event.preventDefault();
        const url = $(this).attr('action');
        ajaxLeaveReq(url, 'put');
    });

    $(document).on('change', '#from', function(event) {
        fromDate = $(this).val();
        const diff = calculateDays(fromDate, toDate);
    });

    $(document).on('change', '#to', function(event) {
        toDate = $(this).val();
        calculateDays(fromDate, toDate);
    });

    function calculateDays(from, to) {
        let total_days;
        if (from && to) {
            const start = moment(from);
            const end = moment(to);
            total_days = end.diff(start, "days") + 1;
        }
        $('#total_days').val(total_days > 0 ? total_days : '');
    }

    $(document).on('submit', '#addLeaveForm', function(event) {
        event.preventDefault();
        const url = $(this).attr('action');
        ajaxLeaveReq(url);
    });

    function ajaxLeaveReq(url, type) {
        const btnSubmitLeave = $('#btnSubmitLeave');
        btnSubmitLeave.text('Please wait...').attr('disabled', true);
        let formData = new FormData();

        const image = document.getElementById('attachment');
        const file = image.files[0];

        formData.append('attachment', file);
        formData.append('type_of_leave_id', $('#type_of_leave_id').val());
        formData.append('from', $('#from').val());
        formData.append('to', $('#to').val());
        formData.append('total_days', $('#total_days').val());
        formData.append('purpose', $('#purpose').val());
        formData.append('authorized_by', $('#authorized_by').val());
        formData.append('_token', "{{ csrf_token() }}");
        if (type === 'put') {
            formData.append('_method', 'put');
        }

        axios.post(url, formData).then(res => {
            btnSubmitLeave.text('Save').attr('disabled', false);
            table.ajax.reload();
            closeModal()
        }).catch(e => {
            btnSubmitLeave.text('Save').attr('disabled', false);
            console.log(e.response.data);
            console.log(e.response.data.errors);
            if (e.response && e.response.data) {

                const errors = e.response.data.errors

                if (errors.type_of_leave_id) {
                    $('#type_of_leave_id').addClass('is-invalid');
                    $('#type_of_leave_id_error').html(errors.type_of_leave_id);
                } else {
                    $('#type_of_leave_id').removeClass('is-invalid');
                }

                if (errors.from) {
                    $('#from').addClass('is-invalid');
                    $('#from_error').html(errors.from);
                } else {
                    $('#from').removeClass('is-invalid');
                }

                if (errors.to) {
                    $('#to').addClass('is-invalid');
                    $('#to_error').html(errors.to);
                } else {
                    $('#to').removeClass('is-invalid');
                }
                if (errors.total_days) {
                    $('#total_days').addClass('is-invalid');
                    $('#total_days_error').html(errors.total_days);
                } else {
                    $('#total_days').removeClass('is-invalid');
                }

                if (errors.purpose) {
                    $('#purpose').addClass('is-invalid');
                    $('#purpose_error').html(errors.purpose);
                } else {
                    $('#purpose').removeClass('is-invalid');
                }

                if (errors.attachment) {
                    $('#attachment').addClass('is-invalid');
                    $('#attachment_error').html(errors.attachment);
                } else {
                    $('#attachment').removeClass('is-invalid');
                }
                if (errors.authorized_by) {
                    $('#authorized_by_name').addClass('is-invalid');
                    $('#authorized_by_error').html(errors.authorized_by);
                } else {
                    $('#authorized_by_name').removeClass('is-invalid');
                }
            }
        });
    }

    $(document).on('keyup', '#authorized_by_name', delay(function(event) {
        const $this = $(this);
        const val = $this.val();
        if (val != '') {
            const url = "{{ route('employees.names')}}";
            axios.get(url, {
                params: {
                    name: val
                }
            }).then(response => {

                let html = "<ul class='list-unstyled'>";
                if (response.data.length) {
                    response.data.forEach(user => {
                        html += `<li class="searched" data-id="${user.id}">${user.name}</li>`;
                    })
                } else {
                    html += `<li  data-id>No User Found</li>`;
                }
                html += "</ul>";
                $('#usersList').fadeIn();
                $('#usersList').html(html);
            }).catch(e => {
                console.log(e.response.data);
            });
        } else {
            $('#usersList').fadeOut();
            $('#usersList').html('');
        }
    }, 500));

    function delay(fn, ms) {
        let timer = 0;
        return function(...args) {
            clearTimeout(timer);
            timer = setTimeout(fn.bind(this, ...args), ms || 0);
        };
    }

    $(document).on('click', '#usersList li', function(event) {
        const $this = $(this);
        const dataId = $this.attr("data-id");

        $('#authorized_by_name').val($this.text());
        $('#authorized_by').val(dataId);
        $('#usersList').fadeOut();
        $('#usersList').html('');

    });

    function getYearlyLeaveBalance(year) {
        const leave_balance_body = $('#leave_balance_body');
        leave_balance_body.html(`
                <tr><td colspan="5">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                </td></tr>    
            `);
        const d = new Date();
        const current_year = d.getFullYear();
        year = year && (year >= 1980 && year < current_year) ? year : current_year;

        const url = `/employees/${employee_id}/leaves/balance?year=${year}`;

        fetch(url)
            .then(result => result.json())
            .then(leavesSum => {
                let html = '';
                leaveLimit = [{
                    id: 1,
                    limit: 30
                }, {
                    id: 2,
                    limit: 30
                }, {
                    id: 3,
                    limit: 30
                }, {
                    id: 4,
                    limit: 30
                }]
                leaveTypes.forEach((type, i) => {
                    const leave_obj = leavesSum.find(leave => leave.id === type.id);
                    const limit_obj = leaveLimit.find(leave => leave.id === type.id);
                    const balance = leave_obj ? limit_obj.limit - parseInt(leave_obj.total_leaves) : limit_obj.limit;
                    html += '<tr>'
                    html += `<td>${i+1}</td>`;
                    html += `<td>${type.name}</td>`;
                    html += `<td>${limit_obj.limit}</td>`;
                    html += `<td>${leave_obj ? leave_obj.total_leaves : '0'}</td>`;
                    html += `<td>${balance}</td>`;
                    html += '</tr>'
                })
                leave_balance_body.html(html);
            });

    }

    getYearlyLeaveBalance();

    // $(function() {
    //     console.log('loaded', leaveTypes);

    //     function getYearlyLeaveBalance(year) {
    //         const leave_balance_body = $('#leave_balance_body');
    //         leave_balance_body.html(`
    //             <tr><td colspan="5">
    //             <div class="d-flex justify-content-center">
    //                 <div class="spinner-border" role="status">
    //                     <span class="sr-only">Loading...</span>
    //                 </div>
    //             </div>
    //             </td></tr>    
    //         `);
    //         const d = new Date();
    //         const current_year = d.getFullYear();
    //         year = year && (year >= 1980 && year < current_year) ? year : current_year;

    //         console.log(year);
    //         const url = `/employees/${employee_id}/leaves/balance`;
    //         axios.get(url, {
    //             params: {
    //                 year
    //             }
    //         }).then(response => {
    //             console.log(response.data)
    //             let html = '';
    //             leaveLimit = [{
    //                 id: 1,
    //                 limit: 30
    //             }, {
    //                 id: 2,
    //                 limit: 30
    //             }, {
    //                 id: 3,
    //                 limit: 30
    //             }, {
    //                 id: 4,
    //                 limit: 30
    //             }]
    //             leaveTypes.forEach((type, i) => {
    //                 const leave_obj = response.data.find(leave => leave.id === type.id);
    //                 const limit_obj = leaveLimit.find(leave => leave.id === type.id);
    //                 const balance = leave_obj ? limit_obj.limit - parseInt(leave_obj.total_leaves) : limit_obj.limit;
    //                 html += '<tr>'
    //                 html += `<td>${i+1}</td>`;
    //                 html += `<td>${type.name}</td>`;
    //                 html += `<td>${limit_obj.limit}</td>`;
    //                 html += `<td>${leave_obj ? leave_obj.total_leaves : '0'}</td>`;
    //                 html += `<td>${balance}</td>`;
    //                 html += '</tr>'
    //             })
    //             leave_balance_body.html(html);
    //         }).catch(err => {
    //             console.log(err.response.data)
    //         })

    //     }
    //     // getYearlyLeaveBalance(2011);
    // });
</script>
@endsection