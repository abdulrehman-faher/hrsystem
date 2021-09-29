@extends('layouts.master', ['title'=> 'Applications', 'active' => 'application', 'activeChild' => ''])



@section('breadcrumb')

<ol class="breadcrumb float-sm-right">

    <li class="breadcrumb-item"><a href="#">Home</a></li>

    <li class="breadcrumb-item"><a href="{{route('applications.index')}}">Applications</a></li>

    <li class="breadcrumb-item active">{{$application->name}}</li>

</ol>

@endsection



@section('content')

<section class="content">



    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card card-primary">

                    <div class="card-header clearfix">

                        <h3 class="card-title float-left">{{$application->name}}</h3>

                        <a href="{{route('application.edit', ['application' => $application->id])}}" class="btn btn-sm btn-info float-right"><i class="far fa-edit"></i> Edit</a>

                    </div>

                    <!-- /.card-header -->

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">

                                <img src="{{ asset('storage/images/common/applicant.jpg')}}" width="250px" class="img-fluid" alt="{{$application->name}}">

                            </div>

                            <div class="col-md-9 col-lg-9 col-sm-6 col-xs-12">

                                <div class="row">

                                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                                        <table class="table">

                                            <tobdy>

                                                <tr>

                                                    <th>Name</th>

                                                    <td>{{$application->name}}</td>

                                                </tr>

                                                <tr>

                                                    <th>CNIC</th>

                                                    <td>{{$application->cnic}}</td>

                                                </tr>

                                                <tr>

                                                    <th>Position Applied For</th>

                                                    <td>{{$jobType[0]}}</td>

                                                </tr>

                                                <tr>

                                                    <th>Email</th>

                                                    <td>{{$application->email}}</td>

                                                </tr>

                                                <tr>

                                                    <th>Contract type</th>

                                                    <td>{{$typeOfContract[0]}}</td>

                                                </tr>

                                            </tobdy>

                                        </table>

                                    </div>

                                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                                        <table class="table">

                                            <tobdy>

                                                <tr>

                                                    <th>Date of birth</th>

                                                    <td>{{ Carbon\Carbon::parse($application->dob)->format('d/m/Y') }} - ({{$application->dob_in_words}})</td>

                                                </tr>

                                                <tr>

                                                    <th>Place of birth</th>

                                                    <td>{{$application->place_of_birth}}</td>

                                                </tr>

                                                <tr>

                                                    <th>Gender</th>

                                                    <td>{{ucfirst($application->gender)}}</td>

                                                </tr>

                                                <tr>

                                                    <th>Father Name</th>

                                                    <td>{{$application->father_name}}</td>

                                                </tr>

                                                <tr>

                                                    <th>Father Profession</th>

                                                    <td>{{$application->father_profession}}</td>

                                                </tr>

                                            </tobdy>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>



                    </div>

                    <!-- /.card-body -->

                </div>

                <!-- /.card -->

            </div>

            <!-- /.col -->

        </div>

        <!-- /.row -->



        <div class="row">

            <div class="col-12 col-sm-12">

                <div class="card card-primary card-outline card-tabs">

                    <div class="card-header p-0 pt-1 border-bottom-0">



                        <ul class="nav nav-tabs">

                            <li class="nav-item">

                                <a class="nav-link active" data-toggle="tab" href="#tabHome">Home</a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link" data-toggle="tab" href="#tabEducation">Education Details</a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link" data-toggle="tab" href="#tabWorkHistory">Work History</a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link" data-toggle="tab" href="#tabDocuments">Attached Documents</a>

                            </li>

                        </ul>

                    </div>

                    <div class="card-body">

                        <div class="tab-content" id="custom-tabs-three-tabContent">

                            <div id="tabHome" class="tab-pane fade show active">

                                @include('application.components.home')

                            </div>

                            <div id="tabEducation" class="tab-pane fade">

                                @include('application.components.educationshow')

                            </div>

                            <div id="tabWorkHistory" class="tab-pane fade">

                                @include('application.components.workhistoryshow')

                            </div>

                            <div id="tabDocuments" class="tab-pane fade">

                                @include('application.components.documents')

                            </div>

                        </div>

                    </div>

                    <!-- /.card -->

                </div>

            </div>

        </div>

    </div>





</section>

@endsection