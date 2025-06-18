@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="page-title mb-4">Create Role</h2>

    <form action="{{ route('roles.store') }}" method="POST" class="card">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Role Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Permissions</label>
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                        <label class="form-check-label">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Create Role</button>
        </div>
    </form>
</div>
@endsection
