<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratDomisili extends Model
{
    use HasFactory;

    protected $table = 'surat_domisili';

    protected $fillable = [
        'nama_pemohon',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'agama',
        'status_perkawinan',
        'alamat',
        'rt',
        'rw',
        'telepon',
        'email',
        'keperluan',
        'nomor_surat',
        'tanggal_surat',
        'status',
        'catatan',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_surat' => 'date',
        'processed_at' => 'datetime',
    ];

    // Relationships
    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDiproses($query)
    {
        return $query->where('status', 'diproses');
    }

    public function scopeDisetujui($query)
    {
        return $query->where('status', 'disetujui');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'ditolak');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Helper to generate letter number
    public function generateNomorSurat()
    {
        $year = now()->year;
        $month = now()->format('m');
        $lastNumber = static::whereYear('created_at', $year)
                            ->whereMonth('created_at', now()->month)
                            ->whereNotNull('nomor_surat')
                            ->count() + 1;
        
        return sprintf('DOM/%03d/%s/%d', $lastNumber, $month, $year);
    }

    // Process approval
    public function approve($userId)
    {
        $this->update([
            'status' => 'disetujui',
            'nomor_surat' => $this->generateNomorSurat(),
            'tanggal_surat' => now(),
            'processed_by' => $userId,
            'processed_at' => now(),
        ]);
    }

    // Process rejection
    public function reject($userId, $catatan = null)
    {
        $this->update([
            'status' => 'ditolak',
            'catatan' => $catatan,
            'processed_by' => $userId,
            'processed_at' => now(),
        ]);
    }
}
