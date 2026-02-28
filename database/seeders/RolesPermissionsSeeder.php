<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles exist
        Role::updateOrCreate(['id' => 1], ['name' => 'admin']);
        Role::updateOrCreate(['id' => 2], ['name' => 'employer']);
        Role::updateOrCreate(['id' => 3], ['name' => 'jobseeker']); // Default user
        Role::updateOrCreate(['id' => 4], ['name' => 'moderator']);
    }
}
