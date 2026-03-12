<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Warung Babi Guling') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --orange: #d35400;
            --orange-light: #e8680a;
            --orange-pale: #fff3ec;
            --dark: #1a1008;
            --dark-2: #2d1a06;
            --dark-3: #3d2310;
            --sidebar-width: 15rem;
            --topbar-height: 64px;
            /* --font-body: 'DM Sans', sans-serif;
            --font-display: font-family: var(--font-body);
            font-display: var(--font-body); */
            --font-body: 'Inter', sans-serif;
            --font-display: 'Inter', sans-serif;
            --text: #3d2b1a;
            --text-light: #8c7060;
            --bg: #f7f3ef;
            --white: #ffffff;
            --border: rgba(211, 84, 0, 0.12);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-style: normal !important;
        }

        body {
            font-family: var(--font-body);
            font-display: var(--font-body);
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
        }

        /* ══════════════════════════════
           SIDEBAR
        ══════════════════════════════ */
        #sidebar-wrapper {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--dark);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: width .25s ease;
            overflow: hidden;
            border-right: 1px solid rgba(211, 84, 0, 0.15);
        }

        /* Subtle glow at top */
        #sidebar-wrapper::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(211, 84, 0, 0.2) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── Brand ── */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: .85rem;
            padding: 1.4rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            text-decoration: none;
            position: relative;
            z-index: 1;
        }

        .sidebar-brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
            box-shadow: 0 6px 18px rgba(211, 84, 0, 0.4);
        }

        .sidebar-brand-icon img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .sidebar-brand-text .title {
            font-family: var(--font-display);
            color: #fff;
            font-weight: 700;
            font-size: .95rem;
            line-height: 1.25;
        }

        .sidebar-brand-text .title span {
            color: var(--orange);
        }

        .sidebar-brand-text .subtitle {
            color: rgba(255, 255, 255, 0.35);
            font-size: .68rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .1em;
            margin-top: 2px;
            display: block;
        }

        /* ── Nav ── */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: .75rem 0 1rem;
            position: relative;
            z-index: 1;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 3px;
        }

        .nav-section-label {
            padding: 1.1rem 1.25rem .35rem;
            font-size: .62rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.3);
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .7rem 1.25rem;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 500;
            font-size: .875rem;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all .2s;
            position: relative;
        }

        .nav-link i {
            width: 18px;
            text-align: center;
            font-size: .85rem;
            color: rgba(255, 255, 255, 0.35);
            transition: color .2s;
            flex-shrink: 0;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.07);
            border-left-color: rgba(211, 84, 0, 0.5);
        }

        .nav-link:hover i {
            color: var(--orange);
        }

        .nav-link.active {
            color: #fff;
            background: rgba(211, 84, 0, 0.15);
            border-left-color: var(--orange);
            font-weight: 600;
        }

        .nav-link.active i {
            color: var(--orange);
        }

        .collapse .nav-link {
            padding-left: 2.8rem;
            font-size: .835rem;
            color: rgba(255, 255, 255, 0.5);
            border-left: 3px solid transparent;
        }

        .collapse .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.06);
            border-left-color: rgba(211, 84, 0, 0.4);
        }

        .collapse .nav-link.active {
            color: #fff;
            background: rgba(211, 84, 0, 0.12);
            border-left-color: var(--orange);
        }

        .sidebar-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            margin: .5rem 1rem;
        }

        .nav-link.collapsed {
            justify-content: space-between;
            cursor: pointer;
        }

        .nav-link.collapsed .chevron {
            font-size: .6rem;
            color: rgba(255, 255, 255, 0.3);
            transition: transform .3s;
        }

        .nav-link.collapsed[aria-expanded="true"] .chevron {
            transform: rotate(180deg);
            color: var(--orange);
        }

        /* ── Sidebar footer ── */
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            font-size: .72rem;
            color: rgba(255, 255, 255, 0.2);
            text-align: center;
            letter-spacing: .04em;
            position: relative;
            z-index: 1;
        }

        /* ══════════════════════════════
           PAGE CONTENT
        ══════════════════════════════ */
        #page-content-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left .25s ease;
        }

        /* ── Topbar ── */
        .topbar {
            height: var(--topbar-height);
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 1.5rem 0 1rem;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(211, 84, 0, 0.06);
        }

        #sidebarToggle {
            background: none;
            border: none;
            color: var(--text-light);
            font-size: 1.1rem;
            padding: .4rem .6rem;
            cursor: pointer;
            border-radius: 8px;
            transition: all .2s;
            flex-shrink: 0;
        }

        #sidebarToggle:hover {
            background: var(--orange-pale);
            color: var(--orange);
        }

        .topbar-divider {
            width: 1px;
            height: 28px;
            background: var(--border);
        }

        .welcome-text {
            font-size: .95rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .welcome-name {
            font-family: var(--font-display);
            color: var(--orange);
            font-weight: 700;
            font-style: italic;
        }

        .topbar-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        /* User dropdown */
        .user-btn {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .4rem .75rem .4rem .5rem;
            border-radius: 40px;
            cursor: pointer;
            background: none;
            border: 1.5px solid var(--border);
            transition: all .2s;
        }

        .user-btn:hover {
            border-color: var(--orange);
            background: var(--orange-pale);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--orange), #f39c12);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: .85rem;
            flex-shrink: 0;
        }

        .user-name {
            font-size: .85rem;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
        }

        .user-btn .fa-chevron-down {
            font-size: .6rem;
            color: var(--text-light);
            transition: transform .2s;
        }

        .user-btn[aria-expanded="true"] .fa-chevron-down {
            transform: rotate(180deg);
        }

        /* Dropdown menu */
        .dropdown-menu {
            border: 1px solid var(--border) !important;
            box-shadow: 0 8px 30px rgba(211, 84, 0, 0.12) !important;
            border-radius: 14px !important;
            overflow: hidden;
            padding: .5rem !important;
            min-width: 160px;
        }

        .dropdown-item {
            border-radius: 8px;
            font-size: .85rem;
            font-weight: 500;
            padding: .55rem .9rem;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: .6rem;
            transition: all .2s;
        }

        .dropdown-item:hover {
            background: var(--orange-pale);
            color: var(--orange);
        }

        .dropdown-item.text-danger {
            color: #e74c3c !important;
        }

        .dropdown-item.text-danger:hover {
            background: rgba(231, 76, 60, 0.08);
            color: #c0392b !important;
        }

        /* ── Main content ── */
        .main-content {
            flex: 1;
            padding: 1.75rem 2rem;
        }

        /* ── Page header helper ── */
        .page-header {
            margin-bottom: 1.75rem;
        }

        .page-header-eyebrow {
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-header-eyebrow::before {
            content: '';
            width: 20px;
            height: 2px;
            background: var(--orange);
            border-radius: 2px;
        }

        .page-title {
            font-family: var(--font-display);
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.2;
        }

        /* ── Cards ── */
        .card {
            border: 1px solid var(--border) !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 20px rgba(211, 84, 0, 0.06) !important;
            overflow: hidden;
        }

        .card-header {
            background: var(--white) !important;
            border-bottom: 1px solid var(--border) !important;
            padding: 1rem 1.25rem !important;
            font-weight: 700;
            color: var(--dark);
            font-size: .9rem;
        }

        /* ── Stat cards ── */
        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.4rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform .25s, box-shadow .25s;
            box-shadow: 0 2px 12px rgba(211, 84, 0, 0.05);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(211, 84, 0, 0.1);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--orange-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--orange);
            flex-shrink: 0;
        }

        .stat-icon.dark {
            background: var(--dark);
            color: var(--orange);
        }

        .stat-label {
            font-size: .75rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 4px;
        }

        .stat-value {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
        }

        /* ── Buttons ── */
        .btn-orange {
            background: var(--orange);
            color: white;
            border: none;
            padding: 9px 22px;
            border-radius: 30px;
            font-size: .875rem;
            font-weight: 600;
            font-family: var(--font-body);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            transition: all .25s;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(211, 84, 0, 0.3);
        }

        .btn-orange:hover {
            background: var(--orange-light);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(211, 84, 0, 0.4);
            color: white;
        }

        .btn-dark-outline {
            background: transparent;
            color: var(--dark);
            border: 1.5px solid rgba(61, 43, 26, 0.2);
            padding: 8px 20px;
            border-radius: 30px;
            font-size: .875rem;
            font-weight: 600;
            font-family: var(--font-body);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            transition: all .25s;
            text-decoration: none;
        }

        .btn-dark-outline:hover {
            border-color: var(--orange);
            color: var(--orange);
            background: var(--orange-pale);
        }

        /* ── Tables ── */
        .table {
            font-size: .875rem;
            color: var(--text);
        }

        .table thead th {
            background: var(--bg) !important;
            color: var(--text-light);
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            border-bottom: 2px solid var(--border) !important;
            padding: .9rem 1rem;
        }

        .table tbody td {
            padding: .85rem 1rem;
            border-color: rgba(211, 84, 0, 0.06) !important;
            vertical-align: middle;
        }

        .table tbody tr:hover td {
            background: var(--orange-pale);
        }

        /* ── Badges ── */
        .badge-orange {
            background: rgba(211, 84, 0, 0.12);
            color: var(--orange);
            font-size: .72rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: .04em;
        }

        .badge-dark {
            background: rgba(26, 16, 8, 0.08);
            color: var(--dark);
            font-size: .72rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
        }

        /* ── Toggle ── */
        body.sb-sidenav-toggled #sidebar-wrapper {
            width: 0;
        }

        body.sb-sidenav-toggled #page-content-wrapper {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            #sidebar-wrapper {
                width: 0;
            }

            #page-content-wrapper {
                margin-left: 0;
            }

            body.sb-sidenav-toggled #sidebar-wrapper {
                width: var(--sidebar-width);
            }

            .welcome-text {
                display: none !important;
            }

            .main-content {
                padding: 1.25rem;
            }
        }

        /* ── DataTables override ── */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px 12px;
            font-family: var(--font-body);
            font-size: .85rem;
            outline: none;
            transition: border-color .2s;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(211, 84, 0, 0.1);
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 5px 10px;
            font-family: var(--font-body);
            font-size: .85rem;
        }

        .page-item.active .page-link {
            background: var(--orange) !important;
            border-color: var(--orange) !important;
        }

        .page-link {
            color: var(--orange) !important;
            border-color: var(--border) !important;
            border-radius: 8px !important;
            margin: 0 2px;
        }

        .page-link:hover {
            background: var(--orange-pale) !important;
        }
    </style>
