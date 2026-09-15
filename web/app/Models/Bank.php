<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_code',
        'bank_name',
        'short_name',
        'swift_code',
        'is_duitnow_active',
        'is_ibg_active',
        'is_active',
        'maintenance_notice',
        'display_order',
    ];

    protected $casts = [
        'is_duitnow_active' => 'boolean',
        'is_ibg_active' => 'boolean',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Scope for active banks ready for transfer routing
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('display_order')->orderBy('short_name');
    }
}
