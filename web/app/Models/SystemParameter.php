<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemParameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'param_key',
        'param_value',
        'value_type',
        'display_name',
        'description',
        'updated_by',
    ];

    /**
     * Cast the parameter value automatically based on value_type
     */
    public function getCastValueAttribute()
    {
        return match ($this->value_type) {
            'integer' => (int) $this->param_value,
            'decimal', 'float' => (float) $this->param_value,
            'boolean' => filter_var($this->param_value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($this->param_value, true),
            default => $this->param_value,
        };
    }
}
