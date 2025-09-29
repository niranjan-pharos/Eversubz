<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessCategory;
use App\Models\Category;

class BusinessCategoryController extends Controller
{
    public function getCategories()
    { 
        $categories = BusinessCategory::select('id', 'name', 'slug')->get();
        return response()->json($categories);
    }

    public function ajaxSearchBusinessCategoryById(Request $request)
    {
        $categoryId = $request->input('id');
        $category = BusinessCategory::find($categoryId); // Adjust this to your actual Category model and method

        return response()->json([
            'id' => $category->id,
            'text' => $category->name
        ]);
    }

   
    // getcategory
    public function product_category(){
        $categories = Category::where('status', '1')
                        ->select('id', 'name AS text')
                        ->get();

        return response()->json(['categories' => $categories]);

    }

}
