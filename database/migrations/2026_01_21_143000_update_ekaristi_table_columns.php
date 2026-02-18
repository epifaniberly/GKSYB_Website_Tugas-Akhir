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
        Schema::table('ekaristi_table', function (Blueprint $table) {
            if (Schema::hasColumn('ekaristi_table', 'nama_perayaan') && !Schema::hasColumn('ekaristi_table', 'jenis_misa')) {
                $table->renameColumn('nama_perayaan', 'jenis_misa');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekaristi_table', function (Blueprint $table) {
            if (Schema::hasColumn('ekaristi_table', 'jenis_misa') && !Schema::hasColumn('ekaristi_table', 'nama_perayaan')) {
                $table->renameColumn('jenis_misa', 'nama_perayaan');
            }
        });
    }
};
