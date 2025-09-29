<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use voku\helper\ASCII;
use voku\helper\UTF8;
use Illuminate\Support\Str;

class ProductAttribute extends Model
{
    protected $fillable = ['business_product_id', 'type', 'value','status'];

    public function businessProduct()
    {
        return $this->belongsTo(BusinessProduct::class);
    }
}