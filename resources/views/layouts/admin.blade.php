<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Warung Babi Guling') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary:        #d35400;
            --primary-dark:   #a04000;
            --primary-light:  #e8743a;
            --primary-xlight: rgba(211,84,0,0.08);
            --sidebar-bg:     #d35400;
            --sidebar-dark:   #b94900;
            --sidebar-text:   rgba(255,255,255,0.8);
            --sidebar-active: #fff;
            --bg-body:        #f8f9fc;
            --font:           'Nunito', sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font);
            background: var(--bg-body);
            color: #5a5c69;
        }

        #wrapper { display: flex; }

        /* ===== SIDEBAR ===== */
        #sidebar-wrapper {
            width: 14rem;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-dark) 100%);
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: width .25s ease;
            overflow: hidden;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            text-decoration: none;
        }
        .sidebar-brand-icon {
            width: 42px; height: 42px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .sidebar-brand-text { display: flex; flex-direction: column; }
        .sidebar-brand-text .title {
            color: #fff; font-weight: 800; font-size: .95rem;
            line-height: 1.2; letter-spacing: .03em;
        }
        .sidebar-brand-text .subtitle {
            color: rgba(255,255,255,0.65); font-size: .7rem;
            font-weight: 600; text-transform: uppercase; letter-spacing: .08em;
        }

        .sidebar-nav {
            flex: 1; overflow-y: auto; padding: .5rem 0 1rem;
        }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.3); border-radius: 4px; }

        .nav-section-label {
            padding: 1.2rem 1.25rem .4rem;
            font-size: .65rem; font-weight: 800;
            color: rgba(255,255,255,0.45);
            letter-spacing: .12em; text-transform: uppercase;
        }

        .nav-link {
            display: flex; align-items: center; gap: .75rem;
            padding: .75rem 1.25rem;
            color: var(--sidebar-text); font-weight: 600; font-size: .85rem;
            text-decoration: none; transition: all .2s ease;
            border-left: 3px solid transparent;
        }
        .nav-link .nav-icon {
            width: 20px; text-align: center; font-size: .95rem;
            flex-shrink: 0; transition: transform .2s ease;
        }
        .nav-link:hover {
            color: #fff; background: rgba(255,255,255,0.12);
            border-left-color: rgba(255,255,255,0.5);
        }
        .nav-link:hover .nav-icon { transform: translateX(2px); }
        .nav-link.active {
            color: #fff; background: rgba(255,255,255,0.18);
            border-left-color: #fff;
        }

        .sidebar-divider {
            border: none; border-top: 1px solid rgba(255,255,255,0.15);
            margin: .5rem 1rem;
        }

        /* ===== TOPBAR ===== */
        #sidebarToggle {
            background: none; border: none; color: #5a5c69;
            font-size: 1.2rem; padding: .25rem .5rem; cursor: pointer; flex-shrink: 0;
        }

        #page-content-wrapper {
            flex: 1; margin-left: 14rem; min-height: 100vh;
            display: flex; flex-direction: column;
            transition: margin-left .25s ease;
        }

        .topbar {
            height: 4rem; background: #fff;
            border-bottom: 1px solid #e3e6f0;
            display: flex; align-items: center;
            padding: 0 1.5rem; gap: 1rem;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.04);
        }

        /* === WELCOME TEXT === */
        .welcome-text {
            font-size: 20px;
            color: #5a5c69;
            font-weight: 600;
        }
        .welcome-name {
            color: var(--primary);
            font-weight: 800;
        }

        .topbar-divider {
            width: 0; border-right: 1px solid #e3e6f0;
            height: 2rem; margin: 0 .5rem;
        }

        .topbar-actions {
            margin-left: auto; display: flex; align-items: center; gap: .25rem;
        }

        .user-info {
            display: flex; align-items: center; gap: .65rem;
            padding: .25rem .5rem .25rem 1rem;
            border-radius: 2rem; cursor: pointer;
            transition: background .2s; border: none; background: none;
        }
        .user-info:hover { background: #f8f9fc; }
        .user-name {
            font-size: .85rem; font-weight: 700;
            color: var(--primary); white-space: nowrap;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 .5rem 1.5rem rgba(58,59,69,.15);
            border-radius: .75rem; overflow: hidden; padding: .5rem;
        }
        .dropdown-item {
            border-radius: .5rem; font-size: .85rem; font-weight: 600;
            padding: .5rem .9rem; color: #5a5c69;
            display: flex; align-items: center; gap: .6rem;
        }
        .dropdown-item:hover { background: var(--primary-xlight); color: var(--primary); }
        .dropdown-item i { width: 16px; text-align: center; }

        .main-content { flex: 1; padding: 1.75rem; }

        /* ===== TOGGLED ===== */
        body.sb-sidenav-toggled #sidebar-wrapper { width: 0; }
        body.sb-sidenav-toggled #page-content-wrapper { margin-left: 0; }

        @media (max-width: 768px) {
            #sidebar-wrapper { width: 0; }
            #page-content-wrapper { margin-left: 0; }
            body.sb-sidenav-toggled #sidebar-wrapper { width: 14rem; }
            .welcome-text { display: none !important; }
        }
    </style>
</head>
<body>
<div id="wrapper">

    <!-- ========== SIDEBAR ========== -->
    <div id="sidebar-wrapper">
        <a class="sidebar-brand" href="{{ url('/') }}">
            <div class="sidebar-brand-icon">🐷</div>
            <div class="sidebar-brand-text">
                <span class="title">Babi Guling</span>
                <span class="subtitle">Point of Sales</span>
            </div>
        </a>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Dashboard</div>
            <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                <span class="nav-icon"><i class="fas fa-tachometer-alt"></i></span>
                Dashboard
            </a>

            <hr class="sidebar-divider">
            <div class="nav-section-label">Menu Utama</div>

            <a class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}" href="{{ url('/transaksi') }}">
                <span class="nav-icon"><i class="fas fa-shopping-cart"></i></span>
                Transaksi
            </a>

            <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" href="{{ url('/produk') }}">
                <span class="nav-icon"><i class="fas fa-box-open"></i></span>
                Produk
            </a>

            <hr class="sidebar-divider">
            <div class="nav-section-label">Laporan</div>

            <a class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}" href="{{ url('/laporan') }}">
                <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
                Laporan
            </a>
        </nav>
    </div>
    <!-- ========== END SIDEBAR ========== -->

    <!-- ========== PAGE CONTENT ========== -->
    <div id="page-content-wrapper">

        <div class="topbar">
            <button id="sidebarToggle" title="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>

            {{-- Sapaan selamat datang --}}
            @auth
            <div class="welcome-text">
                Selamat Datang, <span class="welcome-name">{{ Auth::user()->name }}</span> 👋
            </div>
            @endauth

            <div class="topbar-actions">
                @guest
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @else
                    <div class="dropdown">
                        <button class="user-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="user-name d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Keluar
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>
        </div>

        <main class="main-content">
            @yield('content')
        </main>

    </div>
    <!-- ========== END PAGE CONTENT ========== -->

</div>


<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function(){

    // otomatis aktif jika tabel punya class datatable
    $('.datatable').DataTable({
        pageLength: 5,
        lengthMenu: [5,10,25,50],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Prev",
                next: "Next"
            }
        }
    });

});
</script>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('sidebarToggle');
        if (toggle) {
            toggle.addEventListener('click', e => {
                e.preventDefault();
                document.body.classList.toggle('sb-sidenav-toggled');
            });
        }
    });
</script>
</body>
</html>