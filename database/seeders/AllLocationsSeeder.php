<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class AllLocationsSeeder extends Seeder
{
    public function run()
    {
        // Check if exists, if not create
        Location::firstOrCreate(
            ['city' => 'All Locations'],
            ['country' => 'Global']
        );
    }
}


