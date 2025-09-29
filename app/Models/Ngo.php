<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ngo extends Model
{
    use HasFactory;
    protected $fillable = [
        'ngo_name',
        'user_id',
        'contact_email',
        'establishment',
        'languages',
        'cat_id', 
        'abn',
        'acnc',
        'gst',
        'ngo_address',
        'ngo_city',
        'ngo_state',
        'ngo_country',
        'contact_phone',
        'website_url',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'feature',
        'orderby',
        'logo_path',
        'ngo_description',
        'created_by_admin',
        'status',
        'languages',
        'feature'
    ];

    // Cast languages and other_images as arrays
    protected $casts = [
        'languages' => 'array',
        'feature' => 'boolean',
    ]; 

    // Optionally define default values for attributes
    protected $attributes = [
        'orderby' => 0,
        'created_by_admin' => 0,
    ];

    public function images()
    {
        return $this->hasMany(NgoImage::class, 'ngo_id');
    }

    

    public function languages() 
    {
        return $this->morphMany(Language::class, 'languageable');
    }

    public function members()
    {
        return $this->hasMany(NgoMember::class);
    }
    public function totalmember()
    {
        return $this->hasMany(NgoMember::class, 'ngo_id');
    }

    public function category()
    {
        return $this->belongsTo(NgoCategory::class, 'cat_id');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function fundraising()
    {
        return $this->belongsTo(Fundraising::class, 'ngo_id');
    }

   
}