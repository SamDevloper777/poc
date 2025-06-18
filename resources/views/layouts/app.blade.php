<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ config('app.name', 'Laravel Dashboard') }}</title>

    <!-- Tabler CSS -->
    <link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
  </head>
  <body>
    <div class="page">
      @include('layouts.navbar')

      <!-- Page Content -->
      <div class="page-wrapper">
        @yield('content')
      </div>
    </div>

    <!-- Tabler JS -->
    <script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>

    <!-- Theme Toggle Script -->
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
    @if(session('success') || session('error'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const type = "{{ session('success') ? 'success' : 'error' }}";
        const message = `{!! session('success') ?? session('error') !!}`;

        const toast = document.createElement('div');
        toast.className = 'toast show position-fixed top-0 end-0 m-4 border-0 shadow-lg';
        toast.role = 'alert';
        toast.style.zIndex = 9999;
        toast.style.minWidth = '300px';
        toast.style.animation = 'slideIn 0.4s ease';

        toast.innerHTML = `
            <div class="toast-header text-white ${type === 'success' ? 'bg-success' : 'bg-danger'}">
                <i class="ti ti-${type === 'success' ? 'check' : 'alert-triangle'} me-2"></i>
                <strong class="me-auto">${type === 'success' ? 'Success' : 'Error'}</strong>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body fw-medium fs-6">
                ${message}
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 5000);
    });
</script>

<style>
@keyframes slideIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endif

    @livewireScripts
  </body>
</html>
