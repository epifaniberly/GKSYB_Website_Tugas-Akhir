<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerhubungModel extends Model
{
    use HasFactory;

    protected $table = 'table_terhubung';

    protected $fillable = [
        'user_id',
        'email',
        'nomor_telepon',
        'tanggal_kirim',
        'status',
        'isi_pesan',
        'nama_lengkap',
        'asal_paroki',
        'asal_lingkungan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
