<nav class="navbar navbar-expand-lg py-3 bg-white sticky-top shadow-smooth">
    <div class="container">
      <a class="navbar-brand fw-bold" href="">SanCash</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
          <li class="nav-item">
            <x-navbar-link>
              Dashboard
            </x-navbar-link>
          </li>
          <li class="nav-item">
            <x-navbar-link :href="route('students.index')" :active="request()->routeIs('students.*')">
              Students
            </x-navbar-link>
          </li>
          {{-- <li class="nav-item">
            <x-navbar-link :href="route('bills.index')" :active="request()->routeIs('bills.*')">
            Bills
            </x-navbar-link>
          </li>
          <li class="nav-item">
            <x-navbar-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">
            Transactions
            </x-navbar-link>
          </li> --}}
          {{-- <li class="nav-item">
            <x-navbar-link :href="route('bills.index')" :active="request()->routeIs('bills.*')">
            Bills
            </x-navbar-link>
          </li>
          <li class="nav-item">
            <x-navbar-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">
              Transactions
            </x-navbar-link>
          </li> --}}
          {{-- <li class="nav-item">
            <a class="nav-link" href="">Pengeluaran</a>
          </li>
          <li class="nav-item">
            <x-navbar-link :href="route('users.index')" :active="request()->routeIs('users.*')">
              Pengguna
            </x-navbar-link>
          </li> --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Management
            </a>
            <ul class="dropdown-menu border-0 shadow-smooth p-3">
              <li><a class="dropdown-item" href="{{ route('users.index') }}">Users</a></li>
              <li><a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a></li>
              <li><a class="dropdown-item" href="{{ route('permissions.index') }}">Permissions</a></li>
              <li><a class="dropdown-item" href="{{ route('classrooms.index') }}">Classrooms</a></li>
            </ul>
          </li>
          
        </ul>
        {{-- @auth --}}
        <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
            <img src="" width="40" height="40" class="ms-2 rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow-smooth border-0">
            <li><a class="dropdown-item" href="#">My Dashboard</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </div>
        {{-- @endauth --}}
      </div>
    </div>
</nav>