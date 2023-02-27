@extends('backEnd.auth.layouts.auth')

@section('title')
    {{ 'Log In' }}
@endsection
@section('page-title')
    {{ 'Log In' }}
@endsection
@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <div class="input-group ">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email"
                        autofocus />

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                </div>
                @if ($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>


            <div class="mb-3">
                <div class="input-group ">
                    <input type="password" name="password" class="form-control" placeholder="Password"
                        autocomplete="current-password" />

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                 @if ($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                        <label for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mb-1">
            <a href="{{ route('password.request') }}">I forgot my password</a>
        </p>
    </div>
@endsection
