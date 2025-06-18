@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-xl py-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">👤 User Profile</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">First Name</dt>
                    <dd class="col-sm-9">{{ $user->first_name }}</dd>

                    <dt class="col-sm-3">Last Name</dt>
                    <dd class="col-sm-9">{{ $user->last_name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">Phone</dt>
                    <dd class="col-sm-9">{{ $user->phone }}</dd>

                    <dt class="col-sm-3">City</dt>
                    <dd class="col-sm-9">{{ $user->city }}</dd>

                    <dt class="col-sm-3">Country</dt>
                    <dd class="col-sm-9">{{ $user->country }}</dd>

                    <dt class="col-sm-3">Occupation</dt>
                    <dd class="col-sm-9">{{ $user->occupation }}</dd>

                    <dt class="col-sm-3">Date of Birth</dt>
                    <dd class="col-sm-9">{{ $user->date_of_birth }}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-{{ $user->status === 'Active' ? 'green' : ($user->status === 'Inactive' ? 'yellow' : 'red') }}">
                            {{ $user->status }}
                        </span>
                    </dd>
                </dl>

                <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">
                    ← Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
