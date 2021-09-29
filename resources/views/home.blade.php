@extends('layouts.master', ['title'=> 'Dashboard', 'active' => 'dashboard', 'activeChild' => ''])

<?php $siteUnderConstruction =  'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'temporary' . DIRECTORY_SEPARATOR . 'site-under-construction.jpg'; ?>
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">

        <div class="card ">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection

@section("scripts")
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
@endsection