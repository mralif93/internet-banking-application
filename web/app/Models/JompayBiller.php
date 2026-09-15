<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JompayBiller extends Model
{
    use HasFactory;

    protected $fillable = [
        'biller_code',
        'biller_name',
        'category',
        'ref_1_label',
        'ref_2_label',
        'is_ref_2_required',
        'is_active',
    ];

    protected $casts = [
        'is_ref_2_required' => 'boolean',
        'is_active' => 'boolean',
    ];
}
