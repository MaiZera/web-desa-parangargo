<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demografis extends Model
{
    use HasFactory;

    protected $table = 'demografis';

    protected $fillable = [
        'jumlah_penduduk',
        'kepadatan_penduduk',
        'jumlah_kk',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'jumlah_dusun',
        'jumlah_rw',
        'jumlah_rt',
        'tingkat_pendidikan',
        'mata_pencaharian',
        'agama',
    ];

    protected $casts = [
        'tingkat_pendidikan' => 'array',
        'mata_pencaharian' => 'array',
        'agama' => 'array',
    ];
}
