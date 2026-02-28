<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Application;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Admin users see admin dashboard
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        // All other registered users see employer dashboard (can post jobs)
        return $this->employerDashboard();
    }

    private function adminDashboard()
    {
        $stats = [
            'total_jobs' => Job::count(),
            'total_users' => User::count(),
            'pending_jobs' => Job::where('status', 'pending')->count(),
            'total_applications' => Application::count(),
        ];

        $recentJobs = Job::with('user')->latest()->take(5)->get();

        return view('dashboard.admin', compact('stats', 'recentJobs'));
    }

    private function employerDashboard()
    {
        $userId = Auth::id();

        $totalJobs = Job::where('user_id', $userId)->count();
        $approvedJobs = Job::where('user_id', $userId)->where('status', 'approved')->count();
        $pendingJobs = Job::where('user_id', $userId)->where('status', 'pending')->count();
        $totalApplications = Application::whereHas('job', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        $recentJobs = Job::where('user_id', $userId)
            ->withCount('applications')
            ->with(['location', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('totalJobs', 'approvedJobs', 'pendingJobs', 'totalApplications', 'recentJobs'));
    }

    private function jobseekerDashboard()
    {
        $applications = Application::where('user_id', Auth::id())->with('job.location')->latest()->get();
        return view('dashboard.jobseeker', compact('applications'));
    }
}
