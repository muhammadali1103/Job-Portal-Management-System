<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Location;
use App\Models\Skill;
use App\Models\Job;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles (Already handled by RolesSeeder but ensuring they exist)
        $this->call(RolesSeeder::class);

        // 2. Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@JobsPortal.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role_id' => 1, // Admin
            ]
        );

        $employer = User::firstOrCreate(
            ['email' => 'employer@company.com'],
            [
                'name' => 'Tech Solutions Co.',
                'password' => Hash::make('password'),
                'role_id' => 2, // Employer
                'profile_photo' => 'https://ui-avatars.com/api/?name=Tech+Solutions',
            ]
        );

        $seeker = User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'role_id' => 3, // Jobseeker
            ]
        );

        // 3. Categories
        $categories = [
            ['name' => 'Oil & Gas / Energy', 'slug' => 'oil-gas', 'icon' => '🛢️'],
            ['name' => 'Construction & Civil', 'slug' => 'construction', 'icon' => '🏗️'],
            ['name' => 'Driver & Delivery', 'slug' => 'driver-delivery', 'icon' => '🚚'],
            ['name' => 'Domestic Helper', 'slug' => 'domestic-helper', 'icon' => '🧹'],
            ['name' => 'Sales & Retail', 'slug' => 'sales-retail', 'icon' => '🛍️'],
            ['name' => 'IT & Software', 'slug' => 'it-software', 'icon' => '💻'],
            ['name' => 'Accounting & Finance', 'slug' => 'accounting-finance', 'icon' => '💰'],
            ['name' => 'Engineering', 'slug' => 'engineering', 'icon' => '⚙️'],
            ['name' => 'Medical & Healthcare', 'slug' => 'medical', 'icon' => '🏥'],
            ['name' => 'Education & Teaching', 'slug' => 'education', 'icon' => '🎓'],
            ['name' => 'Administration & HR', 'slug' => 'admin-hr', 'icon' => '📋'],
            ['name' => 'Logistics & Supply Chain', 'slug' => 'logistics', 'icon' => '🚢'],
            ['name' => 'Hospitality & Tourism', 'slug' => 'hospitality', 'icon' => '🏨'],
            ['name' => 'Real Estate', 'slug' => 'real-estate', 'icon' => '🏢'],
            ['name' => 'Security & Safety', 'slug' => 'security', 'icon' => '👮'],
            ['name' => 'Beauty & Wellness', 'slug' => 'beauty', 'icon' => '💇'],
            ['name' => 'Automotive', 'slug' => 'automotive', 'icon' => '🚗'],
            ['name' => 'Legal', 'slug' => 'legal', 'icon' => '⚖️'],
            ['name' => 'Others', 'slug' => 'others', 'icon' => '📦'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 4. Locations
        $locations = [
            ['country' => 'Global', 'city' => 'Salmiya'],
            ['country' => 'Global', 'city' => 'Hawally'],
            ['country' => 'Global', 'city' => 'Salmiya'],
            ['country' => 'Global', 'city' => 'Fahaheel'],
            ['country' => 'Global', 'city' => 'Farwaniya'],
            ['country' => 'Global', 'city' => 'Ahmadi'],
            ['country' => 'Global', 'city' => 'Jahra'],
        ];

        foreach ($locations as $loc) {
            Location::firstOrCreate(['city' => $loc['city']], $loc);
        }

        // 5. Skills
        $skills = ['PHP', 'Laravel', 'React', 'Sales', 'Communication', 'Project Management', 'AutoCAD', 'Accounting', 'Driving', 'Cooking', 'Teaching'];
        foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill]);
        }

        // 6. Jobs
        $cats = Category::all();
        $locs = Location::all();
        $allSkills = Skill::all();

        $jobs = [
            [
                'title' => 'Senior Laravel Developer',
                'description' => "We are looking for an experienced Laravel developer to join our team.\n\nResponsibilities:\n- Build robust APIs.\n- Optimize database queries.\n- Collaborate with frontend team.",
                'salary_min' => 1200,
                'salary_max' => 1800,
                'job_type' => 'Full-time',
                'experience' => '5+ Years',
                'status' => 'approved',
                'is_featured' => true,
                'nationality' => 'Any',
                'apply_method' => 'email',
                'apply_value' => 'tech@example.com',
            ],
            [
                'title' => 'Sales Executive',
                'description' => "Join our dynamic sales team. We need a motivated individual who can drive sales and build relationships.\n\nRequirements:\n- Proven track record.\n- Valid driving license.",
                'salary_min' => 400,
                'salary_max' => 700,
                'job_type' => 'Full-time',
                'experience' => '2 Years',
                'status' => 'approved',
                'is_featured' => false,
                'nationality' => 'Arab Nationals',
                'apply_method' => 'whatsapp',
                'apply_value' => '96599999999',
            ],
            [
                'title' => 'Civil Engineer',
                'description' => "Site engineer needed for a major construction project in South Global.",
                'salary_min' => 800,
                'salary_max' => 1200,
                'job_type' => 'Contract',
                'experience' => '3 Years',
                'status' => 'pending', // Pending approval
                'is_featured' => false,
                'nationality' => 'Indian',
                'apply_method' => 'phone',
                'apply_value' => '96588888888',
            ],
            [
                'title' => 'Light Driver',
                'description' => "Need a reliable driver with valid Global license. 18 Visa transferable.",
                'salary_min' => 250,
                'salary_max' => 300,
                'job_type' => 'Full-time',
                'experience' => '1 Year',
                'status' => 'approved',
                'is_featured' => true,
                'nationality' => 'Indian / Filipino',
                'apply_method' => 'whatsapp',
                'apply_value' => '96577777777',
            ]
        ];

        foreach ($jobs as $index => $jobData) {
            $categorySlug = match ($index) {
                0 => 'others', // Fallback or IT if added
                1 => 'sales-marketing',
                2 => 'engineering-technical',
                3 => 'labor-skilled',
                default => 'others',
            };

            $category = $cats->where('slug', $categorySlug)->first() ?? $cats->first();

            $job = Job::create(array_merge($jobData, [
                'user_id' => $employer->id,
                'category_id' => $category->id,
                'location_id' => $locs->random()->id,
                'apply_link' => null // Deprecated
            ]));

            // Attach random skills
            $job->skills()->attach($allSkills->random(2));
        }

        // 7. Applications
        // John applies to Laravel job
        $job = Job::where('title', 'Senior Laravel Developer')->first();
        if ($job) {
            \App\Models\Application::create([
                'job_id' => $job->id,
                'user_id' => $seeker->id,
                'resume_link' => 'resumes/dummy.pdf',
                'status' => 'applied'
            ]);
        }
    }
}


