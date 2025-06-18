@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl d-flex justify-content-between align-items-center">
            <h2 class="page-title">User Management</h2>
            <div>
                <form method="POST" action="{{ route('users.clear.cache') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="ti ti-brush"></i> Clear Cache
                    </button>
                </form>

                <a href="{{ route('users.export.excel', request()->query()) }}" class="btn btn-success ms-2">
                    <i class="ti ti-download"></i> Export Excel
                </a>

            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <form method="GET" action="{{ route('users.index') }}" class="row g-2 mb-4">
                <div class="col">
                    <div class="input-icon">
                        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search users...">
                        <span class="input-icon-addon">
                            <i class="ti ti-search"></i>
                        </span>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">
                        <i class="ti ti-filter-search me-1"></i> Search
                    </button>
                </div>
            </form>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('users.index', ['search' => $search, 'sortField' => 'first_name', 'sortDirection' => $sortField === 'first_name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                                        First Name {!! $sortField === 'first_name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('users.index', ['search' => $search, 'sortField' => 'last_name', 'sortDirection' => $sortField === 'last_name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                                        Last Name {!! $sortField === 'last_name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                                    </a>
                                </th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Status</th>
                                @can('edit-users')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->city }}</td>
                                <td>{{ $user->country }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->status === 'Active' ? 'green' : ($user->status === 'Inactive' ? 'yellow' : 'red') }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td>
                                   @can('assign-role')
                                     <a href="{{ route('users.assign-role', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                        Assign Role
                                    </a>
                                    @endcan
                                    @can('edit-users')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                    @endcan

                                    @can('edit-users')
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-info me-1">
                                        View
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No users found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex justify-content-center">
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection