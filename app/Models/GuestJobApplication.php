<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestJobApplication extends Model
{
    use HasFactory;
    protected $table = 'guest_job_applications';

    protected $fillable = [
        'job_id',
        'name', 
        'email',
        'resume',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function getResumeUrlAttribute()
    {
        if ($this->resume) {
            return asset('storage/candidates/' . $this->resume);
        }
        return null;
    }
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
}
