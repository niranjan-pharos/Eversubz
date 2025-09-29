<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $fillable = ['attribute_type_id', 'value', 'status'];

    public function type()
    {
        return $this->belongsTo(AttributeType::class, 'attribute_type_id');
    }

    public function products()
    {
        return $this->belongsToMany(BusinessProduct::class, 'product_attribute_values')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
