<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'ad_posts_images';
    protected $fillable = ['url','is_primary','ad_post_id'];

    use HasFactory;

    public function adPost() 
    {
        return $this->belongsTo(AdPost::class, 'ad_post_id');
    }


    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }
}