@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow rounded">
                <div class="card-header text-center">
                    <h3 class="card-title">Forgot Password</h3>
                    <p class="text-muted mb-0">Enter your email to reset your password</p>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autofocus
                                placeholder="testuser@example.com">
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>

                    @if (session('debug'))
                        <div class="alert alert-info mt-3">
                            <strong>⚠️ For Local Testing:</strong> Open <code>storage/logs/laravel.log</code> to copy the reset link.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
