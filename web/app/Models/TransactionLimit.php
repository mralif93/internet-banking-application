<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLimit extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'limit_type',
        'daily_limit',
        'spent_today',
        'last_reset_date',
    ];

    protected $casts = [
        'daily_limit' => 'decimal:2',
        'spent_today' => 'decimal:2',
        'last_reset_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
