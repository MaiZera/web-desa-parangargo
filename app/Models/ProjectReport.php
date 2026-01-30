<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'description',
        'rt',
        'rw',
        'image',
        'percentage',
        'status',
        'fund_usage',
    ];

    protected $casts = [
        'percentage' => 'integer',
        'fund_usage' => 'decimal:2',
    ];

    public function getFundUsageFormattedAttribute()
    {
        return 'Rp ' . number_format($this->fund_usage, 0, ',', '.');
    }
}
