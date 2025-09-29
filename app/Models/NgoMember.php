<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgoMember extends Model
{
    use HasFactory;
    protected $fillable = ['ngo_id', 'name', 'designation', 'image'];

    public function ngo()
    {
        return $this->belongsTo(Ngo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
