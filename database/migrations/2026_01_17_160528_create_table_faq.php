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
        Schema::create('table_faq', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_faq_id')->constrained('kategori_faq')->onDelete('cascade');
            $table->string('pertanyaan');
            $table->text('jawaban');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_faq');
    }
};
