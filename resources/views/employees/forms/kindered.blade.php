<div class="clearfix">
    <h3 class="mb-3 float-left">Kindered Roll and Names</h3>
    <div class="float-right">
        <button type="button" onclick="addKindered('{{$employee->id}}')" class="btn btn-primary btn-sm">Add New</button>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nearest Relative</th>
            <th>Name</th>
            <th>D.O.B</th>
            <th>Date of Marriage</th>
            <th>Next of Kin (Legal Heir).</th>
            <th>CNIC</th>
            <th>Date of Entry</th>
            <th>AuthorizedBy</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @forelse ($kindereds2 as $key => $k2)
        <tr>
            <th colspan="10">
                <h4>{{$loop->iteration}} - {{Str::ucfirst($key)}}</h4>
            </th>
        </tr>
        @if ($k2)
        @foreach ($k2 as $k)
        <tr>
            <td>{{$loop->parent->iteration}}.{{$loop->iteration}}</td>
            <th>{{$key == 'parents' ? Str::ucfirst($k['relationship']) : ''}}</th>
            <td>{{$k['name']}}</td>
            <td>{{Helper::parseDate($k['dob'], 'd/m/Y')}}</td>
            <td>{{Helper::parseDate($k['marriage_date'], 'd/m/Y')}}</td>
            <td>{{$k['next_of_kin']}}</td>
            <td>{{$k['cnic']}}</td>
            <td>{{Helper::parseDate($k['date_of_entry'], 'd/m/Y')}}</td>
            <td>{{$k['authenticated_by'] ? $k['authenticated_by']['name'] : '' }}</td>
            <td width="15%">
                <button onclick="editKindered({{ json_encode($k) }}, '{{$employee->id}}')" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</button> &nbsp;
                <a href="{{route('employees_medical.show', ['employee' => $employee->id, 'medical' => $k['id']])}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</button>
            </td>
        </tr>
        @endforeach
        @endif
        @empty
        <tr>
            <td colspan="10" class="text-center">
                <h4>No record(s) found</h4>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>