<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'ad_posts_tags';
    protected $fillable = ['tag_name', 'ad_post_id'];
    use HasFactory;

    public function adPost()
    {
        return $this->belongsTo(AdPost::class, 'ad_post_id');
    }
}
