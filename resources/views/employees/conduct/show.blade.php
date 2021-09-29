@extends('layouts.app')

@section('styles')
<style>
    h1,
    h3 {
        color: #3490dc !important;
    }

    .nav-tabs .nav-link.active,
    .nav-tabs .nav-item.show .nav-link {
        background-color: #3691dc;
        color: #f8fafc;
    }

    .img-div {
        max-height: 250px;
        overflow: hidden;
    }
</style>
@endsection

@section('content')
<div class="container">
    @include('employees.partials.empInfo')
    <!-- <div class="mb-4 mt-5 ">
        <div class="clearfix">
            <h1 class="float-left">{{$employeeConduct->title}}</h1>
            <div class="float-right">
                <select id="conducts" name="conducts" class="form-control js-example-basic-single">
                    @foreach($conducts as $conduct)
                    <option value="{{route('employees_conduct.show', ['employee' => $employee->id, 'employeeConduct' => $conduct->id])}}" {{ $employeeConduct->id == $conduct->id ? "selected":"" }} data-url="{{route('employees_conduct.show', ['employee' => $employee->id, 'employeeConduct' => $conduct->id])}}">{{$conduct->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div> -->

    <h3 class="mb-4 mt-5">{{$employeeConduct->title}}</h3>

    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <table class="table">
                <tobdy>
                    <tr>
                        <th>Title</th>
                        <td>
                            <select id="conducts" name="conducts" class="form-control js-example-basic-single">
                                @foreach($conducts as $conduct)
                                <option value="{{route('employees_conduct.show', ['employee' => $employee->id, 'employeeConduct' => $conduct->id])}}" {{ $employeeConduct->id == $conduct->id ? "selected":"" }} data-url="{{route('employees_conduct.show', ['employee' => $employee->id, 'employeeConduct' => $conduct->id])}}">{{$conduct->title}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Place of Offence</th>
                        <td>{{ $employeeConduct->place_of_offence }}</td>
                    </tr>
                    <tr>
                        <th>Date of Offence </th>
                        <td>{{$employeeConduct->date_of_offence ? Helper::parseDate($employeeConduct->date_of_offence, 'd/m/Y') : ''}}</td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td>{{$employeeConduct->user_id}}</td>
                    </tr>
                </tobdy>
            </table>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <table class="table">
                <tobdy>
                    <tr>
                        <th>Punishment / Award </th>
                        <td>{{$employeeConduct->punishment}}</td>
                    </tr>
                    <tr>
                        <th>Punishment / Award Date </th>
                        <td>{{$employeeConduct->punishment_date ? Helper::parseDate($employeeConduct->punishment_date, 'd/m/Y') : ''}}</td>
                    </tr>
                    <tr>
                        <th>Authorized By </th>
                        <td>{{$employeeConduct->authenticatedBy ? $employeeConduct->authenticatedBy->name : ''}}</td>
                    </tr>
                    <tr>
                        <th>Created at</th>
                        <td>{{Helper::parseDate($employeeConduct->created_at, 'd/m/Y')}}</td>
                    </tr>
                </tobdy>
            </table>
        </div>
    </div>
    <h3 class="mt-4 mb-4">Offence Details</h3>
    <p>{!! nl2br($employeeConduct->offence_details) !!}</p>

    @if($employeeConduct->authority_letter_image)
    <h3 class="mt-4 mb-4">Authority Letter Image</h3>
    <img src="{{ Helper::imgStoragePath($employee->folder_name, $employeeConduct->authority_letter_image) }}" class="img-fluid" width="100%" alt="{{$employeeConduct->title}}">
    @endif

    <script>
        $(document).on('change', '#conducts', function() {
            const url = $(this).val();
            // var url = $(this).data("url");
            console.log(url);
            if (url) { // require a URL
                window.location = url; // redirect
            }
        });
    </script>

</div>
@endsection