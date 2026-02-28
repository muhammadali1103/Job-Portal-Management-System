@extends('layouts.admin')

@section('header_title', 'Locations Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 text-heading fw-bold">Job Locations</h4>
            <p class="text-muted mb-0">Manage job locations.</p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLocationModal">
            <i class="bi bi-plus-lg me-1"></i> Add Location
        </button>
    </div>

    <!-- Search Bar -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body py-3">
            <form method="GET" action="{{ route('admin.locations.index') }}" class="d-flex gap-2">
                <div class="flex-grow-1">
                    <input type="text" name="search" class="form-control" placeholder="Search locations..."
                        value="{{ $search ?? '' }}">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i>Search
                </button>
                @if($search)
                    <a href="{{ route('admin.locations.index') }}" class="btn btn-light">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Add Location Modal -->
    <div class="modal fade" id="addLocationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('admin.locations.store') }}" method="POST">
                @csrf
                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Add New Location</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label for="country" class="form-label fw-medium">Country</label>
                            <input type="text" class="form-control" id="country" name="country" required
                                placeholder="e.g. Pakistan" value="{{ old('country', 'Pakistan') }}">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label fw-medium">Location</label>
                            <input type="text" class="form-control" id="city" name="city" required
                                placeholder="e.g. Salmiya">
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Save Location
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                    <thead class="table-light">
                        <tr class="text-muted text-uppercase" style="font-size: 0.75rem;">
                            <th scope="col" class="ps-4">Country</th>
                            <th scope="col">Location</th>
                            <th scope="col">Jobs Count</th>
                            <th scope="col" class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $location)
                            <tr>
                                <td class="ps-4">
                                    <h6 class="mb-0 fw-semibold text-dark">{{ $location->country }}</h6>
                                </td>
                                <td class="text-muted">{{ $location->city }}</td>
                                <td>
                                    <span
                                        class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
                                        {{ $location->jobs_count ?? 0 }} Jobs
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editLocationModal{{ $location->id }}">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </button>
                                        <form action="{{ route('admin.locations.destroy', $location) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this location?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editLocationModal{{ $location->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('admin.locations.update', $location) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Edit Location</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body px-4">
                                                <div class="mb-3">
                                                    <label for="country{{ $location->id }}"
                                                        class="form-label fw-medium">Country</label>
                                                    <input type="text" class="form-control" id="country{{ $location->id }}"
                                                        name="country" value="{{ $location->country }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="city{{ $location->id }}"
                                                        class="form-label fw-medium">Location</label>
                                                    <input type="text" class="form-control" id="city{{ $location->id }}"
                                                        name="city" value="{{ $location->city }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-check-lg me-1"></i>Update Location
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="mb-3">
                                        <div class="avatar-lg bg-light text-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 64px; height: 64px;">
                                            <i class="bi bi-geo-alt fs-2"></i>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold">No locations found</h5>
                                    <p class="text-muted">Create your first location to get started.</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addLocationModal">
                                        <i class="bi bi-plus-lg me-1"></i> Add Location
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
