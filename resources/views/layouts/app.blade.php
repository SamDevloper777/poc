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
      @include('layouts.sidebar')
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
    @livewireScripts
  </body>
</html>
