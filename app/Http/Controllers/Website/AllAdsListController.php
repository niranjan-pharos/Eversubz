<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\AdPost;
use App\Models\PostAuthor;
use App\Models\Tag;
use App\Models\User;
use App\Models\Review;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;

class AllAdsListController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()  
    {
        $posts = AdPost::where('status', 1)
        ->with('tags', 'primaryImage')
        ->get(); 
        $posts->load('category', 'subcategory');
        // dd($posts);
        
        return view('website.ads-list.index', compact('posts'));
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
        $adPost = AdPost::with('user')->find($id);
        if (!$adPost) {
            abort(404);
        }
     
        // Retrieve the user associated with the ad post
        $user = $adPost->user;
    
        // Retrieve total ads count for the user
        $totalAdsCount = User::findOrFail($user->id)->adPosts()->count();
    
        // Define $postId variable
        $postId = $id;
    
        // Fetch reviews for the specific post ID
        $reviews = Review::where('ad_post_id', $id)->get();
    
        // Fetch count of reviews for the specific post ID
        $reviewCount = Review::where('ad_post_id', $id)->count();
    
        // Fetch count of reviews for all post IDs
        $reviewCounts = Review::select('ad_post_id', DB::raw('COUNT(*) as review_count'))
            ->groupBy('ad_post_id')
            ->get();

                // Fetch count of reviews for the specific user ID
    $userReviewCount = Review::where('user_id', $user->id)->count();
        return view('website.ads-list.details', compact('adPost', 'user', 'totalAdsCount', 'postId', 'reviews', 'reviewCount', 'reviewCounts', 'userReviewCount'));
    }

    public function submitReview(Request $request, $postId)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'category' => 'required',
        'description' => 'required',
        'rating' => 'required|integer|min:1|max:5',
    ]);
    
    // Find the ad post by its ID
    $adPost = AdPost::findOrFail($postId);
    
    // Retrieve user ID from the ad post
    $userId = $adPost->user_id;
    // dd($userId);
    // Create the review associated with the ad post
    $adPost->reviews()->create([
        'user_id' => $userId, // Retrieve user_id from the ad post
        'name' => $request->name,
        'email' => $request->email,
        'category' => $request->category,
        'description' => $request->description,
        'rating' => $request->rating,
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully!');
}

public function submitReport(Request $request, $postId)
{
    $request->validate([
        'reason' => 'required',
    ]);

    // Find the ad post by its ID
    $adPost = AdPost::findOrFail($postId);
    
    // Create a new report associated with the ad post
    $adPost->reports()->create([
        'reason' => $request->input('reason'),
        'details' => $request->input('details'),
    ]);

    return redirect()->back()->with('success', 'Report submitted successfully!');
}

    // Other controller methods...
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
