<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\AdPost;
use Illuminate\Support\Facades\DB; 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $categories = Category::with([
            'subCategories' => function ($query) {
                $query->withCount('adPosts');
            },
            'adPosts' => function ($query) {
                $query->select('category_id', DB::raw('count(*) as total'))
                    ->groupBy('category_id'); 
            }
        ])->get();
        
        return view('categories.index', compact('categories'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
