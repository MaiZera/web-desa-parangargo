<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'nama',
        'rt',
        'rw',
        'email',
        'telepon',
        'subjek',
        'deskripsi',
        'kategori',
        'status',
        'tanggapan',
        'responder_id',
        'responded_at',
        'rating',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'rating' => 'integer',
    ];

    // Relationships
    public function responder()
    {
        return $this->belongsTo(User::class, 'responder_id');
    }

    // Scopes
    public function scopeNew($query)
    {
        return $query->where('status', 'baru');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'dibaca');
    }

    public function scopeProcessed($query)
    {
        return $query->where('status', 'diproses');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'selesai');
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Helper to check if feedback has been responded
    public function getHasResponseAttribute()
    {
        return !is_null($this->tanggapan);
    }

    // Mark as read
    public function markAsRead()
    {
        if ($this->status === 'baru') {
            $this->update(['status' => 'dibaca']);
        }
    }

    // Add response
    public function addResponse($response, $responderId)
    {
        $this->update([
            'tanggapan' => $response,
            'responder_id' => $responderId,
            'responded_at' => now(),
            'status' => 'selesai'
        ]);
    }
}
