@extends('layouts.tabler')

@section('content')
<div class="container-tight py-4">
  <div class="text-center mb-4">
    <h2>Reset Your Password</h2>
    <p class="text-muted">Enter your new password to regain access</p>
  </div>

  <form method="POST" action="{{ route('password.store') }}" class="card card-md">
    @csrf

    <!-- Hidden token input -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="card-body">

      <!-- Email -->
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input
          id="email"
          type="email"
          name="email"
          value="{{ old('email', $request->email) }}"
          required
          autofocus
          autocomplete="username"
          class="form-control @error('email') is-invalid @enderror"
        >
        @error('email')
        <small class="invalid-feedback d-block">{{ $message }}</small>
        @enderror
      </div>

      <!-- New Password -->
      <div class="mb-3">
        <label class="form-label">New Password</label>
        <input
          id="password"
          type="password"
          name="password"
          required
          autocomplete="new-password"
          class="form-control @error('password') is-invalid @enderror"
        >
        @error('password')
        <small class="invalid-feedback d-block">{{ $message }}</small>
        @enderror
      </div>

      <!-- Confirm Password -->
      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input
          id="password_confirmation"
          type="password"
          name="password_confirmation"
          required
          autocomplete="new-password"
          class="form-control @error('password_confirmation') is-invalid @enderror"
        >
        @error('password_confirmation')
        <small class="invalid-feedback d-block">{{ $message }}</small>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="form-footer text-end">
        <button type="submit" class="btn btn-primary w-100">
          Reset Password
        </button>
      </div>

    </div>
  </form>
</div>
@endsection
