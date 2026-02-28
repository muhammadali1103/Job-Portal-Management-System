@extends('layouts.user')

@section('header_title', 'My Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-4">
                <h4 class="mb-2 fw-bold" style="font-size: 1.75rem; color: #111827;">Account Settings</h4>
                <p class="text-muted mb-0">Manage your profile information and password.</p>
            </div>

            <!-- Profile Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                            <i class="bi bi-person-fill text-white"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Profile Information</h6>
                            <small class="text-muted">Update your account's profile information and email address.</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg me-2"></i>Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="bi bi-shield-lock-fill text-white"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Update Password</h6>
                            <small class="text-muted">Ensure your account is using a long, random password to stay
                                secure.</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-12">
                                <label for="current_password" class="form-label">Current Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">New Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-shield-check me-2"></i>Update Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="card" style="border-color: #fecaca;">
                <div class="card-header" style="background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 40px; height: 40px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                            <i class="bi bi-exclamation-triangle-fill text-white"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold text-danger">Delete Account</h6>
                            <small class="text-muted">Permanently delete your account and all associated data.</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                        Before deleting your account, please download any data or information that you wish to retain.
                    </p>

                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteAccountModal">
                        <i class="bi bi-trash me-2"></i>Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: none;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);">
                            <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <p class="text-center mb-4">
                        Are you sure you want to delete your account? This action cannot be undone and all your data will be
                        permanently deleted.
                    </p>

                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Enter your password to confirm</label>
                            <input type="password" class="form-control" id="delete_password" name="password" required
                                placeholder="Your password">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger flex-fill">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection