<!-- resources/views/auth/reset-password.blade.php -->
@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>Reset Password</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required class="form-control">
        </div>
        @error('email')
        <p class="mt-3 text-center text-danger">
            {{ $message }}
        </p>
        @enderror

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection