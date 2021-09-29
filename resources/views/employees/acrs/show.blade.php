@extends('layouts.app')

<?php
$classColorSRO = '';
if ($acr->performanceAppraisalSRO->score < 0) $classColorSRO = 'text-danger';
elseif ($acr->performanceAppraisalSRO->score == 0) $classColorSRO = 'text-secondary';
elseif ($acr->performanceAppraisalSRO->score == 5) $classColorSRO = 'text-primary';
elseif ($acr->performanceAppraisalSRO->score == 10) $classColorSRO = 'text-success';

$classColorIO = '';
if ($acr->performanceAppraisalIO->score < 0) $classColorIO = 'text-danger';
elseif ($acr->performanceAppraisalIO->score == 0) $classColorIO = 'text-secondary';
elseif ($acr->performanceAppraisalIO->score == 5) $classColorIO = 'text-primary';
elseif ($acr->performanceAppraisalIO->score == 10) $classColorIO = 'text-success';
?>

@section('content')
<style>
    @media print {

        #buttons,
        #attachmentsDiv {
            display: none;
        }
    }
</style>
<div class="container">
    <div class="d-flex flex-row-reverse mb-3" id="buttons">
        <a href="{{route('employees_acrs.edit', ['employee' => $employee->id, 'acr' => $acr->id])}}" class="btn btn-warning btn-sm ml-3"><i class="fa fa-pencil"></i> Edit</a>
        <button type="button" class="btn btn-primary btn-sm ml-3" onclick="printDiv('applicationFormDiv')"><i class="fa fa-print"></i> Print Application Form</button>
        <button type="button" class="btn btn-primary btn-sm ml-3" onclick="printDiv('attachmentsDiv')"><i class="fa fa-print"></i> Print Attachments only </button>
        <button type="button" class="btn btn-primary btn-sm ml-3" onclick="printDiv('printEverything')"><i class="fa fa-print"></i> Print full page</button>
    </div>
    <div id="printEverything">
        <div id="applicationFormDiv">
            <h3 class="text-center text-primary">
                @if($employee->club)
                THE DEFENCE CLUB "{{trim(str_replace('Club', '', $employee->club->title))}}" SECTOR <span class="pl-5">ACR - EMPLOYEES</span>
                @else
                DHA <span class="pl-5">ACR - EMPLOYEES</span>
                @endif
            </h3>
            <div class="row mb-4 mt-3">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3">
                            Period Report From
                        </div>
                        <div class="col-md-3">
                            {{$acr->period_from ? Helper::parseDate($acr->period_from, 'd/m/Y') : ''}}
                        </div>
                        <div class="col-md-3">
                            Period Report To
                        </div>
                        <div class="col-md-3">
                            {{$acr->period_to ? Helper::parseDate($acr->period_to, 'd/m/Y') : ''}}
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    Club
                </div>
                <div class="col-md-2">
                    @if($employee->club)
                    <strong>{{trim(str_replace('Club', '', $employee->club->title))}} - ({{$employee->club->number}})</strong>
                    @else
                    <strong>No Club Assigned</strong>
                    @endif
                </div>
            </div>

            <h4 class="text-center text-primary mb-3">PART - I <span class="pl-5">PERSONAL DATA</span></h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>1. Name</th>
                        <td>{{$employee->name}}</td>
                        <th>2. Father Name</th>
                        <td>{{$employee->father_name}}</td>
                    </tr>
                    <tr>
                        <th>3. Appointment</th>
                        <td>{{$employee->appointment}}</td>
                        <th>4. Appointment Date with Grade</th>
                        <td>{{$acr->appointment_date ? Helper::parseDate($acr->appointment_date, 'd/m/Y') : ''}} {{$acr->grade ? '(' . $acr->grade . ')' : ''}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th colspan="6">5. Qualification / Profession Courses</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Degree</th>
                        <th>Institute</th>
                        <th>Marks Obt</th>
                        <th>Grade</th>
                        <th>Year Completed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee->education as $education)
                    <tr>
                        <td class="align-middle">{{$loop->iteration}}</td>
                        <td class="align-middle">{{$education->title}}</td>
                        <td class="align-middle">{{$education->institute_name}}</td>
                        <td class="align-middle">{{$education->marks_obtained}}</td>
                        <td class="align-middle">{{$education->division_grade}}</td>
                        <td class="align-middle">{{$education->year_completed}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th width="40%">6. Period served under</th>
                        <th width="30%">From</th>
                        <th width="30%">To</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="pl-5">a. Initiating Officer</th>
                        <td>{{$acr->period_served_io_from ? Helper::parseDate($acr->period_served_io_from, 'd/m/Y') : ''}} </td>
                        <td>{{$acr->period_served_io_to ? Helper::parseDate($acr->period_served_io_to, 'd/m/Y') : ''}} </td>
                    </tr>
                    <tr>
                        <th class="pl-5">b. Senior Reporting Officer</th>
                        <td>{{$acr->period_served_sro_from ? Helper::parseDate($acr->period_served_sro_from, 'd/m/Y') : ''}} </td>
                        <td>{{$acr->period_served_sro_to ? Helper::parseDate($acr->period_served_sro_to, 'd/m/Y') : ''}} </td>
                    </tr>
                </tbody>
            </table>

            <h4 class="text-center text-primary mb-3">PART - II <span class="pl-5">REPORTING OFFICER'S RECOMMENDATIONS</span></h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="2">7. IO Remarks (Initiating Officer Remarks)</th>
                    </tr>
                    <tr>
                        <th class="pl-5" width="23%">a. Strong Points</th>
                        <td>{!! nl2br($acr->io_remarks_strong_points) !!}</td>
                    </tr>
                    <tr>
                        <th class="pl-5">b. Weak Areas</th>
                        <td>{!! nl2br($acr->io_remarks_weak_area) !!}</td>
                    </tr>
                    <tr>
                        <th class="pl-5">b. Demo Performance</th>
                        <td>{!! nl2br($acr->io_remarks_demo_performance) !!}</td>
                    </tr>
                    <tr>
                        <th>8. Special Achievements</th>
                        <td>{!! nl2br($acr->special_achievements) !!}</td>
                    </tr>
                    <tr>
                        <th>9. Performance Appraisal</th>
                        <td class="{{$classColorIO}}">{{$acr->performanceAppraisalIO->abbr}} ({{$acr->performanceAppraisalIO->title}})</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-borderless table-condensed table-sm">
                <tbody>
                    <tr>
                        <td colspan="2"></td>
                        <td>IO Signature :</td>
                        <td>__________________________________________</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>IO Name :</td>
                        <td>{{$acr->io_name}}</td>
                    </tr>
                    <tr>
                        <td>Sign of Indl :</td>
                        <td>__________________________________________</td>
                        <td>IO Appointment :</td>
                        <td>{{$acr->io_appointment}}</td>
                    </tr>
                    <tr>
                        <td>Emp Sign Date :</td>
                        <td>{{$acr->io_emp_sign_date ? Helper::parseDate($acr->io_emp_sign_date, 'd/m/Y') : ''}}</td>
                        <td>IO Sign Date :</td>
                        <td>{{$acr->io_sign_date ? Helper::parseDate($acr->io_sign_date, 'd/m/Y') : ''}}</td>
                    </tr>
                </tbody>
            </table>

            <h4 class="text-center text-primary mb-3">PART - III <span class="pl-5">SENIOR REPORTING OFFICER'S RECOMMENDATION</span></h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="23%">10. SRO Remarks</th>
                        <td>{!! nl2br($acr->sro_remarks) !!}</td>
                    </tr>
                    <tr>
                        <th>11. Performance Appraisal</th>
                        <td class="{{$classColorSRO}}">{{$acr->performanceAppraisalSRO->abbr}} ({{$acr->performanceAppraisalSRO->title}})</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-borderless table-condensed table-sm">
                <tbody>
                    <tr>
                        <td colspan="2"></td>
                        <td>SRO Signature :</td>
                        <td>__________________________________________</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>SRO Name :</td>
                        <td>{{$acr->sro_name}}</td>
                    </tr>
                    <tr>
                        <td>Sign of Indl :</td>
                        <td>__________________________________________</td>
                        <td>SRO Appointment :</td>
                        <td>{{$acr->sro_appointment}}</td>
                    </tr>
                    <tr>
                        <td>Emp Sign Date :</td>
                        <td>{{$acr->sro_emp_sign_date ? Helper::parseDate($acr->sro_emp_sign_date, 'd/m/Y') : ''}}</td>
                        <td>SRO Sign Date :</td>
                        <td>{{$acr->sro_sign_date ? Helper::parseDate($acr->sro_sign_date, 'd/m/Y') : ''}}</td>
                    </tr>
                </tbody>
            </table>
            @if($acr->authorized_by)
            <table class="table table-bordered table-condensed mb-5">
                <tbody>
                    <tr>
                        <td>Authorized By</td>
                        <th>{{$acr->authenticatedBy->name}}</th>
                        <td>Authorized Date</td>
                        <th>{{$acr->authorized_by_date ? Helper::parseDate($acr->authorized_by_date, 'd/m/Y') : ''}}</th>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
        <div id="attachmentsDiv">
            @if($acr->images)
            <h2 class="text-center text-primary mb-3">Attachments</h2>
            @foreach($acr->images as $image)
            <?php $extension = pathinfo($image->file_name, PATHINFO_EXTENSION); ?>
            @if(in_array($extension, Helper::allowedExtensions()))
            <a href="{{ Helper::imgStoragePath($employee->folder_name, $image->file_name) }}" target="_blank">
                <img src="{{ Helper::imgStoragePath($employee->folder_name, $image->file_name) }}" class="img-fluid" width="100%" alt="Scanned Image" />
            </a>
            <br />
            @else
            <h4 class="mt-4"><a href="{{ Helper::imgStoragePath($employee->folder_name, $image->file_name) }}" target="_blank">{{ $image->file_name }}</a></h4>
            @endif
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function printDiv(divName) {
        const printContents = document.getElementById(divName).innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = `<div class="container">${printContents}</div>`;
        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endsection