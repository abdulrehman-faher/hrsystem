<div class="clearfix">
    <h3 class="mb-3 float-left">Conducts</h3>
    <div class="float-right">
        <button type="button" onclick="addConduct('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm">Add New</button>
    </div>
</div>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Place of Offence</th>
            <th>Date of Offence</th>
            <th>Particulars of Offence</th>
            <th>Punishment / Award</th>
            <!-- <th>Punishment / Award Date </th> -->
            <th>Authority Ltr Date</th>
            <th>Authorized By</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($conducts as $conduct)
        <tr>
            <td width="10">{{$loop->iteration}}</td>
            <td>{{$conduct->title}}</td>
            <td>{{$conduct->place_of_offence}}</td>
            <td>{{Helper::parseDate($conduct->date_of_offence, 'd/m/Y')}}</td>
            <td width="35%">{{Helper::showLessMoreText(nl2br($conduct->offence_details))}}</td>
            <td>{{$conduct->punishment}}</td>
            <!-- <td>{{--Helper::parseDate($conduct->punishment_date, 'd/m/Y')--}}</td> -->
            <td>{{Helper::parseDate($conduct->authority_letter_date, 'd/m/Y')}}</td>
            <td>{{$conduct->authenticatedBy ? $conduct->authenticatedBy->name : ''}}</td>
            <td width="10%">
                <button onclick="editConduct({{$conduct}}, '{{$employee->id}}', '{{$employee->folder_name}}')" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button>
                &nbsp; <a href="{{route('employees_conduct.show', ['employee' => $employee->id, 'employeeConduct' => $conduct->id])}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center">
                <!-- <h4>No offence reported so far</h4> -->
                <h4>No record(s) found</h4>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>