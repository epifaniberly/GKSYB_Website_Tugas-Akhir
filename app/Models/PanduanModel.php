<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanduanModel extends Model
{
    use HasFactory;

    protected $table = 'panduan_table';

    protected $fillable = [
        'jenis_misa',
        'perayaan',
        'ket_perayaan',
        'ayat_alkitab',
        'tanggal',
        'tanggal_mulai',
        'tanggal_akhir',
        'is_publish',
        'file',
        'original_filename',
        'sumber_ayat',
    ];
}
