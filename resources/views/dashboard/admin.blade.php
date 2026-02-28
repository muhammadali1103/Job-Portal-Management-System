@extends('layouts.admin')

@section('header_title', 'Admin Dashboard')

@section('content')
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <div class="card-body position-relative p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                            <i class="bi bi-briefcase-fill text-white fs-4"></i>
                        </div>
                        <h6 class="card-title text-muted mb-0 fw-bold text-uppercase small ls-1">Total Jobs</h6>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <h2 class="display-5 fw-bold mb-0 text-dark">{{ $stats['total_jobs'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <div class="card-body position-relative p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="bi bi-people-fill text-white fs-4"></i>
                        </div>
                        <h6 class="card-title text-muted mb-0 fw-bold text-uppercase small ls-1">Total Users</h6>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <h2 class="display-5 fw-bold mb-0 text-dark">{{ $stats['total_users'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <div class="card-body position-relative p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="bi bi-hourglass-split text-white fs-4"></i>
                        </div>
                        <h6 class="card-title text-muted mb-0 fw-bold text-uppercase small ls-1">Pending Jobs</h6>
                    </div>
                    <div class="d-flex align-items-baseline justify-content-between w-100">
                        <h2 class="display-5 fw-bold mb-0 text-dark">{{ $stats['pending_jobs'] }}</h2>
                        @if($stats['pending_jobs'] > 0)
                            <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-warning text-white rounded-pill px-3">
                                Review <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <div class="card-body position-relative p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                            <i class="bi bi-file-earmark-text-fill text-white fs-4"></i>
                        </div>
                        <h6 class="card-title text-muted mb-0 fw-bold text-uppercase small ls-1">Applications</h6>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <h2 class="display-5 fw-bold mb-0 text-dark">{{ $stats['total_applications'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Jobs -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
            <h5 class="mb-0 fw-bold text-dark">Recent Job Postings</h5>
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-light">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Job Details</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Posted</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentJobs as $job)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $job->title }}</div>
                                    <div class="small text-muted">{{ $job->location->city ?? 'Location not set' }}</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="bi bi-building text-secondary small"></i>
                                        </div>
                                        <span>{{ $job->user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($job->status == 'approved')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">
                                            <i class="bi bi-check-circle-fill me-1"></i> Approved
                                        </span>
                                    @elseif($job->status == 'pending')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">
                                            <i class="bi bi-clock-fill me-1"></i> Pending
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">
                                            <i class="bi bi-x-circle-fill me-1"></i> Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $job->created_at->diffForHumans() }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.jobs.show', $job) }}" class="btn btn-sm btn-light">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection