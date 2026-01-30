<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Umkm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'umkm';

    protected $fillable = [
        'nama_usaha',
        'slug',
        'nama_pemilik',
        'kategori',
        'deskripsi',
        'produk_layanan',
        'alamat',
        'telepon',
        'email',
        'whatsapp',
        'instagram',
        'facebook',
        'website',
        'logo',
        'foto_produk',
        'tahun_berdiri',
        'kisaran_harga_min',
        'kisaran_harga_max',
        'jam_buka',
        'is_active',
    ];

    protected $casts = [
        'tahun_berdiri' => 'integer',
        'kisaran_harga_max' => 'decimal:2',
        'jam_buka' => 'array',
        'produk_layanan' => 'array',
        'is_active' => 'boolean',
    ];

    protected $appends = ['kisaran_harga', 'image_url'];

    public function getImageUrlAttribute()
    {
        return $this->foto_produk ? asset('storage/' . $this->foto_produk) : 'https://placehold.co/800x600?text=' . urlencode($this->nama_usaha);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Mutators
    public function setNamaUsahaAttribute($value)
    {
        $this->attributes['nama_usaha'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Helper to get price range display
    public function getKisaranHargaAttribute()
    {
        if ($this->kisaran_harga_min && $this->kisaran_harga_max) {
            return "Rp " . number_format((float) $this->kisaran_harga_min, 0, ',', '.') .
                " - Rp " . number_format((float) $this->kisaran_harga_max, 0, ',', '.');
        }
        return null;
    }
}
