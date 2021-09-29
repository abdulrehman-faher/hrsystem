<div class="clearfix">
    <h3 class="mb-3 float-left">Medical</h3>
    <div class="float-right">
        <button type="button" onclick="addMedical('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm">Add New</button>
    </div>
</div>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Hospital Name</th>
            <th>Appt</th>
            <th>Admission Date</th>
            <th>ION No.</th>
            <th>Authorized By</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($medicals as $medical)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$medical->title}}</td>
            <td>{{$medical->hospital_name}}</td>
            <td>{{$medical->appt}}</td>
            <td>{{$medical->admission_date ? Helper::parseDate($medical->admission_date, 'd/m/Y') : ''}}</td>
            <td>{{$medical->ion_number}}</td>
            <td>{{$medical->authenticatedBy ? $medical->authenticatedBy->name : ''}}</td>
            <td width="15%">
                <button onclick="editMedical({{$medical}}, '{{$employee->id}}', '{{$employee->folder_name}}')" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button> &nbsp;
                <a href="{{route('employees_medical.show', ['employee' => $employee->id, 'medical' => $medical->id])}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center">
                <h4>No record(s) found</h4>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>