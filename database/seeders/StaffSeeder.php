<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staffData = [
            [
                'nama' => 'H. Sutomo, S.Sos',
                'nip' => '196505151985031001',
                'jabatan' => 'Kepala Desa',
                'pangkat' => 'Pembina',
                'golongan' => 'IV/a',
                'pendidikan' => 'S1 Sosiologi',
                'telepon' => '081234567801',
                'email' => 'kepala.desa@parangargo.desa.id',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1965-05-15',
                'mulai_menjabat' => '2019-08-17',
                'urutan' => 1,
            ],
            [
                'nama' => 'Drs. Bambang Wahyudi',
                'nip' => '197003101992031002',
                'jabatan' => 'Sekretaris Desa',
                'pangkat' => 'Penata Tingkat I',
                'golongan' => 'III/d',
                'pendidikan' => 'S1 Administrasi Negara',
                'telepon' => '081234567802',
                'email' => 'sekretaris@parangargo.desa.id',
                'tempat_lahir' => 'Sleman',
                'tanggal_lahir' => '1970-03-10',
                'mulai_menjabat' => '2020-01-02',
                'urutan' => 2,
            ],
            [
                'nama' => 'Ahmad Fauzi, SE',
                'nip' => '198201052005021001',
                'jabatan' => 'Kaur Keuangan',
                'pangkat' => 'Penata Muda Tingkat I',
                'golongan' => 'III/b',
                'pendidikan' => 'S1 Ekonomi',
                'telepon' => '081234567803',
                'email' => 'keuangan@parangargo.desa.id',
                'tempat_lahir' => 'Bantul',
                'tanggal_lahir' => '1982-01-05',
                'mulai_menjabat' => '2020-03-01',
                'urutan' => 3,
            ],
            [
                'nama' => 'Sri Lestari, S.Sos',
                'nip' => '198506152007022001',
                'jabatan' => 'Kaur Pemerintahan',
                'pendidikan' => 'S1 Sosiologi',
                'telepon' => '081234567804',
                'email' => 'pemerintahan@parangargo.desa.id',
                'tempat_lahir' => 'Kulon Progo',
                'tanggal_lahir' => '1985-06-15',
                'mulai_menjabat' => '2020-03-01',
                'urutan' => 4,
            ],
            [
                'nama' => 'Rudi Hartono',
                'jabatan' => 'Kaur Pembangunan',
                'pendidikan' => 'SMA',
                'telepon' => '081234567805',
                'tempat_lahir' => 'Gunung Kidul',
                'tanggal_lahir' => '1987-08-20',
                'mulai_menjabat' => '2020-04-01',
                'urutan' => 5,
            ],
            [
                'nama' => 'Dewi Kusuma, S.Pd',
                'jabatan' => 'Kaur Kesejahteraan',
                'pendidikan' => 'S1 Pendidikan',
                'telepon' => '081234567806',
                'email' => 'kesejahteraan@parangargo.desa.id',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1988-11-12',
                'mulai_menjabat' => '2020-04-01',
                'urutan' => 6,
            ],
            [
                'nama' => 'Agus Susanto',
                'jabatan' => 'Kepala Dusun Utara',
                'pendidikan' => 'SMA',
                'telepon' => '081234567807',
                'tempat_lahir' => 'Sleman',
                'tanggal_lahir' => '1975-04-25',
                'mulai_menjabat' => '2019-09-01',
                'urutan' => 7,
            ],
            [
                'nama' => 'Siti Nurjanah',
                'jabatan' => 'Kepala Dusun Tengah',
                'pendidikan' => 'SMA',
                'telepon' => '081234567808',
                'tempat_lahir' => 'Bantul',
                'tanggal_lahir' => '1978-07-18',
                'mulai_menjabat' => '2019-09-01',
                'urutan' => 8,
            ],
            [
                'nama' => 'Joko Widodo',
                'jabatan' => 'Kepala Dusun Selatan',
                'pendidikan' => 'SMA',
                'telepon' => '081234567809',
                'tempat_lahir' => 'Gunung Kidul',
                'tanggal_lahir' => '1976-06-21',
                'mulai_menjabat' => '2019-09-01',
                'urutan' => 9,
            ],
            [
                'nama' => 'Budi Santoso',
                'jabatan' => 'Kaur Keamanan dan Ketertiban',
                'pendidikan' => 'SMA',
                'telepon' => '081234567810',
                'tempat_lahir' => 'Sleman',
                'tanggal_lahir' => '1980-09-30',
                'mulai_menjabat' => '2020-05-01',
                'urutan' => 10,
            ],
        ];

        foreach ($staffData as $staff) {
            Staff::create([
                'nama' => $staff['nama'],
                'nip' => $staff['nip'] ?? null,
                'jabatan' => $staff['jabatan'],
                'pangkat' => $staff['pangkat'] ?? null,
                'golongan' => $staff['golongan'] ?? null,
                'pendidikan' => $staff['pendidikan'],
                'telepon' => $staff['telepon'],
                'email' => $staff['email'] ?? null,
                'tempat_lahir' => $staff['tempat_lahir'],
                'tanggal_lahir' => $staff['tanggal_lahir'],
                'mulai_menjabat' => $staff['mulai_menjabat'],
                'selesai_menjabat' => $staff['selesai_menjabat'] ?? null,
                'urutan' => $staff['urutan'],
                'is_active' => true,
            ]);
        }
    }
}
