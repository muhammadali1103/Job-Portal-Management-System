<x-guest-layout>
    <div class="mb-4">
        <h2 class="text-center h4 mb-3 fw-bold">Forgot Password?</h2>
        <p class="text-center text-muted text-sm">No problem. Just let us know your email address and we will email you
            a password reset link.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="alert alert-success mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-primary mb-3">
            Email Password Reset Link
        </button>

        <div class="auth-links">
            <a href="{{ route('login') }}" class="text-muted text-decoration-none">← Back to Login</a>
        </div>
    </form>
</x-guest-layout>