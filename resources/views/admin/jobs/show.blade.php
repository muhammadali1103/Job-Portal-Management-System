@extends('layouts.admin')

@section('header_title', 'Job Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 text-heading fw-bold">Job Details</h4>
            <p class="text-muted mb-0">Review and manage job posting</p>
        </div>
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Jobs
        </a>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8 mb-4">
            <!-- Job Header Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-grow-1">
                            <h3 class="mb-2 fw-bold text-heading">{{ $job->title }}</h3>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">
                                    <i class="bi bi-briefcase me-1"></i>{{ $job->job_type }}
                                </span>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $job->location->city ?? 'Not Mentioned' }}
                                </span>
                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3">
                                    <i class="bi bi-tags me-1"></i>{{ $job->category->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </div>
                        @if($job->status == 'approved')
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                                <i class="bi bi-check-circle-fill me-1"></i>Approved
                            </span>
                        @elseif($job->status == 'pending')
                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill">
                                <i class="bi bi-clock-fill me-1"></i>Pending
                            </span>
                        @elseif($job->status == 'rejected')
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill">
                                <i class="bi bi-x-circle-fill me-1"></i>Rejected
                            </span>
                        @endif
                    </div>

                    <div class="row g-3 mb-4">
                        @if($job->salary_min && $job->salary_max)
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="bg-success-subtle text-success rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-currency-dollar fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Salary Range</small>
                                    <strong class="text-dark">{{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}</strong>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($job->experience)
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary-subtle text-primary rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-award fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Experience</small>
                                    <strong class="text-dark">{{ $job->experience }}</strong>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($job->qualification)
                        <div class="col-md-12">
                            <div class="d-flex align-items-start">
                                <div class="bg-info-subtle text-info rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-mortarboard fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Qualification</small>
                                    <strong class="text-dark">{{ $job->qualification }}</strong>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <hr class="my-4">

                    <div>
                        <h5 class="fw-bold mb-3"><i class="bi bi-file-text text-primary me-2"></i>Job Description</h5>
                        <div class="text-muted" style="line-height: 1.8; white-space: pre-wrap;">{{ $job->description }}</div>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            @if($job->status != 'approved' || $job->status == 'approved')
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-gear me-2 text-primary"></i>Job Actions</h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex gap-2 flex-wrap">
                        @if($job->status == 'pending')
                            <form action="{{ route('admin.jobs.approve', $job) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i>Approve Job
                                </button>
                            </form>
                            <form action="{{ route('admin.jobs.reject', $job) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-danger">
                                    <i class="bi bi-x-circle me-1"></i>Reject Job
                                </button>
                            </form>
                        @endif

                        @if($job->status == 'approved')
                            <form action="{{ route('admin.jobs.reject', $job) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-warning">
                                    <i class="bi bi-pause-circle me-1"></i>Suspend Job
                                </button>
                            </form>
                        @endif

                        @if($job->status == 'rejected')
                            <form action="{{ route('admin.jobs.approve', $job) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i>Approve Job
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger">
                                <i class="bi bi-trash me-1"></i>Delete Job
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Company Info -->
            @if($job->company_name || $job->company_logo)
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-building me-2 text-primary"></i>Company Information</h6>
                </div>
                <div class="card-body p-4 text-center">
                    @if($job->company_logo)
                        <img src="{{ Storage::url($job->company_logo) }}" alt="Company Logo" class="rounded-3 mb-3" style="max-width: 120px; max-height: 120px; object-fit: contain;">
                    @endif
                    @if($job->company_name)
                        <h5 class="fw-bold text-dark mb-0">{{ $job->company_name }}</h5>
                    @endif
                </div>
            </div>
            @endif

            <!-- Employer Info -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-person-badge me-2 text-primary"></i>Employer Details</h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ $job->user->name }}&background=6366f1&color=fff&bold=true" 
                             class="rounded-circle me-3" width="56" height="56">
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">{{ $job->user->name }}</h6>
                            <small class="text-muted">{{ $job->user->email }}</small>
                        </div>
                    </div>
                    <div class="pt-3 border-top">
                        <small class="text-muted d-block mb-1">Member Since</small>
                        <strong class="text-dark">{{ $job->user->created_at->format('F Y') }}</strong>
                    </div>
                </div>
            </div>

            <!-- Meta Info -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>Meta Information</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Posted On</small>
                        <strong class="text-dark">{{ $job->created_at->format('M d, Y \a\t h:i A') }}</strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Last Updated</small>
                        <strong class="text-dark">{{ $job->updated_at->diffForHumans() }}</strong>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Job ID</small>
                        <code class="bg-light px-2 py-1 rounded">#{{ $job->id }}</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
