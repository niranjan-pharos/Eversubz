<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Carbon\Carbon; // Import Carbon from the correct namespace
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    if ($request->ajax()) {
        $blogs = Blog::orderBy('date', 'desc')->get(); // Fetch all blogs ordered by date descending
        return response()->json($blogs);
    }

    $pageTitle = 'Blogs';
    $breadcrumbs = [
        [
            'label' => 'Dashboard',
            'url' => route('adminDashboard')
        ],
        [
            'label' => 'Blogs',
            'url' => null
        ],
    ];

    return view('admin.blog.index', compact('breadcrumbs', 'pageTitle'));
}


    public function addblog(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Blog Add',
                'url' => null
            ],
        ];
        return view('admin.blog.add_blog',compact('breadcrumbs'));
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
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'alt_text' => 'required|string|max:255',
            'blog_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'blog_description' => 'required|string',
        ]);

        // Handle file upload
        if ($request->hasFile('blog_image')) {
            $imageName = time() . '.' . $request->blog_image->extension();
            $request->blog_image->storeAs('public/blog_images', $imageName);
            $validatedData['blog_image'] = $imageName;
        }

        // Create a new blog entry
        Blog::create($validatedData);

        return redirect()->route('adminBlogAdd')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    
    {

        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Edit Blog',
                'url' => null
            ],
        ];
        $blog = Blog::findOrFail($id);

        // Convert date to Carbon instance
        $blog->date = Carbon::parse($blog->date);

        return view('admin.blog.edit_blog', compact('blog', 'breadcrumbs'));
    }

    /**
     * Update the specified blog in storage.
     */
    public function update(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'date' => 'required|date',
        'meta_title' => 'required|string|max:255',
        'meta_description' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'alt_text' => 'required|string|max:255',
        'blog_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:1024', // Only validate if a new image is uploaded
        'blog_description' => 'required|string',
    ]);

    // Find the blog by ID
    $blog = Blog::findOrFail($id);

    // Handle file upload if a new image is provided
    if ($request->hasFile('blog_image')) {
        $imageName = time() . '.' . $request->blog_image->extension();
        $request->blog_image->storeAs('public/blog_images', $imageName);
        $validatedData['blog_image'] = $imageName;

        // Delete the old image file if exists
        if ($blog->blog_image) {
            Storage::delete('public/blog_images/' . $blog->blog_image);
        }
    }

    // Update the blog entry
    $blog->update($validatedData);

    return redirect()->route('adminBlogEdit', $id)->with('success', 'Blog updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
    
        return response()->json(['success' => 'Blog deleted successfully']);
    }
}
