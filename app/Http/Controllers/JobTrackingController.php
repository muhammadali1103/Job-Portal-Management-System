<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobAnalytics;
use Illuminate\Http\Request;

class JobTrackingController extends Controller
{
    public function trackClick(Request $request, Job $job)
    {
        // Increment global counter
        $job->increment('clicks_count');

        // Log analytics event
        JobAnalytics::create([
            'job_id' => $job->id,
            'type' => 'click',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Determine destination
        $destination = null;

        if ($job->apply_method === 'url') {
            $destination = $job->apply_value;
        } elseif ($job->apply_method === 'whatsapp') {
            // Clean number and build wa.me link
            $number = preg_replace('/[^0-9]/', '', $job->apply_value);
            $destination = "https://wa.me/{$number}";
        } elseif ($job->apply_method === 'email') {
            $subject = rawurlencode("Application for {$job->title}");
            $destination = "mailto:{$job->apply_value}?subject={$subject}";
        } elseif ($job->apply_method === 'phone') {
            $destination = "tel:{$job->apply_value}";
        } else {
            // Fallback
            $destination = route('jobs.show', $job);
        }

        return redirect()->away($destination);
    }
}
