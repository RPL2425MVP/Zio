<!-- Left Sidebar -->
<nav class="sidebar-left bg-white border-end" id="adminSidebar">
    <div class="p-3 border-bottom">
        <h5 class="mb-0">Admin Panel</h5>
    </div>
    <div class="p-3 sidebar-content">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pages.admin.dashboard') ? 'active text-primary fw-bold' : 'text-dark' }}" 
                   href="/admin/dashboard">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pages.admin.tableProduk') ? 'active text-primary fw-bold' : 'text-dark' }}" 
                   href="/admin/tbProduk">
                    <i class="fas fa-box me-2"></i> Produk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.keranjang')}}">
                    <i class="fas fa-shopping-cart me-2"></i> Keranjang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.account_user')}}">
                    <i class="fas fa-users me-2"></i> Pelanggan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('admin.pesanan')}}">
                    <i class="fas fa-cog me-2"></i> Pesanan
                </a>
            </li>
            <li class="nav-item mt-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>     
            </li>
        </ul>
    </div>
    <div class="d-md-none mb-3">
    <button class="btn btn-primary" onclick="document.getElementById('adminSidebar').classList.toggle('d-block')">
        ☰ Menu
    </button>
</div>
</nav>

<style>
.sidebar-left {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 260px;
    z-index: 1030;
    box-shadow: 2px 0 5px rgba(0,0,0,0.05);
    overflow-y: auto;
}
.sidebar-content {
    height: calc(100vh - 60px);
    overflow-y: auto;
}
.nav-link {
    border-radius: 6px;
    margin-bottom: 4px;
}
.nav-link:hover {
    background-color: #f8f9fa;
}
.nav-link.active {
    background-color: #e7f1ff;
    color: #0d6efd !important;
}
/* Konten utama geser ke kanan agar tidak tertutup sidebar */
.main-content {
    margin-left: 260px;
}
/* Mobile: sembunyikan sidebar & reset margin */
@media (max-width: 767px) {
    .sidebar-left {
        display: none;
        position: absolute !important;
        width: 240px;
        height: 100vh;
        z-index: 1050;
    }
    .sidebar-left.d-block {
        display: block !important;
    }
}

</style>