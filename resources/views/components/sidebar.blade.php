  <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="{{ route('dashboard.index') }}">
      <img class="navbar-brand-dark" src="{{ asset('img/cmnplogo.png') }}" alt="Logo" />
      {{-- <img class="navbar-brand-light" src="{{ asset('dist/assets/img/brand/dark.svg') }}" alt="Volt logo" /> --}}
    </a>
    <div class="d-flex align-items-center">
      <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">

      <ul class="nav flex-column pt-3 pt-md-0">
        <li class="nav-item">
          <a href="#" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
              <img src="{{ asset('img/cmnplogo.png') }}" width="100" alt="Logo" />
            </span>
            <span class="mt-1 ms-1 sidebar-text">APLIKASI</span>
          </a>
        </li>

        @foreach ($sidebar as $menu)
          @can($menu->permission_name)
            @php
              $hasChildren = $menu->child_menu;

              $isActive = $hasChildren
                  ? $menu->items->contains(function ($item) {
                      return request()->routeIs($item->route);
                  })
                  : request()->routeIs($menu->route);
            @endphp
            @if ($hasChildren)
              <li class="nav-item">
                <span
                  class="nav-link collapsed d-flex justify-content-between align-items-center {{ $isActive ? '' : 'collapsed' }}"
                  data-bs-toggle="collapse" data-bs-target="#submenu-{{ $menu->id }}">

                  <span>
                    <i class="{{ $menu->icon }} me-2"></i>
                    <span class="sidebar-text">{{ $menu->name }}</span>
                  </span>

                  <span class="link-arrow">
                    <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd">
                      </path>
                    </svg>

                  </span>
                </span>
                <div class="multi-level collapse {{ $isActive ? 'show' : '' }}" role="list"
                  id="submenu-{{ $menu->id }}" aria-expanded="false">
                  <ul class="flex-column nav">
                    @foreach ($menu->items as $child_menu)
                      @can($child_menu->permission_name)
                        <li class="nav-item {{ request()->routeIs($child_menu->route) ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route($child_menu->route) }}"><span
                              class="sidebar-text">{{ $child_menu->name }}</span></a>
                        </li>
                      @endcan
                    @endforeach
                  </ul>
                </div>
              </li>
            @else
              <li class="nav-item {{ $isActive ? 'active' : '' }}">
                <a href="{{ route($menu->route) }}" class="nav-link d-flex align-items-center">
                  <span class="sidebar-icon">
                    <i class="{{ $menu->icon }} me-2"></i>
                  </span>
                  <span class="sidebar-text">{{ $menu->name }}</span>
                </a>
              </li>
            @endif
          @endcan
        @endforeach



        {{-- <li class="nav-item">
          <a href="{{ route('dashboard.index') }}" class="nav-link">
            <i class="bi bi-house-door-fill me-2"></i>
            <span class="sidebar-text">Dashboard</span>
          </a>
        </li>


        <li class="nav-item">
          <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
            data-bs-target="#submenu-app">

            <span>
              <i class="bi bi-credit-card-2-front me-2"></i>
              <span class="sidebar-text">Tables</span>
            </span>

            <span class="link-arrow">
              <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd">
                </path>
              </svg>
            </span>
          </span>

          <div class="multi-level collapse" role="list" id="submenu-app" aria-expanded="false">
            <ul class="flex-column nav">
              <li class="nav-item">
                <a class="nav-link" href="../../pages/tables/bootstrap-tables.html"><span class="sidebar-text">Bootstrap
                    Tables</span></a>
              </li>
            </ul>
          </div>
        </li> --}}

        <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>

        <li class="nav-item ">
          <a href="#!" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
              <i class="bi bi-question-circle me-2"></i>
            </span>
            <span class="sidebar-text">Documentation</span></a>
        </li>

        <li class="nav-item">
          <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
              <i class="bi bi-box-arrow-left me-2"></i>
            </span>
            <span class="sidebar-text">Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>


    </div>
  </nav>
