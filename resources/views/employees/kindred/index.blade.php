@extends('layouts.master', ['title'=> 'Employees', 'active' => 'employee', 'activeChild' => ''])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Employees</a></li>
    <li class="breadcrumb-item active">{{$employee->name}}</li>
</ol>
@endsection

<style>
    .img-div {
        max-height: 250px;
        overflow: hidden;
    }
</style>

<?php $current_year = date('Y'); ?>
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('employees.partials.empInfo')

                <div class="card card-info">
                    <div class="card-header clearfix">
                        <h3 class="card-title float-left mt-1">Kindered Roll and Names</h3>
                        <div class="float-right">
                            <button type="button" onclick="addKindered()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nearest Relative</th>
                                        <th>Name</th>
                                        <th>D.O.B</th>
                                        <th>Date of Marriage</th>
                                        <th>Next of Kin (Legal Heir).</th>
                                        <th>CNIC</th>
                                        <th>Date of Entry</th>
                                        <th>AuthorizedBy</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($kindereds as $key => $kinderd)
                                    <tr>
                                        <th colspan="10">
                                            <h4>{{$loop->iteration}} - {{Str::ucfirst($key)}}</h4>
                                        </th>
                                    </tr>
                                    @if ($kinderd)
                                    @foreach ($kinderd as $k)
                                    <tr>
                                        <td>{{$loop->parent->iteration}}.{{$loop->iteration}}</td>
                                        <th>{{$key == 'parents' ? Str::ucfirst($k['relationship']) : ''}}</th>
                                        <td>{{$k['name']}}</td>
                                        <td>{{Helper::parseDate($k['dob'], 'd/m/Y')}}</td>
                                        <td>{{Helper::parseDate($k['marriage_date'], 'd/m/Y')}}</td>
                                        <td>{{$k['next_of_kin']}}</td>
                                        <td>{{$k['cnic']}}</td>
                                        <td>{{Helper::parseDate($k['date_of_entry'], 'd/m/Y')}}</td>
                                        <td>{{$k['authenticated_by'] ? $k['authenticated_by']['name'] : '' }}</td>
                                        <td width="15%">
                                            <button onclick="editKindered({{ json_encode($k) }}, '{{$employee->id}}')" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button> &nbsp;
                                            <a href="{{route('employees_medical.show', ['employee' => $employee->id, 'medical' => $k['id']])}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
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
    const relationships = <?php echo json_encode($kindered_relations); ?>;
</script>
<script src="{{ asset('js/emp_kindered.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>

@endsection