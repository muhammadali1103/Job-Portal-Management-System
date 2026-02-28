<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with(['category', 'location', 'skills']);

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->has('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        // Only show approved jobs for public, or all for admin
        // For simplicity, we filter in frontend or assume public endpoint returns approved
        // $query->where('status', 'approved');

        return response()->json($query->latest()->paginate(10));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'job_type' => 'required|string',
            'apply_link' => 'nullable|string',
            'skills' => 'array'
        ]);

        $job = Job::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'job_type' => $request->job_type,
            'experience' => $request->experience,
            'apply_link' => $request->apply_link,
            'status' => 'pending' // Default
        ]);

        if ($request->has('skills')) {
            $job->skills()->attach($request->skills);
        }

        return response()->json($job, 201);
    }

    public function show($id)
    {
        $job = Job::with(['category', 'location', 'skills', 'user'])->findOrFail($id);
        return response()->json($job);
    }

    public function update(Request $request, Job $job)
    {
        // Add authorization check (policy) here

        $request->validate([
            'title' => 'string|max:255',
        ]);

        $job->update($request->all());

        if ($request->has('skills')) {
            $job->skills()->sync($request->skills);
        }

        return response()->json($job);
    }

    public function destroy(Job $job)
    {
        // Add authorization check
        $job->delete();
        return response()->json(['message' => 'Job deleted']);
    }
}
