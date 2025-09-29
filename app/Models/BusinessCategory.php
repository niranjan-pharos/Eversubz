<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    use HasFactory;
    protected $table = 'business_categories';

    protected $fillable = [
        'icon',
        'name',
        'slug',
        'status',
    ];

    public function userBusinessInfos()
    {
        return $this->hasMany(UserBusinessInfos::class, 'business_category', 'id');
    }

    public function products()
    {
        return $this->hasMany(BusinessProduct::class, 'category_id');
    }
}
