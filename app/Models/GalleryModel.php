<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{
    use HasFactory;

    protected $table = 'gallery_link';

    protected $fillable = [
        'url',
    ];
}
