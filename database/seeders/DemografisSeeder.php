<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Demografis;

class DemografisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Demografis::create([
            'jumlah_penduduk' => 5432,
            'kepadatan_penduduk' => 436, // jiwa/km2 (asumsi)
            'jumlah_kk' => 1456,
            'jumlah_laki_laki' => 2718,
            'jumlah_perempuan' => 2714,
            'jumlah_dusun' => 5,
            'jumlah_rw' => 12,
            'jumlah_rt' => 48,
            'tingkat_pendidikan' => [
                'Tidak Sekolah' => 150,
                'SD/Sederajat' => 1200,
                'SMP/Sederajat' => 1500,
                'SMA/Sederajat' => 1800,
                'Diploma' => 300,
                'Sarjana' => 450,
                'Pascasarjana' => 32
            ],
            'mata_pencaharian' => [
                'Petani' => 1200,
                'Buruh Tani' => 800,
                'PNS/TNI/Polri' => 250,
                'Wiraswasta' => 900,
                'Karyawan Swasta' => 1100,
                'Pedagang' => 400,
                'Lainnya' => 782
            ],
            'agama' => [
                'Islam' => 5000,
                'Kristen' => 300,
                'Katolik' => 100,
                'Hindu' => 20,
                'Buddha' => 10,
                'Konghucu' => 2
            ]
        ]);
    }
}
