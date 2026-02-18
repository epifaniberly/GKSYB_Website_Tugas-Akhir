<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoModel extends Model
{
    use HasFactory;

    protected $table = 'table_seo';

    protected $fillable = [
        'meta_desc',
        'meta_keyword',
        'google_id',
        'maintenance_mode',
    ];
}
