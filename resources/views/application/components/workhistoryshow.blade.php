<h3>Work History</h3>
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
        </tr>
    </thead>
    <tbody>
        @foreach($workHistories as $work_history)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$work_history->job_title}}</td>
            <td>{{$work_history->company_name}}</td>
            <td>{{$work_history->company_address}}</td>
            <td>{{$work_history->start_date}}</td>
            <td>{{$work_history->end_date}}</td>
            <td>
                @if($work_history->attachment && in_array($work_history->file_ext, ['jpeg', 'gif', 'png', 'bmp', 'jpg']))
                <a href="/storage/images/applications/{{$application->folder_name}}/{{$work_history->attachment}}" target="_blank">
                    <img src="{{ asset('storage/images/applications/' . $application->folder_name    . '/' . $work_history->attachment)}}" class="img-fluid" width="50px" alt="{{$work_history->title}}">
                </a>
                @elseif($work_history->attachment)
                <a href="/storage/images/applications/{{$application->folder_name}}/{{$work_history->attachment}}" target="_blank">{{ substr($work_history->attachment, -9,5)}}</a>
                @else
                <p>No file</p>
                @endif
            </td>
        </tr>
        @endforeach

    </tbody>
</table>