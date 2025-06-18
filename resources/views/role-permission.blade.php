@extends('layouts.app') {{-- Ensure Tabler layout --}}
@section('content')

<div class="container py-4">
    <h2 class="page-title mb-4">Roles & Permissions</h2>

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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td class="fw-bold">{{ $role->name }}</td>
                                    <td>
                                        @forelse($role->permissions as $permission)
                                            <span class="badge bg-green-lt">{{ $permission->name }}</span>
                                        @empty
                                            <span class="text-muted">No Permissions</span>
                                        @endforelse
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
