<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDoa extends Model
{
    use HasFactory;

    protected $table = 'table_jadwal_doa';

    protected $fillable = [
        'nama_jadwal',
        'kategori_jadwal_id',
        'hari',
        'waktu',
        'lokasi',
        'keterangan',
        'is_active',
    ];

    public function kategoriJadwal()
    {
        return $this->belongsTo(KategoriJadwal::class, 'kategori_jadwal_id');
    }
}
