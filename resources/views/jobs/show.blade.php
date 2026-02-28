@extends('layouts.app')

@section('title', Str::limit($job->title, 46) . ' | Global jobz')

@section('meta_description', 'Apply for ' . Str::limit($job->title, 40) . ' in ' . ($job->location->city ?? 'Global') . '. ' . Str::limit(strip_tags($job->description), 50) . ' Apply today - no registration required.')
@section('meta_keywords', $job->title . ' jobs, ' . ($job->category->name ?? 'Jobs') . ' in global, jobs in ' . ($job->location->city ?? 'Global') . ', ' . $job->job_type . ' vacancies global')

@section('og_title', $job->title . ' Hiring in Global – Apply Now')
@section('og_description', 'Latest ' . $job->title . ' job opening in ' . ($job->location->city ?? 'Global') . '. Apply online and get hired today on Jobs Portal.')
@section('og_image', asset('images/job-default.png'))

@section('schema')
    <script type="application/ld+json">
                                                            {
                                                              "@@context": "https://schema.org/",
                                                              "@@type": "JobPosting",
                                                              "title": "{{ $job->title }}",
                                                              "description": "{!! addslashes(strip_tags($job->description)) !!}",
                                                              "identifier": {
                                                                "@@type": "PropertyValue",
                                                                "name": "{{ $job->company_name ?? 'Jobs Portal' }}",
                                                                "value": "{{ $job->id }}"
                                                              },
                                                              "datePosted": "{{ $job->created_at->toIso8601String() }}",
                                                              "validThrough": "{{ $job->created_at->addMonths(1)->toIso8601String() }}",
                                                              "employmentType": "{{ $job->job_type === 'Full Time' ? 'FULL_TIME' : ($job->job_type === 'Part Time' ? 'PART_TIME' : 'CONTRACTOR') }}",
                                                              "hiringOrganization": {
                                                                "@@type": "Organization",
                                                                "name": "{{ $job->company_name ?? 'Jobs Portal' }}",
                                                                "sameAs": "{{ route('home') }}"
                                                              },
                                                              "jobLocation": {
                                                                "@@type": "Place",
                                                                "address": {
                                                                  "@@type": "PostalAddress",
                                                                  "streetAddress": "{{ $job->location->city ?? 'Global' }}",
                                                                  "addressLocality": "{{ $job->location->city ?? 'Global' }}",
                                                                  "addressRegion": "Global",
                                                                  "postalCode": "00000",
                                                                  "addressCountry": "KW"
                                                                }
                                                              },
                                                              "baseSalary": {
                                                                "@@type": "MonetaryAmount",
                                                                "currency": "PKR",
                                                                "value": {
                                                                  "@@type": "QuantitativeValue",
                                                                  "minValue": {{ $job->salary_min ?? 0 }},
                                                                  "unitText": "MONTH"
                                                                }
                                                              }
                                                            }
                                                            </script>
@endsection

@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="bg-light py-2">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Jobs</a></li>
                @if($job->category)
                    <li class="breadcrumb-item"><a
                            href="{{ route('jobs.index', ['category_id' => $job->category_id]) }}">{{ $job->category->name }}</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($job->title, 50) }}</li>
            </ol>
        </div>
    </nav>

    <!-- Breadcrumb Schema -->
    <script type="application/ld+json">
                                                            {
                                                              "@@context": "https://schema.org",
                                                              "@@type": "BreadcrumbList",
                                                              "itemListElement": [
                                                                {
                                                                  "@@type": "ListItem",
                                                                  "position": 1,
                                                                  "name": "Home",
                                                                  "item": "{{ route('home') }}"
                                                                },
                                                                {
                                                                  "@@type": "ListItem",
                                                                  "position": 2,
                                                                  "name": "Jobs",
                                                                  "item": "{{ route('jobs.index') }}"
                                                                }
                                                                @if($job->category)
                                                                    ,{
                                                                      "@@type": "ListItem",
                                                                      "position": 3,
                                                                      "name": "{{ $job->category->name }}",
                                                                      "item": "{{ route('jobs.index', ['category_id' => $job->category_id]) }}"
                                                                    }
                                                                @endif
                                                                ,{
                                                                  "@@type": "ListItem",
                                                                  "position": {{ $job->category ? 4 : 3 }},
                                                                  "name": "{{ $job->title }}",
                                                                  "item": "{{ route('jobs.show', $job) }}"
                                                                }
                                                              ]
                                                            }
                                                            </script>
    @if($job->company_logo)
        @push('styles')
            <link rel="preload" href="{{ Storage::url($job->company_logo) }}" as="image">
        @endpush
    @endif

@endsection

