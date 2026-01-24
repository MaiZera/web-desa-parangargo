<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananPublik;
use Illuminate\Support\Str;

class LayananPublikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layananData = [
            [
                'nama_layanan' => 'Surat Keterangan Domisili',
                'deskripsi' => 'Layanan pembuatan surat keterangan domisili untuk warga yang membutuhkan.',
                'persyaratan' => "1. Fotocopy KTP\n2. Fotocopy KK\n3. Surat Pengantar RT/RW\n4. Pas foto 3x4 (2 lembar)",
                'waktu_proses' => '3 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Sekretaris Desa',
                'telepon' => '(0274) 123456',
                'email' => 'sekretaris@parangargo.desa.id',
                'icon' => 'file-text',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Usaha',
                'deskripsi' => 'Layanan pembuatan surat keterangan usaha (SKU) untuk pelaku UMKM.',
                'persyaratan' => "1. Fotocopy KTP\n2. Fotocopy KK\n3. Surat Pengantar RT/RW\n4. Pas foto 3x4 (2 lembar)\n5. Foto tempat usaha",
                'waktu_proses' => '5 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Kaur Pemerintahan',
                'telepon' => '(0274) 123456',
                'icon' => 'briefcase',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Tidak Mampu (SKTM)',
                'deskripsi' => 'Layanan pembuatan SKTM untuk keperluan beasiswa, berobat, dan lainnya.',
                'persyaratan' => "1. Fotocopy KTP\n2. Fotocopy KK\n3. Surat Pengantar RT/RW\n4. Keterangan dari RT/RW tentang kondisi ekonomi",
                'waktu_proses' => '2 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Kaur Kesejahteraan',
                'telepon' => '(0274) 123456',
                'icon' => 'heart',
            ],
            [
                'nama_layanan' => 'Surat Pengantar Nikah (N1-N4)',
                'deskripsi' => 'Layanan pembuatan surat pengantar untuk keperluan pernikahan.',
                'persyaratan' => "1. Fotocopy KTP\n2. Fotocopy KK\n3. Fotocopy Akta Kelahiran\n4. Pas foto 4x6 (4 lembar)\n5. Surat Keterangan dari RT/RW",
                'waktu_proses' => '7 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Sekretaris Desa',
                'telepon' => '(0274) 123456',
                'icon' => 'users',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Kelahiran',
                'deskripsi' => 'Layanan pembuatan surat keterangan kelahiran untuk pengurusan akta kelahiran.',
                'persyaratan' => "1. Fotocopy KTP orang tua\n2. Fotocopy KK\n3. Fotocopy Surat Nikah orang tua\n4. Surat keterangan dari Bidan/Dokter\n5. Surat Pengantar RT/RW",
                'waktu_proses' => '1 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Kaur Pemerintahan',
                'telepon' => '(0274) 123456',
                'icon' => 'baby',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Kematian',
                'deskripsi' => 'Layanan pembuatan surat keterangan kematian untuk pengurusan akta kematian.',
                'persyaratan' => "1. Fotocopy KTP yang meninggal\n2. Fotocopy KK\n3. Fotocopy KTP pelapor\n4. Surat keterangan dari Dokter/RS\n5. Surat Pengantar RT/RW",
                'waktu_proses' => '1 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Kaur Pemerintahan',
                'telepon' => '(0274) 123456',
                'icon' => 'file-minus',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Pindah',
                'deskripsi' => 'Layanan pembuatan surat keterangan pindah untuk warga yang pindah domisili.',
                'persyaratan' => "1. Fotocopy KTP seluruh anggota keluarga yang pindah\n2. Fotocopy KK\n3. Surat Pengantar RT/RW\n4. Surat keterangan pindah dari desa asal (jika pindah masuk)",
                'waktu_proses' => '3 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Kaur Pemerintahan',
                'telepon' => '(0274) 123456',
                'icon' => 'truck',
            ],
            [
                'nama_layanan' => 'Legalisir Surat',
                'deskripsi' => 'Layanan legalisir berbagai surat dan dokumen dari desa.',
                'persyaratan' => "1. Dokumen asli yang akan dilegalisir\n2. Fotocopy KTP\n3. Surat Pengantar RT/RW",
                'waktu_proses' => '1 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Sekretaris Desa',
                'telepon' => '(0274) 123456',
                'icon' => 'stamp',
            ],
            [
                'nama_layanan' => 'Surat Izin Keramaian',
                'deskripsi' => 'Layanan penerbitan izin untuk mengadakan acara/keramaian di wilayah desa.',
                'persyaratan' => "1. Surat permohonan\n2. Fotocopy KTP penanggung jawab\n3. Proposal kegiatan\n4. Surat Pengantar RT/RW\n5. Persetujuan warga sekitar",
                'waktu_proses' => '5 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Kaur Keamanan dan Ketertiban',
                'telepon' => '(0274) 123456',
                'icon' => 'music',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Penghasilan',
                'deskripsi' => 'Layanan pembuatan surat keterangan penghasilan untuk berbagai keperluan.',
                'persyaratan' => "1. Fotocopy KTP\n2. Fotocopy KK\n3. Surat Pengantar RT/RW\n4. Keterangan tempat kerja (jika ada)",
                'waktu_proses' => '2 hari kerja',
                'biaya' => 0,
                'penanggung_jawab' => 'Kaur Kesejahteraan',
                'telepon' => '(0274) 123456',
                'icon' => 'dollar-sign',
            ],
        ];

        $urutan = 1;
        foreach ($layananData as $layanan) {
            LayananPublik::create([
                'nama_layanan' => $layanan['nama_layanan'],
                'slug' => Str::slug($layanan['nama_layanan']),
                'deskripsi' => $layanan['deskripsi'],
                'persyaratan' => $layanan['persyaratan'],
                'waktu_proses' => $layanan['waktu_proses'],
                'biaya' => $layanan['biaya'],
                'penanggung_jawab' => $layanan['penanggung_jawab'],
                'telepon' => $layanan['telepon'],
                'email' => $layanan['email'] ?? null,
                'icon' => $layanan['icon'],
                'is_active' => true,
                'urutan' => $urutan++,
            ]);
        }
    }
}