</head>

<body>
    <div id="wrapper">

        <!-- ══════ SIDEBAR ══════ -->
        <div id="sidebar-wrapper">
            <a class="sidebar-brand" href="{{ url('/') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('image/logo_sari_nadi_transparent.png') }}" alt="Logo">
                </div>
                <div class="sidebar-brand-text">
                    <span class="title">Sari <span>Nadi</span></span>
                    <span class="subtitle">Point of Sales</span>
                </div>
            </a>

            <nav class="sidebar-nav">
                <div class="nav-section-label">Dashboard</div>
                <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                    <i class="fas fa-gauge-high"></i> Dashboard
                </a>

                <hr class="sidebar-divider">
                <div class="nav-section-label">Menu Utama</div>

                <a class="nav-link {{ request()->is('transaksi') || request()->is('transaksi/buat*') ? 'active' : '' }}"
                    href="{{ url('/transaksi') }}">
                    <i class="fas fa-cash-register"></i> Transaksi
                </a>

                <a class="nav-link {{ request()->is('transaksi/riwayat*') ? 'active' : '' }}"
                    href="{{ url('/transaksi/riwayat') }}">
                    <i class="fas fa-clock-rotate-left"></i> Riwayat Transaksi
                </a>

                <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" href="{{ url('/produk') }}">
                    <i class="fas fa-bowl-food"></i> Produk
                </a>

                <hr class="sidebar-divider">
                <div class="nav-section-label">Laporan</div>

                @php $laporanActive = request()->is('laporan*'); @endphp
                <a class="nav-link collapsed {{ $laporanActive ? '' : '' }}" href="#laporanDropdown"
                    data-bs-toggle="collapse" aria-expanded="{{ $laporanActive ? 'true' : 'false' }}">
                    <i class="fas fa-chart-line"></i>
                    Laporan
                    <i class="fas fa-chevron-down chevron ms-auto"></i>
                </a>

                <div class="collapse {{ $laporanActive ? 'show' : '' }}" id="laporanDropdown">
                    <a class="nav-link {{ request()->is('laporan/penjualan*') ? 'active' : '' }}"
                        href="{{ url('/laporan/penjualan') }}">
                        Penjualan
                    </a>
                    <a class="nav-link {{ request()->is('laporan/produk-terlaris*') ? 'active' : '' }}"
                        href="{{ url('/laporan/produk-terlaris') }}">
                        Produk Terlaris
                    </a>
                    <a class="nav-link {{ request()->is('laporan/metode-pembayaran*') ? 'active' : '' }}"
                        href="{{ url('/laporan/metode-pembayaran') }}">
                        Metode Pembayaran
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                &copy; {{ date('Y') }} Sari Nadi
            </div>
        </div>

        <!-- ══════ PAGE CONTENT ══════ -->
        <div id="page-content-wrapper">

            <!-- Topbar -->
            <div class="topbar">
                <button id="sidebarToggle" title="Toggle Menu">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="topbar-divider"></div>

                @auth
                    <div class="welcome-text">
                        Selamat Datang, <span class="welcome-name">{{ Auth::user()->name }}</span> 👋
                    </div>
                @endauth

                <div class="topbar-actions">
                    @guest
                        <a href="{{ route('login') }}" class="btn-orange" style="padding: 7px 18px; font-size: .82rem;">
                            <i class="fas fa-right-to-bracket"></i> Login
                        </a>
                    @else
                        <div class="dropdown">
                            <button class="user-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="user-name d-none d-md-inline">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-right-from-bracket"></i> Keluar
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

            <!-- Main -->
            <main class="main-content">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
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

    @stack('scripts')
</body>

</html>
