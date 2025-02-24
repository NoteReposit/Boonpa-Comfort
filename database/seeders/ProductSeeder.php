<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\RoomType;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // สร้าง Product 20 รายการ
        Product::factory(20)->create();
    }
}
