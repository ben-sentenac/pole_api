<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $locations = Location::all();

        for( $i = 0; $i < 200; $i++ ) {
            $user = $users->random();
            $location = $locations->random();
            Event::factory()->create([
                'user_id' =>$user->id,
                'location_id' => $location->id,
            ]);
        }

    }
}
