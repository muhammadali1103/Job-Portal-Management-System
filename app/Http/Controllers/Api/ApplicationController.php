<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        // Return applications for the authenticated user (if jobseeker) or for jobs owned by user (if employer)
        // Ignoring complex logic for MVP, returning all for now or filtering by user
        $applications = Application::with(['job', 'user'])->where('user_id', Auth::id())->get();
        return response()->json($applications);
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $path = $request->file('resume')->store('resumes');

        $application = Application::create([
            'job_id' => $request->job_id,
            'user_id' => Auth::id(),
            'resume_link' => $path,
            'status' => 'applied'
        ]);

        return response()->json($application, 201);
    }
}
