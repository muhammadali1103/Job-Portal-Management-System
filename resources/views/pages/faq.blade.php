@extends('layouts.app')

@section('title', 'Jobs Portal FAQ – Frequently Asked Questions')
@section('meta_description', 'Find answers to frequently asked questions about Jobs Portal. Learn how to apply for jobs and how to post vacancies in Global safely and for free.')
@section('meta_keywords', 'global jobs faq, apply for jobs global, post jobs global, global recruitment questions')

@section('content')
    <div class="legal-page">
        <div class="container">
            <div class="legal-content">
                <h1>Frequently Asked Questions</h1>

                <div class="faq-item">
                    <h3>How do I apply for a job?</h3>
                    <p>Click on any job listing to view full details. Then click the "Apply Now" button to be directed to
                        the application method chosen by the employer (WhatsApp, email, or external link).</p>
                </div>

                <div class="faq-item">
                    <h3>Do I need to create an account to apply?</h3>
                    <p>No, you can apply for jobs without creating an account. Simply browse and apply directly through the
                        employer's preferred method.</p>
                </div>

                <div class="faq-item">
                    <h3>How do I post a job?</h3>
                    <p>Register as an employer, verify your account, and you can start posting jobs immediately. We offer
                        both free and featured listing options.</p>
                </div>

                <div class="faq-item">
                    <h3>Are all jobs verified?</h3>
                    <p>Yes, we verify all job postings to ensure they are legitimate. We also collect jobs from official
                        newspapers and government sources.</p>
                </div>

                <div class="faq-item">
                    <h3>How can I search for specific jobs?</h3>
                    <p>Use our search filters to narrow down by category, location, job type, or use keywords to find
                        relevant positions.</p>
                </div>

                <div class="faq-item">
                    <h3>Is Jobs Portal free to use?</h3>
                    <p>Yes, job seekers can browse and apply to jobs completely free. Employers can post jobs with both free
                        and paid options available.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .faq-item {
            background: #f6f8fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 3px solid #0969da;
        }

        .faq-item h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #0d1117;
            margin-bottom: 0.75rem;
        }

        .faq-item p {
            color: #57606a;
            line-height: 1.7;
            margin: 0;
        }
    </style>
@endsection

