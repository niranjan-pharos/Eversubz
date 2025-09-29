<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundraisingCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status'];

    public function fundraisings()
    {
        return $this->hasMany(Fundraising::class, 'category_id');
    }

    
    
}
