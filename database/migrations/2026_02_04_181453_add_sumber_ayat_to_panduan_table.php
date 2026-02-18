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
        Schema::table('panduan_table', function (Blueprint $table) {
            $table->string('sumber_ayat')->nullable()->after('ayat_alkitab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('panduan_table', function (Blueprint $table) {
            $table->dropColumn('sumber_ayat');
        });
    }
};
