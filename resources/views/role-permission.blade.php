@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="page-title mb-4">Roles & Permissions</h2>

    <div class="row mb-3">
        <div class="col-auto">
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 5v14m-7 -7h14" />
                </svg> Create Role
            </a>
        </div>
        <div class="col-auto">
            <a href="{{ route('permissions.create') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 5v14m-7 -7h14" />
                </svg> Create Permission
            </a>
        </div>
    </div>

    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Roles and their Permissions</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td class="fw-bold">{{ $role->name }}</td>
                                    <td>
                                        @forelse($role->permissions as $permission)
                                            <span class="badge bg-green-lt text-dark dark:bg-green-dark dark:text-white">{{ $permission->name }}</span>
                                        @empty
                                            <span class="text-muted">No Permissions</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M15 6l3 3l-9 9h-3v-3z" />
                                                <path d="M18.5 5.5a2.121 2.121 0 0 1 3 3l-1 1l-3 -3l1 -1z" />
                                            </svg> Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    Total Roles: {{ $roles->count() }} | Total Permissions: {{ $permissions->count() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
