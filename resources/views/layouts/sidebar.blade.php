<aside class="navbar navbar-vertical navbar-expand-lg" id="app-sidebar">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-brand-image">
    </a>

    <!-- Toggle for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="sidebar-menu">
      <ul class="navbar-nav pt-lg-3">

        <!-- Dashboard -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <span class="nav-link-icon"><i class="ti ti-home"></i></span>
            <span class="nav-link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <span class="nav-link-icon"><i class="ti ti-home"></i></span>
            <span class="nav-link-title">Dashboard</span>
          </a>
        </li>

        <!-- Logout -->
        <li class="nav-item mt-3">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
              <i class="ti ti-logout me-2"></i> Logout
            </button>
          </form>
        </li>

      </ul>
    </div>
  </div>
</aside>
