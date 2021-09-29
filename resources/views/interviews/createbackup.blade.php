@extends('layouts.master', ['title'=> 'Interviews', 'active' => 'interview', 'activeChild' => 'interviewAddNew'])



@section('breadcrumb')

<ol class="breadcrumb float-sm-right">

    <li class="breadcrumb-item"><a href="#">Home</a></li>

    <li class="breadcrumb-item active">Interviews</li>

</ol>

@endsection





@section('content')

<section class="content">

    <div class="container-fluid">



        <div class="row">

            <div class="col-12 col-sm-12">

                <form method="post" action="{{ route('interviews.store')}}" id="addInterviewForm">

                    @csrf



                    @if(count($errors))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">

                        You have errors in the form.

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                    @endif



                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title">Interview Details</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                            </div>

                        </div>

                        <!-- /.card-header -->

                        <div class="card-body">

                            <div class="row">



                                <div class="col-md-12">

                                    <div class="form-group row">

                                        <label for="title" class="col-sm-2 col-form-label">Title</label>

                                        <div class="col-sm-10">

                                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" id="title" value="{{ old('title') }}" name="title" required />

                                            @error('title')

                                            <div class="invalid-feedback">

                                                {{$errors->first('title')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label for="job_type_id" class="col-sm-2 col-form-label">Job Type</label>

                                        <div class="col-sm-10">

                                            <select id="job_type_id" name="job_type_id" class="form-control {{ $errors->has('job_type_id') ? 'is-invalid' : ''}}" required>

                                                <option value="0">All job types</option>

                                                @foreach($jobTypes as $key => $value)

                                                <option value="{{$key}}" {{ (old("job_type_id") == $key ? "selected":"") }}>{{$value}}</option>

                                                @endforeach

                                            </select>



                                            @error('job_type_id')

                                            <div class="invalid-feedback">

                                                {{$errors->first('job_type_id')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label for="interview_date" class="col-sm-2 col-form-label">Date of Interview</label>

                                        <div class="col-sm-10">

                                            <input type="date" class="form-control {{ $errors->has('interview_date') ? 'is-invalid' : ''}}" id="interview_date" value="{{ old('interview_date') }}" name="interview_date" required />

                                            @error('interview_date')

                                            <div class="invalid-feedback">

                                                {{$errors->first('interview_date')}}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- /.row -->

                        </div>

                    </div>







                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title">Please select candidates from the list below to be interviewed.</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                            </div>

                        </div>

                        <!-- /.card-header -->

                        <div class="card-body">

                            <div class="row">



                                <div class="col-md-12">

                                    <table id="interview_data" class="table table-bordered dt-responsive nowrap" style="width:100%">

                                        <thead>

                                            <tr>

                                                <th width="1px">#</th>

                                                <th>

                                                    <div class="icheck-primary d-inline">

                                                        <input type="checkbox" id="checkAll" />

                                                        <label for="checkAll">

                                                            Shortlisted

                                                        </label>

                                                    </div>

                                                </th>

                                                <th>Name</th>

                                                <th>Position applied for</th>

                                                <th>Experience</th>

                                                <th>Email</th>

                                                <th>Created At</th>

                                            </tr>

                                        </thead>

                                    </table>

                                </div>

                            </div>

                            <!-- /.row -->

                        </div>

                    </div>



                    <div class="form-row mt-5">

                        <div class="form-group col-md-2 offset-6">

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>

                        </div>

                        <div class="form-group col-md-2">

                            <button type="reset" class="btn btn-info btn-lg btn-block">Reset</button>

                        </div>

                        <div class="form-group col-md-2">

                            <a href="{{route('interviews.index')}}" class="btn btn-secondary btn-lg btn-block">Cancel</a>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <!-- /.container-fluid -->

</section>

@endsection



@section('scripts')

<script>

    // $(function() {

    //     const checkAll = $('#checkAll').prop('checked', false);

    //     // console.log('checkAll is', checkAll);

    //     // // if($('#checkAll').)

    //     // if (checkAll) {

    //     //     $('input[name="shortlisted[]"]').prop('checked', checkAll);

    //     // }

    // });



    $(document).on('submit', '#addInterviewForm', function(event) {

        var checked = $('#interview_data').find(':checked').length;



        if (!checked) {

            event.preventDefault();

            alert('Please select atleast one of the applicant.');

        }

    });





    $(document).on('change', 'input[name="shortlisted[]"]', function(event) {

        // event.preventDefault();

        // const url = $(this).attr('action');

        // ajaxEduReq(url);

        const $this = $(this);

        const value = $this.val();

        if ($this.prop("checked") == true) {

            console.log("Checkbox is checked. ", value);

        } else if ($this.prop("checked") == false) {

            console.log("Checkbox is unchecked.");

        }

    });



    $("#checkAll").click(function() {

        $('input:checkbox').not(this).prop('checked', this.checked);

    });



    $('#interview_data').DataTable({

        processing: true,

        serverSide: true,

        ajax: {

            url: "{{ route('interviews.create') }}"

        },

        buttons: [

            'copy', 'excel', 'pdf'

        ],

        columns: [{

                data: 'DT_RowIndex',

                name: 'DT_RowIndex',

                orderable: false,

                searchable: false

            },

            {

                data: 'shortlist',

                name: 'shortlist',

                orderable: false

            },

            {

                data: 'name',

                name: 'name'

            },

            {

                data: 'job_type_id',

                name: 'job_type_id'

            },

            {

                data: 'years_of_experience',

                name: 'years_of_experience'

            },

            {

                data: 'email',

                name: 'email'

            },

            {

                data: 'created_at',

                name: 'created_at'

            },



        ],

        order: [],

        // columnDefs: [{

        //     'targets': 6,

        //     'checkboxes': true

        // }],

    });

</script>

@endsection