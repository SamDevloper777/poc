@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="page-title mb-4">Edit Role</h2>

    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="card p-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Role Name</label>
            <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Permissions</label>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-4">
                        <label class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input"
                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                            <span class="form-check-label">{{ $permission->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update Role</button>
            <a href="{{ route('role-permission.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
