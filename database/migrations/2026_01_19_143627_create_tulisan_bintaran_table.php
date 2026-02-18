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
        Schema::create('tulisan_bintaran', function (Blueprint $table) {
            $table->id();
            $table->string('judul_tulisan');
            $table->foreignId('kategori_bintaran_id')->constrained('kategori_bintaran')->onDelete('cascade');
            $table->string('ringkasan');
            $table->string('konten');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tulisan_bintaran');
    }
};
