@extends('layouts.auth')

@section('title') Login @endsection

@section('desc') Enter your email address and password to access your dashboard. @endsection

@section('content')
<h5 class="auth-title">{{ __('Sign In') }}</h5>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group mb-3">
        <label for="emailaddress">{{ __('Email address') }}</label>
        <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" id="emailaddress" required="" placeholder="Enter your email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="password">{{ __('Password') }}</label>
        <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" id="password" placeholder="Enter your password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3">
        <div class="custom-control custom-checkbox checkbox-info">
            <input type="checkbox" class="custom-control-input" id="checkbox-signin" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="checkbox-signin">{{ __('Remember me') }}</label>
        </div>
    </div>
    <div class="form-group mb-0 text-center">
        <button class="btn btn-danger btn-block" type="submit"> {{ __('Log In') }}</button>
    </div>
</form>
@endsection

@section('extra')
    @if (Route::has('password.request'))
    <p> <a href="{{ route('password.request') }}" class="text-muted ml-1">
            {{ __('Forgot Your Password?') }}</a></p>
    @endif
    <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-muted ml-1"><b class="font-weight-semibold">Sign Up</b></a></p>
@endsection