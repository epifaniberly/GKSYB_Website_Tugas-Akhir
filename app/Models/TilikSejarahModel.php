<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TilikSejarahModel extends Model
{
    use HasFactory;

    protected $table = 'profil_gereja';

    protected $fillable = [
        'nama',
        'deskripsi',
        'sejarah',
        'visi',
        'misi',
        'galeri',
        'maps',
    ];

    protected $casts = [
        'misi' => 'array',
        'galeri' => 'array',
    ];
}
