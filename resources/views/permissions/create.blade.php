@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="page-title mb-4">Create Permission</h2>

    <form action="{{ route('permissions.store') }}" method="POST" class="card">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Permission Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-success">Create Permission</button>
        </div>
    </form>
</div>
@endsection
