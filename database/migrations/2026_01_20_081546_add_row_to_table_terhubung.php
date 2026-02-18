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
        Schema::table('table_terhubung', function (Blueprint $table) {
            $table->string('nama_lengkap')->after('user_id')->nullable();
            $table->string('asal_paroki')->nullable()->after('nama_lengkap');
            $table->string('asal_lingkungan')->nullable()->after('asal_paroki');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_terhubung', function (Blueprint $table) {
            //
        });
    }
};
