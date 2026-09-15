<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'account_id',
        'transaction_type',
        'direction',
        'amount',
        'fee',
        'recipient_name',
        'recipient_bank',
        'recipient_account',
        'payment_reference',
        'recipient_reference',
        'biller_code',
        'biller_name',
        'ref_1',
        'ref_2',
        'status',
        'cooling_off_until',
        'balance_after',
        'description',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'cooling_off_until' => 'datetime',
        'metadata' => 'array',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
