<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'discount',
        'is_valid',
        'expires_at',
        'module_name', 
    ];

    public function isValid()
    {
        return $this->is_valid && (!$this->expires_at || Carbon::parse($this->expires_at)->isFuture());
    }

    public function scopeForModule($query, $module)
    {
        return $query->where('module_name', $module);
    }

    protected $casts = [
        'expires_at' => 'datetime',
    ];


}
