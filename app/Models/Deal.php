<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $table = 'deals_in';

    protected $fillable = [
        'user_business_info_id',
        'deal',
    ];

    public function userBusinessInfo()
    {
        return $this->belongsTo(UserBusinessInfos::class, 'user_business_info_id');
    }
}
