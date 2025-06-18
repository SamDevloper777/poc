@extends('layouts.app')

@section('content')
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="{{ route('users.update', $user->id) }}" class="card shadow">
                @csrf
                @method('PUT')

                <div class="card-header">
                    <h3 class="card-title">Edit User: {{ $user->first_name }} {{ $user->last_name }}</h3>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name', $user->first_name) }}">
                            @error('first_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name', $user->last_name) }}">
                            @error('last_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                                value="{{ old('date_of_birth', $user->date_of_birth) }}">
                            @error('date_of_birth')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Occupation</label>
                            <input type="text" name="occupation" class="form-control @error('occupation') is-invalid @enderror"
                                value="{{ old('occupation', $user->occupation) }}">
                            @error('occupation')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                value="{{ old('city', $user->city) }}">
                            @error('city')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                                value="{{ old('country', $user->country) }}">
                            @error('country')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                value="{{ old('address', $user->address) }}">
                            @error('address')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                @foreach (['Active', 'Inactive', 'Suspended'] as $status)
                                    <option value="{{ $status }}" @selected($user->status === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
