<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransparansiPembangunan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transparansi_pembangunan';

    protected $fillable = [
        'judul_pembangunan',
        'rt_number',
        'rw_number',
        'lokasi',
        'jenis_pembangunan',
        'anggaran',
        'sumber_dana',
        'tanggal_mulai',
        'tanggal_selesai_rencana',
        'tanggal_selesai_aktual',
        'status',
        'persentase_penyelesaian',
        'keterangan',
        'dokumentasi',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai_rencana' => 'date',
        'tanggal_selesai_aktual' => 'date',
        'anggaran' => 'decimal:2',
        'persentase_penyelesaian' => 'integer',
    ];

    /**
     * Accessor untuk format currency anggaran
     */
    public function getAnggaranFormattedAttribute()
    {
        return 'Rp ' . number_format($this->anggaran, 0, ',', '.');
    }

    /**
     * Accessor untuk status badge
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'perencanaan' => 'bg-blue-100 text-blue-800',
            'dalam_proses' => 'bg-yellow-100 text-yellow-800',
            'selesai' => 'bg-green-100 text-green-800',
            'ditunda' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Accessor untuk status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'perencanaan' => 'Perencanaan',
            'dalam_proses' => 'Dalam Proses',
            'selesai' => 'Selesai',
            'ditunda' => 'Ditunda',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Scope untuk filter per RT
     */
    public function scopeByRt($query, $rtNumber)
    {
        return $query->where('rt_number', $rtNumber);
    }

    /**
     * Scope untuk filter per RW
     */
    public function scopeByRw($query, $rwNumber)
    {
        return $query->where('rw_number', $rwNumber);
    }

    /**
     * Scope untuk filter per status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk pembangunan aktif
     */
    public function scopeAktif($query)
    {
        return $query->whereIn('status', ['perencanaan', 'dalam_proses']);
    }

    /**
     * Scope untuk pembangunan selesai
     */
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }
}
