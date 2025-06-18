<div>
    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-muted">
                Show
                <select class="form-select form-select-sm" wire:model.live="perPage">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                entries
            </div>
            <div class="ms-2">
                <button wire:click="exportCsv" class="btn btn-sm btn-secondary">
                    Export CSV
                </button>
            </div>
            <div class="ms-auto text-muted">
                Search:
                <input type="text" wire:model.debounce.500ms.live="search" class="form-control form-control-sm" placeholder="Search users…">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th wire:click="sortBy('first_name')" class="cursor-pointer">First Name</th>
                    <th wire:click="sortBy('last_name')" class="cursor-pointer">Last Name</th>
                    <th wire:click="sortBy('email')" class="cursor-pointer">Email</th>
                    <th wire:click="sortBy('date_of_birth')" class="cursor-pointer">DOB</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->date_of_birth }}</td>
                    <td>
                        <a wire:click="showUser({{ $user->id }})" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-muted text-center">No users found.</td>
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