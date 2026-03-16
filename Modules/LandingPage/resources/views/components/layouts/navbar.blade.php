<header id="header" class="header d-flex align-items-center {{ Request::is('/') ? 'fixed-top' : 'sticky-top' }}">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
      <img src="{{ asset('template/landing/assets/img/logo-srkt.png') }}" alt="">
      <h1 class="sitename">SPPELITAAIR</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="/#hero" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="/#about">About</a></li>
        <li><a href="/#regulation">Regulation</a></li>
        <li><a href="/#event">Event</a></li>
        <li><a href="/#contact">Contact</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    {{-- Bagian Kanan Header (Login / Avatar Dropdown) --}}
  @php
    $admin = Auth::guard('web')->user();       // default guard
    $anggota = Auth::guard('anggota')->user(); // guard anggota
@endphp

@if (!$admin && !$anggota)
  {{-- Jika Belum Login --}}
  <a class="btn-getstarted flex-md-shrink-0" href="{{ route('login') }}">Login</a>
@else
  {{-- Jika Sudah Login --}}
  <div class="dropdown ms-3">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
      <div class="avatar avatar-online">
        {{-- Gambar default / sesuai user --}}
        <img src="{{ asset('gallery/ava.jpeg')}}" alt class="w-px-50 h-auto rounded-circle" />
      </div>
    </a>

    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="#">
          <div class="d-flex">
            <div class="flex-shrink-0 me-3">
              <div class="avatar avatar-online">
                <img src="{{ asset('gallery/ava.jpeg')}}" alt class="w-px-50 h-auto rounded-circle" />
              </div>
            </div>
            <div class="flex-grow-1">
              <span class="fw-semibold d-block">{{ $admin ? $admin->name : $anggota->username }}</span>
              <small class="text-muted">{{ $admin ? 'Admin' : 'Anggota' }}</small>
            </div>
          </div>
        </a>
      </li>

      <li><div class="dropdown-divider"></div></li>

      {{-- Menu Dashboard --}}
      <li>
        <a class="dropdown-item" href="{{ $admin ? url('/dashboard-admin') : url('/dashboard') }}">
          <i class="bx bx-user me-2"></i>
          <span class="align-middle">Dashboard</span>
        </a>
      </li>

      <li><div class="dropdown-divider"></div></li>

      {{-- Tombol Logout --}}
      <li>
        <form action="{{ $admin ? route('logout') : route('logout-admin') }}" method="POST">
          @csrf
          <button type="submit" class="dropdown-item">
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle">Log Out</span>
          </button>
        </form>
      </li>
    </ul>
  </div>
@endif


  </div>
</header>
