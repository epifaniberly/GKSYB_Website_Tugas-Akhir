<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferBankModel extends Model
{
    use HasFactory;

    protected $table = 'table_transfer_bank';

    protected $fillable = [
        'nama_bank',
        'nomor_rekening',
        'atas_nama',
        'kode_bank',
    ];
}
