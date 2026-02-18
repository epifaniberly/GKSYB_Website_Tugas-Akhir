<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasModel extends Model
{
    use HasFactory;

    protected $table = 'identitas';

    protected $fillable = [
        'nama_website',
        'logo',
    ];
}
