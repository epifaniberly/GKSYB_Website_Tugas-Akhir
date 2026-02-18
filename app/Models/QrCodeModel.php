<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodeModel extends Model
{
    use HasFactory;

    protected $table = 'table_qr_code';

    protected $fillable = [
        'qr_img',
    ];
}
