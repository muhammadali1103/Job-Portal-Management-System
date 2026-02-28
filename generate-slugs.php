<?php

use App\Models\Job;
use Illuminate\Support\Str;

// Generate slugs for existing jobs
Job::whereNull('slug')->chunk(100, function ($jobs) {
    foreach ($jobs as $job) {
        $slug = Str::slug($job->title);
        $originalSlug = $slug;
        $counter = 1;

        // Ensure uniqueness
        while (Job::where('slug', $slug)->where('id', '!=', $job->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $job->slug = $slug;
        $job->save();

        echo "Generated slug for: {$job->title} -> {$slug}\n";
    }
});

echo "Done!\n";
