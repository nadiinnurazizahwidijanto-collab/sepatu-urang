<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Cek dulu apakah kolom discount sudah ada
            if (!Schema::hasColumn('orders', 'discount')) {
                $table->integer('discount')->default(0)->after('address');
            }
            // Cek dulu apakah kolom status sudah ada
            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status', 10)->default('P')->after('discount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['discount', 'status']);
        });
    }
};