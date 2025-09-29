<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;
    
    protected $fillable = ['candidate_id', 'sender_name','sender_email','message'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
