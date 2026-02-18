<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosmedModel extends Model
{
    use HasFactory;

    protected $table = 'table_sosmed';

    protected $fillable = [
        'url_fb',
        'url_ig',
        'url_yt',
        'url_x',
        'url_tiktok',
        'url_gmaps',
    ];
}
