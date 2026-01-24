<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LayananPublik extends Model
{
    use HasFactory;

    protected $table = 'layanan_publik';

    protected $fillable = [
        'nama_layanan',
        'slug',
        'deskripsi',
        'persyaratan',
        'waktu_proses',
        'biaya',
        'penanggung_jawab',
        'telepon',
        'email',
        'icon',
        'gambar',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'biaya' => 'decimal:2',
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    public function scopeFree($query)
    {
        return $query->where('biaya', 0);
    }

    // Mutators
    public function setNamaLayananAttribute($value)
    {
        $this->attributes['nama_layanan'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Helper to format currency
    public function getBiayaFormattedAttribute()
    {
        if ($this->biaya == 0) {
            return 'Gratis';
        }
        return 'Rp ' . number_format($this->biaya, 0, ',', '.');
    }
}
