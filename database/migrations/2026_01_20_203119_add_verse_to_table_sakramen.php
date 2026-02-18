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
        Schema::table('table_sakramen', function (Blueprint $table) {
            $table->text('kutipan_ayat')->nullable()->after('deskripsi_singkat');
            $table->string('sumber_ayat')->nullable()->after('kutipan_ayat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_sakramen', function (Blueprint $table) {
            $table->dropColumn(['kutipan_ayat', 'sumber_ayat']);
        });
    }
};
