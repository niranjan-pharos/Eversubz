<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faq'; // Specify the table name

    protected $fillable = [
        'question', 'slug', 'category_id', 'subcategory_id', 'answer',
    ];

  
    public function category()
{
    return $this->belongsTo(FaqCategory::class, 'category_id');
}

public function subcategory()
{
    return $this->belongsTo(FaqSubcategory::class, 'subcategory_id');
}
}
