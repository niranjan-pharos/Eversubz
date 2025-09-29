<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'last_name',
        'phone',
        'description',
        'module',
        'appointment_date',
        'appointment_time',
        'enquiryable_id',
        'enquiryable_type',
    ];

    public function enquiryable()
    {
        return $this->morphTo();
    }

    public function scopeEvent($query)
    {
        return $query->where('enquiryable_type', 'App\Models\Event');
    }

    public function scopeBusiness($query)
    {
        return $query->where('enquiryable_type', 'App\Models\UserBusinessInfos');
    }

    public function relatedEvent()
    {
        return $this->morphTo('enquiryable', 'enquiryable_type', 'enquiryable_id')
                    ->where('enquiryable_type', 'App\Models\Event')
                    ->first();
    } 

    public function relatedBusiness()
    {
        return $this->morphTo('enquiryable', 'enquiryable_type', 'enquiryable_id')
                    ->where('enquiryable_type', 'App\Models\UserBusinessInfos')
                    ->first();
    }

    
}
