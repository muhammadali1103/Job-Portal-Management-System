<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Category;
use App\Models\Location;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobManagementController extends Controller
{
    public function index()
    {
        $jobs = Job::where('user_id', Auth::id())
            ->withCount('applications')
            ->with(['category', 'location'])
            ->latest()
            ->paginate(15);

        return view('user.jobs.index', compact('jobs'));
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

        return view('user.jobs.create', compact('categories', 'locations', 'jobRoles'));
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'location_id' => 'nullable|exists:locations,id',
            'job_type' => 'required|string',
            'salary_min' => 'nullable|numeric',

            'experience' => 'nullable|string',
            'qualification' => 'nullable|string',
            'job_role' => 'required|string|max:255',
            'company_name' => 'nullable|string',
            'company_logo' => 'nullable|image|max:2048',
            'primary_country_code' => 'nullable|string',
            'primary_mobile' => 'nullable|string',
            'apply_method' => 'required|in:whatsapp,email,website',
            'application_url' => 'nullable|required_if:apply_method,website|url',
            'whatsapp_number' => 'nullable|required_if:apply_method,whatsapp|string',
            'application_email' => 'nullable|required_if:apply_method,email|email',
            'contact_email' => 'nullable|email',
            'nationality' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
            'whatsapp_country_code' => 'nullable|string', // Support for WhatsApp CC
        ]);

        $data = $validated;
        unset($data['skills']); // handle skills separately

        // Handle File Upload
        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('company_logos', 'public');
            $data['company_logo'] = $path;
        }

        $data['user_id'] = Auth::id();

        $isAutoApprove = \App\Models\Setting::where('key', 'job_auto_approve')->value('value') === 'true';
        $data['status'] = (Auth::user()->isAdmin() || $isAutoApprove) ? 'approved' : 'pending';

        // Map Apply Method & Value
        if ($request->apply_method === 'website') {
            $data['apply_method'] = 'url';
            $data['apply_value'] = $request->application_url;
        } elseif ($request->apply_method === 'email') {
            $data['apply_method'] = 'email';
            $data['apply_value'] = $request->application_email;
        } else {
            $data['apply_method'] = 'whatsapp';
            $data['apply_value'] = ($request->whatsapp_country_code ?? '+1') . $request->whatsapp_number;
        }

        $job = Job::create($data);

        if ($request->has('skills')) {
            $job->skills()->attach($request->skills);
        }

        return redirect()->route('user.jobs.index')->with('success', 'Job posted successfully! Awaiting admin approval.');
    }

    public function edit(Job $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::orderByRaw("CASE WHEN name = 'Other' THEN 1 ELSE 0 END")
            ->orderBy('name')
            ->get();
        $locations = Location::all();

        // Get all job roles from our dedicated table
        $jobRoles = \App\Models\JobRole::orderBy('name')->pluck('name')->toArray();

        return view('user.jobs.edit', compact('job', 'categories', 'locations', 'jobRoles'));
    }

    public function update(Request $request, Job $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }

        // Auto-prepend https:// if missing from application_url
        if ($request->apply_method === 'website' && $request->filled('application_url')) {
            $url = $request->application_url;
            if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                $request->merge(['application_url' => "https://" . $url]);
            }
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'job_role' => 'required|string|max:255',
            'description' => 'required|string',
            'job_type' => 'required|string',
            'apply_method' => 'required|in:whatsapp,email,website',

            // Optional Fields
            'category_id' => 'nullable|exists:categories,id',
            'location_id' => 'nullable|exists:locations,id',
            'salary_min' => 'nullable|numeric',

            'experience' => 'nullable|string',
            'qualification' => 'nullable|string',
            'company_name' => 'nullable|string',
            'company_logo' => 'nullable|image|max:2048',
            'primary_country_code' => 'nullable|string',
            'primary_mobile' => 'nullable|string',
            'application_url' => 'nullable|url',
            'whatsapp_number' => 'nullable|string',
            'application_email' => 'nullable|email',
            'contact_email' => 'nullable|email',
            'nationality' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
            'whatsapp_country_code' => 'nullable|string',
        ]);

        $data = $validated;
        unset($data['skills']);

        // Handle File Upload
        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('company_logos', 'public');
            $data['company_logo'] = $path;
        }

        // Map Apply Method & Value
        if ($request->apply_method === 'website') {
            $data['apply_method'] = 'url';
            $data['apply_value'] = $request->application_url;
        } elseif ($request->apply_method === 'email') {
            $data['apply_method'] = 'email';
            $data['apply_value'] = $request->application_email;
        } else {
            $data['apply_method'] = 'whatsapp';
            $data['apply_value'] = ($request->whatsapp_country_code ?? '+1') . $request->whatsapp_number;
        }

        $job->update($data);

        if ($request->has('skills')) {
            $job->skills()->sync($request->skills);
        }

        return redirect()->route('user.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        if ($job->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $job->delete();
        return redirect()->route('dashboard')->with('success', 'Job deleted successfully!');
    }
}

