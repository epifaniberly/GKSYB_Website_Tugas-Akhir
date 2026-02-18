<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDokumenModel extends Model
{
    use HasFactory;

    protected $table = 'kategori_dokumen';

    protected $fillable = [
        'nama_kategori',
    ];

    public function dokumen()
    {
        return $this->hasMany(DokumenModel::class, 'kategori_id');
    }
}
