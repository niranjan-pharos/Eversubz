<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasHashSlug, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users'; 
    protected $fillable = [
        'uid',
        'name',
        'username',
        'email',
        'phone',
        'password', 
        'account_type',
        'is_admin_approved',
        'ngo_id',
        'address',
        'ngo_join_date',
        'permanent_city',
        'permanent_state',
        'permanent_country',
        'is_module_visible',
        'tagline',
        'status',
        'image',
        'email_verified_at',
        'remember_token',
        'active_status',
        'avatar',
        'dark_mode',
        'messenger_color',
        'deleted_at'
    ];

    protected $guard = 'User';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\CustomPasswordReset($token));
    }

    public function adPosts()
    {
        return $this->hasMany(AdPost::class);
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'user_id')->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'following_id')->withTimestamps();
    }

    public function businessHours()
    {
        return $this->hasMany(UserBusinessHour::class, 'user_id', 'id');
    }

    public function BusinessInfos() {
        return $this->hasOne(UserBusinessInfos::class,'user_id', 'id');
    }

    public function NgoInfos() {
        return $this->hasOne(Ngo::class,'user_id', 'id');
    }

    public function reviewsReceived()
    {
        return Review::whereHas('reviewable', function ($query) {
            $query->where('user_id', $this->id);
        })->count();
    }
 
    // public function events()
    // {
    //     return $this->morphMany(Event::class, 'creatable');
    // }
    public function events()
    {
        return $this->belongsToMany(Event::class)->withPivot('interested', 'going')->withTimestamps();
    }


    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }
    
    public function tickets()
    {
        return $this->hasMany(UserTicket::class);
    }

    // candidate
    public function candidateProfile()
    {
        return $this->hasOne(CandidateProfile::class, 'user_id', 'id');
    }


    public function educations()
    {
        return $this->hasMany(Education::class, 'user_id', 'id');
    }


    public function experiences()
    {
        return $this->hasMany(Experience::class, 'user_id', 'id')->orderBy('from_date', 'desc');
    }

    public function candidateLanguages()
    {
        return $this->hasMany(CandidateLanguage::class);
    }

    public function contactRequests()
    {
        return $this->hasMany(ContactRequest::class, 'candidate_id');
    }

    public function bookmarks()
    {
        return $this->belongsToMany(CandidateProfile::class, 'bookmarks', 'user_id', 'candidate_profile_id')->withTimestamps();
    }

    public function totalExperienceYears()
    {
        return $this->experiences()
            ->selectRaw('SUM(TIMESTAMPDIFF(MONTH, from_date, IFNULL(to_date, CURDATE()))) / 12 as total_experience_years');
    }

    // display event
    public function orderEvents()
    {
        return $this->hasMany(\App\Models\OrderEvent::class, 'user_id');
    }

    public function hostedEvents()
    {
        return $this->hasMany(Event::class, 'user_id');
    }
   
}