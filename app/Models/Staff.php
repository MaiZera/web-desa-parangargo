<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'pangkat',
        'golongan',
        'pendidikan',
        'telepon',
        'email',
        'foto',
        'alamat',
        'tanggal_lahir',
        'tempat_lahir',
        'mulai_menjabat',
        'selesai_menjabat',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'mulai_menjabat' => 'date',
        'selesai_menjabat' => 'date',
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

    public function scopeByJabatan($query, $jabatan)
    {
        return $query->where('jabatan', $jabatan);
    }

    // Helper method to get full name with position
    public function getNamaLengkapAttribute()
    {
        return "{$this->nama}, {$this->jabatan}";
    }
}
