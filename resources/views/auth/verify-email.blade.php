<x-guest-layout>
    <div class="mb-4">
        <h2 class="text-center h4 mb-3 fw-bold">Verify Email</h2>
        <p class="text-center text-muted text-sm">Thanks for signing up! Before getting started, could you verify your
            email address by clicking on the link we just emailed to you? If you didn't receive the email, we will
            gladly send you another.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4" role="alert">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit" class="btn-primary">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-link text-muted text-decoration-none">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>