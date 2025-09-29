<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTag extends Model
{
    use HasFactory;

    protected $fillable = ['tag_name','job_id'];

    public function jobs()
    {
        return $this->belongsTo(Job::class);
    }

}
