@extends('layouts.auth')

@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="{{ url('/') }}">
        <img src="./img/logo_dark.png" alt="c230 consultores logo">
      </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
            <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>
            </div>

            @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>

            @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-block btn-primary">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          {{-- <a href="#" class="btn btn-block btn-primary">
            <i class="fa fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fa fa-google-plus mr-2"></i> Sign in using Google+
          </a> --}}
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        </p>
        <p class="mb-0">
          <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection
