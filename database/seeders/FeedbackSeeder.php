<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        $categories = ['Complaint', 'Suggestion', 'Question', 'Praise'];
        $statuses = ['baru', 'dibaca', 'diproses', 'selesai'];

        // Create feedback for different months to test filtering
        for ($i = 0; $i < 30; $i++) {
            $status = $faker->randomElement($statuses);
            $createdAt = $faker->dateTimeBetween('-4 months', 'now');

            // Generate RT/RW
            $rt = str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT);
            $rw = str_pad($faker->numberBetween(1, 5), 3, '0', STR_PAD_LEFT);

            $data = [
                'nama' => $faker->name,
                'rt' => $rt,
                'rw' => $rw,
                'email' => $faker->email,
                'telepon' => $faker->phoneNumber,
                'subjek' => $faker->sentence(4),
                'deskripsi' => $faker->paragraph(3),
                'kategori' => $faker->randomElement($categories),
                'status' => $status,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];

            if ($status === 'selesai' || $status === 'diproses') {
                $data['tanggapan'] = $faker->paragraph;
                $data['responder_id'] = 1; // Assuming admin user with ID 1 exists
                $data['responded_at'] = Carbon::instance($createdAt)->addDays(1);
            }

            if ($status === 'selesai') {
                $data['rating'] = $faker->numberBetween(3, 5);
            }

            Feedback::create($data);
        }
    }
}
