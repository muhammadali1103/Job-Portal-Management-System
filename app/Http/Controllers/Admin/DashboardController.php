<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Overall Stats
        $stats = [
            'total_jobs' => Job::count(),
            'pending_jobs' => Job::where('status', 'pending')->count(),
            'total_users' => User::count(),
            'total_applications' => Application::count(),
        ];

        // 2. Time-based Stats (Daily, Weekly, Monthly)
        $periods = [
            'daily' => now()->startOfDay(),
            'weekly' => now()->subDays(7),
            'monthly' => now()->subDays(30),
        ];

        $timeStats = [];
        foreach ($periods as $key => $date) {
            $timeStats[$key] = [
                'jobs_posted' => Job::where('created_at', '>=', $date)->count(),
                'views' => \App\Models\JobAnalytics::where('type', 'view')->where('created_at', '>=', $date)->count(),
                'clicks' => \App\Models\JobAnalytics::where('type', 'click')->where('created_at', '>=', $date)->count(),
            ];
        }

        // 3. Chart Data (Last 30 Days) - Kept for detailed page if needed
        $chartData = [
            'labels' => [],
            'views' => [],
            'applies' => []
        ];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartData['labels'][] = now()->subDays($i)->format('M d');

            $chartData['views'][] = \App\Models\JobAnalytics::where('type', 'view')
                ->whereDate('created_at', $date)
                ->count();

            $chartData['applies'][] = \App\Models\JobAnalytics::where('type', 'click')
                ->whereDate('created_at', $date)
                ->count();
        }

        // 4. Filtered Data for Charts (Daily, Weekly, Monthly)
        $chartStats = [];
        foreach ($periods as $key => $date) {
            $views = \App\Models\JobAnalytics::where('type', 'view')->where('created_at', '>=', $date)->count();
            $applies = \App\Models\JobAnalytics::where('type', 'click')->where('created_at', '>=', $date)->count();

            // Device Stats (Simple heuristic)
            $mobile = \App\Models\JobAnalytics::where('created_at', '>=', $date)
                ->where('user_agent', 'LIKE', '%Mobile%')
                ->count();
            $desktop = ($views + $applies) - $mobile; // Approx total events - mobile

            $chartStats[$key] = [
                'views' => $views,
                'applies' => $applies,
                'devices' => [
                    'mobile' => $mobile,
                    'desktop' => max(0, $desktop)
                ]
            ];
        }

        $recent_jobs = Job::where('status', 'pending')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'timeStats', 'chartStats', 'recent_jobs'));
    }
}
