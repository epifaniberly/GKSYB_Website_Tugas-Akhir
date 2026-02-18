<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriFaqModel extends Model
{
    use HasFactory;

    protected $table = 'kategori_faq';

    protected $fillable = [
        'nama_kategori',
    ];

    public function faqs()
    {
        return $this->hasMany(FaqModel::class, 'kategori_faq_id');
    }
}
