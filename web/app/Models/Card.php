<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'account_id',
        'card_number_masked',
        'card_holder_name',
        'card_type',
        'expiry_month',
        'expiry_year',
        'status',
        'is_overseas_enabled',
        'is_online_enabled',
        'is_contactless_enabled',
        'daily_purchase_limit',
    ];

    protected $casts = [
        'is_overseas_enabled' => 'boolean',
        'is_online_enabled' => 'boolean',
        'is_contactless_enabled' => 'boolean',
        'daily_purchase_limit' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
