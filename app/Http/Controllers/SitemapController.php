<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'approved')
            ->select('id', 'title', 'slug', 'updated_at')
            ->latest('updated_at')
            ->get();

        $categories = Category::select('id', 'name', 'updated_at')->get();

        $content = view('sitemap', [
            'jobs' => $jobs,
            'categories' => $categories,
        ])->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
