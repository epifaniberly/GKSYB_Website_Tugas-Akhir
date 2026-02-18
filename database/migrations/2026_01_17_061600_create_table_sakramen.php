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
        Schema::create('table_sakramen', function (Blueprint $table) {
            $table->id();

            $table->string('icon_sakramen')->nullable();
            $table->string('judul_sakramen');
            $table->string('deskripsi_singkat');
            $table->text('deskripsi_lengkap')->nullable();
            $table->json('gambar_slide')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_sakramen');
    }
};
