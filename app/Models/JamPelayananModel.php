<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamPelayananModel extends Model
{
    use HasFactory;

    protected $table = 'table_jam_pelayanan';

    protected $fillable = [
        'kontak_id',
        'hari_dari',
        'hari_sampai',
        'jam_mulai',
        'jam_selesai'
    ];

    public function kontak()
    {
        return $this->belongsTo(KontakModel::class, 'kontak_id');
    }
}
