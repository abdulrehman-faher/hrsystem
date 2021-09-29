<div class="mt-5"></div>
<table class="table">
    <tbody>
        <tr>
            <th>Name of referee</th>
            <td>{{$employee->referee_name}}</td>
            <th>Address of referee</th>
            <td>{{$employee->referee_address}}</td>
        </tr>
        <tr>
            <th>Religion</th>
            <td>{{$employee->religion}}</td>
            <th>Caste</th>
            <td>{{$employee->caste}}</td>
        </tr>
        <tr>
            <th>Height</th>
            <td>{{$employee->height}}</td>
            <th>Sect</th>
            <td>{{$employee->sect}}</td>
        </tr>
    </tbody>
</table>


<div class="mt-5">
    <h3>Address</h3>
</div>
<table class="table">
    <tbody>
        <tr>
            <th>Street Mohallah</th>
            <td>{{$employee->street_mohallah}}</td>
            <th>Village / Town</th>
            <td>{{$employee->address01}}</td>
        </tr>
        <tr>
            <th>City</th>
            <td>{{$employee->city}}</td>
            <th>Tehsil</th>
            <td>{{$employee->tehsil}}</td>
        </tr>
        <tr>
            <th>District / Political Agency</th>
            <td>{{$employee->district}}</td>
            <th>Post Office</th>
            <td>{{$employee->post_office}}</td>
        </tr>
        <tr>
            <th>Police Station</th>
            <td>{{$employee->police_station}}</td>
            <th>Nearest Bus Stop</th>
            <td>{{$employee->bus_stop}}</td>
        </tr>
        <tr>
            <th colspan="2">Railway Station and Distance from residence</th>
            <td colspan="2">{{$employee->railway_station}}</td>
        </tr>
    </tbody>
</table>
<div class="mt-5">
    <h3>Armed forces history</h3>
</div>

<table class="table">
    <tbody>
        <tr>
            <th>Post</th>
            <td>{{$employee->post}}</td>
            <th>Rank</th>
            <td>{{$employee->rank}}</td>
        </tr>
        <tr>
            <th>ARM</th>
            <td>{{$employee->arm}}</td>
            <th>Last Appointment</th>
            <td>{{$employee->last_appointment}}</td>
        </tr>
        <tr>
            <th>Enrollment Date</th>
            <td>{{ Carbon\Carbon::parse($employee->enrollment_date)->format('d/m/Y') }}</td>
            <th>SOS Date</th>
            <td>{{ Carbon\Carbon::parse($employee->sod_date)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>SOS Date</th>
            <td>{{ Carbon\Carbon::parse($employee->sos_date)->format('d/m/Y') }}</td>
            <th>&nbsp;</th>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>