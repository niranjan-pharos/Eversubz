<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgoCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'image', 'status'];

    public function ngos()
    {
        return $this->hasMany(Ngo::class, 'cat_id');
    }
}
 