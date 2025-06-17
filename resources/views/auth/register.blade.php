@extends('layouts.tabler')

@section('title', 'Register')

@section('content')
<form method="POST" action="{{ route('register') }}" class="card card-md">
    @csrf
    <div class="card-body">
        <h2 class="card-title text-center mb-4">Create New Account</h2>

        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input name="first_name" type="text" class="form-control" value="{{ old('first_name') }}" required>
            @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input name="last_name" type="text" class="form-control" value="{{ old('last_name') }}" required>
            @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control" required>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Create account</button>
        </div>
    </div>

    <div class="card-footer text-center">
        <div class="text-muted">Already registered? <a href="{{ route('login') }}">Sign in</a></div>
    </div>
</form>
@endsection
