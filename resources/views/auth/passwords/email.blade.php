@extends('public.app')

@section('title')
| Password Reset
@endsection

@section('content')
<p class="login-box-msg">Reset Password</p>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

<form action="{{ route('password.email') }}" method="post">
    @csrf
    
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <input type="text" name="email" class="form-control" placeholder="Email">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
    </div>
</form>

<a href="{{ route('login') }}">Go to Login</a>
@endsection
