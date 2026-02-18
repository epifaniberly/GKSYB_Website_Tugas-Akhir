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
        Schema::create('ekaristi_table', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perayaan');
            $table->text('ket_perayaan')->nullable();

            $table->date('tanggal')->nullable();          
            $table->date('tanggal_mulai')->nullable();    
            $table->date('tanggal_akhir')->nullable();    

            $table->boolean('is_publish')->default(false);
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekaristi_table');
    }
};
