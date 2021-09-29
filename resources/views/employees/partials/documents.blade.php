<?php
$numberOfColumns = 3;
$bootstrapColWidth = 12 / $numberOfColumns;

$applications_path =  'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR;
?>


<div class="clearfix">
    <h3 class="mb-3 float-left">Images / Documents</h3>
    <div class="float-right">
        <button type="button" onclick="attachImage('{{$employee->id}}', '{{$employee->folder_name}}')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>
    </div>
</div>
@foreach(array_chunk($imageFiles, $numberOfColumns) as $items)
<div class="row mt-3">
    @foreach ($items as $file)
    <div class="col-md-{{$bootstrapColWidth}}">
        <a href="{{asset($applications_path . $employee->folder_name  . DIRECTORY_SEPARATOR . $file) }}" target="_blank">
            <img src="{{ asset($applications_path . $employee->folder_name  . DIRECTORY_SEPARATOR . $file)}}" class="img-fluid" height="400px" alt="{{$file}}">
        </a>
    </div>
    @endforeach
</div>
@endforeach
@if($otherFiles)
<div class="mt-5">
    <h3>Other Documents</h3>
</div>

<table class="table">
    <tbody>
        @foreach ($otherFiles as $file)
        <tr>
            <td><a href="{{asset($applications_path . $employee->folder_name  . '/' . $file) }}" target="_blank">{{$file}}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif