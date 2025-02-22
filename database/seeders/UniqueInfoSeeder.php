<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UniqueInfo;
use App\Models\Product;

class UniqueInfoSeeder extends Seeder
{
    public function run()
    {
        $uniqueInfos = [
            ['title' => 'Material', 'description' => 'Leather Material', 'product_id' => Product::where('name', 'Modern Sofa')->first()->id],
            ['title' => 'Feature', 'description' => 'Adjustable Height', 'product_id' => Product::where('name', 'Office Chair')->first()->id],
            ['title' => 'Material', 'description' => 'Solid Wood', 'product_id' => Product::where('name', 'Dining Table')->first()->id],
        ];

        foreach ($uniqueInfos as $uniqueInfo) {
            UniqueInfo::create($uniqueInfo);
        }
    }
}
