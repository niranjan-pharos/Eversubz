<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\AdPost;

class Subcategory extends Model
{
    use HasFactory;
    protected $table= 'subcategories';
    protected $fillable = ['category_id', 'name', 'slug','status'];

    public function category() 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory() 
    {
        return $this->belongsTo(SubCategory::class, 'id');
    }

    public function products() 
    {
        return $this->hasMany(BusinessProduct::class, 'subcategory_id');
    }


    public static function searchCat($searchTerm, $catId)
    {
        $query = self::query();

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        $query->where('category_id', $catId);

        $results = $query->select('id', 'name as text')->get()->toArray();

        return $results;
    }

    public function adPosts() 
    {
        return $this->hasMany(AdPost::class)->where('status', '=', 1);
    }

    public function activePostsCount()
    {
        return $this->adPosts()->count();
    }

    public function businessProducts()
    {
        return $this->hasMany(BusinessProduct::class,'subcategory_id');
    }
    

}
