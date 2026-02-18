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
        Schema::rename('kategori_dokparoki', 'kategori_dokumen');
        Schema::rename('dokparoki', 'dokumen');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('kategori_dokumen', 'kategori_dokparoki');
        Schema::rename('dokumen', 'dokparoki');
    }
};
