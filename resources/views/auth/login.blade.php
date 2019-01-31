@extends('public.app')

@section('title')
| Log-in
@endsection

@section('content')
<p class="login-box-msg">Sign in to access our Library</p>

<form action="{{ route('login') }}" method="post">
    @csrf

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <input type="text" name="email" class="form-control" placeholder="Email" required>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <input type="checkbox" name="remember" value="checked"> Remember me
        </div>
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
    </div>
</form>

<a href="{{ route('password.request') }}">I forgot my password</a>
@endsection
