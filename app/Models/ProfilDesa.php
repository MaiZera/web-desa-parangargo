<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    use HasFactory;

    protected $table = 'profil_desa';

    protected $fillable = [
        'alamat',
        'telepon',
        'email',
        'website',
        'visi',
        'misi',
        'sejarah',
        'jumlah_penduduk',
        'jumlah_kk',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'jumlah_dusun',
        'jumlah_rw',
        'jumlah_rt',
        'logo',
        'gambar_kantor',
        'gambar_peta',
    ];

    protected $casts = [
        'jumlah_penduduk' => 'integer',
        'jumlah_kk' => 'integer',
        'jumlah_laki_laki' => 'integer',
        'jumlah_perempuan' => 'integer',
        'jumlah_dusun' => 'integer',
        'jumlah_rw' => 'integer',
        'jumlah_rt' => 'integer',
    ];


}
