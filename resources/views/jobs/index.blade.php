@extends('layouts.app')

@php
    $pageTitle = 'Browse Latest Jobs in Global';
    if (request('search')) {
        $pageTitle = request('search') . ' Jobs in Global';
    } elseif (request('category_id')) {
        $catName = \App\Models\Category::find(request('category_id'))?->name;
        $pageTitle = ($catName ?? 'Browse') . ' Jobs in Global';
    }
@endphp

@section('title', $pageTitle . ' – Apply Online Today – Jobs Portal')

@section('meta_description', 'Latest ' . (request('search') ?: 'job') . ' openings in Global. Browse ' . (request('category_id') ? $catName : 'thousands of') . ' jobs. Apply today - no registration required.')
@section('meta_keywords', (request('search') ? request('search') . ', ' : '') . 'global jobs, jobs in global, driver jobs global, accountant jobs global, part time jobs global')

@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="bg-light py-2">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Browse Jobs</li>
            </ol>
        </div>
    </nav>
@endsection

@section('content')

    <!-- Hero / Search Section -->
    <section class="hero-professional">
        <div class="container">
            <div class="hero-content-pro">
                <h1>{{ $pageTitle }}</h1>
                <p>Latest Government & Private Sector Vacancies Updated Daily</p>

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

    <!-- Jobs List -->
    <section class="jobs-pro">
        <div class="container">

            <div class="d-flex justify-content-center align-items-center mb-4">
                <h2 class="mb-0 fs-4">All Jobs</h2>
            </div>

            <div class="job-list-pro">
                @forelse($jobs as $job)
                    <div class="job-card-pro">
                        <div class="job-card-main">
                            <h3>
                                <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                            </h3>
                            <div class="job-meta-pro">
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
                @empty
                    <div class="text-center py-5 bg-white rounded-4 border border-dashed">
                        <div class="mb-3 text-muted">
                            <i class="bi bi-search" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                        <h4 class="fw-bold text-dark">No jobs found</h4>
                        <p class="text-muted">Try adjusting your search filters.</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary rounded-pill">Clear Filters</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <!-- Pagination -->
            @if($jobs->hasPages())
                <div class="d-flex flex-column align-items-center mt-5">
                    <p class="text-muted mb-3">
                        Showing <span class="fw-bold text-dark">{{ $jobs->firstItem() }}</span> to <span
                            class="fw-bold text-dark">{{ $jobs->lastItem() }}</span> of <span
                            class="fw-bold text-dark">{{ $jobs->total() }}</span> results
                    </p>
                    {{ $jobs->onEachSide(1)->links() }}
                </div>
            @endif
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* Hero */
        .hero-professional {
            background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
            padding: 2rem 0 2.5rem;
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

        /* Jobs */
        .jobs-pro {
            padding: 2.5rem 0;
            background: #f6f8fa;
            min-height: 600px;
        }

        .jobs-pro h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0d1117;
        }

        .job-list-pro {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .job-card-pro {
            background: white;
            border: 1px solid #60a5fa;
            /* Blue border */
            border-radius: 0;
            padding: 1.25rem;
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
            margin: -1px;
            box-shadow: 0 8px 15px rgba(9, 105, 218, 0.15);
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
    </style>

@endsection

