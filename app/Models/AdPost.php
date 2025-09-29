<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AdPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'post_id' ,'user_id','category_id','subcategory_id','price_condition', 'ad_category', 'product_condition', 'abn', 'location', 'description', 'status', 'price', 'offer_price', 'video_url', 'author_address', 'author_name', 'author_email', 'author_phone','preview_count', 'clicks_count','item_url', 'expiry_date','featured','recommended','urgent','spotlight'];
    protected $casts = [
        'expiry_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->post_id = self::generateUniquePostId();
        });
    }

    private static function generateUniquePostId()
    {
        do {
            $postId = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (self::where('post_id', $postId)->exists());

        return $postId;
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('jS M Y');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'ad_post_id');
    }

    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageable');
    }

    
    public function images()
    {
        return $this->hasMany(PostImage::class, 'ad_post_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    public function primaryImage()
    {
        return $this->hasOne(PostImage::class)->where('is_primary', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Delete image associated with this AdPost
     *
     * @param int $imageId
     * @return void
     */
    public function deleteImage($imageId)
    {
        // Find the image associated with this AdPost
        $image = $this->images()->where('id', $imageId)->first();

        // Check if the image exists
        if ($image) {
            // Delete the image
            $image->delete();
        }
    }

    public function wishlists()
    {
        return $this->morphMany(Wishlist::class, 'wishable');
    }

    public function isInWishlist()
    {
        // Assuming you have a user authentication system
        $userId = auth()->id();
        return $this->wishlists()->where('user_id', $userId)->exists();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public static function addProductByUrl(array $data)
    {

        $existingProduct = static::where('item_url', $data['item_url'])->first();

        if ($existingProduct) {
            return $existingProduct;
        }

        // Otherwise, create a new product
        return static::create($data);
    }

    public function getIsExpiredAttribute()
    {
        return $this->expiry_date->isPast();
    }

    public function getRouteKeyName()
    {
        return 'item_url';
    }

    public function getDatetimeAttribute()
    {
        return $this->created_at->format('mdHis');
    }

    public function enquiries()
    {
        return $this->morphMany(Enquiry::class, 'enquiryable');
    }

} 
