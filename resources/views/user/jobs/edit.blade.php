@extends('layouts.user')

@section('header_title', 'Edit Job')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h4 class="mb-2 fw-bold" style="font-size: 1.75rem; color: #111827;">Edit Job Posting</h4>
                    <p class="text-muted mb-0">Update your job details.</p>
                </div>
                <a href="{{ route('user.jobs.index') }}" class="btn btn-light">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </a>
            </div>

            <form action="{{ route('user.jobs.update', $job) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                                <i class="bi bi-info-circle-fill text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Basic Information</h6>
                                <small class="text-muted">Job title, category, and type</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="title" class="form-label">Job Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="title" name="title" required
                                    value="{{ old('title', $job->title) }}" placeholder="e.g. Senior Software Engineer">
                            </div>

                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="job_role" class="form-label">Job Role <span class="text-danger">*</span></label>
                                <select id="job_role" name="job_role" required placeholder="Select or type to add...">
                                    <option value="">Select or type to add...</option>
                                    @foreach($jobRoles as $role)
                                        <option value="{{ $role }}" {{ old('job_role', $job->job_role) == $role ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="job_type" class="form-label">Job Type <span class="text-danger">*</span></label>
                                <select class="form-select" id="job_type" name="job_type" required>
                                    <option value="Full-time" {{ old('job_type', $job->job_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                    <option value="Part-time" {{ old('job_type', $job->job_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="Contract" {{ old('job_type', $job->job_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="Temporary" {{ old('job_type', $job->job_type) == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                                    <option value="Freelance" {{ old('job_type', $job->job_type) == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="location_id" class="form-label">Location <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <select class="form-select" id="location_id" name="location_id">
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id', $job->location_id) == $location->id ? 'selected' : '' }}>
                                            {{ $location->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="nationality" class="form-label">Nationality <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <select class="form-select" id="nationality" name="nationality">
                                    <option value="Any" {{ old('nationality', $job->nationality) == 'Any' ? 'selected' : '' }}>Any Nationality</option>
                                    <option value="Local" {{ old('nationality', $job->nationality) == 'Local' ? 'selected' : '' }}>Local</option>
                                    <option value="Indian" {{ old('nationality', $job->nationality) == 'Indian' ? 'selected' : '' }}>Indian</option>
                                    <option value="Egyptian" {{ old('nationality', $job->nationality) == 'Egyptian' ? 'selected' : '' }}>Egyptian</option>
                                    <option value="Philippine" {{ old('nationality', $job->nationality) == 'Philippine' ? 'selected' : '' }}>Philippine</option>
                                    <option value="Pakistan" {{ old('nationality', $job->nationality) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                    <option value="Bangladesh" {{ old('nationality', $job->nationality) == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                    <option value="Other Arab" {{ old('nationality', $job->nationality) == 'Other Arab' ? 'selected' : '' }}>Other Arab</option>
                                    <option value="Other Asian" {{ old('nationality', $job->nationality) == 'Other Asian' ? 'selected' : '' }}>Other Asian</option>
                                    <option value="European/Western" {{ old('nationality', $job->nationality) == 'European/Western' ? 'selected' : '' }}>European/Western
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                <i class="bi bi-file-text-fill text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Job Details</h6>
                                <small class="text-muted">Salary, experience, and description</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Salary <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="salary_min" placeholder="Salary"
                                        value="{{ old('salary_min', $job->salary_min) }}">
                                </div>
                                <small class="form-text">Leave empty if not applicable</small>
                            </div>

                            <div class="col-md-6">
                                <label for="experience" class="form-label">Experience Level <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <input type="text" class="form-control" id="experience" name="experience"
                                    placeholder="e.g. 2-3 Years" value="{{ old('experience', $job->experience) }}">
                            </div>

                            <div class="col-12">
                                <label for="qualification" class="form-label">Qualification / Requirements <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <input type="text" class="form-control" id="qualification" name="qualification"
                                    placeholder="e.g. Bachelor's Degree in Computer Science"
                                    value="{{ old('qualification', $job->qualification) }}">
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Job Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="6" required
                                    placeholder="Describe the job responsibilities, required skills, and qualifications...">{{ old('description', $job->description) }}</textarea>
                                <small class="form-text">Be detailed and clear about the role expectations</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                                <i class="bi bi-building-fill text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Company Information</h6>
                                <small class="text-muted">Company details and contacts</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="company_name" class="form-label">Company Name <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    value="{{ old('company_name', $job->company_name) }}"
                                    placeholder="Leave empty to use your name">
                            </div>

                            <div class="col-md-6">
                                <label for="company_logo" class="form-label">Company Logo <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                @if($job->company_logo)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($job->company_logo) }}" alt="Current logo"
                                            style="max-height: 50px;">
                                    </div>
                                @endif
                                <input class="form-control" type="file" id="company_logo" name="company_logo"
                                    accept="image/*">
                                <small class="form-text">PNG, JPG or JPEG (max 2MB)</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Primary Contact <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <div class="input-group contact-group">
                                    <select class="form-select country-code-select" name="primary_country_code">
                                        @include('partials.country-codes', ['selectedCode' => old('primary_country_code', $job->primary_country_code ?? '+1')])
                                    </select>
                                    <input type="text" class="form-control phone-number-input" name="primary_mobile"
                                        placeholder="Mobile Number"
                                        value="{{ old('primary_mobile', $job->primary_mobile) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="contact_email" class="form-label">Contact Email <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email"
                                    value="{{ old('contact_email', $job->contact_email) }}" placeholder="company@email.com">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Method -->
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                                <i class="bi bi-envelope-fill text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Application Method</h6>
                                <small class="text-muted">How candidates should apply</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="apply_method" class="form-label"> How user Apply ? <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="apply_method" name="apply_method" required
                                    onchange="toggleApplyFields()">
                                    <option value="whatsapp" {{ old('apply_method', $job->apply_method) == 'whatsapp' ? 'selected' : '' }}>Apply via WhatsApp</option>
                                    <option value="email" {{ old('apply_method', $job->apply_method) == 'email' ? 'selected' : '' }}>Apply via Email</option>
                                    <option value="website" {{ old('apply_method', $job->apply_method) == 'website' ? 'selected' : '' }}>Apply on Company Website</option>
                                </select>
                            </div>

                            <!-- WhatsApp -->
                            <div class="col-12 d-none" id="whatsapp_group">
                                <label class="form-label">WhatsApp Number <span class="text-danger">*</span></label>
                                <div class="input-group whatsapp-group">
                                    @php
                                        $waSelected = old('whatsapp_country_code');
                                        if (!$waSelected && old('apply_method', $job->apply_method) === 'whatsapp' && preg_match('/^\+\d{1,4}/', $job->apply_value ?? '', $matches)) {
                                            $waSelected = $matches[0];
                                        }
                                        $waSelected = $waSelected ?? '+1';
                                    @endphp
                                    <select class="form-select country-code-select" name="whatsapp_country_code">
                                        @include('partials.country-codes', ['selectedCode' => $waSelected])
                                    </select>
                                    <input type="text" class="form-control phone-number-input" name="whatsapp_number" id="whatsapp_number"
                                        placeholder="Enter WhatsApp Number"
                                        value="{{ old('whatsapp_number', preg_replace('/^\+\d{1,4}/', '', $job->apply_value ?? '')) }}">
                                </div>
                                <small class="form-text">Candidates will be redirected to chat via WhatsApp</small>
                            </div>

                            <!-- Email -->
                            <div class="col-12 d-none" id="email_group">
                                <label for="application_email" class="form-label">Application Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="application_email" name="application_email"
                                    placeholder="e.g. careers@company.com"
                                    value="{{ old('application_email', $job->application_email) }}">
                                <small class="form-text">Candidates will send their CVs to this email</small>
                            </div>

                            <!-- Website -->
                            <div class="col-12 d-none" id="website_link_group">
                                <label for="application_url" class="form-label">Application URL <span
                                        class="text-danger">*</span></label>
                                <input type="url" class="form-control" id="application_url" name="application_url"
                                    placeholder="https://company.com/careers/apply"
                                    value="{{ old('application_url', $job->application_url) }}">
                                <small class="form-text">Candidates will be redirected to this page to apply</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <a href="{{ route('user.jobs.index') }}" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-x-lg me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-check-lg me-2"></i>Update Job
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function toggleApplyFields() {
            const method = document.getElementById('apply_method').value;

            const whatsappGroup = document.getElementById('whatsapp_group');
            const emailGroup = document.getElementById('email_group');
            const linkGroup = document.getElementById('website_link_group');

            // Hide all first
            whatsappGroup.classList.add('d-none');
            emailGroup.classList.add('d-none');
            linkGroup.classList.add('d-none');

            // Remove required
            document.getElementById('whatsapp_number').required = false;
            document.getElementById('application_email').required = false;
            document.getElementById('application_url').required = false;

            if (method === 'whatsapp') {
                whatsappGroup.classList.remove('d-none');
                document.getElementById('whatsapp_number').required = true;
            } else if (method === 'email') {
                emailGroup.classList.remove('d-none');
                document.getElementById('application_email').required = true;
            } else if (method === 'website') {
                linkGroup.classList.remove('d-none');
                document.getElementById('application_url').required = true;
            }
        }

        // Run on load
        document.addEventListener('DOMContentLoaded', toggleApplyFields);
    </script>
    <style>
        .country-code-select {
            flex: 0 0 44%;
            max-width: 44%;
            min-width: 170px;
        }

        .phone-number-input {
            flex: 1 1 56%;
            min-width: 180px;
        }

        @media (max-width: 768px) {
            .contact-group,
            .whatsapp-group {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .contact-group .country-code-select,
            .whatsapp-group .country-code-select,
            .contact-group .phone-number-input,
            .whatsapp-group .phone-number-input {
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 0.5rem !important;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new TomSelect("#job_role", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: "Select or type to add...",
                plugins: ['restore_on_backspace'],
                dropdownParent: 'body',
                items: ["{{ old('job_role', $job->job_role) }}"], // Pre-select old value if exists
            });
        });
    </script>
@endsection

