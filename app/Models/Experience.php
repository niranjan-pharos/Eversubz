<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'job_title','company','from_date','to_date','ongoing','description','location','job_type','portfolio_url'];
    
    protected $table = 'candidate_experiences';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
