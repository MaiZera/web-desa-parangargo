<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileDesa;

class ProfilDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileDesa::create([
            'nama_desa' => 'Parangargo',
            'alamat' => 'Jl. Raya Parangargo No. 1',
            'kecamatan' => 'Parangargo',
            'kabupaten' => 'Kabupaten XYZ',
            'provinsi' => 'Jawa Tengah',
            'kode_pos' => '50123',
            'telepon' => '(0274) 123456',
            'email' => 'info@parangargo.desa.id',
            'website' => 'https://parangargo.desa.id',
            
            // Visi & Misi
            'visi' => 'Mewujudkan Desa Parangargo yang Maju, Mandiri, dan Sejahtera',
            'misi' => "1. Meningkatkan kualitas pelayanan publik kepada masyarakat\n2. Mengembangkan potensi ekonomi desa berbasis UMKM\n3. Meningkatkan kualitas infrastruktur desa\n4. Memberdayakan masyarakat melalui pendidikan dan pelatihan\n5. Melestarikan budaya dan kearifan lokal",
            'sejarah' => "Desa Parangargo merupakan salah satu desa tertua di wilayah Kabupaten XYZ. Didirikan pada tahun 1850, desa ini awalnya merupakan perkampungan kecil yang berkembang menjadi desa yang maju dan sejahtera.\n\nNama Parangargo berasal dari bahasa Jawa 'Parang' yang berarti pedang dan 'Argo' yang berarti gunung, melambangkan semangat pantang menyerah masyarakat dalam menghadapi tantangan.",
            
            // Data Geografis
            'luas_wilayah' => 12.45,
            'batas_utara' => 'Desa Utara Jaya',
            'batas_selatan' => 'Desa Selatan Makmur',
            'batas_timur' => 'Desa Timur Sejahtera',
            'batas_barat' => 'Desa Barat Indah',
            'latitude' => '-7.797068',
            'longitude' => '110.370529',
            'ketinggian' => 145,
            
            // Data Demografis
            'jumlah_penduduk' => 5432,
            'jumlah_kk' => 1456,
            'jumlah_laki_laki' => 2718,
            'jumlah_perempuan' => 2714,
            'jumlah_dusun' => 5,
            'jumlah_rw' => 12,
            'jumlah_rt' => 48,
        ]);
    }
}
