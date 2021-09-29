@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">
        @if($employee->club)
        THE DEFENCE CLUB "{{trim(str_replace('Club', '', $employee->club->title))}}" SECTOR <br />ACR - EMPLOYEES
        @else
        DHA <br />ACR - EMPLOYEES
        @endif
    </h1>
    <form method="POST" action="{{ route('employees_acrs.update', ['employee' => $employee->id, 'acr' => $acr->id])}}" enctype="multipart/form-data" id="createACRForm">
        @csrf
        @method('put')

        @if(count($errors))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            You have errors in the form.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                @foreach($acr->images as $image)
                <?php $extension = pathinfo($image->file_name, PATHINFO_EXTENSION); ?>
                @if(in_array($extension, Helper::allowedExtensions()))
                <a href="{{ Helper::imgStoragePath($employee->folder_name, $image->file_name) }}" target="_blank">
                    <img src="{{ Helper::imgStoragePath($employee->folder_name, $image->file_name) }}" class="img-fluid mr-4" width="100px" alt="Scanned Image" />
                </a>
                @else
                <h6 class="mt-4"><a href="{{ Helper::imgStoragePath($employee->folder_name, $image->file_name) }}" target="_blank">{{ $image->file_name }}</a></h6>
                @endif
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="attachment" class="col-sm-4 col-form-label">Add new attachment </label>
                    <div class="col-sm-8">
                        <input type="file" multiple class="form-control {{ $errors->has('attachments.*') ? 'is-invalid' : ''}}" id="attachment" value="{{ old('attachments[]') }}" name="attachments[]" />
                        <span class="text-secondary">(You can select multiple files)</span>
                        @error('attachments.*')
                        <div class="invalid-feedback">
                            {{$errors->first('attachments.*')}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="authorized_by_name" class="col-sm-4 col-form-label">Authorized By </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{ $errors->has('authorized_by') ? 'is-invalid' : ''}}" id="authorized_by_name" value="{{ old('authorized_by_name', $acr->authorized_by ? $acr->authenticatedBy->name : '') }}" name="authorized_by_name" />
                        <input type="hidden" id="authorized_by" name="authorized_by" value="{{ old('authorized_by', $acr->authorized_by) }}" />
                        <div id="authByUsersList" class="usersList"></div>

                        @error('authorized_by')
                        <div class="invalid-feedback">
                            {{$errors->first('authorized_by')}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="authorized_by_date" class="col-sm-4 col-form-label">Authorized Date </label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control {{ $errors->has('authorized_by_date') ? 'is-invalid' : ''}}" id="authorized_by_date" value="{{ old('authorized_by_date', $acr->authorized_by_date ? Helper::parseDate($acr->authorized_by_date, 'd/m/Y') : '') }}" name="authorized_by_date" />
                        @error('authorized_by_date')
                        <div class="invalid-feedback">
                            {{$errors->first('authorized_by_date')}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>


        <hr />
        <div class="form-group row">
            <label for="period_from" class="col-sm-2 col-form-label">Period of Report From</label>
            <div class="col-sm-4">
                <input type="date" class="form-control {{ $errors->has('period_from') ? 'is-invalid' : ''}}" id="period_from" value="{{ old('period_from', $acr->period_from ? Helper::parseDate($acr->period_from, 'Y-m-d') : '') }}" name="period_from" required />
                @error('period_from')
                <div class="invalid-feedback">
                    {{$errors->first('period_from')}}
                </div>
                @enderror
            </div>
            <label for="period_to" class="col-sm-2 col-form-label">Period of Report To</label>
            <div class="col-sm-4">
                <input type="date" class="form-control {{ $errors->has('period_to') ? 'is-invalid' : ''}}" id="period_to" value="{{ old('period_to', $acr->period_to ? Helper::parseDate($acr->period_to, 'Y-m-d') : '') }}" name="period_to" />
                @error('period_to')
                <div class="invalid-feedback">
                    {{$errors->first('period_to')}}
                </div>
                @enderror
            </div>
        </div>

        <h2 class="text-center mt-4 mb-3">PART - I <br />PERSONAL DATA</h2>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" value="{{ old('name', $employee->name) }}" name="name" required />
                @error('name')
                <div class="invalid-feedback">
                    {{$errors->first('name')}}
                </div>
                @enderror
            </div>
            <label for="father_name" class="col-sm-2 col-form-label">Father’s Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control {{ $errors->has('father_name') ? 'is-invalid' : ''}}" id="father_name" value="{{ old('father_name', $employee->father_name) }}" name="father_name" />
                @error('father_name')
                <div class="invalid-feedback">
                    {{$errors->first('father_name')}}
                </div>
                @enderror
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="appointment">Appointment</label>
                <input type="text" class="form-control {{ $errors->has('appointment') ? 'is-invalid' : ''}}" id="appointment" value="{{ old('appointment', $acr->appointment) }}" name="appointment" />
                @error('appointment')
                <div class="invalid-feedback">
                    {{$errors->first('appointment')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" class="form-control {{ $errors->has('appointment_date') ? 'is-invalid' : ''}}" id="appointment_date" value="{{ old('appointment_date', $acr->appointment_date ? Helper::parseDate($acr->appointment_date, 'Y-m-d') : '') }}" name="appointment_date" />
                @error('appointment_date')
                <div class="invalid-feedback">
                    {{$errors->first('appointment_date')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="grade">Grade</label>
                <input type="text" class="form-control {{ $errors->has('grade') ? 'is-invalid' : ''}}" id="grade" value="{{ old('grade', $acr->grade) }}" name="grade" />
                @error('grade')
                <div class="invalid-feedback">
                    {{$errors->first('grade')}}
                </div>
                @enderror
            </div>
        </div>

        <h4 class="mt-4 mb-3">Qualification / Profession Courses</h4>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Degree</th>
                    <th>Institute</th>
                    <th>Marks Obt</th>
                    <th>Grade</th>
                    <th>Year Completed</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee->education as $education)
                <tr>
                    <td class="align-middle">{{$loop->iteration}}</td>
                    <td class="align-middle">{{$education->title}}</td>
                    <td class="align-middle">{{$education->institute_name}}</td>
                    <td class="align-middle">{{$education->marks_obtained}}</td>
                    <td class="align-middle">{{$education->division_grade}}</td>
                    <td class="align-middle">{{$education->year_completed}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="mt-4 mb-3">Period Served Under</h4>
        <div class="form-group row">
            <label for="period_served_io_from" class="col-sm-2 col-form-label">IO From</label>
            <div class="col-sm-4">
                <input type="date" class="form-control {{ $errors->has('period_served_io_from') ? 'is-invalid' : ''}}" id="period_served_io_from" value="{{ old('period_served_io_from', $acr->period_served_io_from ? Helper::parseDate($acr->period_served_io_from, 'Y-m-d') : '') }}" name="period_served_io_from" />
                @error('period_served_io_from')
                <div class="invalid-feedback">
                    {{$errors->first('period_served_io_from')}}
                </div>
                @enderror
            </div>
            <label for="period_served_io_to" class="col-sm-2 col-form-label">IO To</label>
            <div class="col-sm-4">
                <input type="date" class="form-control {{ $errors->has('period_served_io_to') ? 'is-invalid' : ''}}" id="period_served_io_to" value="{{ old('period_served_io_to', $acr->period_served_io_to ? Helper::parseDate($acr->period_served_io_to, 'Y-m-d') : '') }}" name="period_served_io_to" />
                @error('period_served_io_to')
                <div class="invalid-feedback">
                    {{$errors->first('period_served_io_to')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="period_served_sro_from" class="col-sm-2 col-form-label">SRO From</label>
            <div class="col-sm-4">
                <input type="date" class="form-control {{ $errors->has('period_served_sro_from') ? 'is-invalid' : ''}}" id="period_served_sro_from" value="{{ old('period_served_sro_from', $acr->period_served_sro_from ? Helper::parseDate($acr->period_served_sro_from, 'Y-m-d') : '') }}" name="period_served_sro_from" />
                @error('period_served_sro_from')
                <div class="invalid-feedback">
                    {{$errors->first('period_served_sro_from')}}
                </div>
                @enderror
            </div>
            <label for="period_served_sro_to" class="col-sm-2 col-form-label">SRO To</label>
            <div class="col-sm-4">
                <input type="date" class="form-control {{ $errors->has('period_served_sro_to') ? 'is-invalid' : ''}}" id="period_served_sro_to" value="{{ old('period_served_sro_to', $acr->period_served_sro_to ? Helper::parseDate($acr->period_served_sro_to, 'Y-m-d') : '') }}" name="period_served_sro_to" />
                @error('period_served_sro_to')
                <div class="invalid-feedback">
                    {{$errors->first('period_served_sro_to')}}
                </div>
                @enderror
            </div>
        </div>

        <h2 class="text-center mt-4 mb-3">PART - II <br />REPORTING OFFICER'S RECOMMENDATIONS</h2>
        <h4 class="mt-4 mb-3" title="Initiating Officer Remarks">IO Remarks</h4>

        <div class="form-group row">
            <label for="io_remarks_strong_points" class="col-sm-2 offset-1 col-form-label">a. Strong Points</label>
            <div class="col-sm-9">
                <textarea class="form-control {{ $errors->has('io_remarks_strong_points') ? 'is-invalid' : ''}}" id="io_remarks_strong_points" name="io_remarks_strong_points" rows="3">{{old('io_remarks_strong_points', $acr->io_remarks_strong_points)}}</textarea>
                @error('io_remarks_strong_points')
                <div class="invalid-feedback">
                    {{$errors->first('io_remarks_strong_points')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="io_remarks_weak_area" class="col-sm-2 offset-1 col-form-label">b. Weak Areas</label>
            <div class="col-sm-9">
                <textarea class="form-control {{ $errors->has('io_remarks_weak_area') ? 'is-invalid' : ''}}" id="io_remarks_weak_area" name="io_remarks_weak_area" rows="3">{{old('io_remarks_weak_area', $acr->io_remarks_weak_area)}}</textarea>
                @error('io_remarks_weak_area')
                <div class="invalid-feedback">
                    {{$errors->first('io_remarks_weak_area')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="io_remarks_demo_performance" class="col-sm-2 offset-1 col-form-label">c. Demo Performance</label>
            <div class="col-sm-9">
                <textarea class="form-control {{ $errors->has('io_remarks_demo_performance') ? 'is-invalid' : ''}}" id="io_remarks_demo_performance" name="io_remarks_demo_performance" rows="3">{{old('io_remarks_demo_performance', $acr->io_remarks_demo_performance)}}</textarea>
                @error('io_remarks_demo_performance')
                <div class="invalid-feedback">
                    {{$errors->first('io_remarks_demo_performance')}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="special_achievements" class="col-sm-2 col-form-label">Special Achievements</label>
            <div class="col-sm-6">
                <textarea class="form-control {{ $errors->has('special_achievements') ? 'is-invalid' : ''}}" id="special_achievements" name="special_achievements" rows="3">{{old('special_achievements', $acr->special_achievements)}}</textarea>
                @error('special_achievements')
                <div class="invalid-feedback">
                    {{$errors->first('special_achievements')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="io_performance_appraisal_id">Performance Appraisal</label>
                <select class="form-control {{ $errors->has('io_performance_appraisal_id') ? 'is-invalid' : ''}}" id="io_performance_appraisal_id" name="io_performance_appraisal_id" required>
                    @foreach($performance_appraisals as $performance_appraisal)
                    <option value="{{$performance_appraisal->id}}" {{$acr->io_performance_appraisal_id == $performance_appraisal->id ? 'selected' : ''}}>{{ $performance_appraisal->abbr}} - ({{$performance_appraisal->title}})</option>
                    @endforeach
                </select>
                @error('io_performance_appraisal_id')
                <div class="invalid-feedback">
                    {{$errors->first('io_performance_appraisal_id')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="io_emp_sign_date">Employee sign date</label>
                <input type="date" class="form-control {{ $errors->has('io_emp_sign_date') ? 'is-invalid' : ''}}" id="io_emp_sign_date" value="{{ old('io_emp_sign_date', $acr->io_emp_sign_date ? Helper::parseDate($acr->io_emp_sign_date, 'Y-m-d') : '') }}" name="io_emp_sign_date" />
                @error('io_emp_sign_date')
                <div class="invalid-feedback">
                    {{$errors->first('io_emp_sign_date')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="io_name" title="Initiating Officer Name">IO Name</label>
                <input type="text" class="form-control {{ $errors->has('io_name') ? 'is-invalid' : ''}}" id="io_name" value="{{ old('io_name', $acr->io_name) }}" name="io_name" />
                <input type="hidden" id="io_employee_id" name="io_employee_id" value="{{ old('io_employee_id', $acr->io_employee_id) }}" />
                <div class="usersList" id="ioUsersList"></div>
                @error('io_name')
                <div class="invalid-feedback">
                    {{$errors->first('io_name')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3" title="Initiating Officer Appointment">
                <label for="io_appointment">IO Appointment</label>
                <input type="text" class="form-control {{ $errors->has('io_appointment') ? 'is-invalid' : ''}}" id="io_appointment" value="{{ old('io_appointment', $acr->io_appointment) }}" name="io_appointment" />
                @error('io_appointment')
                <div class="invalid-feedback">
                    {{$errors->first('io_appointment')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="io_sign_date" title="Initiating Officer date of sign">IO sign date</label>
                <input type="date" class="form-control {{ $errors->has('io_sign_date') ? 'is-invalid' : ''}}" id="io_sign_date" value="{{ old('io_sign_date', $acr->io_sign_date ? Helper::parseDate($acr->io_sign_date, 'Y-m-d') : '') }}" name="io_sign_date" />
                @error('io_sign_date')
                <div class="invalid-feedback">
                    {{$errors->first('io_sign_date')}}
                </div>
                @enderror
            </div>
        </div>


        <h2 class="text-center mt-4 mb-5">PART - III <br />SENIOR REPORTING OFFICER'S RECOMMENDATIONS</h2>

        <div class="form-group row">
            <label for="sro_remarks" class="col-sm-2 col-form-label">SRO Remarks</label>
            <div class="col-sm-6">
                <textarea class="form-control {{ $errors->has('sro_remarks') ? 'is-invalid' : ''}}" id="sro_remarks" name="sro_remarks" rows="3">{{old('sro_remarks', $acr->sro_remarks)}}</textarea>
                @error('sro_remarks')
                <div class="invalid-feedback">
                    {{$errors->first('sro_remarks')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="sro_performance_appraisal_id">Performance Appraisal</label>
                <select class="form-control {{ $errors->has('sro_performance_appraisal_id') ? 'is-invalid' : ''}}" id="sro_performance_appraisal_id" name="sro_performance_appraisal_id">
                    @foreach($performance_appraisals as $performance_appraisal)
                    <option value="{{$performance_appraisal->id}}" {{$acr->sro_performance_appraisal_id == $performance_appraisal->id ? 'selected' : ''}}>{{ $performance_appraisal->abbr}} - ({{$performance_appraisal->title}})</option>
                    @endforeach
                </select>
                @error('sro_performance_appraisal_id')
                <div class="invalid-feedback">
                    {{$errors->first('sro_performance_appraisal_id')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="sro_emp_sign_date">Employee sign date</label>
                <input type="date" class="form-control {{ $errors->has('sro_emp_sign_date') ? 'is-invalid' : ''}}" id="sro_emp_sign_date" value="{{ old('sro_emp_sign_date', $acr->sro_emp_sign_date ? Helper::parseDate($acr->sro_emp_sign_date, 'Y-m-d') : '') }}" name="sro_emp_sign_date" />
                @error('sro_emp_sign_date')
                <div class="invalid-feedback">
                    {{$errors->first('sro_emp_sign_date')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="sro_name" title="Senior Reporting Officer Name">SRO Name</label>
                <input type="text" class="form-control {{ $errors->has('sro_name') ? 'is-invalid' : ''}}" id="sro_name" value="{{ old('sro_name', $acr->sro_name) }}" name="sro_name" />
                <input type="hidden" id="sro_employee_id" name="sro_employee_id" value="{{ old('sro_employee_id', $acr->sro_employee_id) }}" />
                <div id="sroUsersList" class="usersList"></div>
                @error('sro_name')
                <div class="invalid-feedback">
                    {{$errors->first('sro_name')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3" title="Senior Reporting Officer Appointment">
                <label for="sro_appointment">SRO Appointment</label>
                <input type="text" class="form-control {{ $errors->has('sro_appointment') ? 'is-invalid' : ''}}" id="sro_appointment" value="{{ old('sro_appointment', $acr->sro_appointment) }}" name="sro_appointment" />
                @error('sro_appointment')
                <div class="invalid-feedback">
                    {{$errors->first('sro_appointment')}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="sro_sign_date" title="Senior Reporting Officer date of sign">SRO sign date</label>
                <input type="date" class="form-control {{ $errors->has('sro_sign_date') ? 'is-invalid' : ''}}" id="sro_sign_date" value="{{ old('sro_sign_date', $acr->sro_sign_date ? Helper::parseDate($acr->sro_sign_date, 'Y-m-d') : '') }}" name="sro_sign_date" />
                @error('sro_sign_date')
                <div class="invalid-feedback">
                    {{$errors->first('sro_sign_date')}}
                </div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block mt-5 mb-5">Submit</button>
    </form>
    <br />
    <br />
    <br />
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/emp_acr.js') }}"></script>
@endsection