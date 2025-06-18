<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
<livewire:user-list/>
{{-- <div class="container">
    <form method="GET" action="{{ route('users.index') }}" class="mb-4 d-flex gap-3">
        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
        <select name="perPage" class="form-select w-auto">
            @foreach([10, 25, 50, 100] as $size)
                <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>{{ $size }} per page</option>
            @endforeach
        </select>
        <button class="btn btn-primary">Apply</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Clear</a>
    </form>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th><a href="{{ route('users.index', array_merge(request()->all(), ['sortField' => 'first_name', 'sortDirection' => $sortField === 'first_name' && $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">First Name</a></th>
                <th><a href="{{ route('users.index', array_merge(request()->all(), ['sortField' => 'last_name', 'sortDirection' => $sortField === 'last_name' && $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">Last Name</a></th>
                <th><a href="{{ route('users.index', array_merge(request()->all(), ['sortField' => 'email', 'sortDirection' => $sortField === 'email' && $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">Email</a></th>
                <th><a href="{{ route('users.index', array_merge(request()->all(), ['sortField' => 'date_of_birth', 'sortDirection' => $sortField === 'date_of_birth' && $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">DOB</a></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->date_of_birth }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
      {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div> --}}
@endsection
