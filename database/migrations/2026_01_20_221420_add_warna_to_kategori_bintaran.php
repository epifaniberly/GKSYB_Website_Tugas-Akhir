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
        Schema::table('kategori_bintaran', function (Blueprint $table) {
            $table->string('warna', 20)->default('#8C1007')->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_bintaran', function (Blueprint $table) {
            $table->dropColumn('warna');
        });
    }
};
