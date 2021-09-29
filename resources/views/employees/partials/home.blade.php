<div class="card card-info">
    <div class="card-header clearfix">
        <h3 class="card-title float-left">Personal Information</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <th>CNIC</th>
                    <td>{{$employee->cnic}}</td>
                    <th>Email</th>
                    <td><a href="mailto:{{$employee->email}}">{{$employee->email}}</a></td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>{{$employee->phone_number}}</td>
                    <th>Gender</th>
                    <td>{{ucfirst($employee->gender)}}</td>
                </tr>
                <tr>
                    <th>Date of birth</th>
                    <td>
                        {{ Helper::parseDate($employee->dob, 'd/m/Y') }}
                        @if($employee->dob_in_words)
                        - ({{$employee->dob_in_words}})
                        @endif
                    </td>
                    <th>Place of birth</th>
                    <td>{{$employee->place_of_birth}}</td>
                </tr>
                <tr>
                    <th>Father Name</th>
                    <td>{{$employee->father_name}}</td>
                    <th>Father Profession</th>
                    <td>{{$employee->father_profession}}</td>
                </tr>
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
    </div>
    <!-- /.card -->
</div>

<div class="card card-info">
    <div class="card-header clearfix">
        <h3 class="card-title float-left">Address</h3>
    </div>
    <div class="card-body">
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
    </div>
    <!-- /.card -->
</div>