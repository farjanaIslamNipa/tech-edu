@extends('backEnd.auth.layouts.auth')

@section('title')
    {{"Registration"}}
@endsection
@section('page-title')
    {{"Registration"}}
@endsection
@section('content')
    <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new admin</p>

        <form action="{{ route('register') }}" method="post">
            @csrf

            <div class="input-group mb-3">
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="First Name" required autofocus />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Last Name" required autofocus />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control" placeholder="Phone Number" required autofocus />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="email" name="email" value="{{ old('email') }}"class="form-control" placeholder="Email" required />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" value="password" class="form-control" placeholder="Password" required autocomplete="new-password" />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password_confirmation" value="password_confirmation" class="form-control" placeholder="Retype password" required />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                            I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
@endsection
