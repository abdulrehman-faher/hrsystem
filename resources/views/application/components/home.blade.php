<table class="table">
    <tbody>
        <tr>
            <th>Name of referee</th>
            <td>{{$application->referee_name}}</td>
            <th>Address of referee</th>
            <td>{{$application->referee_address}}</td>
        </tr>
        <tr>
            <th>Religion</th>
            <td>{{$application->religion}}</td>
            <th>Caste</th>
            <td>{{$application->caste}}</td>
        </tr>
        <tr>
            <th>Height</th>
            <td>{{$application->height}}</td>
            <th>Sect</th>
            <td>{{$application->sect}}</td>
        </tr>
    </tbody>
</table>




<div class="card card-info">
    <div class="card-header clearfix">
        <h3 class="card-title float-left">Address</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <th>Street Mohallah</th>
                    <td>{{$application->street_mohallah}}</td>
                    <th>Village / Town</th>
                    <td>{{$application->address01}}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{$application->city}}</td>
                    <th>Tehsil</th>
                    <td>{{$application->tehsil}}</td>
                </tr>
                <tr>
                    <th>District / Political Agency</th>
                    <td>{{$application->district}}</td>
                    <th>Post Office</th>
                    <td>{{$application->post_office}}</td>
                </tr>
                <tr>
                    <th>Police Station</th>
                    <td>{{$application->police_station}}</td>
                    <th>Nearest Bus Stop</th>
                    <td>{{$application->bus_stop}}</td>
                </tr>
                <tr>
                    <th colspan="2">Railway Station and Distance from residence</th>
                    <td colspan="2">{{$application->railway_station}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card -->
</div>

<div class="card card-info">
    <div class="card-header clearfix">
        <h3 class="card-title float-left">Armed forces history</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <th>Post</th>
                    <td>{{$application->post}}</td>
                    <th>Rank</th>
                    <td>{{$application->rank}}</td>
                </tr>
                <tr>
                    <th>ARM</th>
                    <td>{{$application->arm}}</td>
                    <th>Last Appointment</th>
                    <td>{{$application->last_appointment}}</td>
                </tr>
                <tr>
                    <th>Enrollment Date</th>
                    <td>{{ $application->enrollment_date ? Carbon\Carbon::parse($application->enrollment_date)->format('d/m/Y') : '' }}</td>
                    <th>SOD Date</th>
                    <td>{{ $application->sod_date ? Carbon\Carbon::parse($application->sod_date)->format('d/m/Y') : '' }}</td>
                </tr>
                <tr>
                    <th>SOS Date</th>
                    <td>{{ $application->sos_date ? Carbon\Carbon::parse($application->sos_date)->format('d/m/Y') : '' }}</td>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card -->
</div>