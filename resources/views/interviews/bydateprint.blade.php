@extends('layouts.print', ['title'=> 'Interviews', 'active' => 'interview', 'activeChild' => ''])

@section('content')
<div class="card card-default color-palette-box">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-1">
            <h4 style="margin-bottom: 0"></h4>
            <h4 style="margin-bottom: 0">DHA HR CLUBS BRANCH</h4>
            <h3 class="card-title font-weight-bold">Copy For: <span id="copy_for_span"></span></h3>
        </div>
        <div class="d-flex justify-content-between">
            <h4 style="margin-bottom: 0"></h4>
            <h4 style="margin-bottom: 0">INTERVIEW FOR&nbsp;<span id="club_name_span"></span>&nbsp;CANDIDATES</h4>
            <h3 class="card-title font-weight-bold">Dated: <span id="date_span"><span></h3>
        </div>
    </div>
    <table class="table table-bordered dt-responsive nowrap mb-0" style="width:100%">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Name</th>
                <th>Father's Name</th>
                <th>Education</th>
                <th>Position Applied for</th>
                <th>Experience</th>
                <th>Contact #</th>
                <th>Reference</th>
                <th width="350px">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($interviews as $interview)
                <tr>
                    <td colspan="4" class="border-left-0">
                        <h5 class="pl-5 font-weight-bolder">{{$interview->jobType->title}}</h5>
                    </td>
                    <td colspan="3">
                        <h5 class="font-weight-bolder">Required: {{$interview->candidates_required}}x {{$interview->jobType->title}}</h5>
                    </td>
                    <td colspan="2">
                        <h5 class="font-weight-bolder">Salary: {{$interview->salary_range}}</h5>
                    </td>
                </tr>
                @foreach($interview->candidates as $applicant)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $applicant->application->name }}</td>
                        <td>{{ $applicant->application->father_name }}</td>
                        <td>{{ $applicant->application->education }}</td>
                        <td>{{ $interview->jobType->title }}</td>
                        <td>{{ $applicant->application->years_of_experience }}</td>
                        <td>{{ $applicant->application->phone_number }}</td>
                        <td>{{ $applicant->application->referee_name }}</td>
                        <td>{{ $interview->remarks }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
//window.print();
//$('#copy_for_span').val('bori bistra');
function getDate(date) {
    const monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
    ];
    const dateObj = date ? date : new Date();
    const month = monthNames[dateObj.getMonth()];
    const day = String(dateObj.getDate()).padStart(2, "0");
    const year = dateObj.getFullYear();

    return `${day} ${month} ${year}`;
}
document.getElementById('copy_for_span').innerHTML = localStorage.getItem("copy_for");
document.getElementById('date_span').innerHTML = localStorage.getItem("dated_date");
document.getElementById('club_name_span').innerHTML = localStorage.getItem("club_name");
</script>
@endsection