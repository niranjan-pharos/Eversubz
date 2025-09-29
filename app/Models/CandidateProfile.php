<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'profession','about','address','city','state','country','gender','salary','linkedin_url','github_url','website_url','resume','created_at','updated_at'];

    protected $dates = ['dob'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(JobCategory::class, 'candidate_profile_category', 'candidate_profile_id', 'job_category_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'candidate_skill', 'candidate_profile_id', 'skill_id')
                    ->withPivot('proficiency_level');
    }

    public function educations()
    {
        return $this->hasManyThrough(Education::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }

    public function candidateLanguages()
    {
        return $this->hasMany(CandidateLanguage::class, 'user_id', 'user_id');
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'candidate_profile_id', 'user_id')->withTimestamps();
    }


    
}
