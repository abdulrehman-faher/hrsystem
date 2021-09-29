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
        <div class="row">
            <div class="col-12">
                @include('employees.partials.empInfo')
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">

                        <ul class="nav nav-tabs ">

                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabHome">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabEducation">Education Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabWorkHistory">Work History</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Forms</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" data-toggle="tab" href="#tabMedicalForm">Medical</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#tabConductsForm">Conduct Sheet</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#tabServiceDataForm">Service Data</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#tablocalCoursesForm">Local Courses</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#tabAcrForm">Record of ACRs</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#tabKinderedForm">Kindered Roll and Names</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#">Nomination for Misc Grants</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#tabLeavesForm">Leaves Record</a>
                                    <!-- <a class="dropdown-item" data-toggle="tab" href="#">Record of Other Types of Leave</a> -->
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabDocuments">Attached Documents</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div class="tab-content">
                            <div id="tabHome" class="tab-pane fade show active">
                                @include('employees.partials.home')
                            </div>
                            <div id="tabEducation" class="tab-pane fade">
                                @include('employees.partials.educationshow')
                            </div>
                            <div id="tabWorkHistory" class="tab-pane fade">
                                @include('employees.partials.workhistoryshow')
                            </div>
                            <div id="tabDocuments" class="tab-pane fade">
                                @include('employees.partials.documents')
                            </div>

                            <!-- Forms -->
                            <div id="tabMedicalForm" class="tab-pane fade">
                                @include('employees.forms.medical')
                            </div>
                            <div id="tabConductsForm" class="tab-pane fade">
                                @include('employees.forms.conducts')
                            </div>
                            <div id="tabServiceDataForm" class="tab-pane fade">
                                @include('employees.forms.serviceData')
                            </div>
                            <div id="tablocalCoursesForm" class="tab-pane fade">
                                @include('employees.forms.localCourses')
                            </div>
                            <div id="tabAcrForm" class="tab-pane fade">
                                @include('employees.forms.acrs')
                            </div>
                            <div id="tabKinderedForm" class="tab-pane fade">
                                @include('employees.forms.kindered')
                            </div>
                            <div id="tabLeavesForm" class="tab-pane fade">
                                @include('employees.forms.leaves')
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>


    @include('employees.partials.modal')
</section>
@endsection

@section('scripts')
<script>
    var employee = <?php echo json_encode($employee) ?>;
</script>

<script src="{{ asset('js/emp_education.js') }}"></script>
<script src="{{ asset('js/emp_workhistory.js') }}"></script>

@endsection