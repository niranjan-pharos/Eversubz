<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Skill extends Model
{
    use HasFactory;
    
    protected $fillable = ['skill_name','slug', 'status'];
    protected $table = 'skills';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->skill_name);
        });
    }

    
    public function candidateProfiles()
    {
        return $this->belongsToMany(CandidateProfile::class, 'candidate_skill', 'skill_id', 'candidate_profile_id')
                    ->withPivot('proficiency_level');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_skill', 'skill_id', 'job_id');
    }
}
