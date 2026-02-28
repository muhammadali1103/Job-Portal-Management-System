@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Employer Dashboard</h2>
            <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Post a New Job
            </a>
        </div>

        <!-- Stats or other info can go here -->

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white font-bold py-3">My Jobs</div>
            <div class="card-body p-0">
                @if($jobs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Job Title</th>
                                    <th>Status</th>
                                    <th>Applications</th>
                                    <th>Posted Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                    <tr>
                                        <td class="fw-bold">{{ $job->title }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $job->status == 'approved' ? 'bg-success' : ($job->status == 'pending' ? 'bg-warning' : 'bg-secondary') }}">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-dark rounded-pill">{{ $job->applications_count }}</span>
                                        </td>
                                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-secondary">View</a>
                                                <a href="{{ route('employer.jobs.edit', $job) }}"
                                                    class="btn btn-outline-primary">Edit</a>
                                                <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        onclick="return confirm('Delete this job?')">Delete</button>
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
                        <p>You haven't posted any jobs yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection