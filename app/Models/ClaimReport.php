<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimReport extends Model
{
    use HasFactory;

    protected $fillable = ['ad_post_id', 'name', 'address', 'email', 'phoneno', 'reason'];

    public function adPost()
    {
        return $this->belongsTo(AdPost::class);
    }
}
