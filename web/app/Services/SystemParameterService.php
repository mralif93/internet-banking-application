<?php

namespace App\Services;

use App\Models\SystemParameter;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Cache;

class SystemParameterService
{
    protected const CACHE_PREFIX = 'sys_param:';
    protected const CACHE_TTL = 3600; // 1 hour

    /**
     * Get a parameter value by key with fallback
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember(self::CACHE_PREFIX . $key, self::CACHE_TTL, function () use ($key, $default) {
            $param = SystemParameter::where('param_key', $key)->first();
            if (!$param) {
                return $default;
            }
            return $param->cast_value;
        });
    }

    /**
     * Set a parameter value and write to AuditLog
     */
    public function set(string $key, mixed $value, ?string $updatedBy = 'Admin'): bool
    {
        $param = SystemParameter::where('param_key', $key)->first();
        if (!$param) {
            return false;
        }

        $oldValue = $param->param_value;
        $stringValue = is_bool($value) ? ($value ? '1' : '0') : (string) $value;

        $param->update([
            'param_value' => $stringValue,
            'updated_by' => $updatedBy,
        ]);

        Cache::forget(self::CACHE_PREFIX . $key);

        // Record Audit Log for Compliance
        AuditLog::create([
            'event' => 'SYSTEM_PARAMETER_MODIFIED',
            'details' => [
                'param_key' => $key,
                'old_value' => $oldValue,
                'new_value' => $stringValue,
                'updated_by' => $updatedBy,
            ],
            'ip_address' => request()->ip() ?? '127.0.0.1',
            'user_agent' => request()->userAgent() ?? 'BankFlow Internal Admin',
        ]);

        return true;
    }

    /**
     * Get all parameters grouped by category
     */
    public function getAllGrouped(): array
    {
        $parameters = SystemParameter::orderBy('category')->orderBy('id')->get();
        $grouped = [];
        foreach ($parameters as $param) {
            $grouped[$param->category][] = $param;
        }
        return $grouped;
    }

    /**
     * Helper: Check if DuitNow Rail is active
     */
    public function isDuitNowRailActive(): bool
    {
        return (bool) $this->get('duitnow_rail_active', true);
    }

    /**
     * Helper: Check if JomPAY Rail is active
     */
    public function isJompayRailActive(): bool
    {
        return (bool) $this->get('jompay_rail_active', true);
    }

    /**
     * Helper: Check if Maintenance Mode is active
     */
    public function isMaintenanceMode(): bool
    {
        return (bool) $this->get('maintenance_mode_active', false);
    }

    /**
     * Helper: Get Cooling-Off duration in hours
     */
    public function getCoolingOffHours(): int
    {
        return (int) $this->get('cooling_off_period_hours', 12);
    }

    /**
     * Helper: Get Cooling-Off transaction amount threshold
     */
    public function getCoolingOffThreshold(): float
    {
        return (float) $this->get('cooling_off_threshold_amount', 1000.00);
    }
}
