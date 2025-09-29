<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBusinessHour extends Model
{
    use HasFactory;
    protected $table = 'user_business_hours'; 

    protected $fillable = [
        'user_business_info_id',
        'user_id',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function businessInfo() {
        return $this->belongsTo(UserBusinessInfos::class);
    }

    public function getMondayHoursAttribute()
    {
        return $this->monday ?: 'Closed';
    }
    public function getTuesdayHoursAttribute()
    {
        return $this->tuesday ?: 'Closed';
    }
    public function getWednesdayHoursAttribute()
    {
        return $this->wednesday ?: 'Closed';
    }
    public function getThursdayHoursAttribute()
    {
        return $this->thursday ?: 'Closed';
    }
    public function getFridayHoursAttribute()
    {
        return $this->friday ?: 'Closed';
    }
    public function getSaturdayHoursAttribute()
    {
        return $this->saturday ?: 'Closed';
    }
    
    public function getSundayHoursAttribute()
    {
        return $this->sunday ?: 'Closed';
    }
    
}
