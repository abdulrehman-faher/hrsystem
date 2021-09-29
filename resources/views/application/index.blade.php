@extends('layouts.master', ['title'=> 'Applications', 'active' => 'application', 'activeChild' => 'applicationViewAll'])


@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Applications</li>
</ol>
@endsection


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Applications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Shortlisted</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Employeed</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">All Applications</a>
                            </li>

                        </ul>

                    </div>

                    <div class="card-body">
                        <div class="clearfix mb-3">
                            <a href="{{route('applications.create')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i> Add New</a>
                        </div>

                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <table class="table table-bordered table-striped" id="application_remaining" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="1px">#</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Education</th>
                                            <th>Applied for</th>
                                            <th>Expierence</th>
                                            <th>Contact</th>
                                            <th>Reference</th>
                                            <th>CNIC</th>
                                            <th>Created At</th>
                                            <th width="1px"></th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>

                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                <table class="table table-bordered table-striped" id="application_shortlisted" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="1px">#</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Education</th>
                                            <th>Applied for</th>
                                            <th>Expierence</th>
                                            <th>Contact</th>
                                            <th>Reference</th>
                                            <th>CNIC</th>
                                            <th>Created At</th>
                                            <th width="1px"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                <table class="table table-bordered table-striped" id="application_employeed" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="1px">#</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Education</th>
                                            <th>Applied for</th>
                                            <th>Expierence</th>
                                            <th>Contact</th>
                                            <th>Reference</th>
                                            <th>CNIC</th>
                                            <th>Created At</th>
                                            <th width="1px"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">

                                <table class="table table-bordered table-striped" id="application_all" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="1px">#</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Education</th>
                                            <th>Applied for</th>
                                            <th>Expierence</th>
                                            <th>Contact</th>
                                            <th>Reference</th>
                                            <th>CNIC</th>
                                            <th>Created At</th>
                                            <th width="1px"></th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>

                        </div>

                    </div>

                    <!-- /.card -->

                </div>



            </div>

            <!-- /.col -->

        </div>

        <!-- /.row -->

    </div>

    <!-- /.container-fluid -->

</section>

@endsection



@section('scripts')
<script>
    const url =  "{{ route('applications.index') }}" ;
</script>

<script src="{{ asset('js/applications/index.js') }}" ></script>

@endsection