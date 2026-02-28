@extends('layouts.admin')

@section('header_title', 'Edit Job')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <form action="{{ route('admin.jobs.update', $job) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header -->
                <div class="mb-5 text-center">
                    <h3 class="fw-bold text-dark mb-2">Edit Job Posting</h3>
                    <p class="text-muted">Update the job details below.</p>
                </div>

                <!-- Job Details Section -->
                <div class="mb-5">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <span
                            class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center me-3"
                            style="width: 28px; height: 28px; font-size: 14px;">1</span>
                        Job Details
                    </h5>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label for="title" class="form-label text-muted small text-uppercase fw-bold ls-1">Job
                                    Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="title" name="title" required
                                    value="{{ old('title', $job->title) }}" placeholder="e.g. Senior Software Engineer">
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label for="category_id"
                                        class="form-label text-muted small text-uppercase fw-bold ls-1">Category <span
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
                                    <label for="job_type"
                                        class="form-label text-muted small text-uppercase fw-bold ls-1">Job Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="job_type" name="job_type" required>
                                        @foreach(['Full-time', 'Part-time', 'Contract', 'Temporary', 'Freelance'] as $type)
                                            <option value="{{ $type }}" {{ old('job_type', $job->job_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="job_role"
                                        class="form-label text-muted small text-uppercase fw-bold ls-1">Job Role <span class="text-danger">*</span></label>
                                    <select id="job_role" name="job_role" required placeholder="Select or type to add...">
                                        <option value="">Select or type to add...</option>
                                        @foreach($jobRoles as $role)
                                            <option value="{{ $role }}" {{ old('job_role', $job->job_role) == $role ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="location_id"
                                            class="form-label text-muted small text-uppercase fw-bold ls-1 mb-1">Location <span
                                                class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                        <a href="{{ route('admin.locations.index') }}" target="_blank"
                                            class="small text-decoration-none fw-semibold">
                                            <i class="bi bi-plus-circle me-1"></i>Add Location
                                        </a>
                                    </div>
                                    <select class="form-select" id="location_id" name="location_id">
                                        <option value="">Select Location</option>
                                        @foreach($locations as $location)
                                            @php
                                                $selected = old('location_id', $job->location_id) == $location->id;
                                                $isAllLocations = $location->city === 'All Locations';
                                            @endphp
                                            <option value="{{ $location->id }}" {{ $selected ? 'selected' : '' }}
                                                class="{{ $isAllLocations ? 'fw-bold text-primary' : '' }}"
                                                style="{{ $isAllLocations ? 'font-weight: 800; background-color: #f0f9ff;' : '' }}">
                                                {{ $location->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-4 mt-1">
                                <div class="col-md-6">
                                    <label for="nationality"
                                        class="form-label text-muted small text-uppercase fw-bold ls-1">Nationality <span
                                            class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                    <select class="form-select" id="nationality" name="nationality">
                                        <option value="Any" {{ old('nationality', $job->nationality) == 'Any' ? 'selected' : '' }}>Any Nationality</option>
                                        @foreach(['Local', 'Indian', 'Egyptian', 'Philippine', 'Pakistan', 'Bangladesh', 'Other Arab', 'Other Asian', 'European/Western'] as $nat)
                                            <option value="{{ $nat }}" {{ old('nationality', $job->nationality) == $nat ? 'selected' : '' }}>{{ $nat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Requirements Section -->
                <div class="mb-5">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <span
                            class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center me-3"
                            style="width: 28px; height: 28px; font-size: 14px;">2</span>
                        Requirements & Compensation
                    </h5>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold ls-1">Salary
                                         <span
                                            class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                    <div class="d-flex gap-2">
                                        <input type="number" class="form-control" name="salary_min" placeholder="Salary"
                                            value="{{ old('salary_min', $job->salary_min) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="experience"
                                        class="form-label text-muted small text-uppercase fw-bold ls-1">Experience <span
                                            class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                    <input type="text" class="form-control" id="experience" name="experience"
                                        placeholder="e.g. 2 Years" value="{{ old('experience', $job->experience) }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="qualification"
                                    class="form-label text-muted small text-uppercase fw-bold ls-1">Qualification <span
                                        class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                <input type="text" class="form-control" id="qualification" name="qualification"
                                    placeholder="e.g. Bachelor's Degree" value="{{ old('qualification', $job->qualification) }}">
                            </div>

                            <div>
                                <label for="description"
                                    class="form-label text-muted small text-uppercase fw-bold ls-1">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="5" required
                                    placeholder="Enter job description...">{{ old('description', $job->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Method -->
                <div class="mb-5">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <span
                            class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center me-3"
                            style="width: 28px; height: 28px; font-size: 14px;">3</span>
                        How to Apply
                    </h5>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                             <!-- Company Info -->
                             <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold ls-1">Company
                                        Name <span
                                            class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                    <input type="text" class="form-control" name="company_name"
                                        value="{{ old('company_name', $job->company_name) }}" placeholder="Optional">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold ls-1">Company Logo
                                        <span class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                    <input class="form-control" type="file" name="company_logo" accept="image/*"
                                        onchange="document.getElementById('logo_preview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('logo_preview').classList.remove('d-none');">
                                    <div class="mt-2">
                                        @if($job->company_logo)
                                            <img id="logo_preview" src="{{ Storage::url($job->company_logo) }}" alt="Logo" class="rounded border"
                                                style="max-width: 100px; max-height: 100px; object-fit: contain;">
                                        @else
                                            <img id="logo_preview" src="#" alt="Logo Preview" class="d-none rounded border"
                                                style="max-width: 100px; max-height: 100px; object-fit: contain;">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-muted small text-uppercase fw-bold ls-1">Primary
                                        Contact <span
                                            class="text-muted fw-normal text-capitalize ms-1">(Optional)</span></label>
                                    <div class="input-group contact-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-telephone text-muted"></i>
                                        </span>
                                        <select class="form-select border-start-0 ps-0 bg-light country-code-select" name="primary_country_code">
                                            @include('partials.country-codes', ['selectedCode' => old('primary_country_code', $job->primary_country_code ?? '+1')])
                                        </select>
                                        <input type="text" class="form-control ps-3 phone-number-input" name="primary_mobile"
                                            placeholder="Mobile Number" value="{{ old('primary_mobile', $job->primary_mobile) }}">
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase fw-bold ls-1 mb-3">How user can
                                    apply</label>
                                <div class="row g-3">
                                    @php
                                        $method = old('apply_method', $job->apply_method == 'url' ? 'website' : $job->apply_method);
                                        $apply_value = old('whatsapp_number', $method == 'whatsapp' ? (str_starts_with($job->apply_value, '+') ? substr($job->apply_value, 4) : $job->apply_value) : '');
                                        if(!$apply_value && $method == 'email') $apply_value = old('application_email', $job->apply_value);
                                        if(!$apply_value && $method == 'website') $apply_value = old('application_url', $job->apply_value);
                                    @endphp
                                    <div class="col-md-4">
                                        <div
                                            class="form-check custom-radio-card h-100 position-relative p-0 rounded-3 border overflow-hidden">
                                            <input class="form-check-input position-absolute top-50 start-50" type="radio"
                                                style="opacity: 0;" name="apply_method" id="method_whatsapp"
                                                value="whatsapp" onchange="toggleApplyFields()" {{ $method == 'whatsapp' ? 'checked' : '' }}>
                                            <label
                                                class="form-check-label d-flex flex-column align-items-center justify-content-center p-4 text-center h-100 w-100"
                                                for="method_whatsapp">
                                                <div class="icon-box mb-2 text-success">
                                                    <i class="bi bi-whatsapp fs-3"></i>
                                                </div>
                                                <span class="fw-bold d-block text-dark">WhatsApp</span>
                                                <small class="text-muted" style="font-size: 0.75rem;">Chat directly</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="form-check custom-radio-card h-100 position-relative p-0 rounded-3 border overflow-hidden">
                                            <input class="form-check-input position-absolute top-50 start-50" type="radio"
                                                style="opacity: 0;" name="apply_method" id="method_email" value="email"
                                                onchange="toggleApplyFields()" {{ $method == 'email' ? 'checked' : '' }}>
                                            <label
                                                class="form-check-label d-flex flex-column align-items-center justify-content-center p-4 text-center h-100 w-100"
                                                for="method_email">
                                                <div class="icon-box mb-2 text-primary">
                                                    <i class="bi bi-envelope fs-3"></i>
                                                </div>
                                                <span class="fw-bold d-block text-dark">Email</span>
                                                <small class="text-muted" style="font-size: 0.75rem;">Receive CVs</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="form-check custom-radio-card h-100 position-relative p-0 rounded-3 border overflow-hidden">
                                            <input class="form-check-input position-absolute top-50 start-50" type="radio"
                                                style="opacity: 0;" name="apply_method" id="method_website" value="website"
                                                onchange="toggleApplyFields()" {{ $method == 'website' ? 'checked' : '' }}>
                                            <label
                                                class="form-check-label d-flex flex-column align-items-center justify-content-center p-4 text-center h-100 w-100"
                                                for="method_website">
                                                <div class="icon-box mb-2 text-info">
                                                    <i class="bi bi-globe fs-3"></i>
                                                </div>
                                                <span class="fw-bold d-block text-dark">Website</span>
                                                <small class="text-muted" style="font-size: 0.75rem;">External link</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="apply_fields_container" class="bg-light rounded-3 p-4 mt-3">
                                <div id="whatsapp_group" class="{{ $method == 'whatsapp' ? '' : 'd-none' }}">
                                    <label class="form-label text-muted small text-uppercase fw-bold ls-1">WhatsApp
                                        Number <span class="text-danger">*</span></label>
                                    <div class="input-group whatsapp-group">
                                        <select class="form-select border-white country-code-select" name="whatsapp_country_code">
                                            @php
                                                $wa_country = old('whatsapp_country_code');
                                                if (!$wa_country && $method == 'whatsapp' && preg_match('/^\+\d{1,4}/', $job->apply_value ?? '', $matches)) {
                                                    $wa_country = $matches[0];
                                                }
                                                $wa_country = $wa_country ?? '+1';
                                            @endphp
                                            @include('partials.country-codes', ['selectedCode' => $wa_country])
                                        </select>
                                        <input type="text" class="form-control border-white phone-number-input" name="whatsapp_number"
                                            id="whatsapp_number" placeholder="e.g. 12345678"
                                            value="{{ old('whatsapp_number', $method == 'whatsapp' ? preg_replace('/^\+\d{1,4}/', '', $job->apply_value ?? '') : '') }}">
                                    </div>
                                </div>

                                <div id="email_group" class="{{ $method == 'email' ? '' : 'd-none' }}">
                                    <label class="form-label text-muted small text-uppercase fw-bold ls-1">Email
                                        Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control border-white" id="application_email"
                                        name="application_email" placeholder="recruit@company.com"
                                        value="{{ old('application_email', $method == 'email' ? $job->apply_value : '') }}">
                                </div>

                                <div id="website_link_group" class="{{ $method == 'website' ? '' : 'd-none' }}">
                                    <label class="form-label text-muted small text-uppercase fw-bold ls-1">Website
                                        URL <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control border-white" id="application_url"
                                        name="application_url" placeholder="https://..."
                                        value="{{ old('application_url', $method == 'website' ? $job->apply_value : '') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-5">
                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold shadow-sm w-100 mb-3"
                        style="max-width: 300px;">
                        Update Job
                    </button>
                    <div>
                        <a href="{{ route('admin.jobs.index') }}"
                            class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold shadow-sm border w-100 text-secondary"
                            style="max-width: 300px;">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .ls-1 {
            letter-spacing: 0.05em;
        }

        .custom-radio-card {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .custom-radio-card label {
            cursor: pointer;
        }

        .custom-radio-card:hover {
            border-color: #bfdbfe !important;
            background-color: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .custom-radio-card:has(.form-check-input:checked) {
            border-color: #3b82f6 !important;
            background-color: #eff6ff;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        .custom-radio-card:has(.form-check-input:checked) .text-muted {
            color: #60a5fa !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

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

            .contact-group .input-group-text {
                border: 1px solid #d1d5db !important;
                border-radius: 0.5rem !important;
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

    <script>
        function toggleApplyFields() {
            const method = document.querySelector('input[name="apply_method"]:checked').value;

            document.getElementById('whatsapp_group').classList.add('d-none');
            document.getElementById('email_group').classList.add('d-none');
            document.getElementById('website_link_group').classList.add('d-none');

            document.getElementById('whatsapp_number').required = false;
            document.getElementById('application_email').required = false;
            document.getElementById('application_url').required = false;

            if (method === 'whatsapp') {
                document.getElementById('whatsapp_group').classList.remove('d-none');
                document.getElementById('whatsapp_number').required = true;
            } else if (method === 'email') {
                document.getElementById('email_group').classList.remove('d-none');
                document.getElementById('application_email').required = true;
            } else if (method === 'website') {
                document.getElementById('website_link_group').classList.remove('d-none');
                document.getElementById('application_url').required = true;
            }
        }
    </script>
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
                items: ["{{ old('job_role', $job->job_role) }}"], 
            });
        });
    </script>
@endsection


