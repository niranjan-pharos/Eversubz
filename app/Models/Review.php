<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'ad_post_id',
        'name',
        'email',
        'category',
        'description',
        'rating',
        'user_id',
        'status',
        'reviewable_type',
        'reviewable_id'
    ]; 

    public function adPost()
    {
        return $this->belongsTo(AdPost::class);
    }

    public function reviewable()
    {
        return $this->morphTo();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
