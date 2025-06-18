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
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@if ($birthdayUsers->count())
    <div class="toast-container position-fixed top-0 end-0 p-3 z-3">
        @foreach ($birthdayUsers as $user)
            <div class="toast show mb-2 border shadow-sm" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-primary text-white">
                    <strong class="me-auto">🎉 Happy Birthday!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Happy Birthday, <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>!<br>
                    Wishing you a fantastic year ahead! 🎂
                </div>
            </div>
        @endforeach
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let toastElList = [].slice.call(document.querySelectorAll('.toast'))
        toastElList.map(function (toastEl) {
            new bootstrap.Toast(toastEl, { delay: 6000 }).show()
        });
    });
</script>


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
