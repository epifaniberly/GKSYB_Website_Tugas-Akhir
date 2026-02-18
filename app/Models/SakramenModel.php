<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakramenModel extends Model
{
    use HasFactory;

    protected $table = 'table_sakramen';

    protected $fillable = [
        'icon_sakramen',
        'judul_sakramen',
        'deskripsi_singkat',
        'kutipan_ayat',
        'sumber_ayat',
        'deskripsi_lengkap',
        'gambar_slide',
    ];

    protected $casts = [
        'gambar_slide' => 'array',
    ];
}
