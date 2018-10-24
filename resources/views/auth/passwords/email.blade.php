@extends('layouts.auth')

@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="{{ url('/') }}">
        <img src="../img/logo_dark.png" alt="c230 consultores logo">
      </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('Reset Password') }}</p>

        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf

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
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-block btn-primary">{{ __('Send Password Reset Link') }}</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection
