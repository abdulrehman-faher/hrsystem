<div class="clearfix">
    <h3 class="mb-3 float-left">Local Courses</h3>
    <div class="float-right">
        <button type="button" onclick="addLocalCourse('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>
    </div>
</div>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr class="text-center">
            <th rowspan="2">#</th>
            <th rowspan="2">Course Title</th>
            <th colspan="2">Date</th>
            <th rowspan="2">Held At (Place)</th>
            <th rowspan="2">Grade</th>
            <th rowspan="2">Marks</th>
            <th colspan="2">Authentication</th>
            <th rowspan="2">Attachment</th>
            <th rowspan="2">Action</th>

        </tr>
        <tr class="text-center">
            <th>From</th>
            <th>To</th>
            <th>By</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($localCourses as $localCourse)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $localCourse->title }}</td>
            <td>{{ $localCourse->date_from ? Helper::parseDate($localCourse->date_from, 'd/m/Y') : '' }}</td>
            <td>{{ $localCourse->date_to ? Helper::parseDate($localCourse->date_to, 'd/m/Y') : '' }}</td>
            <td>{{ $localCourse->held_at_place }}</td>
            <td>{{ $localCourse->grade }}</td>
            <td>{{ $localCourse->marks }}</td>
            <td>{{ $localCourse->authorized_by ? $localCourse->authenticatedBy->name : '' }}</td>
            <td>{{ $localCourse->authorized_by_date ? Helper::parseDate($localCourse->authorized_by_date, 'd/m/Y') : '' }}</td>
            <td>
                @if($localCourse->attachment && in_array(pathinfo($localCourse->attachment, PATHINFO_EXTENSION), Helper::allowedExtensions()))
                <a href="/storage/images/applications/{{$employee->folder_name}}/{{$localCourse->attachment}}" target="_blank">
                    <img src="{{ asset('storage/images/applications/' . $employee->folder_name  . '/' . $localCourse->attachment)}}" class="img-fluid" width="100px" alt="{{$localCourse->title}}">
                </a>
                @elseif($localCourse->attachment)
                <a href="/storage/images/applications/{{$employee->folder_name}}/{{$localCourse->attachment}}" target="_blank">{{ substr($localCourse->attachment, -9,5)}}</a>
                @endif
            </td>
            <td width="15%">
                <button onclick="editLocalCourse({{$localCourse}}, '{{$employee->id}}', '{{$employee->folder_name}}')" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button> &nbsp;
                <a href="{{route('employees_leaves.show', ['employee' => $employee->id, 'leave' => $localCourse->id])}}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="11" class="text-center">
                <h4>No record(s) found</h4>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>