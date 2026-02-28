<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryUpdateSeeder extends Seeder
{
    public function run(): void
    {
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
    }
}
