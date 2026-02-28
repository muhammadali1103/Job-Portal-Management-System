<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_jobs_index_has_proper_canonical_tag()
    {
        $response = $this->get(route('jobs.index'));

        $response->assertStatus(200);
        $response->assertSee('<link rel="canonical" href="' . route('jobs.index') . '">', false);
    }

    public function test_category_filtered_jobs_has_proper_canonical_tag()
    {
        $category = Category::create(['name' => 'IT', 'slug' => 'it']);

        $url = route('jobs.index', ['category_id' => $category->id]);
        $response = $this->get($url);

        $response->assertStatus(200);
        // We expect the canonical to match the URL exactly, including the category_id
        $response->assertSee('<link rel="canonical" href="' . $url . '">', false);
    }

    public function test_sitemap_urls_are_consistent()
    {
        $category = Category::create(['name' => 'IT', 'slug' => 'it']);
        Job::create([
            'title' => 'Test Job',
            'slug' => 'test-job',
            'description' => 'Test Description',
            'category_id' => $category->id,
            'status' => 'approved',
            'job_role' => 'Software Engineer',
            'job_type' => 'Full Time',
        ]);

        $response = $this->get(route('sitemap'));
        $response->assertStatus(200);

        $categoryUrl = route('jobs.index', ['category_id' => $category->id]);
        $response->assertSee($categoryUrl);
    }
}
