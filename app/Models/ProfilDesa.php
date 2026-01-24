<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    use HasFactory;

    protected $table = 'profil_desa';

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
        'logo',
        'gambar_kantor',
        'gambar_peta',
    ];

    protected $casts = [
        'luas_wilayah' => 'decimal:2',
        'ketinggian' => 'integer',
        'jumlah_penduduk' => 'integer',
        'jumlah_kk' => 'integer',
        'jumlah_laki_laki' => 'integer',
        'jumlah_perempuan' => 'integer',
        'jumlah_dusun' => 'integer',
        'jumlah_rw' => 'integer',
        'jumlah_rt' => 'integer',
    ];

    // Helper method to get full address
    public function getAlamatLengkapAttribute()
    {
        return "{$this->alamat}, {$this->kecamatan}, {$this->kabupaten}, {$this->provinsi} {$this->kode_pos}";
    }
}
