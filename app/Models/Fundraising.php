<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundraising extends Model 
{
    use HasFactory;
    protected $table = 'fundraising'; // Specify the table name
    protected $fillable = [
        'title', 'for', 'amount', 'category_id', 'location', 'city', 'state', 'country', 'fundraising_description',
        'facebook_link', 'linkedin_link', 'x_link', 'copy_fundraising_url', 'video_link', 'from_date_time',
        'to_date_time', 'main_image', 'slug', 'status', 'featured', 'user_id', 'ngo_id'
    ];

    public function fundraisingImages()
    {
        return $this->hasMany(FundraisingImage::class);
    }

    public function category()
    {
        return $this->belongsTo(FundraisingCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ngo()
    {
        return $this->belongsTo(Ngo::class, 'ngo_id');
    }

    public function members()
    {
        return $this->hasMany(NgoMember::class, 'ngo_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'fundraising_id');
    }

    
}
