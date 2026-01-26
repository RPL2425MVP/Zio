@php
    $isLoginPage = request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('adminMode') ;
@endphp
@if ($isLoginPage)
    {{-- Hanya tampilkan logo di tengah --}}
    <nav class="navbar navbar-light bg-light fixed-top" style="height: 75px;" id="mainNavbar">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto" href="/index" style="position: static; transform: none;">FaZhion</a>
        </div>
    </nav>
@else
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNavbar">
  <div class="container-fluid">
    <!-- Menu Kiri -->
    <div class="collapse navbar-collapse ps-3" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/index">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/product">Product</a></li>
      </ul>
    </div>

    <!-- Logo Tengah -->
    <a class="navbar-brand" href="#">FaZhion</a>

    <!-- Ikon Kanan -->
    <div class="d-flex align-items-center ms-auto pe-3">
      <!-- Search bar dengan ikon di dalam -->
      <div class="search-wrapper me-3 d-none d-lg-block my-auto">
        <form action="{{ route('produkList.show') }}" method="GET" class="d-flex">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2" 
                placeholder="Cari produk..."
                value="{{ request()->is('product') ? request('search') : '' }}"
                aria-label="Search" style="width:200px;"
            >
            <button class="btn" type="submit" style="position:relative; margin-left:-30px;">
              <i class='bx bx-search text-dark'></i>
            </button>
        </form>
      </div>
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a href="{{ route('keranjang.index') }}" class="nav-link text-dark">
            <i class='bx bx-cart'></i>
          </a>
        </li>
        <li class="nav-item">     
          <a href="{{ route('user.profile') }}" class="nav-link text-dark">
            <i class='bx bx-user'></i>
          </a>
        </li>
      </ul>
      <form action="{{ route('logout') }}" method="POST">
          @csrf
        <button type="submit" class="btn">Logout</button>
      </form>
      <!-- Toggler mobile -->
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</nav>
@endif