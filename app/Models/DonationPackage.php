<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationPackage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ngo_id',
        'name',
        'description',
        'in_packages',
        'image',
        'price',
        'quantity',
        'decide_by_eversabz',
        'status',
    ];

    protected $casts = [
        'price'             => 'decimal:2',
        'decide_by_eversabz'=> 'boolean',
        'status'            => 'boolean',
    ];

    public function ngo()
    {
        return $this->belongsTo(Ngo::class);
    }

    public function gallery()
    {
        return $this->hasMany(DonationPackageImage::class)
                    ->orderBy('position')
                    ->orderBy('id');
    }
    
}

