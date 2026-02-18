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
        Schema::table('tulisan_bintaran', function (Blueprint $table) {
            \DB::statement('ALTER TABLE tulisan_bintaran MODIFY konten LONGTEXT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tulisan_bintaran', function (Blueprint $table) {
            \DB::statement('ALTER TABLE tulisan_bintaran MODIFY konten VARCHAR(255)');
        });
    }
};
