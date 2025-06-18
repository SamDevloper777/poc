<div>
    <div class="row mb-3">
        <div class="col">
            <input
                type="text"
                wire:model.debounce.500ms="search"
                class="form-control"
                placeholder="Search users..."
            >
        </div>
        <div class="col-auto">
            <button wire:click="$refresh" class="btn btn-secondary">
                🔁 Refresh
            </button>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap">
                <thead>
                    <tr>
                        <th wire:click="sortBy('first_name')" class="cursor-pointer">
                            First Name {!! $sortField === 'first_name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th wire:click="sortBy('last_name')" class="cursor-pointer">
                            Last Name {!! $sortField === 'last_name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th wire:click="sortBy('email')" class="cursor-pointer">
                            Email {!! $sortField === 'email' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Occupation</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->city }}</td>
                            <td>{{ $user->country }}</td>
                            <td>{{ $user->occupation }}</td>
                            <td>
                                <span class="badge bg-{{ $user->status === 'Active' ? 'success' : ($user->status === 'Inactive' ? 'warning' : 'danger') }}">
                                    {{ $user->status }}
                                </span>
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

        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
            </div>
            <div>
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
