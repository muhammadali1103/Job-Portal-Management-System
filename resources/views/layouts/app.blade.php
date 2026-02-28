<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <!-- Performance: Preconnect ASAP -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    <!-- Critical Asset Preloading -->
    <link rel="preload"
        href="https://fonts.gstatic.com/s/inter/v13/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfMZg.woff2" as="font"
        type="font/woff2" crossorigin>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jobs Portal') }} - @yield('title', 'Find Your Dream Job')</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}">

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="@yield('meta_description', 'Find your dream job in Global. Browse thousands of job opportunities. Apply via WhatsApp, phone, or email - no registration required.')">
    <meta name="keywords"
        content="global jobs, jobs in global, global careers, employment global, job vacancies global, @yield('meta_keywords', 'part time jobs, full time jobs, driver jobs')">
    <meta name="author" content="Jobs Portal">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    @php
        $canonical = $canonical ?? (request()->routeIs('jobs.index') && request('category_id')
            ? route('jobs.index', ['category_id' => request('category_id')])
            : url()->current());
    @endphp
    <link rel="canonical" href="@yield('canonical', $canonical)">


    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', config('app.name') . ' - Find Your Dream Job in Global')">
    <meta property="og:description"
        content="@yield('og_description', 'Browse thousands of job opportunities from top employers in Global. Apply directly without registration.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    <meta property="og:site_name" content="Jobs Portal">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title"
        content="@yield('twitter_title', config('app.name') . ' - Find Your Dream Job in Global')">
    <meta name="twitter:description"
        content="@yield('twitter_description', 'Browse thousands of job opportunities from top employers in Global.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-image.jpg'))">

    <!-- Optimized Fonts: Consolidate to one provider to avoid multiple DNS lookups -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- Core CSS (Non-blocking pattern) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles Stack for Critical CSS -->
    @stack('styles')



    <!-- Custom Styles -->
    <style>
        /* Compact Mode - Manual Sizing */
        body {
            font-size: 0.8125rem;
            /* 13px Base */
            line-height: 1.5;
        }

        /* Headings - Scaled Down */
        h1,
        .h1 {
            font-size: 1.5rem !important;
        }

        h2,
        .h2 {
            font-size: 1.25rem !important;
        }

        h3,
        .h3 {
            font-size: 1.1rem !important;
        }

        h4,
        .h4 {
            font-size: 1rem !important;
        }

        h5,
        .h5 {
            font-size: 0.9rem !important;
        }

        /* Compact Layout Elements */
        .container,
        .container-fluid {
            max-width: 1200px;
            /* Restrict width slightly */
        }

        .card {
            margin-bottom: 1rem !important;
        }

        .card-body {
            padding: 1rem !important;
            /* Compact padding */
        }

        /* Form Elements - Compact */
        .form-control,
        .form-select,
        .btn {
            font-size: 0.85rem !important;
            padding: 0.375rem 0.75rem !important;
            /* Smaller padding */
            height: auto !important;
        }

        .form-label {
            font-size: 0.8rem !important;
            margin-bottom: 0.25rem !important;
        }

        /* Icons */
        .bi {
            font-size: 1rem !important;
            /* Force smaller icons */
        }

        /* Custom Overrides */
        a {
            text-decoration: none;
        }

        /* Navbar specific compaction if needed */
        .navbar-brand img {
            height: 32px !important;
            /* Smaller logo */
            width: auto;
        }

        .nav-link {
            font-size: 0.85rem !important;
        }

        /* Essential Layout Utilities (Replacing Tailwind) */
        .max-w-7xl {
            max-width: 80rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .py-6 {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        @media (min-width: 640px) {
            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        /* Pagination - Show numbers on mobile */
        .pagination .page-item {
            display: inline-block !important;
        }

        .pagination .page-link {
            display: block !important;
        }
    </style>
    <!-- Deferred CSS: Icons are not needed for initial page render -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    </noscript>

    <!-- Organization & Website Schema -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "WebSite",
      "name": "Jobs Portal",
      "url": "{{ url('/') }}",
      "potentialAction": {
        "@@type": "SearchAction",
        "target": {
          "@@type": "EntryPoint",
          "urlTemplate": "{{ url('/jobs') }}?search={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Organization",
      "name": "Jobs Portal",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/logo.png') }}",
      "sameAs": [
        "https://www.facebook.com/JobsPortal",
        "https://twitter.com/JobsPortal",
        "https://www.linkedin.com/company/JobsPortal"
      ]
    }
    </script>

    <!-- Page-specific Schema -->
    @yield('schema')
</head>

<body class="bg-light d-flex flex-column min-vh-100"
    style="font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased;">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Breadcrumbs -->
    @yield('breadcrumbs')

    <!-- Page Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

