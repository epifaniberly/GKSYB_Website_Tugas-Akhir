<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TulisanBintaranImage extends Model
{
    use HasFactory;

    protected $table = 'tulisan_bintaran_images';

    protected $fillable = [
        'tulisan_bintaran_id',
        'image',
        'caption',
    ];

    public function tulisanBintaran()
    {
        return $this->belongsTo(TulisanBintaranModel::class, 'tulisan_bintaran_id');
    }
}
