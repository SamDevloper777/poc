@extends('layouts.tabler')

@section('title', 'Login')

@section('content')
    <form class="card card-md" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="card-body">
            <h2 class="card-title text-center mb-4">Login to your account</h2>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" required autofocus>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Password -->
            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember">
                    <span class="form-check-label">Remember me</span>
                </label>
            </div>

            <!-- Submit -->
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
        </div>

        <div class="card-footer text-center">
            <div class="text-muted">forgot password? <a href="{{ route('password.email') }}">Sign up</a></div>
        </div>
    </form>
@endsection
