@extends('layouts.app')

@section('title', 'About Jobs Portal – Connecting Talent with Opportunity')
@section('meta_description', 'Learn more about Jobs Portal, the premier destination for job seekers and employers in Global. Dedicated to bridging the hiring gap in the Local market.')
@section('meta_keywords', 'about global jobs, global recruitment platform, jobs in global, recruitment agencies global')

@section('content')
    <div class="bg-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Connecting Talent with Opportunity in Global</h1>
                    <p class="lead text-muted mb-4">
                        JobsPortal is the premier destination for job seekers and employers in Global.
                        We are dedicated to making the hiring process smooth, efficient, and accessible for everyone.
                    </p>
                    <p class="text-secondary mb-4">
                        Founded with a mission to bridge the gap between skilled professionals and leading companies,
                        we provide a robust platform tailored to the unique needs of the Local market.
                        Whether you are an engineer, a sales professional, or looking for your first break, we are here to
                        help.
                    </p>
                    <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-lg px-5">Browse Jobs</a>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                        alt="Team working" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <div class="fs-1 text-primary mb-3"><i class="bi bi-people-fill"></i></div>
                        <h3>For Job Seekers</h3>
                        <p class="text-muted">Access thousands of verified job listings from top employers across all
                            industries.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <div class="fs-1 text-primary mb-3"><i class="bi bi-briefcase-fill"></i></div>
                        <h3>For Employers</h3>
                        <p class="text-muted">Post jobs and find the perfect candidate with our advanced recruitment tools.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <div class="fs-1 text-primary mb-3"><i class="bi bi-shield-check"></i></div>
                        <h3>Verified & Secure</h3>
                        <p class="text-muted">We prioritize safety and authenticity, ensuring a trusted environment for all
                            users.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

