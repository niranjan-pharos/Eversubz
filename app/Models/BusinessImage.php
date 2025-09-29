<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'user_business_infos_id'];

    public function userBusinessInfo()
    {
        return $this->belongsTo(UserBusinessInfos::class);
    }
}
