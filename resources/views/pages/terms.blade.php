@extends('layouts.app')

@section('title', 'Terms and Conditions – Jobs Portal')
@section('meta_description', 'Review the terms and conditions for using Jobs Portal. Understand your rights and responsibilities when searching for jobs or posting vacancies on our platform.')
@section('meta_keywords', 'terms of service, global jobs terms, website conditions, recruitment terms global')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-5">
                        <h1 class="mb-4 fw-bold">Terms of Service</h1>
                        <p class="text-muted mb-5">Last updated: {{ date('F j, Y') }}</p>

                        <h4 class="fw-bold mt-4">1. Introduction</h4>
                        <p>Welcome to JobsPortal. By accessing our website, you agree to these Terms of Service. Please read
                            them carefully.</p>

                        <h4 class="fw-bold mt-4">2. Using our Services</h4>
                        <p>You must follow any policies made available to you within the Services. Don't misuse our
                            Services. For example, don't interfere with our Services or try to access them using a method
                            other than the interface and the instructions that we provide.</p>

                        <h4 class="fw-bold mt-4">3. User Accounts</h4>
                        <p>You may need a JobsPortal Account in order to use some of our Services. You may create your own
                            JobsPortal Account, or your JobsPortal Account may be assigned to you by an administrator, such
                            as your employer or educational institution.</p>

                        <h4 class="fw-bold mt-4">4. Content</h4>
                        <p>Our Services display some content that is not JobsPortal'. This content is the sole
                            responsibility of the entity that makes it available. We may review content to determine whether
                            it is illegal or violates our policies, and we may remove or refuse to display content that we
                            reasonably believe violates our policies or the law.</p>

                        <h4 class="fw-bold mt-4">5. Modification and Termination of Services</h4>
                        <p>We are constantly changing and improving our Services. We may add or remove functionalities or
                            features, and we may suspend or stop a Service altogether.</p>

                        <h4 class="fw-bold mt-4">6. Warranties and Disclaimers</h4>
                        <p>OTHER THAN AS EXPRESSLY SET OUT IN THESE TERMS OR ADDITIONAL TERMS, NEITHER JobsPortal NOR ITS
                            SUPPLIERS OR DISTRIBUTORS MAKE ANY SPECIFIC PROMISES ABOUT THE SERVICES.</p>

                        <div class="mt-5 pt-4 border-top">
                            <p class="text-muted small">If you have any questions about these Terms, please contact us at
                                support@JobsPortal.com.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

