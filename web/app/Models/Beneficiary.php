<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'nickname',
        'account_number',
        'bank_name',
        'duitnow_id_type',
        'duitnow_id_value',
        'is_favorite',
        'last_transferred_at',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'last_transferred_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
