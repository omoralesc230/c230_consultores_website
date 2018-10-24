@extends('layouts.auth')

@section('content')
  <div class="register-box">
    <div class="register-logo">
      <a href="{{ url('/') }}">
        <img src="./img/logo_dark.png" alt="c230 consultores logo">
      </a>
    </div>
    
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="input-group mb-3">
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Full name">
            <div class="input-group-append">
              <span class="fa fa-user input-group-text"></span>
            </div>

            @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>
          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">
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
          <div class="input-group mb-3">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Retype password">
            <div class="input-group-append">
              <span class="fa fa-lock input-group-text"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          {{-- <a href="#" class="btn btn-block btn-primary">
          <i class="fa fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
        <i class="fa fa-google-plus mr-2"></i>
        Sign up using Google+
      </a> --}}
    </div>

    <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div><!-- /.card -->
</div>
@endsection
