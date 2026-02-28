@extends('layouts.admin')

@section('header_title', 'My Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-4">
                <h4 class="mb-1 text-heading fw-bold">Account Settings</h4>
                <p class="text-muted mb-0">Manage your profile information and security.</p>
            </div>

            <div class="row g-4">
                <!-- Profile Information -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white py-3 border-0">
                            <h6 class="mb-0 fw-bold">
                                <i class="bi bi-person-circle me-2 text-primary"></i>Profile Information
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <!-- Profile Avatar -->
                            <div class="text-center mb-4">
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=6366f1&color=fff&bold=true&size=120"
                                    class="rounded-circle shadow-sm mb-3" width="120" height="120">
                                <h5 class="fw-bold text-dark mb-1">{{ auth()->user()->name }}</h5>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>

                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-medium">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label fw-medium">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-check-lg me-1"></i>Save Changes
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white py-3 border-0">
                            <h6 class="mb-0 fw-bold">
                                <i class="bi bi-shield-lock me-2 text-primary"></i>Security Settings
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="alert alert-info border-0 mb-4"
                                style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);">
                                <i class="bi bi-info-circle me-2"></i>
                                <small class="text-info-emphasis">Choose a strong password to keep your account
                                    secure.</small>
                            </div>

                            <form action="{{ route('admin.password.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="current_password" class="form-label fw-medium">Current Password</label>
                                    <input type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password" name="current_password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-medium">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-medium">Confirm New
                                        Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="bi bi-key me-1"></i>Update Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection