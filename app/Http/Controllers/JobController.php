<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\Location;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with(['category', 'location', 'skills', 'user']);

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('job_role', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->filled('nationality') && $request->nationality !== 'Any') {
            $query->where(function ($q) use ($request) {
                $q->where('nationality', 'like', '%' . $request->nationality . '%')
                    ->orWhere('nationality', 'Any')
                    ->orWhereNull('nationality');
            });
        }

        $jobs = $query->latest()->paginate(15);
        $categories = Category::withCount('jobs')
            ->orderByRaw("CASE WHEN name IN ('Other', 'Others') THEN 1 ELSE 0 END")
            ->orderBy('name')
            ->get();
        $locations = Location::withCount('jobs')->get();

        return view('jobs.index', compact('jobs', 'categories', 'locations'));
    }

    public function show(Request $request, Job $job)
    {
        // Increment global counter
        $job->increment('views_count');

        // Log analytics event (fire and forget basically, or strictly logged)
        // To avoid spam, we could check session or constraints, but for now we track all.
        \App\Models\JobAnalytics::create([
            'job_id' => $job->id,
            'type' => 'view',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return view('jobs.show', compact('job'));
    }
}
