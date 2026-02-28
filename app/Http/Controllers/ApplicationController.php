<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        $userId = Auth::id();

        // Check if already applied (for authenticated users)
        if ($userId) {
            $existing = Application::where('job_id', $job->id)
                ->where('user_id', $userId)
                ->first();
            if ($existing) {
                return back()->with('error', 'You have already applied to this job!');
            }
        }

        $validated = $request->validate([
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string|max:1000',
            'guest_name' => $userId ? 'nullable' : 'required|string|max:255',
            'guest_email' => $userId ? 'nullable' : 'required|email|max:255',
            'guest_phone' => 'nullable|string|max:20',
        ]);

        $resumePath = 'resumes/dummy.pdf';
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        Application::create([
            'job_id' => $job->id,
            'user_id' => $userId,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'resume_link' => $resumePath,
            'status' => 'applied',
        ]);

        return redirect()->route('jobs.index')->with('success', 'Application submitted successfully!');
    }

    public function myApplications()
    {
        $applications = Application::where('user_id', Auth::id())
            ->with('job.user', 'job.location')
            ->latest()
            ->get();
        return view('jobseeker.applications', compact('applications'));
    }
}
