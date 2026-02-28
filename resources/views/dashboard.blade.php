@extends('layouts.user')

@section('header_title', 'My Dashboard')

@section('content')
    <div class="mb-4">
        <h4 class="mb-2 fw-bold" style="font-size: 1.75rem; color: #111827;">Welcome back, {{ auth()->user()->name }}! 👋</h4>
        <p class="text-muted mb-0">Here's what's happening with your job postings today.</p>
    </div>

    <!-- Stats Cards -->
    <!-- Mobile: Post Job Section (Shown first on mobile) -->
    <div class="mb-4 d-md-none">
        <div class="card" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none;">
            <div class="card-body p-4">
                <div class="mb-3">
                    <i class="bi bi-plus-circle-fill" style="font-size: 2.5rem; opacity: 0.9;"></i>
                </div>
                <h5 class="fw-bold mb-2">Post a New Job</h5>
                <p class="mb-4" style="opacity: 0.9;">Reach thousands of job seekers looking for opportunities in Global.</p>
                <a href="{{ route('user.jobs.create') }}" class="btn btn-light w-100">
                    <i class="bi bi-briefcase-fill me-2"></i>Create Job Posting
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                            <i class="bi bi-briefcase-fill text-white fs-5"></i>
                        </div>
                        <span class="badge" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af; font-weight: 600;">All Time</span>
                    </div>
                    <h3 class="mb-1 fw-bold" style="color: #111827;">{{ $totalJobs }}</h3>
                    <p class="text-muted mb-0 small">Total Jobs Posted</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="bi bi-check-circle-fill text-white fs-5"></i>
                        </div>
                        <span class="badge" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; font-weight: 600;">Active</span>
                    </div>
                    <h3 class="mb-1 fw-bold" style="color: #111827;">{{ $approvedJobs }}</h3>
                    <p class="text-muted mb-0 small">Approved Jobs</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="bi bi-clock-fill text-white fs-5"></i>
                        </div>
                        <span class="badge" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e; font-weight: 600;">Review</span>
                    </div>
                    <h3 class="mb-1 fw-bold" style="color: #111827;">{{ $pendingJobs }}</h3>
                    <p class="text-muted mb-0 small">Pending Approval</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-8 d-none d-md-block">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold">Recent Job Posts</h6>
                </div>
                <div class="card-body p-0">
                    @if($recentJobs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background: linear-gradient(180deg, #fafbfc 0%, #f9fafb 100%);">
                                    <tr style="font-size: 0.75rem; text-transform: uppercase; color: #374151;">
                                        <th class="ps-4 py-3">Job Title</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3">Applications</th>
                                        <th class="py-3">Posted</th>
                                        <th class="pe-4 py-3 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentJobs as $job)
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <div class="fw-semibold text-dark">{{ $job->title }}</div>
                                                <small class="text-muted">{{ $job->location->city ?? 'Not Mentioned' }}</small>
                                            </td>
                                            <td class="py-3">
                                                @if($job->status == 'approved')
                                                    <span class="badge" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46;">Approved</span>
                                                @elseif($job->status == 'pending')
                                                    <span class="badge" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e;">Pending</span>
                                                @else
                                                    <span class="badge" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b;">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="py-3">
                                                <span class="badge" style="background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%); color: #5b21b6; font-weight: 600;">
                                                    <i class="bi bi-people-fill me-1"></i>{{ $job->applications_count ?? 0 }}
                                                </span>
                                            </td>
                                            <td class="py-3"><small class="text-muted">{{ $job->created_at->diffForHumans() }}</small></td>
                                            <td class="pe-4 py-3 text-end">
                                                <a href="{{ route('user.jobs.edit', $job) }}" class="btn btn-sm btn-light me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3 text-center border-top">
                            <a href="{{ route('user.jobs.index') }}" class="text-decoration-none fw-semibold" style="color: #3b82f6;">
                                View All Jobs <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-briefcase" style="font-size: 3rem; color: #d1d5db;"></i>
                            </div>
                            <h6 class="fw-bold mb-2">No jobs posted yet</h6>
                            <p class="text-muted mb-3">Start by posting your first job</p>
                            <a href="{{ route('user.jobs.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-2"></i>Post Your First Job
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card d-none d-md-block" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none;">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <i class="bi bi-plus-circle-fill" style="font-size: 2.5rem; opacity: 0.9;"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Post a New Job</h5>
                    <p class="mb-4" style="opacity: 0.9;">Reach thousands of job seekers looking for opportunities in Global.</p>
                    <a href="{{ route('user.jobs.create') }}" class="btn btn-light w-100">
                        <i class="bi bi-briefcase-fill me-2"></i>Create Job Posting
                    </a>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3"><i class="bi bi-lightbulb text-warning me-2"></i>Quick Tips</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 small">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span class="text-muted">Include detailed job descriptions</span>
                        </li>
                        <li class="mb-2 small">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span class="text-muted">Specify clear requirements</span>
                        </li>
                        <li class="mb-0 small">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span class="text-muted">Respond to applications quickly</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

