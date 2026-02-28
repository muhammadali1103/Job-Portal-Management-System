@extends('layouts.admin')

@section('header_title', 'Manage Job Roles')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Header & Actions -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="mb-0 text-muted">Manage the list of job roles available for selection.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                    <i class="bi bi-plus-lg me-2"></i>Add New Role
                </button>
            </div>

            <!-- Search Bar -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body py-3">
                    <form method="GET" action="{{ route('admin.job-roles.index') }}" class="d-flex gap-2">
                        <div class="flex-grow-1">
                            <input type="text" name="search" class="form-control" placeholder="Search job roles..."
                                value="{{ $search ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i>Search
                        </button>
                        @if($search)
                            <a href="{{ route('admin.job-roles.index') }}" class="btn btn-light">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Job Roles Table -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Job Roles</h5>
                        <div class="text-muted small">
                            Total Roles: {{ $jobRoles->count() }}
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4" style="width: 50%;">Role Name</th>
                                    <th class="text-center">Assigned Jobs</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobRoles as $role)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="bi bi-briefcase text-primary"></i>
                                                </div>
                                                <span class="fw-bold text-dark">{{ $role->name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($role->total > 0)
                                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                                    {{ $role->total }} Jobs
                                                </span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
                                                    Unused
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-4">
                                            <button type="button" class="btn btn-sm btn-outline-primary me-2"
                                                data-bs-toggle="modal" data-bs-target="#editRoleModal"
                                                data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}"
                                                data-role-url="{{ route('admin.job-roles.update', $role->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteRoleModal" data-role-name="{{ $role->name }}"
                                                data-role-url="{{ route('admin.job-roles.destroy', $role->id) }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                                No job roles found.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Role Modal -->
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold">Add New Job Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.job-roles.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-4">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" required
                            placeholder="e.g. Sales Manager">
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Create Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Job Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRoleForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body py-4">
                        <label for="edit_name" class="form-label">Role Name</label>
                        <input type="text" class="form-control form-control-lg" id="edit_name" name="name" required>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger">Delete Job Role?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <p class="mb-0 text-muted">Are you sure you want to delete <strong id="modalRoleName"
                            class="text-dark"></strong>?</p>
                    <p class="small text-danger mt-2 mb-0"><i class="bi bi-exclamation-triangle me-1"></i> This role will be
                        removed from all active job postings.</p>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteRoleForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill px-4">Delete Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Edit Modal Handler
            const editModal = document.getElementById('editRoleModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const name = button.getAttribute('data-role-name');
                    const url = button.getAttribute('data-role-url');

                    document.getElementById('edit_name').value = name;
                    document.getElementById('editRoleForm').action = url;
                });
            }

            // Delete Modal Handler
            const deleteModal = document.getElementById('deleteRoleModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const name = button.getAttribute('data-role-name');
                    const url = button.getAttribute('data-role-url');

                    document.getElementById('modalRoleName').textContent = name;
                    document.getElementById('deleteRoleForm').action = url;
                });
            }
        });
    </script>
@endsection