<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'judul',
        'konten',
        'tipe',
        'tanggal_mulai',
        'tanggal_selesai',
        'icon',
        'file_lampiran',
        'author_id',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'published')
                     ->where(function($q) {
                         $q->whereNull('tanggal_mulai')
                           ->orWhere('tanggal_mulai', '<=', now());
                     })
                     ->where(function($q) {
                         $q->whereNull('tanggal_selesai')
                           ->orWhere('tanggal_selesai', '>=', now());
                     });
    }

    public function scopeByTipe($query, $tipe)
    {
        return $query->where('tipe', $tipe);
    }

    public function scopeUrgent($query)
    {
        return $query->where('tipe', 'urgent');
    }

    // Helper to check if announcement is currently active
    public function getIsActiveAttribute()
    {
        if ($this->status !== 'published') {
            return false;
        }

        $now = now()->startOfDay();
        
        $startValid = is_null($this->tanggal_mulai) || $this->tanggal_mulai <= $now;
        $endValid = is_null($this->tanggal_selesai) || $this->tanggal_selesai >= $now;
        
        return $startValid && $endValid;
    }
}
