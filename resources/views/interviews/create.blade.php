@extends('layouts.master', ['title'=> 'Interviews', 'active' => 'interview', 'activeChild' => 'interviewAddNew'])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('interviews.index')}}">Interviews</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">

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

                <div class="card-body">

                    <div class="form-group row">
                        <label for="job_type_id" class="col-sm-2 col-form-label">Job Type *</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="title" id="title" />
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
                        <label for="interview_date" class="col-sm-2 col-form-label">Date of Interview *</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control {{ $errors->has('interview_date') ? 'is-invalid' : ''}}" id="interview_date" value="{{ old('interview_date') }}" name="interview_date" required />
                            @error('interview_date')
                            <div class="invalid-feedback">
                                {{$errors->first('interview_date')}}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="candidates_required" class="col-sm-2 col-form-label">Candidates Required</label>
                        <div class="col-sm-4">
                            <input type="text" id="candidates_required" value="{{ old('candidates_required') }}" name="candidates_required" class="form-control {{ $errors->has('candidates_required') ? 'is-invalid' : ''}}" />
                            @error('candidates_required')
                            <div class="invalid-feedback">
                                {{$errors->first('candidates_required')}}
                            </div>
                            @enderror
                        </div>
                        <label for="salary_range" class="col-sm-2 col-form-label">Salary Range</label>
                        <div class="col-sm-4">
                            <input type="text" id="salary_range" value="{{ old('salary_range') }}" name="salary_range" class="form-control {{ $errors->has('salary_range') ? 'is-invalid' : ''}}" />
                            @error('salary_range')
                            <div class="invalid-feedback">
                                {{$errors->first('salary_range')}}
                            </div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Please select candidates from the list below to be interviewed.</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
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
                                <th>Reference</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                    </table>
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
</section>

@endsection



@section('scripts')

<script>
    const url = "{{ route('interviews.create') }}";
</script>
<script src="{{ asset('js/interviews/create.js') }}"></script>

@endsection