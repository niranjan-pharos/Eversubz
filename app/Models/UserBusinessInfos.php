<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class UserBusinessInfos extends Model
{
    use HasFactory;
    protected $table = 'user_business_infos'; 

    protected $fillable = [
        'user_id',
        'business_name',
        'slug',
        'business_category',
        'abn',
        'sku',
        'contact_email',
        'contact_phone',
        'business_address',
        'business_description',        
        'establish_year',
        'website_url',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'business_city',
        'business_state',
        'business_country',
        'logo_path',
        'status',
        'feature',
        'orderby',
        'created_by_admin',
    ];

    public function languages()
    {
        return $this->morphMany(Language::class, 'languageable');
    }

    public function images()
    {
        return $this->hasMany(BusinessImage::class,'user_business_infos_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function businessHours()
    {
        return $this->hasMany(UserBusinessHour::class, 'user_business_info_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(BusinessProduct::class, 'business_id');
    }

    public function deals() 
    {
        return $this->hasMany(Deal::class, 'user_business_info_id');
    }

    public function businessCategory()
    {
        return $this->belongsTo(BusinessCategory::class, 'business_category', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug'; 
    }

    public function productReviews(): HasManyThrough
    {
        return $this->hasManyThrough(
            Review::class,
            BusinessProduct::class,
            'business_id', // Foreign key on the BusinessProduct table (referencing UserBusinessInfos)
            'reviewable_id', // Foreign key on the reviews table...
            'id', // Local key on the UserBusinessInfos table...
            'id'  // Local key on the BusinessProduct table...
        )->where('reviewable_type', BusinessProduct::class);
    }

    
    public function enquiries() 
    {
        return $this->morphMany(Enquiry::class, 'enquiryable');
    }
    
}
