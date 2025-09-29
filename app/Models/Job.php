<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'company_name',
        'category_id',
        'address',
        'description',
        'requirements',
        'city',
        'state',
        'country',
        'posted_by',
        'is_featured',
        'is_urgent',
        'experience_id',
        'job_mode',
        'status',
        'expires_at',
        'job_role',
        'image',
        'salary',
        'payment_type',
        'contact_phone',
        'website_url',  
        'user_id',
        'created_by_admin'
    ];

    public function category()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function tags()
    {
        return $this->hasMany(JobTag::class);
    }
    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class, 'job_tags', 'job_id', 'tag_id'); 
    // }
    
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skills', 'job_id', 'skill_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            $job->slug = Str::slug($job->title) . '-' . rand(1000, 9999);
        });
    }
    public function applications()
    {
        return $this->hasMany(GuestJobApplication::class, 'job_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
