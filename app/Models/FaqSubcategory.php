<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqSubcategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'slug', 'status'];

    /**
     * Get the parent category of the subcategory.
     */
    public function category()
    { 
        return $this->belongsTo(FaqCategory::class, 'category_id');
    }

public function faqs()
{
    return $this->hasMany(Faq::class, 'subcategory_id');
}

}
