@extends('layouts.app')

@section('title', 'Privacy Policy – Jobs Portal – Your Data Security')
@section('meta_description', 'Read our privacy policy to understand how Jobs Portal collects, uses, and protects your personal information. We prioritize your data security and privacy.')
@section('meta_keywords', 'privacy policy, global jobs privacy, data protection global, recruitment privacy')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-5">
                        <h1 class="mb-4 fw-bold">Privacy Policy</h1>
                        <p class="text-muted mb-5">Last updated: {{ date('F j, Y') }}</p>

                        <h4 class="fw-bold mt-4">1. Information We Collect</h4>
                        <p>We collect information to provide better services to all our users. This includes information you
                            give us such as your name, email address, and telephone number when you sign up for a JobsPortal
                            Account.</p>

                        <h4 class="fw-bold mt-4">2. How We Use Information</h4>
                        <p>We use the information we collect from all our services to provide, maintain, protect and improve
                            them, to develop new ones, and to protect JobsPortal and our users.</p>

                        <h4 class="fw-bold mt-4">3. Information We Share</h4>
                        <p>We do not share personal information with companies, organizations and individuals outside of
                            JobsPortal unless one of the following circumstances applies:</p>
                        <ul>
                            <li>With your consent</li>
                            <li>For legal reasons</li>
                        </ul>

                        <h4 class="fw-bold mt-4">4. Information Security</h4>
                        <p>We work hard to protect JobsPortal and our users from unauthorized access to or unauthorized
                            alteration, disclosure or destruction of information we hold.</p>

                        <h4 class="fw-bold mt-4">5. Changes</h4>
                        <p>Our Privacy Policy may change from time to time. We will not reduce your rights under this
                            Privacy Policy without your explicit consent. We will post any privacy policy changes on this
                            page.</p>

                        <div class="mt-5 pt-4 border-top">
                            <p class="text-muted small">If you have any questions about this Privacy Policy, please contact
                                us at support@JobsPortal.com.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

