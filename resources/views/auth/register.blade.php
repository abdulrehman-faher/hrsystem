@extends('layouts.master', ['title'=> 'Users', 'active' => 'user', 'activeChild' => 'userAddNew'])

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="/users">Users</a></li>
    <li class="breadcrumb-item active">Add New</li>
</ol>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create a new users account') }} </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="employee_id" class="col-md-4 col-form-label text-md-right">{{ __('Employee') }}</label>

                            <div class="col-md-6">
                                <!-- <select id="employee_id" name="employee_id" class="form-control select2" onchange="myNewFunction(this)"> -->
                                <select id="employee_id" name="employee_id" class="form-control select2">
                                    <option value>Choose...</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" {{ old('employee_id') == $employee->id ? "selected" : "" }} data-club="{{$employee->club_id}}">{{$employee->name}} {{$employee->email ? "(" . $employee->email.")" : ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="club_id" class="col-md-4 col-form-label text-md-right">{{ __('Club') }}</label>

                            <div class="col-md-6">
                                <select id="club_id" name="club_id" class="form-control">
                                    <option value>Choose...</option>
                                    @foreach($clubs as $club)
                                    <option value="{{$club->id}}" {{ old('club_id') == $club->id ? 'selected' : '' }} data-club="{{$employee->club_id}}" data-email="{{$employee->email}}">{{$club->title}} {{$club->number ? "(" . $club->number.")" : ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                            <div class="col-md-6">
                                <select id="type" name="type" class="form-control">
                                    @foreach(['1' => 'User', '2' => 'Admin', '3'=>'Super Admin', '4'=>'Director'] as $key => $value)
                                    <option value="{{$key}}" {{ old('type') == $key ? "selected":"" }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    function myNewFunction(event) {
        const text = event.options[event.selectedIndex].text;
        var parts = text.split(/[(\)]{1,2}/);

        $('#name').val(parts[0]);
        $('#email').val(parts[1]);
    }
    $(document).on('change', '#employee_id', function(e) {
        const $this = $(this);
        const selected = $this.find('option:selected');
        const text = selected.text();
        const club = selected.attr('data-club');
        const parts = text.split(/[(\)]{1,2}/);
        if (text !== 'Choose...') {
            $('#name').val(parts[0]);
            $('#email').val(parts[1]);
            if (club) {
                $('#club_id').val(club)
            } else {
                $("#club_id").prop("selectedIndex", 0);
            }
        } else {
            $('#name').val('');
            $('#email').val('');
            $("#club_id").prop("selectedIndex", 0);
        }
    });

    // $(document).on('blur', '#email', function() {
    //     const $this = $(this);
    //     console.log('blur', $this.val());
    //     axios.get(`/users/api?email=${$this.val()}`).then(response => {
    //         console.log(response.data);
    //     }).catch(error => {
    //         console.log(error);
    //     });
    // });
</script>
@endsection