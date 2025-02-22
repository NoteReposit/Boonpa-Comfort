<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\RoomType;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Modern Sofa',
                'description' => 'A stylish and modern sofa for your living room.',
                'price' => 15999.99,
                'stock_quantity' => 10,
                'image_url' => 'sofa.jpg',
                'category_id' => Category::where('name', 'Sofas')->first()->id,
                'roomtype_id' => RoomType::where('name', 'Living Room')->first()->id,
            ],
            [
                'name' => 'Office Chair',
                'description' => 'Ergonomic office chair for better comfort.',
                'price' => 4999.99,
                'stock_quantity' => 20,
                'image_url' => 'office_chair.jpg',
                'category_id' => Category::where('name', 'Chairs')->first()->id,
                'roomtype_id' => RoomType::where('name', 'Office')->first()->id,
            ],
            [
                'name' => 'Dining Table',
                'description' => 'A wooden dining table for family meals.',
                'price' => 9999.99,
                'stock_quantity' => 5,
                'image_url' => 'dining_table.jpg',
                'category_id' => Category::where('name', 'Tables')->first()->id,
                'roomtype_id' => RoomType::where('name', 'Dining Room')->first()->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
