@extends('layouts.admin')

@section('header_title', 'Users Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 text-heading fw-bold">All Users</h4>
            <p class="text-muted mb-0">Manage user accounts and roles.</p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="bi bi-person-plus-fill me-2"></i>Add New User
        </button>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                    <thead class="table-light">
                        <tr class="text-muted text-uppercase" style="font-size: 0.75rem;">
                            <th scope="col" class="ps-4">User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Joined</th>
                            <th scope="col" class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=6366f1&color=fff&bold=true"
                                            class="rounded-circle me-3" width="40" height="40">
                                        <div>
                                            <h6 class="mb-0 fw-semibold text-dark">{{ $user->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted">{{ $user->email }}</td>
                                <td>
                                    @if($user->role_id == 1)
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">
                                            <i class="bi bi-shield-fill-check me-1"></i>Admin
                                        </span>
                                    @elseif($user->role_id == 2)
                                        <span
                                            class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
                                            <i class="bi bi-briefcase-fill me-1"></i>Employer
                                        </span>
                                    @elseif($user->role_id == 4)
                                        <span
                                            class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">
                                            <i class="bi bi-person-badge-fill me-1"></i>Moderator
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="text-end pe-4">
                                    @if($user->id === auth()->id())
                                        <span class="badge bg-info-subtle text-info">Current User</span>
                                    @else
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#editUserModal{{ $user->id }}">
                                                <i class="bi bi-pencil me-1"></i>Edit Role
                                            </button>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>

                            <!-- Edit Role Modal -->
                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Edit User Role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body px-4">
                                                <input type="hidden" name="name" value="{{ $user->name }}">
                                                <input type="hidden" name="email" value="{{ $user->email }}">

                                                <div class="mb-3">
                                                    <label class="form-label fw-medium">User</label>
                                                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=6366f1&color=fff&bold=true"
                                                            class="rounded-circle me-3" width="48" height="48">
                                                        <div>
                                                            <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                                            <small class="text-muted">{{ $user->email }}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="role_id{{ $user->id }}"
                                                        class="form-label fw-medium">Role</label>
                                                    <select class="form-select" id="role_id{{ $user->id }}" name="role_id">
                                                        @foreach($roles as $role)
                                                            @if($role->id !== 3)
                                                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                                    {{ ucfirst($role->name) }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-check-lg me-1"></i>Update Role
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="mb-3">
                                        <div class="avatar-lg bg-light text-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 64px; height: 64px;">
                                            <i class="bi bi-people fs-2"></i>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold">No users found</h5>
                                    <p class="text-muted">Users will appear here once they register.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            {{ $users->onEachSide(1)->links() }}
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body px-4 py-4">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                placeholder="e.g. John Doe">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="8"
                                placeholder="Minimum 8 characters">
                        </div>
                        <div class="mb-3">
                            <label for="new_role_id" class="form-label fw-medium">Role</label>
                            <select class="form-select" id="new_role_id" name="role_id" required>
                                <option value="" selected disabled>Select Role</option>
                                @foreach($roles as $role)
                                    @if($role->id !== 3)
                                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i>Create User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection