<div class="clearfix">
    <h3 class="mb-3 float-left">Record of ACR's</h3>
    <div class="float-right">
        <a href="{{route('employees_acrs.create', ['employee' => $employee->id])}}" class="btn btn-primary btn-sm">Add New</a>
    </div>
</div>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Year of ACR</th>
            <th>Grading</th>
            <th>Prom Recommended for Next Appt</th>
            <th>Remarks</th>
            <th>Authorized By</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($acrs as $acr)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{Helper::parseDate($acr->period_from, 'Y')}}</td>
            <td>{{$acr->grade}}</td>
            <td>{{$acr->promotion_recomended}}</td>
            <td>{{Helper::showLessMoreText(nl2br($acr->sro_remarks))}}</td>
            <td>{{$acr->authenticatedBy ? $acr->authenticatedBy->name : ''}}</td>
            <td width="15%">
                <a href="{{route('employees_acrs.edit', ['employee' => $employee->id, 'acr' => $acr->id])}}" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a> &nbsp;
                <a href="{{route('employees_acrs.show', ['employee' => $employee->id, 'acr' => $acr->id])}}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>
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