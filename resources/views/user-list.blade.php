@extends('layouts.app')

@section('content')
<div class="container-xl py-3">
  <h2>User Management</h2>

  <!-- Filter & Controls -->
  <form method="GET" action="" class="row g-2 mb-3">
    <div class="col-md-4">
      <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name or email">
    </div>
    <div class="col-md-2">
      <select name="perPage" class="form-select" onchange="this.form.submit()">
        @foreach([10, 25, 50, 100] as $size)
          <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>{{ $size }} per page</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary">Apply</button>
    </div>
  </form>

  <!-- Table -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th><a href="?sort=first_name&direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">First Name</a></th>
          <th><a href="?sort=last_name&direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">Last Name</a></th>
          <th><a href="?sort=email&direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">Email</a></th>
          <th><a href="?sort=date_of_birth&direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">Date of Birth</a></th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->date_of_birth }}</td>
            <td>{{ $user->status }}</td>
            <td>
              <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">View</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="mt-3">
      {{ $users->appends(request()->query())->links() }}
    </div>
  </div>
</div>
@endsection
