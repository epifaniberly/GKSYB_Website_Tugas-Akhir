<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakModel extends Model
{
    use HasFactory;

    protected $table = 'table_kontak';

    protected $fillable = [
        'alamat',
        'telepon',
        'whatsapp',
        'email'
    ];

    public function jamPelayanan()
    {
        return $this->hasMany(JamPelayananModel::class, 'kontak_id');
    }
}
