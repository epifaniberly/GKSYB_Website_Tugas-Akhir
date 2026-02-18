<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqModel extends Model
{
    use HasFactory;

    protected $table = 'table_faq';

    protected $fillable = [
        'kategori_faq_id',
        'pertanyaan',
        'jawaban',
        'is_active',
    ];

    public function kategoriFaq()
    {
        return $this->belongsTo(KategoriFaqModel::class, 'kategori_faq_id');
    }
}
