<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    use HasFactory;

    protected $table= 'job_skills';

    protected $fillable = ['job_id', 'skill_id'];

    public function jobs()
    {
        return $this->belongsTo(Job::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
    
}
