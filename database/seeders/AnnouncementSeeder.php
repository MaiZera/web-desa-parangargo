<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            [
                'judul' => 'Pemadaman Listrik Bergilir',
                'konten' => 'Diberitahukan kepada warga bahwa akan ada pemadaman listrik bergilir pada hari Rabu, 12 Feb 2026 mulai pukul 09.00 - 15.00 WIB dikarenakan perawatan gardu induk.',
                'tipe' => 'layanan',
                'status' => 'published',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addDays(2),
            ],
            [
                'judul' => 'Vaksinasi Rabies Gratis',
                'konten' => 'Dinas Peternakan akan mengadakan vaksinasi rabies gratis untuk hewan peliharaan warga. Silakan bawa hewan peliharaan anda ke Balai Desa pada tanggal 20 Feb 2026.',
                'tipe' => 'layanan',
                'status' => 'published',
                'tanggal_mulai' => now()->addDays(5),
                'tanggal_selesai' => now()->addDays(20),
            ],
            [
                'judul' => 'Waspada Demam Berdarah',
                'konten' => 'Mengingat musim hujan telah tiba, dimohon seluruh warga untuk melakukan 3M (Menguras, Menutup, Mengubur) untuk mencegah perkembangbiakan nyamuk demam berdarah.',
                'tipe' => 'darurat',
                'status' => 'published',
                'tanggal_mulai' => now()->subDays(10),
                'tanggal_selesai' => null, // Berlaku terus
            ],
            [
                'judul' => 'Rapat Koordinasi RT/RW',
                'konten' => 'Undangan rapat koordinasi bagi seluruh Ketua RT dan RW se-Desa Parangargo pada Jumat malam, 14 Feb 2026 di Ruang Rapat Balai Desa.',
                'tipe' => 'agenda',
                'status' => 'published',
                'tanggal_mulai' => now()->addDays(2),
                'tanggal_selesai' => now()->addDays(2),
            ],
            [
                'judul' => 'Pendaftaran Lomba Desa Bersih',
                'konten' => 'Pendaftaran lomba kebersihan lingkungan antar RT telah dibuka. Segera daftarkan RT anda sebelum tanggal 25 Feb 2026.',
                'tipe' => 'umum',
                'status' => 'published',
                'tanggal_mulai' => now()->subDays(2),
                'tanggal_selesai' => now()->addDays(10),
            ]
        ];

        foreach ($announcements as $data) {
            Announcement::create(array_merge($data, ['author_id' => 1]));
        }
    }
}
