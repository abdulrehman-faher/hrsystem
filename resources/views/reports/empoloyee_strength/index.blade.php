@extends('layouts.master', ['title'=> 'Empoloyee Strength', 'active' => 'reports', 'activeChild' => 'reportEmpStrength'])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Reports</a></li>
    <li class="breadcrumb-item active">Empoloyee Strength</li>
</ol>
@endsection

@section('content')
<section class="content">

    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#overall">Overall</a>
                            </li>
                            </li>
                            @foreach($club_titles as $key => $club_title)
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#{{$key}}">{{$club_title}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="overall">@include('reports.empoloyee_strength.overall')</div>
                            @foreach($club_titles as $key => $club_title)
                            <?php
                            $parts = explode('_', $key);
                            $last = array_pop($parts);
                            $filtered = $results->filter(function ($data) use ($last) {
                                return $data['id'] == $last;
                            })->values()->first();
                            ?>
                            <div class="tab-pane" id="{{$key}}">@include('reports.empoloyee_strength.club', ['club' => $filtered])</div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>


</section>
@endsection