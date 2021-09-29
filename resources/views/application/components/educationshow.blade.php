<h3>Education Details</h3>

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

        </tr>

    </thead>

    <tbody>

        <?php $count = 1; ?>

        @foreach($application->qualification as $education)

        <tr>

            <td class="align-middle">{{$loop->iteration}}</td>

            <td class="align-middle">{{$education->title}}</td>

            <td class="align-middle">{{$education->institute_name}}</td>

            <td class="align-middle">{{$education->marks_obtained}}</td>

            <td class="align-middle">{{$education->division_grade}}</td>

            <td class="align-middle">{{$education->year_completed}}</td>

            <td class="align-middle">

                @if($education->attachment && in_array($education->file_ext, ['jpeg', 'gif', 'png', 'bmp', 'jpg']))

                <a href="/storage/images/applications/{{$application->folder_name}}/{{$education->attachment}}" target="_blank">

                    <img src="{{ asset('storage/images/applications/' . $application->folder_name  . '/' . $education->attachment)}}" class="img-fluid" width="100px" alt="{{$education->title}}">

                </a>

                @elseif($education->attachment)

                <a href="/storage/images/applications/{{$application->folder_name}}/{{$education->attachment}}" target="_blank">{{ substr($education->attachment, -9,5)}}</a>

                @else

                <p>No file</p>

                @endif

            </td>

        </tr>

        @endforeach

    </tbody>

</table>