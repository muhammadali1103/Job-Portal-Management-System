@extends('layouts.app')

@section('title', 'Pending Jobs')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4"><i class="bi bi-hourglass-split me-2"></i>Pending Job Approvals</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                @if($pendingJobs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Job Title</th>
                                    <th>Company</th>
                                    <th>Category</th>
                                    <th>Location</th>
                                    <th>Posted</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingJobs as $job)
                                    <tr>
                                        <td class="fw-bold">{{ $job->title }}</td>
                                        <td>{{ $job->user->name }}</td>
                                        <td><span class="badge bg-info">{{ $job->category->name }}</span></td>
                                        <td>{{ $job->location->city }}</td>
                                        <td>{{ $job->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-secondary"
                                                    target="_blank">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <form action="{{ route('admin.jobs.approve', $job) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success"
                                                        onclick="return confirm('Approve this job?')">
                                                        <i class="bi bi-check-circle"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.jobs.reject', $job) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Reject this job?')">
                                                        <i class="bi bi-x-circle"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 48px;"></i>
                        <p class="mt-3">No pending jobs to approve!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection