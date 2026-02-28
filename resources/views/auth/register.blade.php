<x-guest-layout>
    <div class="mb-2 text-center">
        <h2 class="h6 fw-bold mb-0">Create Account</h2>
        <p class="text-muted mb-0" style="font-size: 0.7rem;">Join us to find your dream job</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-1">
            <label for="name" class="form-label">Full Name</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-1">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                value="{{ old('email') }}" required autocomplete="username" placeholder="name@example.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-1">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password"
                name="password" required autocomplete="new-password" placeholder="Min 8 chars">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-2">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                type="password" name="password_confirmation" required autocomplete="new-password"
                placeholder="Confirm password">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-primary">
            Register
        </button>

        <div class="auth-links mt-2">
            <p class="mb-1 text-muted small" style="font-size: 0.7rem;">Already have an account?</p>
            <a href="{{ route('login') }}" class="btn-outline">Sign In</a>
        </div>
    </form>
</x-guest-layout>