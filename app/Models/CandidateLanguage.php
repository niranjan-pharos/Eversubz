<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateLanguage extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'language_name','proficiency_level'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
