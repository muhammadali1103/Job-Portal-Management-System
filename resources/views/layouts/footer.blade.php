<footer class="footer-professional">
    <div class="container">
        <div class="row g-4">
            <!-- Brand Column -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-4">
                    <x-brand-mark class="footer-logo-mark" aria-hidden="true" />
                    <span class="logo-text text-white">Jobs <span class="text-primary">Portal</span></span>
                </div>
                <p class="footer-description">
                    A modern job portal connecting top talent with leading employers.
                    Find your next career opportunity or hire the best professionals today.
                </p>
                <div class="social-links mt-4">
                    <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <!-- Browse Jobs Column (Requested) -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-title">Browse Jobs</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('jobs.index', ['search' => 'Sales']) }}">Sales Jobs in Global</a></li>
                    <li><a href="{{ route('jobs.index', ['search' => 'Engineer']) }}">Engineer Jobs in Global</a></li>
                    <li><a href="{{ route('jobs.index', ['search' => 'Supervisor']) }}">Supervisor Jobs in Global</a>
                    </li>
                    <li><a href="{{ route('jobs.index', ['search' => 'Accountant']) }}">Accountant Jobs in Global</a>
                    </li>
                    <li><a href="{{ route('jobs.index', ['search' => 'Driver']) }}">Driver Jobs in Global</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h4 class="footer-title">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li><a href="{{ route('jobs.index') }}">All Jobs</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('register') }}">Post a Job</a></li>
                </ul>
            </div>

            <!-- Account -->
            <div class="col-lg-2 col-md-6">
                <h4 class="footer-title">Account</h4>
                <ul class="footer-links">
                    @auth
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-link p-0 border-0 bg-transparent text-decoration-none"
                                    style="color: #8b949e; font-size: inherit;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>

        <div class="footer-bottom mt-5 pt-4 border-top border-secondary">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-white">&copy; {{ date('Y') }} Jobs Portal. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <ul class="footer-legal mb-0">
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-professional {
        background-color: #0d1117;
        color: #8b949e;
        padding: 5rem 0 2rem;
        margin-top: auto;
    }

    .footer-brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .footer-brand .logo-text {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .footer-logo-mark {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
    }

    .logo-icon-box.small {
        width: 32px;
        height: 32px;
        font-size: 1rem;
        background: linear-gradient(135deg, #0969da 0%, #054ea3 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .footer-description {
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 0;
        max-width: 300px;
    }

    .footer-title {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
    }

    .footer-links a {
        color: #8b949e;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-block;
    }

    .footer-links a:hover {
        color: #2f81f7;
        transform: translateX(4px);
    }

    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-link {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        text-decoration: none;
        transition: all 0.3s;
    }

    .social-link:hover {
        background: #0969da;
        color: white;
        transform: translateY(-3px);
    }

    .footer-contact {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-contact li {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .border-secondary {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    .footer-legal {
        list-style: none;
        padding: 0;
        margin: 0;
        display: inline-flex;
        gap: 1.5rem;
    }

    .footer-legal a {
        color: #8b949e;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .footer-legal a:hover {
        color: #ffffff;
        text-decoration: underline;
    }
</style>

