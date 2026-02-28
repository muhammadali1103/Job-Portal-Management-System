<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'permissions' => json_encode(['all'])],
            ['id' => 2, 'name' => 'employer', 'permissions' => json_encode(['post_jobs', 'manage_applications'])],
            ['id' => 3, 'name' => 'jobseeker', 'permissions' => json_encode(['apply_jobs'])],
        ]);
    }
}
