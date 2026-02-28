<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jobs Portal') }}</title>

    <!-- SEO: Noindex auth pages -->
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #dbe4ef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
        }

        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 380px;
            /* Reduced width */
            padding: 1.25rem;
            /* Reduced padding from 2rem */
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 0.75rem;
            /* Reduced from 1.5rem */
            font-size: 1.25rem;
            /* Reduced from 1.5rem */
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            color: #0d1117;
            text-decoration: none;
            display: block;
        }

        .auth-logo img {
            width: 40px !important;
            /* Reduced from 48px */
            height: 40px !important;
        }

        .auth-logo strong {
            color: #0969da;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            /* Reduced from 0.85rem */
            color: #4b5563;
            margin-bottom: 0.15rem; /* Reduced from 0.25rem */
        }

        .form-control {
            padding: 0.5rem 0.75rem;
            /* Reduced from 0.6rem */
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            font-size: 0.85rem; /* Reduced from 0.9rem */
            background-color: #f8fafc;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #0969da;
            box-shadow: 0 0 0 3px rgba(9, 105, 218, 0.1);
        }

        .btn-primary {
            background: #0969da;
            border: none;
            padding: 0.5rem 1rem;
            /* Reduced from 0.6rem */
            font-weight: 600;
            font-size: 0.9rem; /* Reduced from 0.95rem */
            width: 100%;
            border-radius: 8px;
            transition: all 0.2s;
            margin-top: 0.25rem; /* Reduced from 0.5rem */
        }

        .btn-primary:hover {
            background: #0860ca;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(9, 105, 218, 0.15);
        }

        .btn-outline {
            display: inline-block;
            width: 100%;
            padding: 0.5rem 1.5rem; /* Reduced from 0.6rem */
            border: 1px solid #d0d7de;
            border-radius: 8px;
            color: #24292f;
            font-weight: 600;
            font-size: 0.85rem;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s;
            background: #fff;
        }

        .btn-outline:hover {
            background-color: #f6f8fa;
            border-color: #0969da;
            color: #0969da;
            transform: translateY(-1px);
        }

        .auth-links {
            text-align: center;
            margin-top: 0.75rem; /* Reduced from 1.25rem */
            font-size: 0.8rem;
        }

        .auth-links p {
            margin-bottom: 0;
        }

        .auth-links a {
            color: #0969da;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            font-size: 0.75rem;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <a href="/" class="auth-logo d-flex flex-column align-items-center gap-1 text-decoration-none">
            <span style="font-size: 1.15rem;">Jobs <strong class="text-primary">Portal</strong></span>
        </a>

        {{ $slot }}
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
