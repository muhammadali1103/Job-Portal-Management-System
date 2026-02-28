<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Job;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestJobsSeeder extends Seeder
{
    public function run(): void
    {
        $employerRole = Role::firstOrCreate(['name' => 'employer'], ['permissions' => []]);

        $employer = User::firstOrCreate(
            ['email' => 'test.employer@jobsportal.local'],
            [
                'name' => 'Jobs Portal Test Employer',
                'password' => 'password',
                'role_id' => $employerRole->id,
            ]
        );

        $categories = collect([
            'IT & Software',
            'Sales & Retail',
            'Administration & HR',
            'Logistics & Supply Chain',
            'Engineering',
            'Accounting & Finance',
        ])->mapWithKeys(function (string $name) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'icon' => 'briefcase']
            );

            return [$name => $category];
        });

        $locations = collect([
            'Salmiya',
            'Hawally',
            'Salmiya',
            'Farwaniya',
            'Ahmadi',
            'Jahra',
        ])->map(function (string $city) {
            return Location::firstOrCreate(['city' => $city], ['country' => 'Global', 'city' => $city]);
        });

        $testJobs = [
            [
                'title' => 'TEST - Frontend Developer (React)',
                'description' => 'Testing job post for UI checks and application flow.',
                'category' => 'IT & Software',
                'location' => 'Salmiya',
                'salary_min' => 900,
                'salary_max' => 1300,
                'job_type' => 'Full-time',
                'experience' => '2+ Years',
            ],
            [
                'title' => 'TEST - Sales Coordinator',
                'description' => 'Testing job post for list, search, and filter behavior.',
                'category' => 'Sales & Retail',
                'location' => 'Hawally',
                'salary_min' => 450,
                'salary_max' => 700,
                'job_type' => 'Full-time',
                'experience' => '1-2 Years',
            ],
            [
                'title' => 'TEST - HR Assistant',
                'description' => 'Testing job post to validate dashboard and category pages.',
                'category' => 'Administration & HR',
                'location' => 'Salmiya',
                'salary_min' => 500,
                'salary_max' => 750,
                'job_type' => 'Full-time',
                'experience' => '1+ Year',
            ],
            [
                'title' => 'TEST - Warehouse Supervisor',
                'description' => 'Testing job post for contact methods and detail page layout.',
                'category' => 'Logistics & Supply Chain',
                'location' => 'Farwaniya',
                'salary_min' => 650,
                'salary_max' => 900,
                'job_type' => 'Contract',
                'experience' => '3+ Years',
            ],
            [
                'title' => 'TEST - Mechanical Engineer',
                'description' => 'Testing job post for SEO fields and slug generation.',
                'category' => 'Engineering',
                'location' => 'Ahmadi',
                'salary_min' => 1000,
                'salary_max' => 1500,
                'job_type' => 'Full-time',
                'experience' => '3-5 Years',
            ],
            [
                'title' => 'TEST - Junior Accountant',
                'description' => 'Testing job post for pagination and cards on home page.',
                'category' => 'Accounting & Finance',
                'location' => 'Jahra',
                'salary_min' => 550,
                'salary_max' => 800,
                'job_type' => 'Part-time',
                'experience' => '1-2 Years',
            ],
        ];

        foreach ($testJobs as $index => $jobData) {
            $category = $categories[$jobData['category']];
            $location = $locations[$index];

            Job::updateOrCreate(
                ['title' => $jobData['title']],
                [
                    'user_id' => $employer->id,
                    'company_name' => 'Jobs Portal Test Company',
                    'description' => $jobData['description'],
                    'category_id' => $category->id,
                    'location_id' => $location->id,
                    'salary_min' => $jobData['salary_min'],
                    'salary_max' => $jobData['salary_max'],
                    'job_type' => $jobData['job_type'],
                    'experience' => $jobData['experience'],
                    'nationality' => 'Any',
                    'apply_method' => 'email',
                    'apply_value' => 'test-jobs@jobsportal.local',
                    'contact_email' => 'test-jobs@jobsportal.local',
                    'primary_country_code' => '+965',
                    'primary_mobile' => '9000000' . $index,
                    'status' => 'approved',
                    'is_featured' => $index < 2,
                ]
            );
        }

        $this->command->info('6 test jobs added/updated successfully.');
    }
}


