@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">My Applications</h2>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                @if($applications->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Job Title</th>
                                    <th>Company</th>
                                    <th>Location</th>
                                    <th>Applied On</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $app)
                                    <tr>
                                        <td class="fw-bold">
                                            <a href="{{ route('jobs.show', $app->job) }}" class="text-decoration-none">
                                                {{ $app->job->title }}
                                            </a>
                                        </td>
                                        <td>{{ $app->job->user->name }}</td>
                                        <td>{{ $app->job->location->city }}</td>
                                        <td>{{ $app->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $app->status == 'shortlisted' ? 'bg-success' : ($app->status == 'rejected' ? 'bg-danger' : 'bg-primary') }}">
                                                {{ ucfirst($app->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-5 text-center text-muted">
                        <p>You haven't applied to any jobs yet.</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary mt-3">Browse Jobs</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection