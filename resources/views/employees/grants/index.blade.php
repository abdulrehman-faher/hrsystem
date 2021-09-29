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
                        <h3 class="card-title float-left mt-1">Nomination for Misc Grants</h3>
                        <div class="float-right">
                            <button type="button" disabled class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="leave_data" class="table table-bordered" style="width:100%">
                                    <thead align="center">
                                        <tr>
                                            <th rowspan="2"></th>
                                            <th colspan="3">Initial Nominations</th>
                                            <th colspan="6">Subsequent Changes (If Any)</th>
                                        </tr>
                                        <tr>
                                            <th>Nominee</th>
                                            <th>Auth</th>
                                            <th>Date</th>
                                            <th>Nominee</th>
                                            <th>Auth</th>
                                            <th>Date</th>
                                            <th>Nominee</th>
                                            <th>Auth</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Plot if Applicable</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Gp Insurance</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Gratuity</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Leave Encashment</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
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
@endsection

@section('scripts')

@endsection