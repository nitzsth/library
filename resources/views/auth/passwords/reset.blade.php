@extends('public.app')

@section('content')
  <p class="login-box-msg">Reset Password</p>

  <form action="{{ route('password.update') }}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input type="text" name="email" class="form-control" placeholder="Email">
      @if ($errors->has('email'))
        <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
      @endif
    </div>
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
      <input type="password"
             name="password"
             class="form-control"
             placeholder="Password">
      @if ($errors->has('password'))
        <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
      @endif
    </div>
    <div class="form-group">
      <input type="password"
             name="password_confirmation"
             class="form-control"
             placeholder="Confirm Password">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Reset
        Password
      </button>
    </div>
  </form>
@endsection
