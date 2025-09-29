<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['business_product_id', 'image_path'];

    public function businessProduct()
    {
        return $this->belongsTo(BusinessProduct::class);
    }
}
