<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Si-Warga</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body { background-color: #f5f7fb; overflow-x: hidden; }
        #sidebar-wrapper { min-height: 100vh; width: 260px; margin-left: -260px; background: #fff; border-right: 1px solid #e1e5e8; transition: all 0.25s; position: fixed; z-index: 1000; }
        .sidebar-heading { padding: 1.5rem 1.25rem; font-size: 1.5rem; font-weight: 800; color: #0d6efd; border-bottom: 1px solid #f0f0f0; }
        .list-group-item { border: none; padding: 0.9rem 1.5rem; font-weight: 600; color: #6c757d; }
        .list-group-item.active { background-color: #e7f1ff; color: #0d6efd; border-right: 4px solid #0d6efd; }
        #page-content-wrapper { width: 100%; transition: all 0.25s; }
        
        @media (min-width: 768px) {
            #sidebar-wrapper { margin-left: 0; }
            #page-content-wrapper { margin-left: 260px; }
            body.sb-sidenav-toggled #sidebar-wrapper { margin-left: -260px; }
            body.sb-sidenav-toggled #page-content-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>
    @guest
        <main>
            @yield('content')
        </main>
    @else
        <div class="d-flex" id="wrapper">
            <div id="sidebar-wrapper">
                <div class="sidebar-heading text-center"><i class="bi bi-people-fill me-2"></i>Si-Warga</div>
                <div class="list-group list-group-flush mt-3">
                    <a href="{{ route('home') }}" class="list-group-item list-group-item-action {{ request()->is('home') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    <a href="{{ route('wargas.index') }}" class="list-group-item list-group-item-action {{ request()->is('wargas*') ? 'active' : '' }}"><i class="bi bi-person-lines-fill"></i> Data Warga</a>
                    <a href="{{ route('kategoris.index') }}" class="list-group-item list-group-item-action {{ request()->is('kategoris*') ? 'active' : '' }}"><i class="bi bi-tags"></i> Kategori Iuran</a>
                    <a href="{{ route('transaksis.index') }}" class="list-group-item list-group-item-action {{ request()->is('transaksis*') ? 'active' : '' }}"><i class="bi bi-wallet2"></i> Transaksi</a>
                    <a href="{{ route('laporan.index') }}" class="list-group-item list-group-item-action {{ request()->is('laporan*') ? 'active' : '' }}"><i class="bi bi-file-earmark-bar-graph"></i> Laporan</a>
                    <a href="{{ route('pengeluarans.index') }}" class="list-group-item list-group-item-action {{ request()->is('pengeluarans*') ? 'active' : '' }}">
                        <i class="bi bi-cart-dash"></i> Pengeluaran Kas
                    </a>
                    <a class="list-group-item list-group-item-action text-danger mt-5" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>

            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-3">
                    <div class="container-fluid">
                        <button class="btn btn-outline-primary btn-sm" id="sidebarToggle"><i class="bi bi-list fs-5"></i></button>
                        <span class="ms-3 fw-bold">{{ Auth::user()->name }}</span>
                    </div>
                </nav>
                <main class="p-4">
                    @yield('content')
                </main>
            </div>
        </div>
    @endguest

    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                });
            }
        });
    </script>
</body>
</html>