<nav class="navbar navbar-expand-lg py-3 bg-white sticky-top shadow-smooth">
    <div class="container">
      <a class="navbar-brand fw-bold" href="">SanCash</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
          {{-- Dashboard --}}
          <li class="nav-item">
            <x-navbar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
              Dashboard
            </x-navbar-link>
          </li>
          {{-- Students --}}
          <li class="nav-item">
            <x-navbar-link :href="route('students.index')" :active="request()->routeIs('students.*')">
              Students
            </x-navbar-link>
          </li>
          {{-- Bills --}}
          <li class="nav-item">
            <x-navbar-link :href="route('bills.index')" :active="request()->routeIs('bills.*')">
            Bills
            </x-navbar-link>
          </li>
          {{-- Transaction --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Transactions
            </a>
            <ul class="dropdown-menu border-0 shadow-smooth p-3">
              <li><a wire:navigate class="dropdown-item" href="{{ route('transactions.paid') }}">Paid</a></li>
              <li><a wire:navigate class="dropdown-item" href="{{ route('transactions.waiting') }}">Waiting Confirm</a></li>
              <li><a wire:navigate class="dropdown-item" href="{{ route('transactions.cancel') }}">Cancel</a></li>
            </ul>
          </li>
          {{-- Expense --}}
          <li class="nav-item">
            <x-navbar-link :href="route('expenses.index')" :active="request()->routeIs('expenses.*')">
            Expenses
            </x-navbar-link>
          </li>
          {{-- Reports --}}
          <li class="nav-item">
            <x-navbar-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
            Reports
            </x-navbar-link>
          </li>
          {{-- Management --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Management
            </a>
            <ul class="dropdown-menu border-0 shadow-smooth p-3">
              <li></li>
              <li><a wire:navigate class="dropdown-item" href="{{ route('users.index') }}">Users</a></li>
              <li><a wire:navigate class="dropdown-item" href="{{ route('announcements.index') }}">Announcements</a></li>
              <li><a wire:navigate class="dropdown-item" href="{{ route('payment_accounts.index') }}">Payment Accounts</a></li>
              <li><a wire:navigate class="dropdown-item" href="{{ route('classrooms.index') }}">Classrooms</a></li>
              <li><a wire:navigate class="dropdown-item" href="{{ route('years.index') }}">Years</a></li>
              <li><a wire:navigate class="dropdown-item" href="{{ route('roles.index') }}">Roles</a></li>
              <li><a wire:navigate class="dropdown-item" href="{{ route('permissions.index') }}">Permissions</a></li>
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