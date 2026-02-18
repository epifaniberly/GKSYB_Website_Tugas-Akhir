<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBintaranModel extends Model
{
    use HasFactory;

    protected $table = 'kategori_bintaran';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'warna',
    ];

    public function tulisanBintaran()
    {
        return $this->hasMany(TulisanBintaranModel::class, 'kategori_bintaran_id');
    }
}
