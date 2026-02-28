@extends('layouts.app')

@section('title', 'Edit Job')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-warning py-3">
                        <h4 class="mb-0"><i class="bi bi-pencil-fill me-2"></i>Edit Job</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('employer.jobs.update', $job) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label class="form-label fw-bold">Job Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $job->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select" required>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id', $job->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Location <span class="text-danger">*</span></label>
                                    <select name="location_id" class="form-select" required>
                                        @foreach($locations as $loc)
                                            <option value="{{ $loc->id }}" {{ old('location_id', $job->location_id) == $loc->id ? 'selected' : '' }}>{{ $loc->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Job Description <span class="text-danger">*</span></label>
                                <textarea name="description" rows="6" class="form-control"
                                    required>{{ old('description', $job->description) }}</textarea>
                            </div>

                            <!-- Nationality -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Preferred Nationality</label>
                                <select name="nationality" class="form-select">
                                    <option value="">Any Nationality</option>
                                    <option value="Local" {{ old('nationality', $job->nationality) == 'Local' ? 'selected' : '' }}>Local</option>
                                    <option value="Arab Nationals" {{ old('nationality', $job->nationality) == 'Arab Nationals' ? 'selected' : '' }}>Arab Nationals</option>
                                    <option value="Indian" {{ old('nationality', $job->nationality) == 'Indian' ? 'selected' : '' }}>Indian</option>
                                    <option value="Filipino" {{ old('nationality', $job->nationality) == 'Filipino' ? 'selected' : '' }}>Filipino</option>
                                    <option value="Western" {{ old('nationality', $job->nationality) == 'Western' ? 'selected' : '' }}>Western</option>
                                    <option value="Asian" {{ old('nationality', $job->nationality) == 'Asian' ? 'selected' : '' }}>Asian</option>
                                    <option value="Others" {{ old('nationality', $job->nationality) == 'Others' ? 'selected' : '' }}>Others</option>
                                </select>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Job Type</label>
                                    <select name="job_type" class="form-select" required>
                                        @foreach(['Full-time', 'Part-time', 'Contract', 'Remote'] as $type)
                                            <option value="{{ $type }}" {{ old('job_type', $job->job_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Salary Min</label>
                                    <input type="number" name="salary_min" class="form-control"
                                        value="{{ old('salary_min', $job->salary_min) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Salary Max</label>
                                    <input type="number" name="salary_max" class="form-control"
                                        value="{{ old('salary_max', $job->salary_max) }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Experience Required</label>
                                <input type="text" name="experience" class="form-control"
                                    value="{{ old('experience', $job->experience) }}">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Skills Required</label>
                                <select name="skills[]" class="form-select" multiple size="5">
                                    @foreach($skills as $skill)
                                        <option value="{{ $skill->id }}" {{ $job->skills->contains($skill->id) ? 'selected' : '' }}>{{ $skill->name }}</option>
                                    @endforeach
                                </select>
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
                                            <option value="whatsapp" {{ old('apply_method', $job->apply_method) == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                                            <option value="phone" {{ old('apply_method', $job->apply_method) == 'phone' ? 'selected' : '' }}>Phone Call</option>
                                            <option value="email" {{ old('apply_method', $job->apply_method) == 'email' ? 'selected' : '' }}>Email</option>
                                            <option value="url" {{ old('apply_method', $job->apply_method) == 'url' ? 'selected' : '' }}>External Website/Form</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" id="applyValueLabel">WhatsApp Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="apply_value" id="applyValue" class="form-control"
                                            value="{{ old('apply_value', $job->apply_value) }}" placeholder="+CountryCode Number"
                                            required>
                                        <small class="text-muted" id="applyHint">Candidates will contact you directly via
                                            WhatsApp</small>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const methodSelect = document.getElementById('applyMethod');
                                    const label = document.getElementById('applyValueLabel');
                                    const input = document.getElementById('applyValue');
                                    const hint = document.getElementById('applyHint');

                                    function updateFields() {
                                        const method = methodSelect.value;
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
                                    }

                                    methodSelect.addEventListener('change', updateFields);
                                    updateFields(); // Run on load
                                });
                            </script>

                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary px-4">Cancel</a>
                                <button type="submit" class="btn btn-warning px-5"><i
                                        class="bi bi-check-circle me-2"></i>Update Job</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

