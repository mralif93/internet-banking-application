<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'event',
        'ip_address',
        'user_agent',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Record an immutable audit log entry.
     */
    public static function record(string $event, ?string $severity = 'info', ?string $actor = null, ?string $ipAddress = null, ?array $metadata = null, ?int $customerId = null): self
    {
        return self::create([
            'customer_id' => $customerId,
            'event' => $event,
            'ip_address' => $ipAddress ?? request()?->ip(),
            'user_agent' => request()?->userAgent(),
            'payload' => array_merge([
                'severity' => $severity,
                'actor' => $actor,
            ], $metadata ?? []),
        ]);
    }
}
