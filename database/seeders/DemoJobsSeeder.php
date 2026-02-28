<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use App\Models\Location;

class DemoJobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing data
        $users = User::where('role_id', 2)->get(); // Employers
        $categories = Category::all();
        $locations = Location::all();

        // If no employers exist, create one
        if ($users->isEmpty()) {
            $users = collect([
                User::create([
                    'name' => 'Global Technology Co.',
                    'email' => 'tech@demo.com',
                    'password' => bcrypt('password'),
                    'role_id' => 2,
                ])
            ]);
        }

        // Demo jobs data
        $demoJobs = [
            [
                'title' => 'Senior Full Stack Developer',
                'description' => "We are seeking an experienced Full Stack Developer to join our growing team.\n\nResponsibilities:\n- Develop and maintain web applications\n- Work with modern frameworks (Laravel, React)\n- Collaborate with design and product teams\n- Write clean, maintainable code\n- Participate in code reviews\n\nRequirements:\n- 5+ years of development experience\n- Strong knowledge of PHP and JavaScript\n- Experience with Laravel and Vue.js/React\n- Understanding of RESTful APIs\n- Excellent problem-solving skills",
                'job_type' => 'Full-time',
                'experience' => '5+ Years',
                'salary_min' => 1200,
                'salary_max' => 1800,
            ],
            [
                'title' => 'Marketing Manager',
                'description' => "Join our marketing team as a Marketing Manager.\n\nKey Responsibilities:\n- Develop and execute marketing strategies\n- Manage social media campaigns\n- Analyze market trends\n- Coordinate with sales team\n- Manage marketing budget\n\nQualifications:\n- Bachelor's degree in Marketing\n- 3+ years in marketing role\n- Strong communication skills\n- Experience with digital marketing\n- Creative thinking",
                'job_type' => 'Full-time',
                'experience' => '3-5 Years',
                'salary_min' => 800,
                'salary_max' => 1200,
            ],
            [
                'title' => 'Accountant',
                'description' => "We are looking for a detail-oriented Accountant.\n\nDuties:\n- Prepare financial statements\n- Manage accounts payable/receivable\n- Process payroll\n- Maintain financial records\n- Assist with audits\n\nRequirements:\n- Bachelor's in Accounting/Finance\n- CPA certification preferred\n- 2+ years experience\n- Proficiency in accounting software\n- Strong analytical skills",
                'job_type' => 'Full-time',
                'experience' => '2-4 Years',
                'salary_min' => 700,
                'salary_max' => 1000,
            ],
            [
                'title' => 'UI/UX Designer',
                'description' => "Creative UI/UX Designer needed for our product team.\n\nResponsibilities:\n- Design user interfaces for web and mobile\n- Create wireframes and prototypes\n- Conduct user research\n- Collaborate with developers\n- Maintain design systems\n\nRequirements:\n- Portfolio demonstrating UI/UX work\n- Proficiency in Figma/Adobe XD\n- Understanding of responsive design\n- 3+ years experience\n- Strong visual design skills",
                'job_type' => 'Full-time',
                'experience' => '3+ Years',
                'salary_min' => 900,
                'salary_max' => 1400,
            ],
            [
                'title' => 'Sales Executive',
                'description' => "Dynamic Sales Executive wanted to drive business growth.\n\nRole:\n- Generate new business opportunities\n- Build client relationships\n- Meet sales targets\n- Present product demos\n- Negotiate contracts\n\nQualifications:\n- Proven sales track record\n- Excellent communication skills\n- Self-motivated\n- 2+ years in sales\n- Valid driver's license",
                'job_type' => 'Full-time',
                'experience' => '2-3 Years',
                'salary_min' => 600,
                'salary_max' => 1000,
            ],
            [
                'title' => 'Customer Service Representative',
                'description' => "Customer-focused representative needed.\n\nDuties:\n- Handle customer inquiries\n- Resolve complaints\n- Process orders\n- Maintain customer records\n- Provide product information\n\nRequirements:\n- High school diploma\n- 1+ year customer service experience\n- Excellent communication\n- Bilingual (English/Arabic) preferred\n- Patient and friendly",
                'job_type' => 'Full-time',
                'experience' => '1-2 Years',
                'salary_min' => 400,
                'salary_max' => 600,
            ],
            [
                'title' => 'Project Manager',
                'description' => "Experienced Project Manager for tech projects.\n\nResponsibilities:\n- Lead project teams\n- Define project scope and goals\n- Manage budgets and timelines\n- Coordinate with stakeholders\n- Ensure project delivery\n\nRequirements:\n- PMP certification preferred\n- 5+ years project management\n- Agile/Scrum experience\n- Strong leadership skills\n- Excellent organization",
                'job_type' => 'Full-time',
                'experience' => '5+ Years',
                'salary_min' => 1500,
                'salary_max' => 2000,
            ],
            [
                'title' => 'Data Analyst',
                'description' => "Data Analyst to support business decisions.\n\nRole:\n- Analyze business data\n- Create reports and dashboards\n- Identify trends and insights\n- Work with databases\n- Present findings to management\n\nQualifications:\n- Bachelor's in related field\n- SQL proficiency\n- Experience with Excel, Tableau\n- 2+ years experience\n- Strong analytical thinking",
                'job_type' => 'Full-time',
                'experience' => '2-4 Years',
                'salary_min' => 800,
                'salary_max' => 1200,
            ],
            [
                'title' => 'HR Coordinator',
                'description' => "HR Coordinator for growing company.\n\nDuties:\n- Assist with recruitment\n- Handle employee onboarding\n- Maintain HR records\n- Coordinate training programs\n- Support HR manager\n\nRequirements:\n- Bachelor's in HR/Business\n- 1-2 years HR experience\n- Knowledge of labor laws\n- Strong interpersonal skills\n- Organized and detail-oriented",
                'job_type' => 'Full-time',
                'experience' => '1-2 Years',
                'salary_min' => 500,
                'salary_max' => 800,
            ],
            [
                'title' => 'Content Writer',
                'description' => "Creative Content Writer for digital content.\n\nResponsibilities:\n- Write blog posts and articles\n- Create marketing copy\n- Edit and proofread content\n- Research industry topics\n- Optimize for SEO\n\nRequirements:\n- Bachelor's in English/Journalism\n- Portfolio of writing samples\n- 2+ years writing experience\n- SEO knowledge\n- Excellent grammar",
                'job_type' => 'Full-time',
                'experience' => '2-3 Years',
                'salary_min' => 500,
                'salary_max' => 800,
            ],
            [
                'title' => 'Graphic Designer',
                'description' => "Talented Graphic Designer needed.\n\nRole:\n- Design marketing materials\n- Create social media graphics\n- Develop brand assets\n- Work on print and digital\n- Maintain brand consistency\n\nQualifications:\n- Design portfolio required\n- Adobe Creative Suite expertise\n- 2+ years experience\n- Creative and innovative\n- Time management skills",
                'job_type' => 'Full-time',
                'experience' => '2-4 Years',
                'salary_min' => 600,
                'salary_max' => 900,
            ],
            [
                'title' => 'Administrative Assistant',
                'description' => "Organized Administrative Assistant wanted.\n\nDuties:\n- Manage schedules and appointments\n- Handle correspondence\n- Organize files and documents\n- Coordinate meetings\n- Support office operations\n\nRequirements:\n- High school diploma\n- 1+ year admin experience\n- MS Office proficiency\n- Strong organizational skills\n- Professional demeanor",
                'job_type' => 'Full-time',
                'experience' => '1-2 Years',
                'salary_min' => 400,
                'salary_max' => 600,
            ],
        ];

        // Create jobs
        foreach ($demoJobs as $jobData) {
            Job::create([
                'user_id' => $users->random()->id,
                'title' => $jobData['title'],
                'description' => $jobData['description'],
                'category_id' => $categories->random()->id,
                'location_id' => $locations->random()->id,
                'salary_min' => $jobData['salary_min'],
                'salary_max' => $jobData['salary_max'],
                'job_type' => $jobData['job_type'],
                'experience' => $jobData['experience'],
                'apply_method' => 'email',
                'apply_value' => 'jobs@demo.com',
                'status' => 'approved',
                'is_featured' => rand(0, 1), // Randomly feature some jobs
            ]);
        }

        $this->command->info('Demo jobs created successfully!');
    }
}

