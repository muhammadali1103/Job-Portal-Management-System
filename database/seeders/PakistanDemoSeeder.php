<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Job;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PakistanDemoSeeder extends Seeder
{
    public function run(): void
    {
        $employer = User::where('role_id', 2)->first();
        if (!$employer) {
            $employer = User::create([
                'name' => 'Demo Employer',
                'email' => 'demo.employer@jobsportal.local',
                'password' => 'password',
                'role_id' => 2,
            ]);
        }

        $categoryNames = [
            'IT & Software',
            'Sales & Retail',
            'Customer Service',
            'Administration & HR',
            'Accounting & Finance',
        ];

        foreach ($categoryNames as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'icon' => 'briefcase']
            );
        }

        $pakCities = ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan'];
        foreach ($pakCities as $city) {
            Location::firstOrCreate(['country' => 'Pakistan', 'city' => $city]);
        }

        $jobs = [
            ['title' => 'Demo Frontend Developer - Karachi', 'description' => 'Demo job for testing listings and filters.', 'cat' => 'IT & Software', 'city' => 'Karachi', 'salary_min' => 120000, 'salary_max' => 180000, 'job_type' => 'Full-time', 'experience' => '2+ Years'],
            ['title' => 'Demo Sales Executive - Lahore', 'description' => 'Demo sales role for QA and UI testing.', 'cat' => 'Sales & Retail', 'city' => 'Lahore', 'salary_min' => 60000, 'salary_max' => 90000, 'job_type' => 'Full-time', 'experience' => '1-2 Years'],
            ['title' => 'Demo Customer Support Agent - Islamabad', 'description' => 'Demo support role with email application method.', 'cat' => 'Customer Service', 'city' => 'Islamabad', 'salary_min' => 50000, 'salary_max' => 80000, 'job_type' => 'Full-time', 'experience' => '1+ Year'],
            ['title' => 'Demo Admin Assistant - Rawalpindi', 'description' => 'Demo admin assistant posting for test data.', 'cat' => 'Administration & HR', 'city' => 'Rawalpindi', 'salary_min' => 55000, 'salary_max' => 85000, 'job_type' => 'Full-time', 'experience' => '1-2 Years'],
            ['title' => 'Demo Junior Accountant - Faisalabad', 'description' => 'Demo accounting job for pagination and details view.', 'cat' => 'Accounting & Finance', 'city' => 'Faisalabad', 'salary_min' => 70000, 'salary_max' => 110000, 'job_type' => 'Full-time', 'experience' => '1-3 Years'],
            ['title' => 'Demo Laravel Developer - Multan', 'description' => 'Demo backend role for end-to-end testing.', 'cat' => 'IT & Software', 'city' => 'Multan', 'salary_min' => 130000, 'salary_max' => 200000, 'job_type' => 'Full-time', 'experience' => '3+ Years'],
        ];

        foreach ($jobs as $index => $jobData) {
            $category = Category::where('slug', Str::slug($jobData['cat']))->first();
            $location = Location::where('country', 'Pakistan')->where('city', $jobData['city'])->first();

            Job::updateOrCreate(
                ['title' => $jobData['title']],
                [
                    'user_id' => $employer->id,
                    'company_name' => 'Pakistan Demo Co',
                    'description' => $jobData['description'],
                    'category_id' => $category?->id,
                    'location_id' => $location?->id,
                    'salary_min' => $jobData['salary_min'],
                    'salary_max' => $jobData['salary_max'],
                    'job_type' => $jobData['job_type'],
                    'experience' => $jobData['experience'],
                    'nationality' => 'Any',
                    'apply_method' => 'email',
                    'apply_value' => 'careers@demo.local',
                    'contact_email' => 'careers@demo.local',
                    'primary_country_code' => '+92',
                    'primary_mobile' => '30000000' . $index,
                    'status' => 'approved',
                    'is_featured' => $index < 2,
                ]
            );
        }

        $this->command->info('Pakistan demo data seeded.');
    }
}

