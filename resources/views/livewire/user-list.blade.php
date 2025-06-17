<div>
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <div class="input-icon">
                <span class="input-icon-addon">
                    <i class="ti ti-search"></i>
                </span>
                <input wire:model.debounce.500ms.live="search" type="text" class="form-control" placeholder="Search by name or email">
            </div>
        </div>

        <div class="col-md-3 ms-auto">
            <select wire:model.live="perPage" class="form-select">
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
                <option value="100">100 per page</option>
            </select>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-hover table-striped border-0">
                <thead class="bg-light">
                    <tr>
                        <th wire:click="sortBy('first_name')" class="cursor-pointer">
                            First Name @if($sortField === 'first_name') <i class="ti ti-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i> @endif
                        </th>
                        <th wire:click="sortBy('last_name')" class="cursor-pointer">
                            Last Name @if($sortField === 'last_name') <i class="ti ti-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i> @endif
                        </th>
                        <th wire:click="sortBy('email')" class="cursor-pointer">
                            Email @if($sortField === 'email') <i class="ti ti-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i> @endif
                        </th>
                        <th wire:click="sortBy('date_of_birth')" class="cursor-pointer">
                            DOB @if($sortField === 'date_of_birth') <i class="ti ti-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i> @endif
                        </th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->date_of_birth }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary" wire:click="showUser({{ $user->id }})">
                                    <i class="ti ti-eye me-1"></i> View
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-center">
            {{ $users->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <!-- User Detail Modal -->
    @if ($selectedUser)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5);" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content shadow">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="ti ti-user me-1"></i> User Details: {{ $selectedUser->first_name }} {{ $selectedUser->last_name }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6"><strong>Email:</strong> {{ $selectedUser->email }}</div>
                            <div class="col-md-6"><strong>Phone:</strong> {{ $selectedUser->phone }}</div>
                            <div class="col-md-6"><strong>DOB:</strong> {{ $selectedUser->date_of_birth }}</div>
                            <div class="col-md-6"><strong>Occupation:</strong> {{ $selectedUser->occupation }}</div>
                            <div class="col-md-12"><strong>Address:</strong> {{ $selectedUser->address }}, {{ $selectedUser->city }}, {{ $selectedUser->country }}</div>
                            <div class="col-md-6"><strong>Status:</strong> {{ $selectedUser->status }}</div>
                            <div class="col-md-6"><strong>Role:</strong> {{ $selectedUser->role }}</div>
                            <div class="col-md-12"><strong>Joined:</strong> {{ $selectedUser->created_at }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
