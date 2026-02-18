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
            $table->string('asal_paroki')->nullable()->after('nama')->nullable();
            $table->string('asal_lingkungan')->nullable()->after('asal_paroki')->nullable();
            $table->string('nomor_telepon')->nullable()->after('asal_lingkungan')->nullable();
            $table->string('jenis_permohonan')->nullable()->after('nomor_telepon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_doa', function (Blueprint $table) {
            $table->dropColumn('asal_paroki');
            $table->dropColumn('asal_lingkungan');
            $table->dropColumn('nomor_telepon');
            $table->dropColumn('jenis_permohonan');
        });
    }
};
