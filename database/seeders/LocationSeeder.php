<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create([
            "name" => "no location",
            "address" => "N/A",
            "coordinates" => json_encode([
                "lat" => .0000,
                "lon" => .0000,
            ])
            ]);
        Location::factory(49)->create();
    }
}
