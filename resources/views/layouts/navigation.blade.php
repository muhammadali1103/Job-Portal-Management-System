<nav class="nav-professional">
    <div class="container">
        <div class="nav-content">
            <a href="{{ route('home') }}" class="nav-logo">
                <x-brand-mark class="logo-mark" aria-hidden="true" />
                <span class="logo-text">Jobs <span class="text-primary">Portal</span></span>
            </a>

            <!-- Mobile Menu Toggle -->
            <button class="nav-hamburger" id="navToggle" onclick="toggleMenu()" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- Navigation Links -->
            <div class="nav-links" id="navLinks">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('jobs.index') }}">Jobs</a>
                <a href="{{ route('categories.index') }}">Categories</a>
                <a href="{{ route('about') }}">About Us</a>
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="mobile-logout">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}" class="btn-nav-register">Post a Job</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
    .nav-professional {
        background: white;
        border-bottom: 1px solid #d0d7de;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        padding: 0.5rem 0;
    }

    .nav-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        position: relative;
        gap: 0;
    }

    /* Logo Design */
    .nav-logo,
    .mobile-logo {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        /* Reduced gap */
        text-decoration: none;
        z-index: 1001;
        flex-shrink: 0;
    }

    .logo-icon-box {
        width: 32px;
        /* Back to compact */
        height: 32px;
        background: linear-gradient(135deg, #0969da 0%, #054ea3 100%);
        border-radius: 8px;
        /* Slightly less rounded */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        box-shadow: 0 4px 10px rgba(9, 105, 218, 0.2);
    }

    .logo-mark {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
    }

    .logo-text {
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem;
        /* Standard H4 size */
        font-weight: 700;
        /* Slightly less bold */
        color: #0d1117;
        letter-spacing: -0.5px;
        line-height: 1;
    }

    .logo-text .text-primary {
        color: #0969da !important;
    }

    /* Mobile Menu Header */
    .mobile-menu-header {
        display: none;
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #f6f8fa;
    }

    /* Hamburger Menu */
    .nav-hamburger {
        display: none;
        flex-direction: column;
        gap: 5px;
        /* Slightly wider gap */
        background: #f6f8fa;
        /* Light background box */
        border: 1px solid #d0d7de;
        /* Subtle border */
        cursor: pointer;
        padding: 0.6rem;
        /* Comfortable touch target */
        z-index: 1002;
        border-radius: 8px;
        /* Rounded corners */
        transition: all 0.2s ease;
    }

    .nav-hamburger:hover {
        background: #eaf5ff;
        /* Light blue on hover */
        border-color: #0969da;
        /* Blue border on hover */
    }

    .nav-hamburger span {
        width: 24px;
        height: 2.5px;
        /* Slightly thicker */
        background: #0d1117;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 4px;
    }

    .nav-hamburger.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .nav-hamburger.active span:nth-child(2) {
        opacity: 0;
    }

    .nav-hamburger.active span:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        /* Tighter spacing */
    }

    .nav-links a {
        color: #57606a;
        text-decoration: none;
        font-size: 0.95rem;
        /* Standard body size */
        font-weight: 600;
        transition: color 0.2s;
        white-space: nowrap;
    }

    .nav-links a:hover {
        color: #0d1117;
    }

    .nav-link-cta {
        color: #0969da !important;
        font-weight: 600 !important;
    }

    .btn-nav-register {
        background: #0969da;
        color: white !important;
        padding: 0.375rem 0.875rem;
        /* Smaller button */
        border-radius: 6px;
        font-size: 0.9rem;
        /* Smaller text */
        white-space: nowrap;
    }

    .btn-nav-register:hover {
        background: #0860ca;
        color: white !important;
    }

    .mobile-logout {
        display: none;
    }

    .logout-btn {
        width: 100%;
        text-align: left;
        padding: 1rem 0;
        border: none;
        background: none;
        color: #cf222e;
        font-size: 0.9375rem;
        font-weight: 500;
        cursor: pointer;
        border-bottom: 1px solid #f6f8fa;
    }

    /* Mobile Menu */
    @media (max-width: 900px) {
        .nav-content {
            justify-content: space-between !important;
            gap: 0;
            padding: 0.5rem 1rem;
        }

        .nav-hamburger {
            display: flex;
            margin-left: 0;
        }

        .mobile-menu-header {
            display: none;
        }

        .mobile-logout {
            display: block;
        }

        .nav-links {
            position: fixed;
            top: 60px;
            /* Adjusted for smaller header */
            right: -100%;
            width: 100%;
            max-width: 100%;
            height: calc(100vh - 60px);
            background: white;
            flex-direction: column;
            align-items: stretch;
            gap: 0;
            padding: 1rem 2rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            z-index: 990;
        }

        .nav-links.active {
            right: 0;
        }

        .nav-links a {
            padding: 1rem 0;
            border-bottom: 1px solid #f6f8fa;
            font-size: 1rem;
            display: block;
        }

        .btn-nav-register {
            text-align: center;
            margin-top: 1.5rem;
            padding: 0.75rem;
            width: 100%;
            display: block;
            font-size: 1rem;
        }
    }
</style>

<script>
    function toggleMenu() {
        const navToggle = document.getElementById('navToggle');
        const navLinks = document.getElementById('navLinks');
        const navContent = document.querySelector('.nav-content');

        if (navToggle && navLinks) {
            navToggle.classList.toggle('active');
            navLinks.classList.toggle('active');
            if (navContent) navContent.classList.toggle('menu-active');
        }
    }

    // Close menu when clicking outside
    document.addEventListener('click', function (event) {
        const navToggle = document.getElementById('navToggle');
        const navLinks = document.getElementById('navLinks');
        const navContent = document.querySelector('.nav-content');

        if (navToggle && navLinks && navToggle.classList.contains('active')) {
            if (!navToggle.contains(event.target) && !navLinks.contains(event.target)) {
                navToggle.classList.remove('active');
                navLinks.classList.remove('active');
                if (navContent) navContent.classList.remove('menu-active');
            }
        }
    });
</script>
