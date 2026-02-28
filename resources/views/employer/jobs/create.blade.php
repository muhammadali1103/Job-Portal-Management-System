@extends('layouts.app')

@section('title', 'Post a Job')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0"><i class="bi bi-briefcase-fill me-2"></i>Post a New Job</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('employer.jobs.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-bold">Job Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                                    <select name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Location <span class="text-danger">*</span></label>
                                    <select name="location_id"
                                        class="form-select @error('location_id') is-invalid @enderror" required>
                                        <option value="">Select Location</option>
                                        @foreach($locations as $loc)
                                            <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                                                {{ $loc->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Job Description <span class="text-danger">*</span></label>
                                <textarea name="description" rows="6"
                                    class="form-control @error('description') is-invalid @enderror"
                                    required>{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Nationality -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Preferred Nationality</label>
                                <select name="nationality" class="form-select">
                                    <option value="">Any Nationality</option>
                                    <option value="Local">Local</option>
                                    <option value="Arab Nationals">Arab Nationals</option>
                                    <option value="Indian">Indian</option>
                                    <option value="Filipino">Filipino</option>
                                    <option value="Western">Western</option>
                                    <option value="Asian">Asian</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Job Type <span class="text-danger">*</span></label>
                                    <select name="job_type" class="form-select" required>
                                        <option value="Full-time">Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Remote">Remote</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Salary Min</label>
                                    <input type="number" name="salary_min" class="form-control"
                                        value="{{ old('salary_min') }}" placeholder="e.g., 800">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Salary Max</label>
                                    <input type="number" name="salary_max" class="form-control"
                                        value="{{ old('salary_max') }}" placeholder="e.g., 1200">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Experience Required</label>
                                <input type="text" name="experience" class="form-control" value="{{ old('experience') }}"
                                    placeholder="e.g., 3-5 Years">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Skills Required</label>
                                <select name="skills[]" class="form-select" multiple size="5">
                                    @foreach($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
                            </div>

                            <div class="card bg-light mb-4">
                                <div class="card-header bg-success text-white py-2">
                                    <strong><i class="bi bi-hand-thumbs-up me-2"></i>How should candidates apply?</strong>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Apply Method <span
                                                class="text-danger">*</span></label>
                                        <select name="apply_method" id="applyMethod" class="form-select" required>
                                            <option value="whatsapp">WhatsApp</option>
                                            <option value="phone">Phone Call</option>
                                            <option value="email">Email</option>
                                            <option value="url">External Website/Form</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" id="applyValueLabel">WhatsApp Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="apply_value" id="applyValue" class="form-control"
                                            value="{{ old('apply_value') }}" placeholder="+CountryCode Number" required>
                                        <small class="text-muted" id="applyHint">Candidates will contact you directly via
                                            WhatsApp</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-5"><i
                                        class="bi bi-check-circle me-2"></i>Post Job</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('applyMethod').addEventListener('change', function () {
            const method = this.value;
            const label = document.getElementById('applyValueLabel');
            const input = document.getElementById('applyValue');
            const hint = document.getElementById('applyHint');

            switch (method) {
                case 'whatsapp':
                    label.innerHTML = 'WhatsApp Number <span class="text-danger">*</span>';
                    input.placeholder = '+CountryCode Number';
                    hint.textContent = 'Candidates will contact you directly via WhatsApp';
                    break;
                case 'phone':
                    label.innerHTML = 'Phone Number <span class="text-danger">*</span>';
                    input.placeholder = '+CountryCode Number';
                    hint.textContent = 'Candidates will call this number directly';
                    break;
                case 'email':
                    label.innerHTML = 'Email Address <span class="text-danger">*</span>';
                    input.placeholder = 'jobs@company.com';
                    hint.textContent = 'Candidates will send their application to this email';
                    break;
                case 'url':
                    label.innerHTML = 'Application URL <span class="text-danger">*</span>';
                    input.placeholder = 'https://careers.company.com/apply';
                    hint.textContent = 'Candidates will be redirected to this website';
                    break;
            }
        });
    </script>
@endsection

