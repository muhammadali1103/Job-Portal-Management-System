@extends('layouts.app')

@section('title', 'Jobs Portal - Find Your Dream Job in Global Today')
@section('meta_description', 'Latest jobs in Global: driver, helper, and accountant vacancies. Apply online for part-time and full-time jobs - no registration required.')
@section('meta_keywords', 'global jobs, jobs in global, driver jobs global, accountant jobs global, helper jobs, part time jobs global, full time jobs global')

@section('content')

    <!-- Hero Section -->
    <section class="hero-professional">
        <div class="container">
            <div class="hero-content-pro">
                <h1>Jobs Portal - Find Your Dream Job</h1>
                <p>Latest Government & Private Sector Jobs in Global Updated Daily</p>

                <!-- Search Bar -->
                <form action="{{ route('jobs.index') }}" method="GET" class="search-pro">
                    <div class="search-group">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" placeholder="Job title, keywords, or company"
                            value="{{ request('search') }}">
                    </div>
                    <div class="search-group">
                        <i class="bi bi-geo-alt"></i>
                        <select name="location_id">
                            <option value="">Select City</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->city }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-group">
                        <i class="bi bi-briefcase"></i>
                        <select name="category_id">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="search-btn-pro">Search Jobs</button>
                </form>
            </div>
        </div>
    </section>



    <!-- Latest Jobs -->
    <section class="jobs-pro">
        <div class="container">
            <h2>Latest Job Openings</h2>

            <div class="job-list-pro">
                @foreach($jobs as $job)
                    <div class="job-card-pro">
                        <div class="job-card-main">
                            <h3>
                                <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                            </h3>
                            <div class="job-meta-pro">
                                <!-- Removed Poster Name -->
                                <span><i class="bi bi-geo-alt"></i> {{ $job->location->city ?? 'Not Mentioned' }}</span>
                                <span><i class="bi bi-clock"></i> {{ $job->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="job-desc-pro">{{ Str::limit(strip_tags($job->description), 100) }}</p>
                            <div class="job-tags-pro">
                                <span class="tag-type">{{ $job->job_type }}</span>
                                <span class="tag-cat">{{ $job->category->name ?? 'Uncategorized' }}</span>
                            </div>
                        </div>
                        <div class="job-card-action">
                            <a href="{{ route('jobs.show', $job) }}" class="btn-apply-pro">View Job</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($jobs->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $jobs->onEachSide(1)->links() }}
                </div>
            @endif
        </div>
    </section>



    <!-- CTA Post Job -->
    <section class="cta-post-pro">
        <div class="container">
            <div class="cta-content-pro">
                <h2>Hiring? Post a Job for Free</h2>
                <p>Reach thousands of job seekers across Global</p>
                <a href="{{ route('register') }}" class="btn-post-job">Post a Job</a>
            </div>
        </div>
    </section>

    <!-- Popular Job Roles -->
    <section class="popular-roles-pro">
        <div class="container">
            <h2>Popular Job Roles</h2>
            <div class="roles-grid">
                @foreach($jobRoles as $role)
                    <a href="{{ route('jobs.index', ['search' => $role->name]) }}" class="role-pill">{{ $role->name }} Jobs in
                        Global</a>
                @endforeach
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            * {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            }

            /* Hero */
            .hero-professional {
                background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
                padding: 2rem 0 2.5rem;
                /* Reduced padding */
            }

            .hero-content-pro {
                max-width: 1000px;
                margin: 0 auto;
                text-align: center;
            }

            .hero-content-pro h1 {
                font-size: clamp(1.75rem, 4vw, 2.25rem);
                font-weight: 700;
                color: #0d1117;
                margin-bottom: 0.5rem;
                letter-spacing: -0.02em;
            }

            .hero-content-pro p {
                font-size: 1rem;
                color: #57606a;
                margin-bottom: 1.5rem;
                /* Reduced margin */
            }

            /* Search Bar */
            .search-pro {
                background: white;
                border: 1px solid #d0d7de;
                border-radius: 12px;
                padding: 0.75rem;
                display: grid;
                grid-template-columns: 1.8fr 1.6fr 1.6fr auto;
                gap: 0.75rem;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            }

            .search-group {
                position: relative;
                display: flex;
                align-items: center;
                background: #f6f8fa;
                border-radius: 8px;
                padding: 0 1rem;
            }

            .search-group i {
                color: #57606a;
                margin-right: 0.75rem;
                font-size: 0.95rem;
            }

            .search-group input,
            .search-group select {
                border: none;
                background: transparent;
                padding: 0.75rem 0;
                font-size: 0.95rem;
                color: #0d1117;
                width: 100%;
            }

            .search-group input:focus,
            .search-group select:focus {
                outline: none;
            }

            .search-btn-pro {
                background: #0969da;
                color: white;
                border: none;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                font-size: 0.95rem;
                cursor: pointer;
                white-space: nowrap;
                transition: background 0.2s;
                box-shadow: 0 2px 8px rgba(9, 105, 218, 0.2);
            }

            .search-btn-pro:hover {
                background: #0860ca;
                transform: translateY(-1px);
            }

            /* Categories */
            .categories-pro {
                padding: 2.5rem 0;
                /* Reduced */
            }

            .categories-pro h2 {
                font-size: 1.75rem;
                font-weight: 700;
                color: #0d1117;
                margin-bottom: 1.5rem;
                /* Reduced */
                text-align: center;
            }

            .category-grid-pro {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1rem;
            }

            .category-item-pro {
                background: white;
                border: 1px solid #d0d7de;
                border-radius: 10px;
                padding: 1.25rem;
                /* Reduced */
                display: flex;
                align-items: center;
                gap: 1rem;
                text-decoration: none;
                transition: all 0.2s;
            }

            .category-item-pro:hover {
                border-color: #0969da;
                box-shadow: 0 4px 12px rgba(9, 105, 218, 0.1);
                transform: translateY(-2px);
            }

            .category-icon-pro {
                width: 48px;
                height: 48px;
                background: #f6f8fa;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: #0969da;
                flex-shrink: 0;
            }

            .category-info-pro h3 {
                font-size: 1rem;
                font-weight: 600;
                color: #0d1117;
                margin-bottom: 0.25rem;
            }

            .category-info-pro span {
                font-size: 0.875rem;
                color: #57606a;
            }

            /* Jobs */
            .jobs-pro {
                padding: 2.5rem 0;
                /* Reduced */
                background: #f6f8fa;
            }

            .jobs-pro h2 {
                font-size: 1.75rem;
                font-weight: 700;
                color: #0d1117;
                margin-bottom: 1.5rem;
                /* Reduced */
                text-align: center;
            }

            .job-list-pro {
                display: flex;
                flex-direction: column;
                gap: 1rem;
                margin-bottom: 1.5rem;
                /* Reduced */
            }

            .job-card-pro {
                background: white;
                border: 1px solid #60a5fa;
                /* Blue border */
                border-radius: 0;
                /* Square */
                padding: 1.25rem;
                /* Reduced */
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 1.5rem;
                transition: all 0.2s;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
                /* Stronger shadow */
            }

            .job-card-pro:hover {
                border-color: #0969da;
                border-width: 2px;
                /* Thicker on hover */
                margin: -1px;
                /* Prevent layout shift */
                box-shadow: 0 8px 15px rgba(9, 105, 218, 0.15);
                /* Stronger highlight */
                transform: translateY(-2px);
            }

            .job-card-main {
                flex: 1;
                min-width: 0;
            }

            .job-card-main h3 {
                font-size: 1.125rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
                /* Reduced */
            }

            .job-card-main h3 a {
                color: #0d1117;
                text-decoration: none;
            }

            .job-card-main h3 a:hover {
                color: #0969da;
            }

            .job-meta-pro {
                display: flex;
                gap: 1.5rem;
                margin-bottom: 0.5rem;
                /* Reduced */
                font-size: 0.875rem;
                color: #57606a;
                flex-wrap: wrap;
            }

            .job-meta-pro span {
                display: flex;
                align-items: center;
                gap: 0.375rem;
            }

            .job-tags-pro {
                display: flex;
                gap: 0.5rem;
            }

            .job-tags-pro span {
                background: #f6f8fa;
                padding: 0.375rem 0.75rem;
                border-radius: 6px;
                font-size: 0.8125rem;
                font-weight: 500;
                color: #57606a;
            }

            .btn-apply-pro {
                background: #0969da;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                font-size: 0.9375rem;
                white-space: nowrap;
                display: inline-block;
                transition: background 0.2s;
            }

            .btn-apply-pro:hover {
                background: #0860ca;
                color: white;
            }

            .view-all-pro {
                text-align: center;
            }

            .btn-view-all {
                display: inline-block;
                padding: 1rem 2.5rem;
                border: 2px solid #d0d7de;
                border-radius: 8px;
                color: #0d1117;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.2s;
            }

            .btn-view-all:hover {
                border-color: #0969da;
                color: #0969da;
            }

            /* Trust */
            .trust-pro {
                background: white;
                border-top: 1px solid #d0d7de;
                border-bottom: 1px solid #d0d7de;
                padding: 1.5rem 0;
                /* Reduced */
                text-align: center;
            }

            .trust-pro p {
                color: #57606a;
                margin-bottom: 0.75rem;
                /* Reduced */
                font-size: 0.9375rem;
            }

            .trust-sources {
                display: flex;
                justify-content: center;
                gap: 2rem;
                flex-wrap: wrap;
            }

            .trust-sources span {
                color: #0d1117;
                font-weight: 500;
                font-size: 0.875rem;
            }

            /* CTA */
            .cta-post-pro {
                padding: 3rem 0;
                /* Increased slightly for emphasis */
                background: linear-gradient(135deg, #0969da 0%, #054da7 100%);
                /* Beautiful Blue Gradient */
                color: white;
                text-align: center;
            }

            .cta-content-pro {
                max-width: 700px;
                margin: 0 auto;
            }

            .cta-content-pro h2 {
                font-size: 2rem;
                font-weight: 700;
                color: white;
                margin-bottom: 0.75rem;
            }

            .cta-content-pro p {
                color: rgba(255, 255, 255, 0.9);
                margin-bottom: 2rem;
                font-size: 1.1rem;
            }

            .btn-post-job {
                background: white;
                color: #0969da;
                padding: 1rem 3rem;
                border-radius: 50px;
                text-decoration: none;
                font-weight: 700;
                display: inline-block;
                transition: all 0.2s;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .btn-post-job:hover {
                background: #f8f9fa;
                color: #054da7;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .search-pro {
                    grid-template-columns: 1fr;
                }

                .search-btn-pro {
                    width: 100%;
                }

                .job-card-pro {
                    flex-direction: column;
                    align-items: stretch;
                }

                .btn-apply-pro {
                    width: 100%;
                    text-align: center;
                    padding: 0.5rem 1rem;
                    /* Smaller padding */
                    font-size: 0.85rem;
                    /* Smaller font */
                }
            }

            /* Nationality Section */
            .nationality-pro {
                padding: 2.5rem 0;
                /* Reduced */
                background: white;
                border-top: 1px solid #d0d7de;
            }

            .nationality-pro h2 {
                font-size: 1.75rem;
                font-weight: 700;
                color: #0d1117;
                margin-bottom: 1.5rem;
                /* Reduced */
                text-align: center;
            }

            .nationality-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }

            .nationality-card {
                background: #f6f8fa;
                border: 1px solid #d0d7de;
                border-radius: 8px;
                padding: 1rem;
                /* Reduced */
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

            /* WhatsApp Banner */
            .whatsapp-banner {
                background: linear-gradient(135deg, #128C7E 0%, #075E54 100%);
                padding: 2rem 0;
                /* Reduced */
                color: white;
            }

            .wa-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                max-width: 900px;
                margin: 0 auto;
                flex-wrap: wrap;
                gap: 1.5rem;
                /* Reduced */
            }

            .wa-text h3 {
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 0.25rem;
                /* Reduced */
            }

            .wa-text p {
                margin: 0;
                opacity: 0.9;
                font-size: 1.125rem;
            }

            .btn-whatsapp-join {
                background: white;
                color: #128C7E;
                padding: 0.75rem 2rem;
                /* Reduced */
                border-radius: 50px;
                text-decoration: none;
                font-weight: 700;
                transition: all 0.2s;
                white-space: nowrap;
            }

            .btn-whatsapp-join:hover {
                background: #f0f0f0;
                transform: scale(1.05);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                color: #128C7E;
            }

            /* Popular Roles */
            .popular-roles-pro {
                padding: 2.5rem 0;
                /* Reduced */
                background: white;
                border-top: 1px solid #d0d7de;
            }

            .popular-roles-pro h2 {
                font-size: 1.5rem;
                font-weight: 700;
                color: #0d1117;
                margin-bottom: 1.5rem;
                /* Reduced */
                text-align: center;
            }

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

            .job-desc-pro {
                color: #57606a;
                font-size: 0.9375rem;
                margin-bottom: 0.75rem;
                line-height: 1.5;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endpush
@endsection

