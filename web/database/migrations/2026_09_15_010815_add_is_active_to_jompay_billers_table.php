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
        Schema::table('jompay_billers', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('is_ref_2_required');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jompay_billers', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
