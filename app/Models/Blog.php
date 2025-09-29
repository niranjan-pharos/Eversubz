<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'date', 'meta_title', 'meta_description', 'slug', 'alt_text', 'blog_image', 'blog_description'
    ];
}
