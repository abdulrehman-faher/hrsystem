@extends('layouts.master', ['title'=> 'Employees', 'active' => 'employee', 'activeChild' => ''])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="/employees">Employees</a></li>
    <li class="breadcrumb-item"><a href="/employees/{{$employee->id}}">{{$employee->name}}</a></li>
    <li class="breadcrumb-item"><a href="/employees/{{$employee->id}}/medicals">Medicals</a></li>
    <li class="breadcrumb-item active">{{$medical->title}}</li>
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
                <h3 class="card-title float-left">Medical - ({{$medical->title}})</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <table class="table">
                            <tobdy>
                                <tr>
                                    <th>Title</th>
                                    <td>
                                        <select id="medical" name="medical" class="form-control js-example-basic-single">
                                            @foreach($medicals as $med)
                                            <option value="{{route('employees_medical.show', ['employee' => $employee->id, 'medical' => $med->id])}}" {{ $med->id == $medical->id ? "selected":"" }}>{{$med->title}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Hospital Name</th>
                                    <td>{{ $medical->hospital_name }}</td>
                                </tr>
                                <tr>
                                    <th>Appt</th>
                                    <td>{{$medical->appt }}</td>
                                </tr>
                                <tr>
                                    <th>ION Number</th>
                                    <td>{{$medical->ion_number}}</td>
                                </tr>
                                <tr>
                                    <th>Created By</th>
                                    <td>{{$medical->createdBy->name}}</td>
                                </tr>
                            </tobdy>
                        </table>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <table class="table">
                            <tobdy>
                                <tr>
                                    <th>Admission Date</th>
                                    <td>{{$medical->admission_date ? Helper::parseDate($medical->discharge_date, 'd/m/Y') : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Discharge Date </th>
                                    <td>{{$medical->discharge_date ? Helper::parseDate($medical->discharge_date, 'd/m/Y') : ''}}</td>
                                </tr>
                                <tr>
                                    <th>ION Date </th>
                                    <td>{{$medical->ion_date ? Helper::parseDate($medical->ion_date, 'd/m/Y') : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Authorized By </th>
                                    <td>{{$medical->authenticatedBy ? $medical->authenticatedBy->name : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Created at</th>
                                    <td>{{Helper::parseDate($medical->created_at, 'd/m/Y')}}</td>
                                </tr>
                            </tobdy>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        @if($medical->attachment)
        <div class="card card-info">
            <div class="card-header clearfix">
                <h3 class="card-title float-left">Attachment)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ Helper::imgStoragePath($employee->folder_name, $medical->attachment) }}" class="img-fluid" width="100%" alt="{{$medical->title}}">
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        @endif
    </div>

</section>
@endsection

@section('scripts')
<script>
    $(document).on('change', '#medical', function() {
        const url = $(this).val();
        // var url = $(this).data("url");
        console.log(url);
        if (url) { // require a URL
            window.location = url; // redirect
        }
    });
</script>
@endsection