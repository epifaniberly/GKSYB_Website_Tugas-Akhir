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
        Schema::table('table_sosmed', function (Blueprint $table) {
            $table->string('url_tiktok')->nullable()->after('url_yt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_sosmed', function (Blueprint $table) {
            $table->dropColumn('url_tiktok');
        });
    }
};
