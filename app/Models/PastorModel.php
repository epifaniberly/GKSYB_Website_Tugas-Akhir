<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastorModel extends Model
{
    use HasFactory;

    protected $table = 'table_pastor';

    protected $fillable = [
        'nama_pastor',
        'foto_pastor',
        'jabatan',
        'status',
        'tahun_mulai',
        'tahun_selesai'
    ];
}
