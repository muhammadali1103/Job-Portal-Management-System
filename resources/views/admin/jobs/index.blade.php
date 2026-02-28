@extends('layouts.admin')

@section('header_title', 'Jobs Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 text-heading fw-bold">All Jobs</h4>
            <p class="text-muted mb-0">Manage and track all job postings.</p>
        </div>
        <div class="d-flex align-items-center gap-4">
            <!-- Auto Approval Toggle -->
            <form action="{{ route('admin.jobs.toggleAutoApprove') }}" method="POST" id="autoApproveForm"
                class="d-flex align-items-center bg-white border px-3 py-2 rounded-pill shadow-sm">
                @csrf
                <div class="form-check form-switch m-0 d-flex align-items-center">
                    <input class="form-check-input" type="checkbox" role="switch" id="autoApproveSwitch"
                        onchange="document.getElementById('autoApproveForm').submit()"
                        style="transform: scale(1.3); margin-right: 0.8rem; cursor: pointer;" {{ $autoApproveEnabled ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold text-dark user-select-none" for="autoApproveSwitch"
                        style="cursor: pointer;">
                        Auto Approval <span
                            class="text-muted fw-normal ms-1">({{ $autoApproveEnabled ? 'ON' : 'OFF' }})</span>
                    </label>
                </div>
            </form>

            <form action="{{ route('admin.jobs.approveAll') }}" method="POST"
                onsubmit="return confirm('Are you sure you want to approve all pending jobs?')">
                @csrf
                <button type="submit" class="btn btn-success fw-bold px-4 rounded-pill shadow-sm" {{ $pendingCount === 0 ? 'disabled' : '' }}>
                    <i class="bi bi-check-all me-2 fs-5"></i> Approve All Pending
                    @if($pendingCount > 0)
                        <span class="badge bg-white text-success ms-2">{{ $pendingCount }}</span>
                    @endif
                </button>
            </form>

            <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary fw-bold px-4 rounded-pill shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Post Job
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body py-3">
            <form method="GET" action="{{ route('admin.jobs.index') }}" class="d-flex gap-2">
                <div class="flex-grow-1">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by job title, company, or category..." value="{{ $search ?? '' }}">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i>Search
                </button>
                @if($search)
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-light">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                    <thead class="table-light">
                        <tr class="text-muted text-uppercase" style="font-size: 0.75rem;">
                            <th scope="col" class="ps-4">Job Details</th>
                            <th scope="col">Company</th>
                            <th scope="col">Category</th>
                            <th scope="col" class="text-center">Stats</th>
                            <th scope="col">Status</th>
                            <th scope="col">Posted</th>
                            <th scope="col" class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                            <tr>
                                <td class="ps-4">
                                    <h6 class="mb-0 fw-semibold text-dark">{{ $job->title }}</h6>
                                    <small class="text-muted">{{ $job->location->city ?? 'Not Mentioned' }} •
                                        {{ $job->job_type }}</small>
                                </td>
                                <td>
                                    @if($job->company_logo)
                                        <div class="d-flex align-items-center">
                                            <img src="{{ Storage::url($job->company_logo) }}" class="rounded-circle me-2" width="28"
                                                height="28" style="object-fit: cover;">
                                            <span class="fw-medium">{{ $job->company_name }}</span>
                                        </div>
                                    @elseif($job->company_name)
                                        <span class="fw-medium">{{ $job->company_name }}</span>
                                    @else
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-light text-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                                                style="width: 28px; height: 28px;">
                                                <i class="bi bi-building"></i>
                                            </div>
                                            <span class="text-muted">{{ $job->user->name }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td><span
                                        class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill">{{ $job->category->name ?? 'Uncategorized' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-3">
                                        <div class="d-flex align-items-center text-muted" data-bs-toggle="tooltip"
                                            title="Total Views">
                                            <i class="bi bi-eye me-1"></i> {{ number_format($job->views_count) }}
                                        </div>
                                        <div class="d-flex align-items-center text-success" data-bs-toggle="tooltip"
                                            title="Total Applications (Clicks)">
                                            <i class="bi bi-hand-index-thumb me-1"></i> {{ number_format($job->clicks_count) }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($job->status == 'approved')
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Approved</span>
                                    @elseif($job->status == 'pending')
                                        <span
                                            class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">Pending</span>
                                    @elseif($job->status == 'rejected')
                                        <span
                                            class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $job->status }}</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $job->created_at->format('M d, Y') }}</td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.jobs.show', $job) }}" class="btn btn-sm btn-light border"
                                            data-bs-toggle="tooltip" title="View Details">
                                            <i class="bi bi-eye text-primary"></i>
                                        </a>
                                        <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-sm btn-light border"
                                            data-bs-toggle="tooltip" title="Edit Job">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </a>
                                        <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this job?')"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border" data-bs-toggle="tooltip"
                                                title="Delete Job">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="mb-3">
                                        <div class="avatar-lg bg-light text-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 64px; height: 64px;">
                                            <i class="bi bi-search fs-2"></i>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold">No jobs found</h5>
                                    <p class="text-muted">Get started by posting a new job.</p>
                                    <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">Post New Job</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            {{ $jobs->onEachSide(1)->links() }}
        </div>
    </div>
@endsection