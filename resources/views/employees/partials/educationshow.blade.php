<div class="clearfix">
    <h3 class="mb-3 float-left">Education Details</h3>
    <div class="float-right">
        <button type="button" onclick="addEducation('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm">Add Education</button>
    </div>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Degree</th>
            <th>Institute</th>
            <th>Marks Obt</th>
            <th>Grade</th>
            <th>Year Comp</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employee->education as $education)
        <tr>
            <td class="align-middle">{{$loop->iteration}}</td>
            <td class="align-middle">{{$education->title}}</td>
            <td class="align-middle">{{$education->institute_name}}</td>
            <td class="align-middle">{{$education->marks_obtained}}</td>
            <td class="align-middle">{{$education->division_grade}}</td>
            <td class="align-middle">{{$education->year_completed}}</td>
            <td class="align-middle">
                @if($education->attachment && in_array($education->file_ext, ['jpeg', 'gif', 'png', 'bmp', 'jpg', 'JPG']))
                <a href="/storage/images/applications/{{$employee->folder_name}}/{{$education->attachment}}" target="_blank">
                    <img src="{{ asset('storage/images/applications/' . $employee->folder_name  . '/' . $education->attachment)}}" class="img-fluid" width="100px" alt="{{$education->title}}">
                </a>
                @elseif($education->attachment)
                <a href="/storage/images/applications/{{$employee->folder_name}}/{{$education->attachment}}" target="_blank">{{ substr($education->attachment, -9,5)}}</a>
                @else

                @endif
            </td>
            <td width="9%">
                <button onclick="editEdu({{$education}}, '{{$employee->id}}', '{{$employee->folder_name}}')" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>