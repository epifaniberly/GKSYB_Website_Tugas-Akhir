<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenModel extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    protected $fillable = [
        'judul_dokumen',
        'kategori_id',
        'keterangan',
        'file',
        'original_filename',
        'is_active',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriDokumenModel::class, 'kategori_id');
    }
}
