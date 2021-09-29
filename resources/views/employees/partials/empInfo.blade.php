<div class="card card-primary">
    <div class="card-header clearfix">
        <h3 class="card-title float-left mt-2">{{$employee->name}}</h3>

        <a type="a" href="{{ route('employees.edit', ['employee' => $employee->id]) }}" class="btn btn-success float-right"><i class='fa fa-pencil'></i> Edit</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 img-div">
                <?php $common_path =  'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'applicant.jpg'; ?>
                <?php $profile_img_path =  'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR;  ?>
                @if($employee->photograph)
                <img src="{{  asset($profile_img_path . $employee->folder_name . DIRECTORY_SEPARATOR . $employee->photograph) }}" class="rounded img-fluid" alt="{{$employee->name}}">
                @else
                <img src="{{ asset($common_path)}}" width="250px" class="img-fluid" alt="{{$employee->name}}">
                @endif
            </div>
            <div class="col-md-9 col-lg-9 col-sm-6 col-xs-12">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$employee->name}}</td>
                                </tr>
                                <tr>
                                    <th>Emp No.</th>
                                    <td>{{ $employee->employee_number }}</td>
                                </tr>
                                <tr>
                                    <th>Job / Position</th>
                                    <td>{{$employee->jobType->title}}</td>
                                </tr>
                                <tr>
                                    <th>Club</th>
                                    <td>{{$employee->club ? $employee->club->title : '' }}</td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>{{ $employee->department_id ? $employee->department->name :  '' }}</td>
                                </tr>
                                <tr>
                                    <th>Group</th>
                                    <td>{{ $employee->group_id ? $employee->group->title :  '' }}</td>
                                </tr>
                                <tr>
                                    <th>Salary</th>
                                    <td>{{$employee->current_salary ? 'RS. ' . number_format($employee->current_salary, 2, '.', ',') : '' }}</td>
                                </tr>
                                <tr>
                                    <th>CNIC</th>
                                    <td>{{ $employee->cnic }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th>Contract Type</th>
                                    <td>{{$typeOfContract[0]}}</td>
                                </tr>
                                <tr>
                                    <th>Grade</th>
                                    <td>{{$employee->grade}}</td>
                                </tr>
                                <tr>
                                    <th>Appoitment</th>
                                    <td>{{ $employee->appointment }}</td>
                                </tr>
                                <tr>
                                    <th>Appoitment Date</th>
                                    <td>{{ $employee->appointment_date ? Helper::parseDate($employee->appointment_date, 'd/m/Y') : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Contract End Date</th>
                                    <td>{{ $employee->contract_end_date ? Helper::parseDate($employee->contract_end_date, 'd/m/Y') : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Retirement Date</th>
                                    <td>{{ $employee->retirement_date ? Helper::parseDate($employee->retirement_date, 'd/m/Y') : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $employee->phone_number }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>