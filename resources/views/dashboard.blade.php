@extends('layouts.app')

@section('content')
<div class="page">
  <div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            </h2>
            <div class="text-muted mt-1">Email: {{ Auth::user()->email }} | Role: {{ Auth::user()->role }}</div>
          </div>
        </div>
      </div>

      <!-- Cards -->
      <div class="row row-deck row-cards mt-4">
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="text-blue me-3"><i class="ti ti-users text-lg"></i></span>
                <div>
                  <div class="font-weight-medium">Users</div>
                  <div class="text-muted">{{ $usersCount ?? 0 }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="text-green me-3"><i class="ti ti-calendar-event"></i></span>
                <div>
                  <div class="font-weight-medium">Birthdays Today</div>
                  <div class="text-muted">{{ $birthdaysToday ?? 0 }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="text-orange me-3"><i class="ti ti-chart-bar"></i></span>
                <div>
                  <div class="font-weight-medium">Active Users</div>
                  <div class="text-muted">{{ $activeUsers ?? 0 }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="text-red me-3"><i class="ti ti-user-off"></i></span>
                <div>
                  <div class="font-weight-medium">Inactive Users</div>
                  <div class="text-muted">{{ $inactiveUsers ?? 0 }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- System Info -->
      <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">System Info</h3>
          <div>
            <!-- Dark Mode Toggle -->
            <a href="#" class="btn btn-sm btn-dark hide-theme-dark" onclick="setTheme('dark')">
              <i class="ti ti-moon me-1"></i> Dark Mode
            </a>
            <a href="#" class="btn btn-sm btn-light hide-theme-light" onclick="setTheme('light')">
              <i class="ti ti-sun me-1"></i> Light Mode
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p><strong>Logged in as:</strong> {{ Auth::user()->email }}</p>
              <p><strong>Role:</strong> {{ Auth::user()->role }}</p>
              <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('d M, Y') }}</p>
            </div>
            <div class="col-md-6">
              <p><strong>Server Time:</strong> {{ now()->toDayDateTimeString() }}</p>
              <p><strong>IP Address:</strong> {{ request()->ip() }}</p>
              <p><strong>Browser:</strong> {{ request()->userAgent() }}</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Dark Mode Script -->
<script>
  function setTheme(theme) {
    if (theme === 'dark') {
      document.documentElement.setAttribute('data-bs-theme', 'dark');
      localStorage.setItem('theme', 'dark');
    } else {
      document.documentElement.removeAttribute('data-bs-theme');
      localStorage.setItem('theme', 'light');
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      setTheme('dark');
    }
  });
</script>
@endsection
