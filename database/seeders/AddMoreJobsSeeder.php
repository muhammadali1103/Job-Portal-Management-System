<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AddMoreJobsSeeder extends Seeder
{
    public function run()
    {
        $admin = User::first(); // Assign to admin
        $userId = $admin ? $admin->id : 1;

        // Ensure locations exist
        $locations = [
            'Salmiya',
            'Hawally',
            'Salmiya',
            'Fahaheel',
            'Farwaniya',
            'Sharq',
            'Mahboula',
            'Ahmadi',
            'Shuwaikh',
            'Murqab',
            'Jahra'
        ];

        foreach ($locations as $city) {
            Location::firstOrCreate(['city' => $city], ['country' => 'Global']);
        }

        $jobs = [
            [
                'title' => 'Cook needed',
                'description' => 'Need a cook who can prepare South and North Indian food for an Indian hotel. Must be 18 years transferable visa. Immediate joining.',
                'company_name' => 'Indian Hotel',
                'location' => 'Hawally',
                'category' => 'Hospitality & Tourism',
                'role' => 'Cook',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'url',
                'apply_value' => url('/'), // Placeholder or site link
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Manicure and Pedicure Job',
                'description' => 'We are looking for a skilled and passionate Manicure & Pedicure Technician to join our beauty salon team in Global. The ideal candidate will have excellent nail care skills and a friendly personality.',
                'company_name' => 'Beauty Salon',
                'location' => 'Sharq',
                'category' => 'Beauty & Wellness',
                'role' => 'Nail Technician',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Admin cum Front Office Staff (Lady)',
                'description' => 'We are hiring a Lady Admin cum Front Office Staff for our office in Mahboula. Candidate must be fluent in English, have good computer skills, and experience in admin work.',
                'company_name' => 'Private Office',
                'location' => 'Mahboula',
                'category' => 'Administration & HR',
                'role' => 'Admin Staff',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Technical Manager',
                'description' => 'We are looking for an experienced Technical Manager with strong expertise in heavy equipment maintenance and operations. The candidate must have in-depth knowledge of diesel engines, hydraulics, and troubleshooting heavy machinery.',
                'company_name' => 'Heavy Equipment Co.',
                'location' => 'Salmiya',
                'category' => 'Construction & Civil',
                'role' => 'Technical Manager',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Industrial Automation Engineer',
                'description' => 'Key Responsibilities: Expert in industrial automation systems (PLC, SCADA, HMI). Design, program, and commission automation solutions. Troubleshoot and maintain automation equipment.',
                'company_name' => 'Industrial Solutions',
                'location' => 'Salmiya',
                'category' => 'Engineering',
                'role' => 'Automation Engineer',
                'salary_min' => 650,
                'salary_max' => 750,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Technical Supervisor',
                'description' => 'We are seeking an experienced Technical Supervisor for heavy equipment operations. Candidate must have strong leadership skills, knowledge of maintenance schedules, and ability to manage a team of technicians.',
                'company_name' => 'Heavy Equipment Co.',
                'location' => 'Salmiya',
                'category' => 'Construction & Civil',
                'role' => 'Technical Supervisor',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Hair Stylist and Nail Technician',
                'description' => 'Open Positions: Hair Stylist: Expert in cutting, coloring, blow dry, wavy, threading, and facial. Nail Technician: Expert in manicure, pedicure, nail extensions, and nail art. Good salary and accommodation provided.',
                'company_name' => 'Luxury Salon',
                'location' => 'Salmiya',
                'category' => 'Beauty & Wellness',
                'role' => 'Hair Stylist',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Safety Officer',
                'description' => 'Hiring Mode: Local Hiring Only. Visa Status: Transferable (Article 18). Experience: Minimum 3 years in construction or oil & gas sector. Must have valid Global driving license.',
                'company_name' => 'Construction Co.',
                'location' => 'Fahaheel',
                'category' => 'Security & Safety',
                'role' => 'Safety Officer',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Planning Engineer (Primavera P6)',
                'description' => 'Position Open: Junior Planning Engineer. Requirements: Proficient in Primavera P6, good communication skills, transferable visa.',
                'company_name' => 'Engineering Firm',
                'location' => 'Sharq',
                'category' => 'Engineering',
                'role' => 'Planning Engineer',
                'salary_min' => 500,
                'salary_max' => 500,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Senior Sales Executive',
                'description' => 'Looking for Sales Executives with minimum 5 year experience in Oil Sector to promote Mineral oils and lubricants. Must have Global driving license and transferable visa.',
                'company_name' => 'Oil Sector Co.',
                'location' => 'Sharq',
                'category' => 'Oil & Gas',
                'role' => 'Sales Executive',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Cleaner Vacancy',
                'description' => 'Job Responsibilities: Cleaning treatment rooms after every session. Cleaning and maintaining common areas. Restocking supplies. Ensuring high standards of hygiene. Female candidates preferred.',
                'company_name' => 'Cleaning Services',
                'location' => 'Salmiya',
                'category' => 'Hospitality & Tourism',
                'role' => 'Cleaner',
                'salary_min' => 180,
                'salary_max' => 180,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Heavy Driver - Ahmadi',
                'description' => 'Must have valid Global heavy driving license. Experience in oil field preferred. Accommodation will be in Mahboula.',
                'company_name' => 'Logistics Co.',
                'location' => 'Ahmadi',
                'category' => 'Driver & Delivery',
                'role' => 'Heavy Driver',
                'salary_min' => 250,
                'salary_max' => 250,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Packer Job',
                'description' => 'Hiring: Packer (Pastry Experience Required). We are looking for a Packer with prior experience in a bakery or pastry shop. Responsibilities include packing cakes, pastries, and breads neatly.',
                'company_name' => 'Bakery',
                'location' => 'Salmiya',
                'category' => 'Hospitality & Tourism', // Or Others
                'role' => 'Packer',
                'salary_min' => 200,
                'salary_max' => 250,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Hijab Experienced Salesman',
                'description' => 'We require salesman for Hijab selling shop. The sales should have experience with Local customers and good communication skills in Arabic and English.',
                'company_name' => 'Retail Shop',
                'location' => 'Salmiya',
                'category' => 'Sales & Retail',
                'role' => 'Salesman',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Female Cashier',
                'description' => 'POS & supermarket experience compulsory. Arabic speaking is preferable. Transferable visa required.',
                'company_name' => 'Supermarket',
                'location' => 'Shuwaikh',
                'category' => 'Sales & Retail',
                'role' => 'Cashier',
                'salary_min' => 250,
                'salary_max' => 250,
                'apply_method' => 'whatsapp', // User provided contact info implies whatsapp
                'apply_value' => '+96500000000', // Placeholder as per 'number on site posting'
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Chef for Diet Restaurant',
                'description' => 'Wanted: Chef for a Diet Restaurant Kitchen. Requirements: 1. Fluent in English. 2. Experience in healthy and diet meals. 3. Creative with low-calorie recipes. Immediate joining.',
                'company_name' => 'Diet Restaurant',
                'location' => 'Murqab',
                'category' => 'Hospitality & Tourism',
                'role' => 'Chef',
                'salary_min' => 250,
                'salary_max' => 250,
                'apply_method' => 'url',
                'apply_value' => url('/'),
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Juice Prep Expert / Barista',
                'description' => 'Must have experience. Wanted: Barista for a café in Global. Juice maker. Manage inventory and Excel sheets if needed.',
                'company_name' => 'Cafe Global',
                'location' => 'Hawally',
                'category' => 'Hospitality & Tourism',
                'role' => 'Barista',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'whatsapp',
                'apply_value' => '+96555027720',
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Site Supervisor',
                'description' => 'We are looking for a site supervisor for site visits and coordination for MEP services. Immediate joining required. Degree or Diploma holders.',
                'company_name' => 'MEP Services',
                'location' => 'Shuwaikh',
                'category' => 'Construction & Civil',
                'role' => 'Site Supervisor',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'email',
                'apply_value' => 'ibrahimkwt@outlook.com',
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'AutoCAD Draftsman - Fire Suppression',
                'description' => 'We are seeking an experienced AutoCAD Draftsman with strong knowledge of fire suppression system drawings to join our team in Global. Experience with 2D/3D AutoCAD drafting is essential.',
                'company_name' => 'Engineering Office',
                'location' => 'Salmiya',
                'category' => 'Engineering',
                'role' => 'Draftsman',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'email',
                'apply_value' => 'shajisalimm@gmail.com',
                'job_type' => 'Full Time',
            ],
            [
                'title' => 'Fresh Graduate Automation Engineer',
                'description' => 'A leading construction company is seeking qualified candidates to work on water and wastewater projects in Global. Degree/Diploma in Automation, Electrical, Control, or related engineering field.',
                'company_name' => 'Construction Co.',
                'location' => 'Salmiya',
                'category' => 'Engineering',
                'role' => 'Automation Engineer',
                'salary_min' => null,
                'salary_max' => null,
                'apply_method' => 'whatsapp',
                'apply_value' => '+96560446377',
                'job_type' => 'Full Time',
            ],
        ];

        foreach ($jobs as $jobData) {
            $cat = Category::where('name', $jobData['category'])->first();
            $loc = Location::where('city', $jobData['location'])->first();

            if (!$cat || !$loc) {
                // Fallback or skip
                continue;
            }

            try {
                Job::create([
                    'user_id' => $userId,
                    'title' => $jobData['title'],
                    // Slug is auto-generated by model
                    'description' => htmlspecialchars($jobData['description']), // Basic escaping
                    'company_name' => $jobData['company_name'],
                    'category_id' => $cat->id,
                    'location_id' => $loc->id,
                    'salary_min' => $jobData['salary_min'],
                    'salary_max' => $jobData['salary_max'],
                    'job_type' => $jobData['job_type'],
                    'apply_method' => $jobData['apply_method'], // 'url', 'email', 'whatsapp'
                    'apply_value' => $jobData['apply_value'],
                    'status' => 'approved',
                    'job_role' => $jobData['role'],
                    'is_featured' => false,
                    'contact_email' => $jobData['apply_method'] === 'email' ? $jobData['apply_value'] : null,
                    // Add defaults for other fields if nullable
                ]);
            } catch (\Exception $e) {
                echo "Failed to create job: " . $jobData['title'] . "\n";
                echo $e->getMessage() . "\n";
            }
        }
    }
}


