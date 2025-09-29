<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = 'languages';
    protected $fillable = ['name', 'languageable_id', 'languageable_type'];
    protected $casts = [
        'name' => 'string',
    ];
    
    public function languageable()
    {
        return $this->morphTo();
    }

    

}
