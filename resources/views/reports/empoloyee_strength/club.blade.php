<div class="mt-4 mb-4">
    <h3>{{$club['title']}}</h3>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Job Title</th>
            <th>Total Employees</th>
            <th>Maximum allowed Strenth</th>
            <th>Difference +/-</th>
        </tr>
    </thead>
    <tbody>
        @foreach($club['data'] as $row)
        <?php $className = $row->difference > 0 ? "table-danger" : ($row->difference < 0 ? "table-success" : ($row->total_employees == 0 ? "table-info" : "")); ?>
        <tr class="{{$className}}">
            <td>{{$loop->iteration}}</td>
            <td>{{$row->title}}</td>
            <td>{{$row->total_employees}}</td>
            <td>{{$row->max_strength}}</td>
            <td>{{$row->difference}}</td>
        </tr>
        @endforeach
    </tbody>
</table>