<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
=======
        // Call seeders in order
        $this->call([
            UserSeeder::class,
            ProfilDesaSeeder::class,
            NewsSeeder::class,
            UmkmSeeder::class,
            LayananPublikSeeder::class,
            StaffSeeder::class,
        ]);
        
        $this->command->info('Database seeding completed successfully!');
>>>>>>> 33886dba66f07df0cc66a5c27b0ed0aaf258c653
    }
}
