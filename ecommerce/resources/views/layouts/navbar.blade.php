@php
    $isLoginPage = request()->routeIs('login') || request()->routeIs('register');
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
        <li class="nav-item"><a class="nav-link" href="/index">Men</a></li>
        <li class="nav-item"><a class="nav-link" href="/about">Women</a></li>
        <li class="nav-item"><a class="nav-link" href="/product">Product</a></li>
        <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
      </ul>
    </div>

    <!-- Logo Tengah -->
    <a class="navbar-brand" href="#">FaZhion</a>

    <!-- Ikon Kanan -->
    <div class="d-flex align-items-center ms-auto pe-3">
      <!-- Search bar dengan ikon di dalam -->
      <div class="search-wrapper me-3 d-none d-lg-block my-auto">
        <input type="search" placeholder="Search..." aria-label="Search" style="width:200px;">
        <i class='bx bx-search text-dark'></i>
      </div>
      <a href="{{ route('keranjang.index') }}" class="position-relative text-dark">
        <i class='bx bx-cart'></i>
      </a>  
      <a class="nav-link d-none d-lg-block text-dark" href="/profile"><i class='bx bx-user'></i></a>
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