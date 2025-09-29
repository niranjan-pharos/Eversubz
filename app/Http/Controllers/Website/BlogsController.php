<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;

use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
    public function index(Request $request)
    {
            $blogs = Blog::orderBy('date', 'desc')->get(); // Fetch all blogs ordered by date descending
       
    
        return view('main.blogs', compact('blogs'));
    }


    public function show($slug)
    {
     
        $blog = Blog::where('slug', $slug)->firstOrFail(); // Assuming Blog model and 'blogs' table exist
        $new_blogs = Blog::orderBy('date', 'desc')->get(); // Fetch all blogs ordered by date descending
        return view('main.blog_details', compact('blog', 'new_blogs'));
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