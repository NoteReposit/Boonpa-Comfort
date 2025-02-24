<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Sofas', 'description' => 'Comfortable and stylish sofas'],
            ['name' => 'Tables', 'description' => 'Dining and coffee tables'],
            ['name' => 'Chairs', 'description' => 'Office and home chairs'],
            ['name' => 'Beds', 'description' => 'Different types of beds'],
            ['name' => 'Cabinets', 'description' => 'Storage cabinets and shelves'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}