<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 100, 5000), // ราคาสุ่มระหว่าง 100 - 5000
            'stock_quantity' => $this->faker->numberBetween(1, 100), // จำนวนสินค้า 1 - 100
            'image_url' => $this->faker->imageUrl(640, 480, 'furniture'), // สุ่มรูปภาพ
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'roomtype_id' => RoomType::inRandomOrder()->first()->id ?? RoomType::factory(),
        ];
    }
}
