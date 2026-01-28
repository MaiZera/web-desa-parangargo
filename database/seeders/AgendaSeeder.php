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
                'deskripsi' => 'Musyawarah tahunan warga desa untuk rencana pembangunan yang melibatkan seluruh elemen masyarakat (RT, RW, Tokoh Masyarakat) untuk menyusun prioritas pembangunan tahun anggaran mendatang.',
                'lokasi' => 'Balai Desa Parangargo',
                'tanggal_mulai' => Carbon::now()->addDays(2)->setTime(9, 0),
                'tanggal_selesai' => Carbon::now()->addDays(2)->setTime(15, 0),
                'penyelenggara' => 'Pemerintah Desa',
                'narahubung' => 'Pak Carik',
                'telepon' => '081234567890',
                'gambar' => 'https://images.unsplash.com/photo-1577415124269-fc1140a69e91?q=80&w=800&auto=format&fit=crop',
                'status' => 'scheduled',
                'is_featured' => true,
            ],
            [
                'judul' => 'Posyandu Balita & Lansia',
                'deskripsi' => 'Pelayanan kesehatan rutin untuk balita (timbang, imunisasi) dan pemeriksaan kesehatan lansia secara gratis oleh tenaga medis desa dan kader PKK.',
                'lokasi' => 'Polindes Parangargo',
                'tanggal_mulai' => Carbon::now()->addDays(5)->setTime(8, 0),
                'tanggal_selesai' => Carbon::now()->addDays(5)->setTime(12, 0),
                'penyelenggara' => 'PKK Desa',
                'narahubung' => 'Ibu Kades',
                'telepon' => '081234567891',
                'gambar' => 'https://images.unsplash.com/photo-1584515159913-67c27a6c22e8?q=80&w=800&auto=format&fit=crop',
                'status' => 'scheduled',
                'is_featured' => false,
            ],
            [
                'judul' => 'Kerja Bakti Bersama',
                'deskripsi' => 'Pembersihan saluran irigasi dan area pemakaman umum menjelang musim tanam untuk memastikan aliran air lancar ke sawah warga.',
                'lokasi' => 'Dusun Krajan',
                'tanggal_mulai' => Carbon::now()->addDays(10)->setTime(7, 0),
                'tanggal_selesai' => Carbon::now()->addDays(10)->setTime(10, 0),
                'penyelenggara' => 'Karang Taruna',
                'narahubung' => 'Mas RT',
                'telepon' => '081234567892',
                'gambar' => 'https://images.unsplash.com/photo-1541944743827-e04bb64ca63e?q=80&w=800&auto=format&fit=crop',
                'status' => 'scheduled',
                'is_featured' => true,
            ],
            [
                'judul' => 'Pelatihan Digital Marketing UMKM',
                'deskripsi' => 'Pelatihan pemasaran produk lokal lewat media sosial dan marketplace untuk meningkatkan omzet penjualan produk-produk unggulan Desa Parangargo.',
                'lokasi' => 'Ruang Pertemuan Balai Desa',
                'tanggal_mulai' => Carbon::now()->subDays(1)->setTime(10, 0),
                'tanggal_selesai' => Carbon::now()->subDays(1)->setTime(16, 0),
                'penyelenggara' => 'Dinas Koperasi',
                'narahubung' => 'Admin Desa',
                'telepon' => '081234567893',
                'gambar' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=800&auto=format&fit=crop',
                'status' => 'completed',
                'is_featured' => false,
            ],
        ];

        foreach ($agendas as $agenda) {
            Agenda::create($agenda);
        }
    }
}
