<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Admin - Sumbar Fakta</title>

    <link rel="icon" type="image/jpg" href="{{ asset('images/favicon.jpg') }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/vendors/styles/style.css') }}" />

    <style type="text/css">
        /* Kustomisasi Warna Sumbar Fakta */
        .bg-sumbar {
            background-color: #b70000 !important;
        }

        .text-sumbar {
            color: #b70000 !important;
        }

        /* Menyesuaikan Header & Sidebar agar Senada dengan Frontend */
        .header {
            border-bottom: 2px solid #b70000;
        }

        .left-side-bar {
            background: #1a1a1a;
        }

        /* Dark mode sidebar */
        .sidebar-menu .dropdown-toggle.active,
        .sidebar-menu li a.active {
            color: #ffffff;
            background-color: #b70000;
            border-radius: 5px;
        }

        .brand-logo h2 {
            font-weight: 900;
            font-style: italic;
            letter-spacing: -1px;
            margin-top: 15px;
        }

    </style>
</head>
<body>
    {{-- Loader --}}
    @if ($activePage == 'dashboard')
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <h1 class="text-3xl font-black italic">
                    <span style="color: #b70000">SUMBAR</span><span>FAKTA</span>
                </h1>
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1" style="background: #b70000"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Menyiapkan Ruang Redaksi...</div>
        </div>
    </div>
    @endif

    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>
        </div>
        <div class="header-right">
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{ asset('assets-admin/vendors/images/user.png') }}" alt="" />
                        </span>
                        {{-- Null-safe operator untuk Laravel 12 --}}
                        <span class="user-name">{{ auth()->user()?->name ?? 'Admin' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="{{ route('admin.change') }}"><i class="dw dw-password"></i> Ganti Password</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="dw dw-logout"></i> Keluar
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo shadow-sm" style="background: white">
            <a href="{{ url('/') }}" target="_blank">
                <h2 class="text-2xl">
                    <span class="text-sumbar">SUMBAR</span><span style="color: #333">FAKTA</span>
                </h2>
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <a href="{{ route('admin.home') }}" class="dropdown-toggle no-arrow {{ $activePage == 'dashboard' ? 'active' : '' }}">
                            <span class="micon bi bi-speedometer2"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-newspaper"></span><span class="mtext">Manajemen Berita</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('admin.setting.index') }}" class="{{ $activePage == 'setting' ? 'active' : '' }}">Identitas</a></li>
                            <li><a href="{{ route('admin.posts.index') }}" class="{{ $activePage == 'posts' ? 'active' : '' }}">Postingan</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">
            @yield('content')

            <div class="footer-wrap pd-20 mb-20 card-box">
                Sumbar Fakta - Admin Panel © {{ date('Y') }}
                <span class="text-sumbar font-weight-bold ml-2">Cerdas, Tajam, Terpercaya</span>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets-admin/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('assets-admin/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('assets-admin/vendors/scripts/layout-settings.js') }}"></script>
</body>
</html>
