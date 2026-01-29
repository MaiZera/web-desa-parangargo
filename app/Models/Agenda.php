<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'agenda';

    protected $fillable = [
        'judul',
        'deskripsi',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'penyelenggara',
        'narahubung',
        'telepon',
        'gambar',
        'status_kegiatan',
        'status_publikasi',
        'is_featured',
        'catatan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'is_featured' => 'boolean',
    ];

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status_kegiatan', 'scheduled')
            ->where('status_publikasi', 'published')
            ->where('tanggal_mulai', '>=', now())
            ->orderBy('tanggal_mulai', 'asc');
    }

    public function scopeOngoing($query)
    {
        return $query->where('status_kegiatan', 'ongoing')->where('status_publikasi', 'published');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status_kegiatan', 'completed')->where('status_publikasi', 'published');
    }

    public function scopeByMonth($query, $year, $month)
    {
        return $query->whereYear('tanggal_mulai', $year)
            ->whereMonth('tanggal_mulai', $month);
    }

    // Helper to check if event is today
    public function getIsTodayAttribute()
    {
        return $this->tanggal_mulai->isToday();
    }
}
