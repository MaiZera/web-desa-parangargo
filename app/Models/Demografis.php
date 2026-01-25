<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demografis extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_penduduk',
        'kepadatan',
        'struktur_umur',
        'jenis_kelamin',
        'tingkat_pendidikan',
        'mata_pencaharian',
        'agama',
    ];
}
