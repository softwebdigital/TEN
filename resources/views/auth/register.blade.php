@extends('layouts.auth')

@section('title') Register @endsection

@section('desc') Create your account and become a volunteer now @endsection

@section('content')
<h5 class="auth-title">Create Account</h5>
<form action="{{ route('register') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="fullname">Full Name</label>
        <input class="form-control" name="name" type="text" id="fullname" placeholder="Enter your name" required>
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="emailaddress">Email address</label>
        <input class="form-control" type="email" name="email" id="emailaddress" required placeholder="Enter your email">
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input class="form-control" type="number" name="phone" id="phone" required placeholder="Enter your phone number">
        @error('phone')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input class="form-control" type="text" name="address" id="address" required placeholder="Enter your address">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" name="password" type="password" required id="password" placeholder="Enter your password">
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Confirm Password</label>
        <input class="form-control" name="password_confirmation" type="password" required id="password" placeholder="Enter your password again">
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox checkbox-info">
            <input type="checkbox" class="custom-control-input" id="checkbox-signup" name="terms">
            <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
        </div>
    </div>
    <div class="form-group mb-0 text-center">
        <button class="btn btn-danger btn-block" type="submit"> Sign Up </button>
    </div>
</form>
@endsection

@section('extra')
    <p class="text-muted">Already have account?  <a href="/login" class="text-muted ml-1"><b class="font-weight-semibold">Sign In</b></a></p>
@endsection