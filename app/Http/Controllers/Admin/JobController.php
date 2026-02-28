<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Setting;

class JobController extends Controller
{
    public function index()
    {
        $search = request('search');
        $autoApproveEnabled = Setting::where('key', 'job_auto_approve')->value('value') === 'true';
        $pendingCount = Job::where('status', 'pending')->count();

        $jobs = Job::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.jobs.index', compact('jobs', 'search', 'autoApproveEnabled', 'pendingCount'));
    }

    public function create()
    {
        $categories = Category::orderByRaw("CASE WHEN name IN ('Other', 'Others') THEN 1 ELSE 0 END")
            ->orderBy('name')
            ->get();
        $locations = Location::orderByRaw("CASE WHEN city = 'All Locations' THEN 0 ELSE 1 END")
            ->orderBy('city')
            ->get();

        // Get all job roles from our dedicated table
        $jobRoles = \App\Models\JobRole::orderBy('name')->pluck('name')->toArray();

        return view('admin.jobs.create', compact('categories', 'locations', 'jobRoles'));
    }

    public function store(Request $request)
    {
        // Auto-prepend https:// if missing from application_url
        if ($request->apply_method === 'website' && $request->filled('application_url')) {
            $url = $request->application_url;
            if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                $request->merge(['application_url' => "https://" . $url]);
            }
        }

        $validated = $request->validate([
            'apply_method' => 'required|in:whatsapp,email,website',

            // Conditional Application Fields
            'application_url' => 'nullable|required_if:apply_method,website|url',
            'whatsapp_number' => 'nullable|required_if:apply_method,whatsapp|string',
            'application_email' => 'nullable|required_if:apply_method,email|email',
            'whatsapp_country_code' => 'nullable|string',

            // Optional Fields
            'title' => 'required|string|max:255',
            'job_role' => 'required|string|max:255',
            'description' => 'required|string',
            'job_type' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'location_id' => 'nullable|exists:locations,id',
            'salary_min' => 'nullable|numeric',

            'experience' => 'nullable|string',
            'company_name' => 'nullable|string',
            'company_logo' => 'nullable|image|max:2048',
            'primary_country_code' => 'nullable|string',
            'primary_mobile' => 'nullable|string',
            'nationality' => 'nullable|string|max:255',
        ]);

        $data = $validated;

        // Handle File Upload
        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('company_logos', 'public');
            $data['company_logo'] = $path;
        }

        // Set Job defaults
        $data['user_id'] = Auth::id(); // Admin ID
        $data['status'] = 'approved'; // Admin jobs are auto-approved

        // Set Apply Value based on Method
        if ($request->apply_method === 'website') {
            $data['apply_value'] = $request->application_url;
            $data['apply_method'] = 'url'; // Store as 'url' for standard compatibility
        } elseif ($request->apply_method === 'email') {
            $data['apply_value'] = $request->application_email;
        } else {
            // WhatsApp
            $data['apply_method'] = 'whatsapp';
            $data['apply_value'] = ($request->whatsapp_country_code ?? '+1') . $request->whatsapp_number;
        }

        Job::create($data);

        return redirect()->route('admin.jobs.index')->with('success', 'Job posted successfully.');
    }

    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        $categories = Category::orderByRaw("CASE WHEN name IN ('Other', 'Others') THEN 1 ELSE 0 END")
            ->orderBy('name')
            ->get();
        $locations = Location::orderByRaw("CASE WHEN city = 'All Locations' THEN 0 ELSE 1 END")
            ->orderBy('city')
            ->get();
        $jobRoles = \App\Models\JobRole::orderBy('name')->pluck('name')->toArray();

        return view('admin.jobs.edit', compact('job', 'categories', 'locations', 'jobRoles'));
    }

    public function update(Request $request, Job $job)
    {
        // Auto-prepend https:// if missing from application_url
        if ($request->apply_method === 'website' && $request->filled('application_url')) {
            $url = $request->application_url;
            if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                $request->merge(['application_url' => "https://" . $url]);
            }
        }

        $validated = $request->validate([
            'apply_method' => 'required|in:whatsapp,email,website',
            'application_url' => 'nullable|required_if:apply_method,website|url',
            'whatsapp_number' => 'nullable|required_if:apply_method,whatsapp|string',
            'application_email' => 'nullable|required_if:apply_method,email|email',
            'whatsapp_country_code' => 'nullable|string',
            'title' => 'required|string|max:255',
            'job_role' => 'required|string|max:255',
            'description' => 'required|string',
            'job_type' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'location_id' => 'nullable|exists:locations,id',
            'salary_min' => 'nullable|numeric',

            'experience' => 'nullable|string',
            'company_name' => 'nullable|string',
            'company_logo' => 'nullable|image|max:2048',
            'primary_country_code' => 'nullable|string',
            'primary_mobile' => 'nullable|string',
            'nationality' => 'nullable|string|max:255',
        ]);

        $data = $validated;

        // Handle File Upload
        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            if ($job->company_logo) {
                Storage::disk('public')->delete($job->company_logo);
            }
            $path = $request->file('company_logo')->store('company_logos', 'public');
            $data['company_logo'] = $path;
        }

        // Set Apply Value based on Method
        if ($request->apply_method === 'website') {
            $data['apply_value'] = $request->application_url;
            $data['apply_method'] = 'url';
        } elseif ($request->apply_method === 'email') {
            $data['apply_value'] = $request->application_email;
            $data['apply_method'] = 'email';
        } else {
            // WhatsApp
            $data['apply_method'] = 'whatsapp';
            $data['apply_value'] = ($request->whatsapp_country_code ?? '+1') . $request->whatsapp_number;
        }

        $job->update($data);

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
    }

    public function approve(Job $job)
    {
        $job->update(['status' => 'approved']);
        return back()->with('success', 'Job approved successfully.');
    }

    public function reject(Job $job)
    {
        $job->update(['status' => 'rejected']);
        return back()->with('success', 'Job rejected successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return back()->with('success', 'Job deleted successfully.');
    }

    public function approveAll()
    {
        Job::where('status', 'pending')->update(['status' => 'approved']);
        return back()->with('success', 'All pending jobs have been approved.');
    }

    public function toggleAutoApproval()
    {
        $setting = Setting::firstOrCreate(['key' => 'job_auto_approve']);
        $newValue = $setting->value === 'true' ? 'false' : 'true';
        $setting->update(['value' => $newValue]);

        $message = $newValue === 'true' ? 'Auto Approval Enabled' : 'Auto Approval Disabled';
        return back()->with('success', $message);
    }
}

