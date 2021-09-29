<div class="clearfix">
    <h3 class="mb-3 float-left">Leaves Record</h3>
    <div class="float-right">
        <button type="button" onclick="addLeave('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>
        <a href="{{route('employees_leaves.index', ['employee' => $employee->id])}}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View All</a>
    </div>
</div>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th rowspan="2">#</th>
            <th rowspan="2">Type</th>
            <th colspan="3" class="text-center">Leave Period</th>
            <th rowspan="2">Purpose / Reason</th>
            <th rowspan="2">Authorized By</th>
            <th rowspan="2">Attachment</th>
            <th rowspan="2">Action</th>

        </tr>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Days</th>
        </tr>
    </thead>
    <tbody>
        @forelse($leaves as $leave)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$leave->type_of_leave_id ? $leave->type->name : ''}}</td>
            <td>{{ Helper::parseDate($leave->from, 'd/m/Y') }}</td>
            <td>{{ Helper::parseDate($leave->to, 'd/m/Y') }}</td>
            <td>{{$leave->total_days}}</td>
            <td width="25%">{{Helper::showLessMoreText(nl2br($leave->purpose), 50)}}</td>
            <td>{{$leave->authorized_by ? $leave->authenticatedBy->name : ''}}</td>
            <td>
                @if($leave->attachment && in_array(pathinfo($leave->attachment, PATHINFO_EXTENSION), Helper::allowedExtensions()))
                <a href="/storage/images/applications/{{$employee->folder_name}}/{{$leave->attachment}}" target="_blank">
                    <img src="{{ asset('storage/images/applications/' . $employee->folder_name  . '/' . $leave->attachment)}}" class="img-fluid" width="100px" alt="{{$leave->title}}">
                </a>
                @elseif($leave->attachment)
                <a href="/storage/images/applications/{{$employee->folder_name}}/{{$leave->attachment}}" target="_blank">{{ substr($leave->attachment, -9,5)}}</a>
                @endif
            </td>
            <td width="15%">
                <button onclick="editLeave({{$leave}}, '{{$employee->id}}', '{{$employee->folder_name}}')" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button> &nbsp;
                <a href="{{route('employees_leaves.show', ['employee' => $employee->id, 'leave' => $leave->id])}}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</button>
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