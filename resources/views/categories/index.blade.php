@extends('layouts.app')

@section('title', 'Browse Job Categories in Global – Find Your Career today')
@section('meta_description', 'Explore thousands of job opportunities in Global by category, role, and nationality. Find vacancies in sales, accounting, engineering, and more. Apply online today.')
@section('meta_keywords', 'global job categories, jobs by category global, sales jobs global, accountant jobs, engineering jobs global, part time jobs')

@section('content')
    <div class="page-header-minimal">
        <div class="container">
            <h1>Explore Job Categories in Global</h1>
            <p>Find the latest opportunities in Global by category, nationality, and popular roles</p>
        </div>
    </div>

    <div class="container py-5">

        <!-- Job Categories -->
        <section class="mb-5">
            <h2 class="section-title text-center mb-4">Job Categories</h2>
            <div class="category-grid-pro">
                @php $categories = App\Models\Category::has('jobs')->get(); @endphp
                @foreach($categories as $cat)
                    <a href="{{ route('jobs.index', ['category_id' => $cat->id]) }}" class="category-item-pro">
                        <div class="category-icon-pro">{{ $cat->icon }}</div>
                        <div class="category-info-pro">
                            <h3>{{ $cat->name }}</h3>
                            <span>{{ $cat->jobs()->count() }} Jobs</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>



        <!-- Popular Job Roles -->
        <section>
            <h2 class="section-title text-center mb-4">Popular Job Roles</h2>
            <div class="roles-grid">
                @php
                    $activeRoles = App\Models\Job::where('status', 'approved')
                        ->whereNotNull('job_role')
                        ->distinct()
                        ->pluck('job_role')
                        ->sort()
                        ->values();
                @endphp

                @foreach($activeRoles as $role)
                    <a href="{{ route('jobs.index', ['search' => $role]) }}" class="role-pill">{{ $role }} Jobs in Global</a>
                @endforeach
            </div>
        </section>

    </div>

    <style>
        .page-header-minimal {
            background: linear-gradient(to bottom, #f6f8fa 0%, #ffffff 100%);
            padding: 2rem 0 1.5rem;
            /* Reduced */
            text-align: center;
            border-bottom: 1px solid #d0d7de;
        }

        .page-header-minimal h1 {
            font-size: 2rem;
            /* Reduced */
            font-weight: 700;
            color: #0d1117;
            margin-bottom: 0.5rem;
        }

        .page-header-minimal p {
            color: #57606a;
            font-size: 1rem;
            /* Reduced */
        }

        .section-title {
            font-size: 1.5rem;
            /* Reduced */
            font-weight: 700;
            color: #0d1117;
        }

        /* Categories */
        .category-grid-pro {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            /* Aggressively smaller */
            gap: 0.75rem;
            /* Tighter gap */
        }

        .category-item-pro {
            background: white;
            border: 1px solid #d0d7de;
            border-radius: 8px;
            padding: 0.75rem;
            /* Very compact padding */
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .category-item-pro:hover {
            border-color: #0969da;
            box-shadow: 0 4px 12px rgba(9, 105, 218, 0.1);
            transform: translateY(-2px);
        }

        .category-icon-pro {
            width: 36px;
            /* Tiny icon box */
            height: 36px;
            background: #f6f8fa;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            /* Tiny icon font */
            color: #0969da;
            flex-shrink: 0;
        }

        .category-info-pro h3 {
            font-size: 0.9rem;
            /* Smaller heading */
            font-weight: 600;
            color: #0d1117;
            margin-bottom: 0;
            line-height: 1.3;
        }

        .category-info-pro span {
            font-size: 0.75rem;
            color: #0969da;
            background-color: #ddf4ff;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-block;
            margin-top: 4px;
        }

        /* Nationality */
        .nationality-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .nationality-card {
            background: #f6f8fa;
            border: 1px solid #d0d7de;
            border-radius: 8px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .nationality-card:hover {
            background: white;
            border-color: #0969da;
            box-shadow: 0 4px 12px rgba(9, 105, 218, 0.1);
            transform: translateY(-2px);
        }

        .nat-flag {
            font-size: 1.5rem;
        }

        .nat-name {
            font-weight: 600;
            color: #0d1117;
            flex: 1;
        }

        .nationality-card i {
            color: #57606a;
        }

        /* Roles */
        .roles-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
        }

        .role-pill {
            background: #f6f8fa;
            border: 1px solid #d0d7de;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            color: #57606a;
            text-decoration: none;
            transition: all 0.2s;
        }

        .role-pill:hover {
            background: white;
            border-color: #0969da;
            color: #0969da;
            transform: translateY(-1px);
        }
    </style>
@endsection
