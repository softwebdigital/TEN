@extends('layouts.auth')

@section('title') Reset Password @endsection

@section('desc') Enter your email address and we'll send you an email with instructions to reset your password. @endsection

@section('content')
<h5 class="auth-title">{{ __('Recover Password') }}</h5>
                                <form method="POST" action="{{ route('password.email') }}">
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
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-danger btn-block" type="submit"> {{ __('Reset Password') }}</button>
                                    </div>
                                </form>
@endsection

@section('extra')
                                
                                <p> <a href="/login" class="text-muted ml-1">
                                        {{ __('Back to Log In?') }}</a></p>
@endsection