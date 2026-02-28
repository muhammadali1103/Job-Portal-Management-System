<x-guest-layout>
    <div class="mb-4">
        <h2 class="text-center h4 mb-3 fw-bold">Secure Area</h2>
        <p class="text-center text-muted text-sm">Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password"
                name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-primary">
            Confirm Password
        </button>
    </form>
</x-guest-layout>