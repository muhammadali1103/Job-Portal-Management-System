<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Calculate Line Chart Data (Last 30 Days)
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

        // We can add more detailed stats here later (Location wise, Category wise etc.)

        return view('admin.analytics.index', compact('chartData'));
    }
}
