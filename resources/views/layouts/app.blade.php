<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SIMPEG') - Manajemen Pegawai</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fa;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: #172554;
            color: white;
            padding: 25px 18px;
            display: flex;
            flex-direction: column;
            z-index: 1050;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            font-size: 22px;
            font-weight: 700;
            padding: 0 12px;
            margin-bottom: 5px;
        }

        .sidebar-subtitle {
            font-size: 11px;
            color: #cbd5e1;
            padding: 0 12px;
            margin-bottom: 30px;
        }

        .sidebar-label {
            font-size: 11px;
            color: #94a3b8;
            padding: 0 12px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-menu a {
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: 0.2s;
        }

        .sidebar-menu a:hover {
            background: #263b6b;
            color: white;
        }

        .sidebar-menu a.active {
            background: #2563eb;
            color: white;
        }

        .sidebar-menu i {
            font-size: 18px;
        }

        .sidebar-bottom {
            margin-top: auto;
            border-top: 1px solid #334155;
            padding-top: 18px;
        }

        .user-info {
            display: block;
            padding: 10px 12px;
            margin-bottom: 10px;
            border-radius: 8px;
            transition: background 0.2s;
            cursor: pointer;
        }

        .user-info:hover {
            background: #263b6b;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: white;
        }

        .user-role {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 3px;
        }

        .user-info:hover .user-role {
            color: #bfdbfe;
        }

        .profile-arrow {
            color: #94a3b8;
            font-size: 14px;
            transition: transform 0.2s, color 0.2s;
        }

        .user-info:hover .profile-arrow {
            color: white;
            transform: translateX(3px);
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .user-role {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 3px;
        }

        .logout-button {
            width: 100%;
            border: none;
            background: transparent;
            color: #fca5a5;
            text-align: left;
            padding: 12px;
            border-radius: 8px;
        }

        .logout-button:hover {
            background: #7f1d1d;
            color: white;
        }

        /* Konten utama desktop */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 35px;
            transition: margin-left 0.3s ease;
        }

        /* Navbar mobile */
        .mobile-navbar {
            display: none;
        }

        /* Overlay sidebar */
        .sidebar-overlay {
            display: none;
        }

        /* Tampilan mobile */
        @media (max-width: 768px) {

            .sidebar {
                transform: translateX(-100%);
                width: 260px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px 15px;
                padding-top: 85px;
            }

            .mobile-navbar {
                display: flex;
                align-items: center;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 65px;
                background: white;
                padding: 0 18px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
                z-index: 1040;
            }

            .mobile-brand {
                font-size: 19px;
                font-weight: 700;
                color: #172554;
                margin-left: 12px;
            }

            .hamburger-button {
                border: none;
                background: transparent;
                font-size: 25px;
                color: #172554;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .45);
                z-index: 1045;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Navbar Mobile -->
    <nav class="mobile-navbar">
        <button type="button" class="hamburger-button" id="sidebarToggle" aria-label="Buka menu navigasi"
            aria-controls="sidebar" aria-expanded="false">
            <i class="bi bi-list"></i>
        </button>

        <div class="mobile-brand">
            <i class="bi bi-buildings me-1"></i>
            SIMPEG
        </div>
    </nav>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <i class="bi bi-buildings me-2"></i> SIMPEG
        </div>

        <div class="sidebar-subtitle">
            Sistem Informasi Manajemen Pegawai
        </div>

        <div class="sidebar-label">Menu Utama</div>

        <nav class="sidebar-menu">

            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                Dashboard
            </a>

            <a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                Manajemen Pegawai
            </a>

            @if (auth()->user()->role === 'superadmin')
                <a href="{{ route('superadmin.admins.index') }}"
                    class="{{ request()->routeIs('superadmin.admins.*') ? 'active' : '' }}">
                    <i class="bi bi-person-gear"></i>
                    Manajemen Admin
                </a>
            @endif
        </nav>

        <!-- Bagian Bawah Sidebar -->
        <div class="sidebar-bottom">

            <a href="{{ route('profile.index') }}"
                class="user-info text-decoration-none d-flex align-items-center justify-content-between">

                <div>
                    <div class="user-name">
                        <i class="bi bi-person-circle me-2"></i>
                        {{ auth()->user()->name }}
                    </div>

                    <div class="user-role">
                        {{ ucfirst(auth()->user()->role) }}
                    </div>
                </div>

                <i class="bi bi-chevron-right profile-arrow"></i>

            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-left me-2"></i>
                    Logout
                </button>
            </form>

        </div>

    </aside>

    <!-- Konten Utama -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.add('show');
            sidebarOverlay.classList.add('show');
            sidebarToggle.setAttribute('aria-expanded', 'true');
            sidebarToggle.innerHTML = '<i class="bi bi-x-lg"></i>';
        }

        function closeSidebar() {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
            sidebarToggle.setAttribute('aria-expanded', 'false');
            sidebarToggle.innerHTML = '<i class="bi bi-list"></i>';
        }

        sidebarToggle.addEventListener('click', function() {
            if (sidebar.classList.contains('show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        sidebarOverlay.addEventListener('click', closeSidebar);

        // Tutup sidebar setelah memilih menu di mobile
        sidebar.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    closeSidebar();
                }
            });
        });

        // Tutup sidebar ketika kembali ke ukuran desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });
    </script>

    @stack('scripts')

</body>

</html>
