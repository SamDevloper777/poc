@extends('layouts.app')

@section('content')
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('users.assign-role.update', $user->id) }}" method="POST" class="card shadow">
                @csrf
                @method('PUT')

                <div class="card-header">
                    <h3 class="card-title">
                        Assign Role to {{ $user->first_name }} {{ $user->last_name }}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Select Role</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror">
                            <option value="">-- Choose Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" @selected($user->hasRole($role))>{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check"></i> Assign Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
