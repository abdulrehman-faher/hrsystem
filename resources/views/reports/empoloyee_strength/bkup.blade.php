@extends('layouts.app')

@section('content')
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
        @foreach($results as $result)
        <tr class="table-active">
            <th colspan="5">{{$result['title']}}</th>
        </tr>
        @foreach($result['data'] as $row)
        <?php $className = $row->difference > 0 ? "table-danger" : ($row->difference < 0 ? "table-success" : ""); ?>
        <tr class="{{$className}}">
            <td>{{$loop->iteration}}</td>
            <td>{{$row->title}}</td>
            <td>{{$row->total_employees}}</td>
            <td>{{$row->max_strength}}</td>
            <td>{{$row->difference}}</td>
        </tr>
        @endforeach

        @endforeach
    </tbody>
</table>
@endsection