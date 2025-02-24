<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    public function run()
    {
        $roomTypes = [
            ['name' => 'Living Room'],
            ['name' => 'Bedroom'],
            ['name' => 'Dining Room'],
            ['name' => 'Office'],
        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
}
