<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Jobs Portal') }} - Admin Panel</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&display=swap" rel="stylesheet">

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
            font-size: 12px;
            /* 75% Zoom equivalent */
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e8eef5 100%);
            color: #1f2937;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Sidebar - Modern SaaS */
        .sidebar {
            width: 16.25rem;
            /* ~195px at 12px root */
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
            height: 4.375rem;
            /* ~52px */
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0 1.5rem;
            padding: 0 1.5rem;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            font-size: 1.25rem;
            color: #fff;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(59, 130, 246, 0.1);
        }

        .sidebar-brand i {
            color: #60a5fa;
            margin-right: 0.75rem;
            font-size: 1.5rem;
        }

        .sidebar-brand .brand-mark {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
        }

        .sidebar-menu {
            padding: 1.5rem 1rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .nav-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            margin: 1.5rem 0 0.75rem 0.75rem;
            font-weight: 700;
        }

        .nav-label:first-child {
            margin-top: 0;
        }

        .nav-link {
            color: #94a3b8;
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9375rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(4px);
        }

        .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.125rem;
            width: 20px;
            text-align: center;
        }

        /* Main Wrapper */
        .main-wrapper {
            margin-left: 16.25rem;
            /* Matches sidebar */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header - SaaS Style */
        .top-header {
            height: 4.375rem;
            /* Matches sidebar brand height */
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 900;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
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

        /* Search Bar - Enhanced */
        .search-box {
            position: relative;
        }

        .search-box input {
            width: 300px;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.875rem;
            transition: all 0.2s;
            background: white;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        /* Notification Icon */
        .notification-icon {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid #e5e7eb;
        }

        .notification-icon:hover {
            background: #f9fafb;
            color: #3b82f6;
            border-color: #3b82f6;
        }

        .notification-icon .badge {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid white;
        }

        /* User Dropdown */
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

        /* Cards - Modern SaaS */
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

        /* Buttons - SaaS Style */
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

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
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

        .btn-outline-primary {
            background: transparent;
            border: 1.5px solid #3b82f6;
            color: #3b82f6;
        }

        .btn-outline-primary:hover {
            background: #3b82f6;
            color: white;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .btn-outline-secondary {
            background: transparent;
            border: 1.5px solid #d1d5db;
            color: #6b7280;
        }

        .btn-outline-secondary:hover {
            background: #f3f4f6;
            color: #111827;
            border-color: #3b82f6;
        }

        .btn-outline-danger {
            background: transparent;
            border: 1.5px solid #ef4444;
            color: #ef4444;
        }

        .btn-outline-danger:hover {
            background: #ef4444;
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        /* Forms - Enhanced Beautiful Styling */
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
            position: relative;
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

        /* Animated border effect */
        .form-control::before,
        .form-select::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6, #ec4899);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
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

        /* Input groups with beautiful styling */
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
            border-radius: 0;
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
            border-radius: 0;
            box-shadow: none;
        }

        .input-group .form-control:first-child,
        .input-group .form-select:first-child {
            border-left: 2px solid #e5e7eb;
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control:last-child,
        .input-group .form-select:last-child {
            border-radius: 0 12px 12px 0;
        }

        .input-group .form-control:hover,
        .input-group .form-select:hover {
            transform: none;
            box-shadow: none;
        }

        /* Select dropdown styling */
        .form-select {
            background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%233b82f6' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 1rem center !important;
            background-size: 16px 12px !important;
            cursor: pointer;
            padding-right: 2.5rem;
        }

        .form-select:focus {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%232563eb' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        }

        /* File input beautiful styling */
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

        .form-control[type="file"]:focus {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        }

        /* Form text / helper text */
        .form-text {
            color: #6b7280;
            font-size: 0.8125rem;
            margin-top: 0.375rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
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

        /* Checkbox and Radio beautiful styling */
        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-check-input:hover {
            border-color: #94a3b8;
            transform: scale(1.05);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            border-color: #3b82f6;
        }

        /* Invalid state styling */
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #ef4444;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12);
            border-color: #dc2626;
        }

        .invalid-feedback {
            color: #dc2626;
            font-size: 0.8125rem;
            margin-top: 0.375rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .invalid-feedback::before {
            content: '⚠️';
        }

        /* Valid state styling */
        .form-control.is-valid,
        .form-select.is-valid {
            border-color: #10b981;
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        }

        .form-control.is-valid:focus,
        .form-select.is-valid:focus {
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.12);
            border-color: #059669;
        }

        .valid-feedback {
            color: #059669;
            font-size: 0.8125rem;
            margin-top: 0.375rem;
            font-weight: 500;
        }

        .valid-feedback::before {
            content: '✅';
            margin-right: 0.25rem;
        }

        /* Tables - Modern */
        .table {
            font-size: 0.875rem;
        }

        .table thead th {
            border-bottom: 2px solid #e5e7eb;
            font-weight: 700;
            padding: 0.875rem 1rem;
            color: #374151;
            background: linear-gradient(180deg, #fafbfc 0%, #f9fafb 100%);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.025em;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
            color: #1f2937;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: #fafbfc;
        }

        .table-hover tbody tr:hover {
            background: #f3f4f6;
        }

        /* Badges - Modern */
        .badge {
            font-weight: 600;
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
            border-radius: 8px;
        }

        .bg-primary-subtle {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%) !important;
            color: #1e40af !important;
        }

        .bg-success-subtle {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
            color: #065f46 !important;
        }

        .bg-warning-subtle {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
            color: #92400e !important;
        }

        .bg-danger-subtle {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%) !important;
            color: #991b1b !important;
        }

        .bg-secondary-subtle {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%) !important;
            color: #374151 !important;
        }

        /* Alerts - Polished */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            color: #991b1b;
        }

        .alert-info {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #1e40af;
        }

        /* Modal - Modern */
        .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid #f3f4f6;
            padding: 1.25rem 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid #f3f4f6;
            padding: 1rem 1.5rem;
        }

        /* Dropdown */
        .dropdown-menu {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            padding: 0.5rem;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background: #f3f4f6;
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

            .search-box input {
                width: 200px;
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

            .search-box {
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
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <x-brand-mark class="brand-mark" aria-hidden="true" />
            <span>Jobs Portal</span>
        </a>

        <div class="sidebar-menu">
            <div class="nav-label">Main</div>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>

            <div class="nav-label">Management</div>
            <a href="{{ route('admin.jobs.index') }}"
                class="nav-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
                <i class="bi bi-briefcase-fill"></i> Jobs
            </a>
            <a href="{{ route('admin.categories.index') }}"
                class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i> Categories
            </a>
            <a href="{{ route('admin.locations.index') }}"
                class="nav-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt-fill"></i> Locations
            </a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.job-roles.index') }}"
                    class="nav-link {{ request()->routeIs('admin.job-roles.*') ? 'active' : '' }}">
                    <i class="bi bi-list-task"></i> Job Roles
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Users
                </a>
                <!-- Analytics -->
                <a href="{{ route('admin.analytics.index') }}"
                    class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                    <i class="bi bi-graph-up-arrow"></i> Analytics
                </a>
            @endif

            <div class="nav-label">Account</div>
            <a href="{{ route('admin.profile.show') }}"
                class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
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
                <!-- Search Bar -->
                <div class="search-box d-none d-md-block">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search..." class="form-control">
                </div>

                <!-- Notifications -->
                <div class="notification-icon">
                    <i class="bi bi-bell"></i>
                    <span class="badge"></span>
                </div>

                <!-- View Site Link -->
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-light d-none d-sm-inline-flex">
                    <i class="bi bi-box-arrow-up-right me-1"></i> View Site
                </a>

                <!-- User Dropdown -->
                <div class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=3b82f6&color=fff"
                            alt="User" class="user-avatar">
                        <div class="user-info">
                            <span class="user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <span class="user-role">Administrator</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.show') }}"><i
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
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
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
