<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationPackageImage extends Model
{
    protected $fillable = ['donation_package_id', 'image', 'position'];

    public function donationPackage()
    {
        return $this->belongsTo(DonationPackage::class);
    }
}

