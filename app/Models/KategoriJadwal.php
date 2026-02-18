<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriJadwal extends Model
{
    use HasFactory;

    protected $table = 'kategori_jadwal';

    protected $fillable = [
        'nama_kategori',
    ];

    public function jadwals()
    {
        return $this->hasMany(JadwalDoa::class, 'kategori_jadwal_id');
    }
}
