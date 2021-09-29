<?php
$numberOfColumns = 3;
$bootstrapColWidth = 12 / $numberOfColumns;
?>
@if(count($imageFiles))
<h3>Images</h3>
@foreach(array_chunk($imageFiles, $numberOfColumns) as $items)
<div class="row mt-3">
    @foreach ($items as $file)
    <div class="col-md-{{$bootstrapColWidth}}">
        <a href="{{asset('storage/images/applications/' . $application->folder_name  . '/' . $file) }}" target="_blank">
            <img src="{{ asset('storage/images/applications/' . $application->folder_name  . '/' . $file)}}" class="img-fluid" height="400px" alt="{{$file}}">
        </a>
    </div>
    @endforeach
</div>
@endforeach
@endif

@if(count($otherFiles))
<h3>Other Documents</h3>

<table class="table">
    <tbody>
        @foreach ($otherFiles as $file)
        <tr>
            <td><a href="{{asset('storage/images/applications/' . $application->folder_name  . '/' . $file) }}" target="_blank">{{$file}}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif