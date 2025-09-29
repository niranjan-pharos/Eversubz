<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundraisingImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'fundraising_id', 'image_path'
    ];

    public function fundraising()
    {
        return $this->belongsTo(Fundraising::class);
    }
}
