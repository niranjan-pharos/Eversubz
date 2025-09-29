<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgoImage extends Model
{
    use HasFactory;
    protected $fillable = ['ngo_id', 'image_path'];

    public function ngo()
    {
        return $this->belongsTo(Ngo::class);
    }
}
