<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table= 'categories';
    protected $fillable = ['name', 'status','icon','slug'];
    protected $primaryKey = 'id';
    public $timestamps = false; 

    public function adPosts()
    {
        return $this->hasMany(AdPost::class, 'category_id', 'id');
    }

    public function businessProducts()
    {
        return $this->hasMany(BusinessProduct::class, 'category_id','id');
    }


    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function searchCategory($id=null){
        $query = self::select('id', 'name as text')->where('id', $id);

        if ($id) {
            return $query->first(); 
        }

        return $query->orderBy('id', 'DESC')->get();         
    }

    
}
