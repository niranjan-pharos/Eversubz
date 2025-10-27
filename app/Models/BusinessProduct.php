<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use voku\helper\ASCII;
use voku\helper\UTF8;
use Illuminate\Support\Str;

class BusinessProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'sku',
        'product_id',
        'category_id', 
        'subcategory_id', 
        'name',
        'price',
        'mrp',
        'description',
        'main_image',
        'video_url',
        'user_id',
        'item_url',
        'business_id',
        'status',
        'feature',
        'orderby',
        'max_qty',
        'is_active',
    ];
   

    protected $casts = [
        'main_image' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->product_id = self::generateUniqueProductId();

            if (!empty($model->title)) {
                $baseSlug = Str::slug($model->title);
                $baseSlug = UTF8::to_ascii($baseSlug);
                $model->slug = self::generateUniqueSlug($baseSlug);
                $model->item_url = $model->slug; 
                \Log::debug('Creating product: Generated slug and item_url', [
                    'title' => $model->title,
                    'slug' => $model->slug,
                    'item_url' => $model->item_url
                ]);
            } else {
                \Log::warning('Creating product: Title is empty, item_url not set', ['product_id' => $model->product_id]);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') && !empty($model->title)) {
                $baseSlug = Str::slug($model->title);
                $baseSlug = UTF8::to_ascii($baseSlug);
                $model->slug = self::generateUniqueSlug($baseSlug);
                $model->item_url = $model->slug;
                \Log::debug('Updating product: Generated new slug and item_url', [
                    'title' => $model->title,
                    'slug' => $model->slug,
                    'item_url' => $model->item_url
                ]);
            } elseif (empty($model->title)) {
                \Log::warning('Updating product: Title is empty, item_url not updated', ['product_id' => $model->product_id]);
            }
        });
    }

    private static function generateUniqueSlug($baseSlug)
    {
        $slug = $baseSlug;
        $counter = 1;
        while (self::where('slug', $slug)->orWhere('item_url', $slug)->exists()) {
            $slug = $baseSlug . '-' . rand(1000, 9999) . ($counter > 1 ? '-' . $counter : '');
            $counter++;
        }
        return $slug;
    }

    private static function generateUniqueProductId()
    {
        do {
            $productId = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (self::where('product_id', $productId)->exists());

        return $productId;
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function languages()
    {
        return $this->morphMany(Language::class, 'languageable');
    }

    public function businessInfo()
    {
        return $this->belongsTo(UserBusinessInfos::class, 'business_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wishlists()
    {
        return $this->morphMany(Wishlist::class, 'wishable');
    }

    public function isInWishlist()
    {
        $userId = auth()->id();
        return $this->wishlists()->where('user_id', $userId)->exists();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function UserBusinessInfos()
    {
        return $this->belongsTo(UserBusinessInfos::class, 'business_id');
    }

    public function userBusinessHours()
    {
        return $this->belongsTo(UserBusinessHour::class, 'user_business_hours');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getPrimaryImageAttribute()
    {
        return $this->images()->first() ?: null;
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function colors()
    {
        return $this->attributes()->where('type', 'color');
    }

    public function sizes()
    {
        return $this->attributes()->where('type', 'size');
    }
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values')
                    ->withPivot('status')
                    ->withTimestamps();
    }

}
?>