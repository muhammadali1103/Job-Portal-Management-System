<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobRole;
use Illuminate\Database\Seeder;

class JobRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $popularRoles = [
            // Sales & Marketing
            'Sales Executive',
            'Sales Manager',
            'Marketing Manager',
            'Digital Marketing Specialist',
            'Business Development Manager',

            // Engineering & Technical
            'Civil Engineer',
            'Mechanical Engineer',
            'Electrical Engineer',
            'Software Developer',
            'Web Developer',
            'Network Engineer',
            'IT Support Specialist',
            'Data Analyst',
            'Project Manager',

            // Healthcare
            'Nurse',
            'Pharmacist',
            'Medical Representative',
            'Lab Technician',
            'Physiotherapist',

            // Finance & Accounting
            'Accountant',
            'Financial Analyst',
            'Auditor',
            'Bookkeeper',

            // Hospitality & Food Service
            'Chef',
            'Cook',
            'Waiter',
            'Bartender',
            'Hotel Manager',
            'Front Desk Officer',

            // Administrative & Clerical
            'Secretary',
            'Receptionist',
            'Office Assistant',
            'Data Entry Operator',
            'HR Officer',
            'Admin Assistant',

            // Design & Creative
            'Graphic Designer',
            'UI/UX Designer',
            'Content Writer',
            'Video Editor',
            'Photographer',

            // Operations & Logistics
            'Driver',
            'Warehouse Supervisor',
            'Store Keeper',
            'Logistics Coordinator',
            'Supply Chain Manager',

            // Construction & Maintenance
            'Electrician',
            'Plumber',
            'Carpenter',
            'Mason',
            'HVAC Technician',
            'Maintenance Technician',

            // Retail & Customer Service
            'Sales Associate',
            'Cashier',
            'Customer Service Representative',
            'Store Manager',

            // Education
            'Teacher',
            'Trainer',
            'Academic Coordinator',

            // Security & Facilities
            'Security Guard',
            'Cleaner',
            'Housekeeper',
            'Facility Manager',

            // Specialized Roles
            'Technician',
            'Quality Control Inspector',
            'Production Supervisor',
            'Call Center Agent',
            'Delivery Driver'
        ];

        // Seed popular roles
        foreach ($popularRoles as $role) {
            JobRole::firstOrCreate(['name' => $role]);
        }

        // Seed existing roles from jobs
        $existingRoles = Job::whereNotNull('job_role')
            ->distinct()
            ->pluck('job_role');

        foreach ($existingRoles as $role) {
            JobRole::firstOrCreate(['name' => $role]);
        }
    }
}
