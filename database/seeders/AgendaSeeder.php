<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;
use Carbon\Carbon;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $agendas = [
            [
                'judul' => 'Musyawarah Perencanaan Pembangunan (Musrenbang)',
                'deskripsi' => 'Musyawarah tahunan warga desa untuk rencana pembangunan.',
                'lokasi' => 'Balai Desa Parangargo',
                'tanggal_mulai' => Carbon::now()->addDays(2)->setTime(9, 0),
                'tanggal_selesai' => Carbon::now()->addDays(2)->setTime(15, 0),
                'penyelenggara' => 'Pemerintah Desa',
                'narahubung' => 'Pak Carik',
                'status' => 'scheduled',
                'is_featured' => true,
            ],
            [
                'judul' => 'Posyandu Balita & Lansia',
                'deskripsi' => 'Pelayanan kesehatan rutin untuk balita dan lansia.',
                'lokasi' => 'Polindes Parangargo',
                'tanggal_mulai' => Carbon::now()->addDays(5)->setTime(8, 0),
                'tanggal_selesai' => Carbon::now()->addDays(5)->setTime(12, 0),
                'penyelenggara' => 'PKK Desa',
                'narahubung' => 'Ibu Kades',
                'status' => 'scheduled',
                'is_featured' => false,
            ],
            [
                'judul' => 'Kerja Bakti Bersama',
                'deskripsi' => 'Pembersihan saluran irigasi menjelang musim tanam.',
                'lokasi' => 'Dusun Krajan',
                'tanggal_mulai' => Carbon::now()->addDays(10)->setTime(7, 0),
                'tanggal_selesai' => Carbon::now()->addDays(10)->setTime(10, 0),
                'penyelenggara' => 'Karang Taruna',
                'narahubung' => 'Mas RT',
                'status' => 'scheduled',
                'is_featured' => true,
            ],
            [
                'judul' => 'Pelatihan Digital Marketing UMKM',
                'deskripsi' => 'Pelatihan pemasaran produk lokal lewat media sosial.',
                'lokasi' => 'Ruang Pertemuan Balai Desa',
                'tanggal_mulai' => Carbon::now()->subDays(1)->setTime(10, 0),
                'tanggal_selesai' => Carbon::now()->subDays(1)->setTime(16, 0),
                'penyelenggara' => 'Dinas Koperasi',
                'narahubung' => 'Admin Desa',
                'status' => 'completed',
                'is_featured' => false,
            ],
        ];

        foreach ($agendas as $agenda) {
            Agenda::create($agenda);
        }
    }
}
