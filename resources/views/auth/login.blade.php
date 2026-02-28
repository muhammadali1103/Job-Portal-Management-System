<x-guest-layout>
    <div class="mb-2 text-center">
        <h2 class="h6 fw-bold mb-0">Welcome Back</h2>
        <p class="text-muted mb-0" style="font-size: 0.7rem;">Sign in to your account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="alert alert-success py-2 px-3 mb-3 small" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-2">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                value="{{ old('email') }}" required autofocus autocomplete="username" aria-label="Email Address"
                aria-describedby="email-help">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password"
                name="password" required autocomplete="current-password" aria-label="Password"
                aria-describedby="password-help">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember"
                    style="width: 1rem; height: 1rem;">
                <label for="remember_me" class="form-check-label text-muted" style="font-size: 0.8rem;">Remember
                    me</label>
            </div>

            @if (Route::has('password.request'))
                <a class="text-decoration-none fw-bold" href="{{ route('password.request') }}"
                    style="color: #0969da; font-size: 0.8rem;">
                    Forgot Password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary" aria-label="Sign in to your account">
            Sign In
        </button>

        <div class="auth-links mt-3">
            <p class="mb-2 text-muted small">Don't have an account?</p>
            <a href="{{ route('register') }}" class="btn-outline">Create Account</a>
        </div>
    </form>
</x-guest-layout>