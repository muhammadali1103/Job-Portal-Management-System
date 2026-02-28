@extends('layouts.user')

@section('header_title', 'My Job Posts')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h4 class="mb-2 fw-bold" style="font-size: 1.75rem; color: #111827;">My Job Postings</h4>
            <p class="text-muted mb-0">Manage all your job listings in one place.</p>
        </div>
        <a href="{{ route('user.jobs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Post New Job
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <!-- Desktop Table View -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                    <thead style="background: linear-gradient(180deg, #fafbfc 0%, #f9fafb 100%);">
                        <tr style="font-size: 0.75rem; text-transform: uppercase; color: #374151; letter-spacing: 0.025em;">
                            <th scope="col" class="ps-4 py-3">Job Details</th>
                            <th scope="col" class="py-3">Category</th>
                            <th scope="col" class="py-3">Location</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3 text-center">Performance</th>
                            <th scope="col" class="py-3">Posted</th>
                            <th scope="col" class="pe-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        @if($job->company_logo)
                                            <img src="{{ Storage::url($job->company_logo) }}" class="rounded me-3" width="40"
                                                height="40" style="object-fit: contain;">
                                        @else
                                            <div class="rounded me-3 d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                                                <i class="bi bi-briefcase-fill text-white"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0 fw-semibold text-dark">{{ $job->title }}</h6>
                                            <small class="text-muted">{{ $job->job_type }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge"
                                        style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af;">
                                        {{ $job->category->name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $job->location->city ?? 'Not Mentioned' }}
                                    </small>
                                </td>
                                <td class="py-3">
                                    @if($job->status == 'approved')
                                        <span class="badge"
                                            style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46;">
                                            <i class="bi bi-check-circle-fill me-1"></i>Approved
                                        </span>
                                    @elseif($job->status == 'pending')
                                        <span class="badge"
                                            style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e;">
                                            <i class="bi bi-clock-fill me-1"></i>Pending
                                        </span>
                                    @else
                                        <span class="badge"
                                            style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b;">
                                            <i class="bi bi-x-circle-fill me-1"></i>Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 text-center">
                                    <div class="d-flex justify-content-center gap-3">
                                        <div class="text-muted" title="Views">
                                            <i class="bi bi-eye me-1"></i> <span
                                                class="fw-semibold">{{ number_format($job->views_count) }}</span>
                                        </div>
                                        <div class="text-success" title="Applications (Clicks)">
                                            <i class="bi bi-hand-index-thumb me-1"></i> <span
                                                class="fw-semibold">{{ number_format($job->clicks_count) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3"><small class="text-muted">{{ $job->created_at->format('M d, Y') }}</small></td>
                                <td class="pe-4 py-3 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('jobs.show', $job) }}" target="_blank"
                                            class="btn btn-sm btn-light border btn-hover-view" title="View Job">
                                            <i class="bi bi-eye text-primary"></i>
                                        </a>
                                        <a href="{{ route('user.jobs.edit', $job) }}"
                                            class="btn btn-sm btn-light border btn-hover-edit" title="Edit Job">
                                            <i class="bi bi-pencil text-warning"></i>
                                        </a>
                                        <form action="{{ route('user.jobs.destroy', $job) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this job?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-light border btn-hover-delete" title="Delete Job">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="mb-3">
                                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 64px; height: 64px; background: #f3f4f6;">
                                            <i class="bi bi-briefcase" style="font-size: 2rem; color: #9ca3af;"></i>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold mb-2">No jobs posted yet</h5>
                                    <p class="text-muted mb-3">Start by creating your first job posting</p>
                                    <a href="{{ route('user.jobs.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg me-2"></i>Post Your First Job
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile List View -->
            <div class="d-md-none">
                @forelse($jobs as $job)
                    <div class="p-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex align-items-center">
                                @if($job->company_logo)
                                    <img src="{{ Storage::url($job->company_logo) }}" class="rounded me-3" width="40" height="40"
                                        style="object-fit: contain;">
                                @else
                                    <div class="rounded me-3 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                                        <i class="bi bi-briefcase-fill text-white"></i>
                                    </div>
                                @endif
                                <div style="flex: 1; min-width: 0;">
                                    <h6 class="mb-0 fw-bold text-dark text-truncate" style="max-width: 200px;">{{ $job->title }}
                                    </h6>
                                    <small class="text-muted d-block">{{ $job->category->name ?? 'Uncategorized' }} •
                                        {{ $job->location->city ?? 'Not Mentioned' }}</small>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('jobs.show', $job) }}" target="_blank"
                                    class="btn btn-sm btn-light border btn-hover-view" title="View">
                                    <i class="bi bi-eye text-primary"></i>
                                </a>
                                <a href="{{ route('user.jobs.edit', $job) }}" class="btn btn-sm btn-light border btn-hover-edit"
                                    title="Edit">
                                    <i class="bi bi-pencil text-warning"></i>
                                </a>
                                <form action="{{ route('user.jobs.destroy', $job) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-light border btn-hover-delete" title="Delete">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div>
                                @if($job->status == 'approved')
                                    <span
                                        class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">Approved</span>
                                @elseif($job->status == 'pending')
                                    <span
                                        class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2">Pending</span>
                                @else
                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2">Rejected</span>
                                @endif
                            </div>
                            <div class="d-flex gap-3 text-muted small">
                                <span><i class="bi bi-eye me-1"></i>{{ $job->views_count }}</span>
                                <span><i class="bi bi-hand-index-thumb me-1"></i>{{ $job->clicks_count }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-briefcase" style="font-size: 2.5rem; color: #d1d5db;"></i>
                        </div>
                        <h6 class="fw-bold">No jobs yet</h6>
                        <a href="{{ route('user.jobs.create') }}" class="btn btn-sm btn-primary mt-2">Post Job</a>
                    </div>
                @endforelse
            </div>
        </div>
        @if($jobs->hasPages())
            <div class="card-footer bg-white border-top py-3">
                {{ $jobs->onEachSide(1)->links() }}
            </div>
        @endif
    </div>

    <style>
        .btn-hover-view:hover {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }

        .btn-hover-view:hover i {
            color: white !important;
        }

        .btn-hover-edit:hover {
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
        }

        .btn-hover-edit:hover i {
            color: white !important;
        }

        .btn-hover-delete:hover {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .btn-hover-delete:hover i {
            color: white !important;
        }
    </style>
@endsection