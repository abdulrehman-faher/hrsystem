@extends('layouts.master', ['title'=> 'Search Results', 'active' => '', 'activeChild' => ''])



@section('breadcrumb')

<ol class="breadcrumb float-sm-right">

    <li class="breadcrumb-item"><a href="#">Home</a></li>

    <li class="breadcrumb-item active">Search Results</li>

</ol>

@endsection



@section('content')

<section class="content">



    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">All Employees</h3>

                    </div>

                    <!-- /.card-header -->

                    <div class="card-body">



                        <table id="employee_data" class="table table-bordered dt-responsive nowrap" style="width:100%">

                            <thead>

                                <tr>

                                    <th>Name</th>

                                    <th>CNIC</th>

                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($employees as $employee)

                                <tr>

                                    <td>{{$employee->name}}</td>

                                    <td>{{$employee->cnic}}</td>

                                    <td>Actions here</td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <!-- /.card-body -->

                </div>

            </div>

            <!-- /.col -->

        </div>

        <!-- /.row -->



    </div>





</section>

@endsection





@section('scripts')





@endsection