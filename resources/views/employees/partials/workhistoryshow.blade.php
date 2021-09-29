<div class="clearfix">
    <h3 class="mb-3 float-left">Work History Details</h3>
    <div class="float-right">
        <button type="button" onclick="addWorkHistory('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm">Add Work history</button>
    </div>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Job Title</th>
            <th>Company Name</th>
            <th>Address</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employee->workHistory as $work_history)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$work_history->job_title}}</td>
            <td>{{$work_history->company_name}}</td>
            <td>{{$work_history->company_address}}</td>
            <td>{{$work_history->start_date}}</td>
            <td>{{$work_history->end_date}}</td>
            <td>
                @if($work_history->attachment && in_array($work_history->file_ext, ['jpeg', 'gif', 'png', 'bmp', 'jpg']))
                <a href="/storage/images/applications/{{$employee->folder_name}}/{{$work_history->attachment}}" target="_blank">
                    <img src="{{ asset('storage/images/applications/' . $employee->folder_name    . '/' . $work_history->attachment)}}" class="img-fluid" width="50px" alt="{{$work_history->title}}">
                </a>
                @elseif($work_history->attachment)
                <a href="/storage/images/applications/{{$employee->folder_name}}/{{$work_history->attachment}}" target="_blank">{{ substr($work_history->attachment, -9,5)}}</a>
                @else
                <p>No file</p>
                @endif
            </td>
            <td width="9%">
                <button onclick="editWorkHistory({{$work_history}}, '{{$employee->id}}', '{{$employee->folder_name}}')" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>