@section('content')

    <!-- Job Header -->
    <section class="job-header-pro">
        <div class="container">
            <div class="job-header-wrapper">
                <div class="job-header-brands d-flex align-items-center mb-3">
                    @if($job->company_logo)
                        <img src="{{ Storage::url($job->company_logo) }}" alt="{{ $job->company_name ?? 'Company' }}"
                            class="rounded-3 me-3"
                            style="width: 64px; height: 64px; object-fit: contain; background: white; border: 1px solid #e5e7eb;">
                    @endif
                    <h1 class="mb-0">{{ $job->title }}</h1>
                </div>

                <div class="job-header-meta">
                    <!-- Removed Poster Name -->
                    <span><i class="bi bi-geo-alt"></i> {{ $job->location->city ?? 'Not Mentioned' }}</span>
                    <span><i class="bi bi-clock"></i> {{ $job->created_at->diffForHumans() }}</span>
                </div>
                <div class="job-header-tags">
                    <span class="tag-blue">{{ $job->job_type }}</span>
                    <span class="tag-purple">{{ $job->category->name ?? 'Uncategorized' }}</span>
                    @if($job->salary_min)
                        <span class="tag-green">{{ $job->salary_min }}/mo</span>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Job Content -->
    <div class="job-content-wrapper">
        <div class="container">
            <div class="job-layout-grid">
                <!-- Main Content -->
                <main class="job-main">
                    <!-- Description -->
                    <div class="job-section">
                        <h2>Job Description</h2>
                        <div class="job-text">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>
                </main>

                <!-- Sidebar -->
                <aside class="job-sidebar">
                    <!-- Job Info Card -->
                    <div class="sidebar-card">
                        <h3>Job Information</h3>
                        <div class="info-list">
                            <div class="info-item">
                                <span class="info-label">Posted Date</span>
                                <span class="info-value">{{ $job->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Location</span>
                                <span class="info-value">{{ $job->location->city ?? 'Not Mentioned' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Job Type</span>
                                <span class="info-value">{{ $job->job_type }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Salary</span>
                                <span class="info-value {{ $job->salary_min ? 'highlight' : '' }}">
                                    @if($job->salary_min)
                                        {{ $job->salary_min }}
                                    @else
                                        Not Mentioned
                                    @endif
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Experience</span>
                                <span class="info-value">{{ $job->experience ?? 'Not Mentioned' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Category</span>
                                <span class="info-value">{{ $job->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Nationality</span>
                                <span class="info-value">{{ $job->nationality ?? 'Not Mentioned' }}</span>
                            </div>
                        </div>
                        @if($job->apply_method === 'phone')
                            <a href="{{ route('jobs.trackApply', $job) }}" class="btn-apply-only">
                                <i class="bi bi-telephone-fill me-2"></i>Call to Apply
                            </a>
                        @elseif($job->apply_method === 'whatsapp')
                            <a href="{{ route('jobs.trackApply', $job) }}" target="_blank" class="btn-apply-only"
                                style="background-color: #25D366; border-color: #25D366;">
                                <i class="bi bi-whatsapp me-2"></i>Apply on WhatsApp
                            </a>
                        @elseif($job->apply_method === 'email')
                            <a href="{{ route('jobs.trackApply', $job) }}" class="btn-apply-only">
                                <i class="bi bi-envelope-fill me-2"></i>Apply by Email
                            </a>
                        @elseif($job->apply_method === 'url')
                            <a href="{{ route('jobs.trackApply', $job) }}" target="_blank" class="btn-apply-only">
                                <i class="bi bi-box-arrow-up-right me-2"></i>Apply on Company Website
                            </a>
                        @else
                            <a href="#" class="btn-apply-only">
                                <i class="bi bi-send-fill me-2"></i>Apply for this Job
                            </a>
                        @endif
                    </div>

                    <!-- Share -->
                    <div class="sidebar-card">
                        <h3>Share this Job</h3>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('jobs.show', $job)) }}"
                                target="_blank" class="share-btn" title="Share on Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('jobs.show', $job)) }}&text={{ urlencode($job->title) }}"
                                target="_blank" class="share-btn" title="Share on Twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('jobs.show', $job)) }}"
                                target="_blank" class="share-btn" title="Share on LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($job->title . ' - ' . route('jobs.show', $job)) }}"
                                target="_blank" class="share-btn" title="Share on WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="https://www.instagram.com/" target="_blank" class="share-btn"
                                title="Share on Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <!-- Related Jobs -->
    @php
        $relatedJobs = App\Models\Job::where('status', 'approved')
            ->where('id', '!=', $job->id)
            ->where(function ($query) use ($job) {
                $query->where('category_id', $job->category_id)
                    ->orWhere('location_id', $job->location_id);
            })
            ->with(['category', 'location', 'user'])
            ->latest()
            ->take(6)
            ->get();
    @endphp

    @if($relatedJobs->count() > 0)
        <section class="related-jobs-section">
            <div class="container">
                <h2 class="section-title-related">Related Jobs You May Like</h2>

                <div class="job-list-pro">
                    @foreach($relatedJobs as $relatedJob)
                        <div class="job-card-pro">
                            <div class="job-card-main">
                                <h3>
                                    <a href="{{ route('jobs.show', $relatedJob) }}">{{ $relatedJob->title }}</a>
                                </h3>
                                <div class="job-meta-pro">
                                    <span><i class="bi bi-geo-alt"></i> {{ $relatedJob->location->city ?? 'Not Mentioned' }}</span>
                                    <span><i class="bi bi-clock"></i> {{ $relatedJob->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="job-desc-pro">{{ Str::limit(strip_tags($relatedJob->description), 100) }}</p>
                                <div class="job-tags-pro">
                                    <span class="tag-type">{{ $relatedJob->job_type }}</span>
                                    <span class="tag-cat">{{ $relatedJob->category->name ?? 'Uncategorized' }}</span>
                                </div>
                            </div>
                            <div class="job-card-action">
                                <a href="{{ route('jobs.show', $relatedJob) }}" class="btn-apply-pro">View Job</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('jobs.index') }}" class="btn-view-more">View All Jobs →</a>
                </div>
            </div>
        </section>
    @endif

    <style>
        /* Job Header */
        .job-header-pro {
            background: #f6f8fa;
            padding: 1rem 0;
            border-bottom: 1px solid #d0d7de;
        }

        .job-header-wrapper {
            max-width: 900px;
        }

        .job-header-main h1 {
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 700;
            color: #0d1117;
            margin-bottom: 0.5rem;
        }

        .job-header-meta {
            display: flex;
            gap: 1.25rem;
            margin-bottom: 0.75rem;
            font-size: 0.9375rem;
            color: #57606a;
            flex-wrap: wrap;
        }

        .job-header-meta span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .job-header-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .tag-blue,
        .tag-purple,
        .tag-green {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .tag-blue {
            background: rgba(9, 105, 218, 0.1);
            color: #0969da;
        }

        .tag-purple {
            background: rgba(130, 80, 223, 0.1);
            color: #8250df;
        }

        .tag-green {
            background: rgba(26, 127, 55, 0.1);
            color: #1a7f37;
        }

        /* Job Content */
        .job-content-wrapper {
            padding: 1.5rem 0;
        }

        .job-layout-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 1.5rem;
        }

        .job-main {
            min-width: 0;
        }

        .job-section {
            background: white;
            border: 1px solid #d0d7de;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .job-section h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0d1117;
            margin-bottom: 1rem;
        }

        .job-text {
            line-height: 1.8;
            color: #57606a;
            font-size: 1rem;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .skill-tag {
            background: #f6f8fa;
            border: 1px solid #d0d7de;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #0d1117;
        }

        /* Sidebar */
        .job-sidebar {
            position: sticky;
            top: 6rem;
            height: fit-content;
        }

        .sidebar-card {
            background: white;
            border: 1px solid #d0d7de;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1rem;
        }

        .sidebar-card h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #0d1117;
            margin-bottom: 1.25rem;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f6f8fa;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            font-size: 0.875rem;
            color: #57606a;
        }

        .info-value {
            font-size: 0.9375rem;
            font-weight: 600;
            color: #0d1117;
        }

        .info-value.highlight {
            color: #1a7f37;
        }

        .btn-apply-only {
            display: block;
            width: 100%;
            background: #0969da;
            color: white;
            padding: 0.6rem;
            border-radius: 6px;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .btn-apply-only:hover {
            background: #0860ca;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(9, 105, 218, 0.3);
        }

        .share-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .share-btn {
            aspect-ratio: 1;
            background: #f6f8fa;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #57606a;
            text-decoration: none;
            transition: all 0.2s;
            height: 36px;
            width: 36px;
        }

        .share-btn:hover {
            background: #0969da;
            color: white;
            border-color: #0969da;
        }

        /* Related Jobs */
        .related-jobs-section {
            background: #ffffff;
            padding: 1.5rem 0;
            border-top: 1px solid #f0f2f5;
        }

        .section-title-related {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0d1117;
            margin-bottom: 1.25rem;
            text-align: center;
            letter-spacing: -0.5px;
        }

        /* Homepage Card Styles Reused */
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
            /* Prominent visible border */
            border-radius: 0;
            /* Square */
            padding: 1rem;
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
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
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
            gap: 1rem;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
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
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            color: #57606a;
        }

        .btn-apply-pro {
            background: #0969da;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-apply-pro:hover {
            background: #0860ca;
            color: white;
        }

        .salary-tag {
            font-weight: 600;
            color: #1f883d;
            font-size: 0.9rem;
            background: #dafbe1;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
        }

        .job-desc-pro {
            color: #57606a;
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }





        .btn-view-more {
            display: inline-block;
            padding: 0.875rem 2rem;
            border: 2px solid #d0d7de;
            border-radius: 8px;
            color: #0d1117;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-view-more:hover {
            border-color: #0969da;
            color: #0969da;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .job-layout-grid {
                grid-template-columns: 1fr;
            }

            .job-card-pro {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .btn-apply-pro {
                width: 100%;
                text-align: center;
            }

            .job-sidebar {
                position: relative;
                top: 0;
            }
        }

        @media (max-width: 576px) {
            .job-header-meta {
                flex-direction: column;
                gap: 0.75rem;
            }

            .related-jobs-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection


