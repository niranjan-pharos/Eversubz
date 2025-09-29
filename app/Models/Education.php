<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'user_id',
        'institution',
        'degree',
        'field_of_study',
        'from_date',
        'to_date',
        'ongoing',
        'grade',
        'location',
        'achievements',
        'description',
        'certificate_url'
    ];

    protected $table = 'candidate_educations';

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function candidateProfile()
    {
        return $this->belongsTo(CandidateProfile::class);
    }
}
