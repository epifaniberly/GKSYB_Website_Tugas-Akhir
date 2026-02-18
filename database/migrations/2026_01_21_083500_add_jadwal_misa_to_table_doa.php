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
        Schema::table('table_doa', function (Blueprint $table) {
            $table->string('jadwal_misa')->nullable()->after('jenis_permohonan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_doa', function (Blueprint $table) {
            $table->dropColumn('jadwal_misa');
        });
    }
};
