<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_desa',
        'alamat',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'telepon',
        'email',
        'website',
        'deskripsi',
        'visi',
        'misi',
        'sejarah',
        'luas_wilayah',
        'batas_utara',
        'batas_selatan',
        'batas_timur',
        'batas_barat',
        'latitude',
        'longitude',
        'ketinggian',
        'jumlah_penduduk',
        'jumlah_kk',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'jumlah_dusun',
        'jumlah_rw',
        'jumlah_rt',
        'image_path',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'tiktok',
        'jam_kerja_senin_kamis',
        'jam_kerja_jumat',
        'jam_kerja_sabtu_minggu',
    ];
}
