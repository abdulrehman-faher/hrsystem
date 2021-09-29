@extends('layouts.app')

@section('content')
<div class="container">
    {!! $dataTable->table([], true) !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection