<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Admin') — CGPark Console</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800&display=swap" rel="stylesheet">
    <style>
        /* ── CSS Variables ── */
        :root {
            --navy:   #0b2d52;
            --blue:   #1a4f82;
            --accent: #3F46F2;
            --bg:     #f0f4f8;
            --sidebar-w: 260px;
            --topbar-h:  64px;
            --radius: 10px;
            --shadow: 0 2px 12px rgba(11,45,82,.10);
            --transition: .18s ease;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Manrope', sans-serif;
            background: var(--bg);
            color: #1e293b;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: linear-gradient(180deg, var(--navy) 0%, #0d3460 60%, var(--blue) 100%);
            display: flex;
            flex-direction: column;
            z-index: 200;
            transition: transform var(--transition);
            overflow: hidden;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .sidebar-brand .brand-name {
            font-size: 1.35rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.3px;
        }

        .sidebar-brand .brand-sub {
            font-size: .72rem;
            font-weight: 500;
            color: rgba(255,255,255,.45);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.15); border-radius: 4px; }

        .nav-label {
            font-size: .68rem;
            font-weight: 700;
            color: rgba(255,255,255,.35);
            text-transform: uppercase;
            letter-spacing: 1.4px;
            padding: 12px 12px 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,.72);
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            transition: background var(--transition), color var(--transition);
            margin-bottom: 2px;
        }

        .nav-link svg { flex-shrink: 0; opacity: .8; }

        .nav-link:hover {
            background: rgba(255,255,255,.10);
            color: #fff;
        }

        .nav-link:hover svg { opacity: 1; }

        .nav-link.active {
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(63,70,242,.35);
        }

        .nav-link.active svg { opacity: 1; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.10);
            color: rgba(255,255,255,.65);
            font-size: .875rem;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            transition: background var(--transition), color var(--transition);
        }

        .btn-logout:hover {
            background: rgba(239,68,68,.18);
            border-color: rgba(239,68,68,.3);
            color: #fca5a5;
        }

        /* ── Topbar ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 100;
            box-shadow: 0 1px 4px rgba(11,45,82,.06);
            transition: left var(--transition);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            color: #64748b;
            transition: background var(--transition);
        }

        .hamburger:hover { background: var(--bg); }

        .page-title-topbar {
            font-size: 1rem;
            font-weight: 700;
            color: var(--navy);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px 6px 6px;
            background: var(--bg);
            border-radius: 50px;
            font-size: .8rem;
            font-weight: 600;
            color: #475569;
        }

        .user-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--blue));
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: .75rem;
            font-weight: 700;
        }

        /* ── Main Content ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            min-height: 100vh;
            transition: margin-left var(--transition);
        }

        .main-content {
            padding: 28px 32px;
            max-width: 1400px;
        }

        /* ── Alerts ── */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            font-size: .875rem;
            font-weight: 500;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-icon { flex-shrink: 0; margin-top: 1px; }

        /* ── Page Header ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -.3px;
        }

        .page-header p {
            font-size: .875rem;
            color: #64748b;
            margin-top: 3px;
        }

        /* ── Stats Grid ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 20px 22px;
            box-shadow: var(--shadow);
            border: 1px solid #e8edf3;
            transition: transform var(--transition), box-shadow var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(11,45,82,.12);
        }

        .stat-card .stat-label {
            font-size: .75rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--navy);
            margin-top: 6px;
            line-height: 1;
        }

        .stat-card .stat-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 12px;
        }

        .stat-card .stat-info { margin-top: 4px; }

        /* ── Admin Card ── */
        .admin-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid #e8edf3;
            overflow: hidden;
        }

        .admin-card-header {
            padding: 18px 22px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .admin-card-header h2 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--navy);
        }

        .admin-card-body { padding: 22px; }

        .admin-card-footer {
            padding: 14px 22px;
            border-top: 1px solid #f1f5f9;
            font-size: .82rem;
        }

        .admin-card-footer a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        .admin-card-footer a:hover { text-decoration: underline; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: .875rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: 1px solid transparent;
            text-decoration: none;
            transition: background var(--transition), box-shadow var(--transition), transform var(--transition), border-color var(--transition);
            white-space: nowrap;
        }

        .btn:active { transform: scale(.97); }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .btn-primary:hover {
            background: #3238d4;
            border-color: #3238d4;
            box-shadow: 0 4px 14px rgba(63,70,242,.35);
        }

        .btn-danger {
            background: #ef4444;
            color: #fff;
            border-color: #ef4444;
        }

        .btn-danger:hover {
            background: #dc2626;
            border-color: #dc2626;
            box-shadow: 0 4px 14px rgba(239,68,68,.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--navy);
            border-color: #cbd5e1;
        }

        .btn-outline:hover {
            background: var(--bg);
            border-color: #94a3b8;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: .8rem;
            border-radius: 6px;
        }

        /* ── Table ── */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .875rem;
        }

        .admin-table thead th {
            padding: 11px 16px;
            text-align: left;
            font-size: .72rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .8px;
            background: #f8fafc;
            border-bottom: 1px solid #e8edf3;
        }

        .admin-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background var(--transition);
        }

        .admin-table tbody tr:last-child { border-bottom: none; }
        .admin-table tbody tr:hover { background: #f8fafc; }

        .admin-table tbody td {
            padding: 13px 16px;
            color: #334155;
            vertical-align: middle;
        }

        /* ── Forms ── */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 18px;
        }

        .form-grid-full { grid-column: 1 / -1; }

        .form-group { display: flex; flex-direction: column; gap: 6px; }

        .form-label {
            font-size: .8rem;
            font-weight: 600;
            color: #475569;
        }

        .form-label .required { color: #ef4444; margin-left: 2px; }

        .form-control {
            padding: 9px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: .875rem;
            font-family: inherit;
            color: #1e293b;
            background: #fff;
            transition: border-color var(--transition), box-shadow var(--transition);
            outline: none;
            width: 100%;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(63,70,242,.12);
        }

        .form-control::placeholder { color: #94a3b8; }

        textarea.form-control { resize: vertical; min-height: 100px; }

        select.form-control { cursor: pointer; }

        .form-error {
            font-size: .78rem;
            color: #ef4444;
            font-weight: 500;
        }

        .form-control.is-invalid { border-color: #ef4444; }
        .form-control.is-invalid:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.12); }

        /* ── Badges ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 50px;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .3px;
        }

        .badge-success  { background: #dcfce7; color: #166534; }
        .badge-warning  { background: #fef9c3; color: #854d0e; }
        .badge-danger   { background: #fee2e2; color: #991b1b; }
        .badge-gray     { background: #f1f5f9; color: #475569; }
        .badge-blue     { background: #dbeafe; color: #1e40af; }

        /* ── Filter / Search Bar ── */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .filter-bar .search-wrap {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .filter-bar .search-wrap svg {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .filter-bar .search-input {
            padding-left: 36px;
        }

        /* ── Pagination ── */
        .pagination {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 16px 22px;
            border-top: 1px solid #f1f5f9;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 34px;
            padding: 0 8px;
            border-radius: 7px;
            font-size: .8rem;
            font-weight: 600;
            text-decoration: none;
            transition: background var(--transition), color var(--transition);
            color: #475569;
        }

        .pagination a:hover { background: var(--bg); color: var(--navy); }

        .pagination .active,
        .pagination [aria-current="page"] span {
            background: var(--accent);
            color: #fff;
        }

        .pagination .disabled span,
        .pagination [aria-disabled="true"] span {
            color: #cbd5e1;
            cursor: default;
        }

        /* ── Empty State ── */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 24px;
            text-align: center;
            color: #94a3b8;
        }

        .empty-state svg { margin-bottom: 16px; opacity: .5; }

        .empty-state h3 {
            font-size: 1rem;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 6px;
        }

        .empty-state p { font-size: .875rem; }

        /* ── Overlay (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(11,45,82,.45);
            z-index: 150;
            backdrop-filter: blur(2px);
        }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(calc(-1 * var(--sidebar-w)));
            }

            .sidebar.open {
                transform: translateX(0);
                box-shadow: 4px 0 30px rgba(11,45,82,.25);
            }

            .sidebar-overlay.open { display: block; }

            .topbar { left: 0; }

            .main-wrapper { margin-left: 0; }

            .hamburger { display: flex; }

            .main-content { padding: 20px 16px; }
        }

        @media (max-width: 600px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar Overlay (mobile) --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- Sidebar --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-name">CGPark</div>
        <div class="brand-sub">Console Admin</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Navigation</div>

        <a href="{{ route('console.dashboard') }}"
           class="nav-link {{ request()->routeIs('console.dashboard') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('console.parkings.index') }}"
           class="nav-link {{ request()->routeIs('console.parkings.*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <path d="M9 17V7h4a3 3 0 0 1 0 6H9"/>
            </svg>
            Parkings
        </a>

        <a href="{{ route('console.appels-offres.index') }}"
           class="nav-link {{ request()->routeIs('console.appels-offres.*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
            </svg>
            Appels offres
        </a>

        <div class="nav-label" style="margin-top:12px;">Site</div>

        <a href="{{ route('home') }}" target="_blank"
           class="nav-link">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="2" y1="12" x2="22" y2="12"/>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            Voir le site
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('console.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

{{-- Topbar --}}
<header class="topbar">
    <div class="topbar-left">
        <button class="hamburger" id="hamburgerBtn" aria-label="Toggle menu">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
        <span class="page-title-topbar">@yield('page_title', 'Dashboard')</span>
    </div>
    <div class="topbar-right">
        @if(session('admin_email'))
        <div class="user-chip">
            <div class="user-avatar">
                {{ strtoupper(substr(session('admin_email'), 0, 1)) }}
            </div>
            {{ session('admin_email') }}
        </div>
        @endif
    </div>
</header>

{{-- Main --}}
<div class="main-wrapper">
    <main class="main-content">

        {{-- Success Alert --}}
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            <svg class="alert-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        {{-- Error Alert --}}
        @if($errors->any())
        <div class="alert alert-error" role="alert">
            <svg class="alert-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <div>
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul style="margin-top:6px;padding-left:16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        @yield('content')
    </main>
</div>

<script>
    (function () {
        const sidebar  = document.getElementById('sidebar');
        const overlay  = document.getElementById('sidebarOverlay');
        const hamburger = document.getElementById('hamburgerBtn');

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        }

        hamburger.addEventListener('click', function () {
            sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
        });

        overlay.addEventListener('click', closeSidebar);

        // Auto-dismiss alerts after 5 s
        document.querySelectorAll('.alert').forEach(function (el) {
            setTimeout(function () {
                el.style.transition = 'opacity .4s ease';
                el.style.opacity = '0';
                setTimeout(function () { el.remove(); }, 420);
            }, 5000);
        });
    })();
</script>

@stack('scripts')
</body>
</html>
