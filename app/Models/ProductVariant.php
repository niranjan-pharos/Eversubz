<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $table = 'product_variants';
    protected $fillable = [
        'product_id',
        'variant',
        'sku',
        'price',
        'quantity',
        'image',
        'isactive'
    ];



    public function productDetails()
    {
        return $this->hasMany(BusinessProduct::class, 'product_id', 'id');
    }
}
