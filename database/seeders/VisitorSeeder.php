<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $visitors = [];

        // Generate data for the last 2 months
        for ($i = 0; $i < 60; $i++) {
            // Random number of visits per day (between 10 and 50)
            $dailyVisits = rand(10, 50);

            for ($j = 0; $j < $dailyVisits; $j++) {
                $date = Carbon::now()->subDays(rand(0, 60)); // Random date in last 60 days

                $visitors[] = [
                    // 'ip_address' removed for privacy
                    'user_agent' => $faker->userAgent,
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }
        }

        // Chunk insert to avoid memory issues if large (though here it's manageable)
        foreach (array_chunk($visitors, 500) as $chunk) {
            Visitor::insert($chunk);
        }
    }
}
