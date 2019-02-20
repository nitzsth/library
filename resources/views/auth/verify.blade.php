@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="box">
          <div class="box-header with-border">
            <strong>{{ __('Verify Your Email Address') }}</strong>
          </div>

          <div class="box-body">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.

            @if (session('resent'))
              <p class="text-green">
                {{ __('A fresh verification link has been sent to your email address.') }}
              </p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
