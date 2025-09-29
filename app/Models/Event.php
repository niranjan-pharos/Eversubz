<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;
use voku\helper\UTF8;

class Event extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'title', 'slug', 'category_id','host_name', 'about_host', 'location', 'city', 'state', 'country', 'price', 'event_description', 'attendee_info',
        'event_details', 'facebook_link', 'linkedin_link', 'x_link', 'copy_event_url',
        'refund_policy', 'keywords', 'main_image', 'video_link', 'from_date_time',
        'to_date_time', 'user_id', 'status','mode','feature', 'orderby', 'interested_count', 'going_count','available_tickets'
    ]; 

    protected $dates = [
        'from_date_time',
        'to_date_time',
    ];

    protected $casts = [
        'from_date_time' => 'datetime',
        'to_date_time' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->slug) {
                $slug = Str::slug($model->title);
                $slug = UTF8::to_ascii($slug);
                $model->slug = $slug . '-' . rand(1000, 9999); 
            }
        });

        // Handle slug regeneration when the title is updated
        static::updating(function ($model) {
            if ($model->isDirty('title')) {  // Check if the title has changed
                $slug = Str::slug($model->title);  // Convert the title to a basic slug
                $slug = UTF8::to_ascii($slug);     // Transliterate the slug into ASCII if there are non-Latin characters
                $model->slug = $slug . '-' . rand(1000, 9999);
            }
        });
    }

    

    public function setFromDateTimeAttribute($value)
    {
        \Log::info('Mutator called for from_date_time', ['value' => $value, 'trace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10)]);
        if (!$value) return;
        if ($value instanceof \Carbon\Carbon) {
            $this->attributes['from_date_time'] = $value->setTimezone('Australia/Sydney')->format('Y-m-d H:i:s');
        } else {
            try {
                $this->attributes['from_date_time'] = Carbon::createFromFormat('Y-m-d\TH:i', $value, 'Australia/Sydney')
                ->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                throw new \InvalidArgumentException("Invalid from_date_time format: {$value}. Expected Y-m-d\TH:i (e.g., 2025-07-17T14:17).");
            }
        }
    }

    public function getFromDateTimeAttribute($value)
    {
        return Carbon::parse($value)->timezone('Australia/Sydney');
    }


    public function setToDateTimeAttribute($value)
    {
        \Log::info('Mutator called for to_date_time', ['value' => $value, 'trace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10)]);
        if (!$value) return;
        if ($value instanceof \Carbon\Carbon) {
            $this->attributes['to_date_time'] = $value->setTimezone('Australia/Sydney')->format('Y-m-d H:i:s');
        } else {
            try {
                $this->attributes['to_date_time'] = Carbon::createFromFormat('Y-m-d\TH:i', $value, 'Asia/Kolkata')
                    ->setTimezone('Australia/Sydney')
                    ->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                throw new \InvalidArgumentException("Invalid to_date_time format: {$value}. Expected Y-m-d\TH:i (e.g., 2025-07-17T14:17).");
            }
        }
    }

    public function getToDateTimeAttribute($value)
    {
        return Carbon::parse($value)->timezone('Australia/Sydney');
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }

    public function eventTags()
    {
        return $this->hasMany(EventTag::class);
    }

    public function creatable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('interested', 'going')->withTimestamps();
    }

    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageable');
    }



    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function enquiries()
    {
        return $this->morphMany(Enquiry::class, 'enquiryable');
    }

 
    public function ticketTypes()
    {
        return $this->hasMany(EventTicketType::class, 'event_id', 'id');
    }

    // need to check
    public function orders()
    {
        return $this->hasMany(Order::class, 'event_id');
    }

    public function orderEvents()
    {
        return $this->hasMany(OrderEvent::class, 'event_id'); // Ensure the foreign key is correct
    }

    public function getAvailableTicketsAttribute($value)
    {
        return $this->ticketTypes()->sum(\DB::raw('GREATEST(max_quantity - sold_quantity, 0)'));
    }


}


