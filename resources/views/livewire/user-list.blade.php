<div class="container p-4">
    <!-- Page Title -->
    <div class="mb-4">
        <h2 class="page-title">User Management</h2>
    </div>

    <!-- Card -->
    <div class="card">
        <div class="card-header px-4 py-3 d-flex justify-content-between flex-wrap gap-3 align-items-center">
            <!-- Per Page Selector -->
            <div class="d-flex align-items-center gap-2">
                <label class="form-label mb-0">Show</label>
                <select class="form-select form-select-sm w-auto" wire:model.live="perPage">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span>entries</span>
            </div>

            <!-- Search + Export -->
            <div class="d-flex gap-2 ms-auto">
                <input type="text" wire:model.debounce.500ms.live="search"
                    class="form-control form-control-sm" placeholder="Search users...">
                <button wire:click="exportCsv" class="btn btn-sm btn-secondary">
                    <i class="ti ti-download me-1"></i> Export CSV
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive p-3">
            <table class="table table-vcenter card-table table-hover table-bordered mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th wire:click="sortBy('first_name')" class="cursor-pointer px-3 py-2">First Name</th>
                        <th wire:click="sortBy('last_name')" class="cursor-pointer px-3 py-2">Last Name</th>
                        <th wire:click="sortBy('email')" class="cursor-pointer px-3 py-2">Email</th>
                        <th wire:click="sortBy('date_of_birth')" class="cursor-pointer px-3 py-2">DOB</th>
                        <th class="px-3 py-2">Status</th>
                        <th class="px-3 py-2 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                    @forelse ($users as $user)
                    <tr>
                        <td class="px-3 py-2">{{ $user->first_name }}</td>
                        <td class="px-3 py-2">{{ $user->last_name }}</td>
                        <td class="px-3 py-2">{{ $user->email }}</td>
                        <td class="px-3 py-2">{{ $user->date_of_birth }}</td>
                        <td class="px-3 py-2">
                            <span class="badge bg-{{ $user->status === 'Active' ? 'green' : ($user->status === 'Suspended' ? 'red' : 'yellow') }}">
                                {{ $user->status }}
                            </span>
                        </td>
                        
                        <td class="px-3 py-2 text-end">
                            <button wire:click="showUser({{ $user->id }})" class="btn btn-sm btn-primary">
                                <i class="ti ti-eye"></i> View
                            </button>
                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-primary">
                                <i class="ti ti-eye"></i> edit
                            </a>
                            <a href="{{ route('users.assign-role',$user->id) }}" class="btn btn-sm btn-primary">
                                <i class="ti ti-eye"></i> Assign Role
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer pt-3 d-flex justify-content-center">
            {{ $users->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <!-- User Detail Modal -->
    @if ($selectedUser)
    <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5);" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ti ti-user me-2 text-primary"></i> User Details: {{ $selectedUser->first_name }} {{ $selectedUser->last_name }}
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row gy-3">
                        <div class="col-md-6"><strong>Email:</strong> {{ $selectedUser->email }}</div>
                        <div class="col-md-6"><strong>Phone:</strong> {{ $selectedUser->phone }}</div>
                        <div class="col-md-6"><strong>DOB:</strong> {{ $selectedUser->date_of_birth }}</div>
                        <div class="col-md-6"><strong>Occupation:</strong> {{ $selectedUser->occupation }}</div>
                        <div class="col-md-12">
                            <strong>Address:</strong>
                            {{ $selectedUser->address }}, {{ $selectedUser->city }}, {{ $selectedUser->country }}
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $selectedUser->status === 'Active' ? 'green' : ($selectedUser->status === 'Suspended' ? 'red' : 'yellow') }}">
                                {{ $selectedUser->status }}
                            </span>
                        </div>
                        <div class="col-md-6"><strong>Role:</strong> {{ $selectedUser->role }}</div>
                        <div class="col-md-12"><strong>Joined:</strong> {{ $selectedUser->created_at->format('d M Y h:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>