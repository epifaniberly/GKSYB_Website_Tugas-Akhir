<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('panduan_table', 'nama_perayaan') && !Schema::hasColumn('panduan_table', 'jenis_misa')) {
            DB::statement('ALTER TABLE panduan_table CHANGE nama_perayaan jenis_misa VARCHAR(255)');
        }

        Schema::table('panduan_table', function (Blueprint $table) {
            if (!Schema::hasColumn('panduan_table', 'perayaan')) {
                $table->string('perayaan')->nullable()->after('jenis_misa');
            }
            if (!Schema::hasColumn('panduan_table', 'ayat_alkitab')) {
                $table->text('ayat_alkitab')->nullable()->after('ket_perayaan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('panduan_table', function (Blueprint $table) {
            if (Schema::hasColumn('panduan_table', 'jenis_misa')) {
                DB::statement('ALTER TABLE panduan_table CHANGE jenis_misa nama_perayaan VARCHAR(255)');
            }
            $table->dropColumn(['perayaan', 'ayat_alkitab']);
        });
    }
};
