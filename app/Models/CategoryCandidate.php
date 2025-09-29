<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCandidate extends Model
{
    use HasFactory;

    protected $table = 'category_candidates';

    protected $fillable = [
        'fundraising_id','first_name', 'last_name', 'email', 'phone', 'category_id',
        'about', 'dob', 'gender', 'profession', 'education',
        'permanent_address', 'permanent_city', 'permanent_state', 'permanent_country',
        'documents'
    ];

    protected $casts = [
        'education' => 'array',
        'documents' => 'array',
    ];

    // Relationship to JobCategory
    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }
}

