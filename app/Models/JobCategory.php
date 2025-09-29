<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','status'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($jobCategory) {
            if (empty($jobCategory->slug)) {
                $jobCategory->slug = \Str::slug($jobCategory->name);
            }
        });
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    
    public function candidateProfiles()
    {
        return $this->belongsToMany(CandidateProfile::class, 'candidate_profile_category', 'job_category_id', 'candidate_profile_id');
    }
    
}
