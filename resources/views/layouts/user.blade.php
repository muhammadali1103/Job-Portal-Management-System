<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Jobs Portal') }} - Dashboard</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 13px;
            /* Global Scale Down */
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e8eef5 100%);
            color: #1f2937;
            font-size: 0.9rem;
            /* Approx 11.7px base text */
            line-height: 1.5;
        }

        /* Sidebar - Compact SaaS */
        .sidebar {
            width: 15rem;
            /* ~195px */
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.12);
        }

        .sidebar-brand {
            height: 4rem;
            /* ~52px */
            display: flex;
            align-items: center;
            padding: 0 1.25rem;
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(59, 130, 246, 0.1);
        }

        .sidebar-brand i {
            color: #60a5fa;
            margin-right: 0.6rem;
            font-size: 1.25rem;
        }

        .sidebar-menu {
            padding: 1rem 0.75rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .nav-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin: 1.25rem 0 0.5rem 0.6rem;
            font-weight: 700;
        }

        .nav-label:first-child {
            margin-top: 0;
        }

        .nav-link {
            color: #94a3b8;
            padding: 0.6rem 0.85rem;
            margin-bottom: 0.25rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(3px);
        }

        .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4);
        }

        .nav-link i {
            margin-right: 0.6rem;
            font-size: 1rem;
            width: 18px;
            text-align: center;
        }

        /* Main Wrapper */
        .main-wrapper {
            margin-left: 15rem;
            /* Match sidebar width */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header */
        .top-header {
            height: 4rem;
            /* Match sidebar brand height */
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 900;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }

        .header-left h1 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
            background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: #111827;
            padding: 0.5rem 0.75rem;
            border-radius: 10px;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .user-dropdown .dropdown-toggle:hover {
            background: white;
            border-color: #e5e7eb;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e7eb;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
            text-align: left;
        }

        .user-name {
            font-weight: 700;
            font-size: 0.875rem;
            color: #111827;
        }

        .user-role {
            font-size: 0.75rem;
            color: #6b7280;
            font-weight: 500;
        }

        /* Content Area */
        .content-body {
            padding: 2rem;
            flex-grow: 1;
        }

        /* Cards */
        .card {
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            background: white;
            margin-bottom: 1.5rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: linear-gradient(180deg, #fafbfc 0%, #ffffff 100%);
            border-bottom: 1px solid #f3f4f6;
            padding: 1.25rem 1.5rem;
        }

        .card-header h5,
        .card-header h6 {
            margin: 0;
            font-weight: 700;
            color: #111827;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            font-weight: 600;
            padding: 0.625rem 1.25rem;
            border-radius: 10px;
            font-size: 0.875rem;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .btn-light {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            color: #6b7280;
        }

        .btn-light:hover {
            background: #f3f4f6;
            color: #111827;
        }

        /* Forms - Beautiful Modern Styling */
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.625rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
            transition: all 0.3s ease;
        }

        .form-label:has(+ .form-control:focus),
        .form-label:has(+ .form-select:focus) {
            color: #3b82f6;
            transform: translateX(2px);
        }

        .form-control,
        .form-select {
            border: 2px solid #cbd5e1;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.9375rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            color: #1f2937;
            font-weight: 500;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-control::placeholder {
            color: #9ca3af;
            font-weight: 400;
            transition: all 0.3s ease;
        }

        .form-control:hover,
        .form-select:hover {
            border-color: #94a3b8;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3b82f6;
            box-shadow:
                0 0 0 4px rgba(59, 130, 246, 0.12),
                0 8px 16px rgba(59, 130, 246, 0.15);
            outline: none;
            background: #ffffff;
            transform: translateY(-2px) scale(1.01);
        }

        .form-control:focus::placeholder {
            color: #bfdbfe;
            transform: translateX(4px);
        }

        .form-control-lg {
            padding: 0.875rem 1.125rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        }

        .form-control-lg:focus {
            box-shadow:
                0 0 0 5px rgba(59, 130, 246, 0.15),
                0 10px 20px rgba(59, 130, 246, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Input groups */
        .input-group {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-group:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .input-group:focus-within {
            box-shadow:
                0 0 0 4px rgba(59, 130, 246, 0.12),
                0 8px 16px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }

        .input-group-text {
            border: 2px solid #e5e7eb;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            color: #4b5563;
            font-weight: 700;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .input-group:focus-within .input-group-text {
            border-color: #3b82f6;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
        }

        .input-group .form-control,
        .input-group .form-select {
            border-left: none;
            box-shadow: none;
        }

        .input-group .form-control:hover,
        .input-group .form-select:hover {
            transform: none;
        }

        /* Select styling */
        .form-select {
            background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%233b82f6' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 1rem center !important;
            background-size: 16px 12px !important;
            cursor: pointer;
            padding-right: 2.5rem;
        }

        /* File input */
        .form-control[type="file"] {
            padding: 0.625rem 1rem;
            cursor: pointer;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px dashed #3b82f6;
        }

        .form-control[type="file"]:hover {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #2563eb;
        }

        /* Helper text */
        .form-text {
            color: #6b7280;
            font-size: 0.8125rem;
            margin-top: 0.375rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Validation states */
        .form-control.is-invalid {
            border-color: #ef4444;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }

        .invalid-feedback {
            color: #dc2626;
            font-size: 0.8125rem;
            margin-top: 0.375rem;
        }

        .invalid-feedback::before {
            content: '⚠️ ';
        }

        /* Responsive Design - Mobile First */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #111827;
            cursor: pointer;
        }

        /* Tablet and Below (991px) */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1050;
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 4px 0 24px rgba(0, 0, 0, 0.2);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .top-header {
                padding: 0 1rem;
            }

            .content-body {
                padding: 1.5rem;
            }

            /* Tables responsive */
            .table-responsive {
                font-size: 0.8125rem;
            }

            /* Cards spacing */
            .card {
                margin-bottom: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            /* Buttons responsive */
            .btn-group {
                flex-wrap: wrap;
            }
        }

        /* Mobile (576px and below) */
        @media (max-width: 576px) {
            .user-info {
                display: none;
            }

            .header-left h1 {
                font-size: 1.25rem;
            }

            .content-body {
                padding: 1rem;
            }

            /* Cards */
            .card-header {
                padding: 1rem;
            }

            .card-body {
                padding: 0.875rem;
            }

            /* Forms */
            .form-label {
                font-size: 0.8125rem;
            }

            .form-control,
            .form-select {
                font-size: 0.875rem;
                padding: 0.625rem 0.875rem;
            }

            /* Buttons */
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.8125rem;
            }

            .btn-lg {
                padding: 0.625rem 1.125rem;
                font-size: 0.9375rem;
            }

            /* Tables - Stack on mobile */
            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 0.75rem;
            }

            .table tbody td {
                display: block;
                text-align: left !important;
                padding: 0.5rem 0;
                border-bottom: 1px solid #f3f4f6;
            }

            .table tbody td:last-child {
                border-bottom: none;
            }

            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                display: block;
                margin-bottom: 0.25rem;
                font-size: 0.75rem;
                text-transform: uppercase;
                color: #6b7280;
            }

            /* Modal */
            .modal-dialog {
                margin: 0.5rem;
            }

            .modal-body {
                padding: 1rem;
            }

            /* Stat cards */
            .row.g-4 {
                gap: 1rem !important;
            }

            /* Dropdown menu */
            .dropdown-menu {
                font-size: 0.8125rem;
            }

            /* Hide extra columns on mobile */
            .d-none-mobile {
                display: none !important;
            }
        }

        /* Small tablets (768px) */
        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            /* Button groups stack */
            .d-flex.gap-2 {
                flex-direction: column;
            }

            .d-flex.gap-2>* {
                width: 100%;
            }
        }

        /* Overlay for sidebar on mobile */
        @media (max-width: 991px) {
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
                display: none;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        /* Print styles */
        @media print {

            .sidebar,
            .top-header,
            .btn,
            .dropdown,
            .mobile-toggle {
                display: none !important;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .card {
                break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <i class="bi bi-briefcase-fill"></i>
            <span>Jobs Portal</span>
        </a>

        <div class="sidebar-menu">
            <div class="nav-label">Main</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>

            <div class="nav-label">My Jobs</div>
            <a href="{{ route('user.jobs.index') }}"
                class="nav-link {{ request()->routeIs('user.jobs.*') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i> My Job Posts
            </a>
            <a href="{{ route('user.jobs.create') }}" class="nav-link">
                <i class="bi bi-plus-circle"></i> Post New Job
            </a>

            <div class="nav-label">Account</div>
            <a href="{{ route('profile.edit') }}"
                class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">
                    <i class="bi bi-box-arrow-right"></i> Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Header -->
        <header class="top-header">
            <div class="d-flex align-items-center">
                <button class="mobile-toggle me-3" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <div class="header-left">
                    <h1>@yield('header_title', 'Dashboard')</h1>
                </div>
            </div>

            <div class="header-right">
                <!-- View Site Link -->
                <a href="{{ route('home') }}" class="btn btn-sm btn-light d-none d-sm-inline-flex">
                    <i class="bi bi-house me-1"></i> Browse Jobs
                </a>

                <!-- User Dropdown -->
                <div class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=3b82f6&color=fff"
                            alt="User" class="user-avatar">
                        <div class="user-info">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <span class="user-role">Employer</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2" style="border-radius: 12px;">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                    class="bi bi-person me-2"></i>My Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i
                                        class="bi bi-box-arrow-right me-2"></i>Sign Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content Body -->
        <div class="content-body">
            @if(session('success'))
                <div class="alert alert-dismissible fade show d-flex align-items-center mb-4" role="alert"
                    style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); color: #065f46; border: none; border-radius: 12px;">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-dismissible fade show d-flex align-items-center mb-4" role="alert"
                    style="background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); color: #991b1b; border: none; border-radius: 12px;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('sidebarOverlay').classList.remove('active');
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }
    </script>
</body>

</html>
