<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('role')->default('admin')->after('password'); // superadmin, admin, fraud_analyst, compliance_officer
            $table->string('department')->default('Fraud & Risk Operations')->after('role');
            $table->string('employee_id')->nullable()->after('department');
            $table->boolean('is_active')->default(true)->after('employee_id');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'role', 'department', 'employee_id', 'is_active', 'last_login_at']);
        });
    }
};
