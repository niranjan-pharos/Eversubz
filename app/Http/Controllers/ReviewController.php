<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessProduct;
use App\Models\AdPost;
use App\Models\Review;

class ReviewController extends Controller
{
    // Method for handling BusinessProduct reviews
    public function submitBusinessProductReview(Request $request, $slug)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to submit a review.'], 403);
        }

        $request->validate([
            'postId' => 'required|exists:business_products,id',
            'rating' => 'required|integer|between:1,5',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $product = BusinessProduct::where('slug', $slug)->firstOrFail();

        if ($product->user_id == Auth::id()) {
            return response()->json(['error' => 'You cannot review your own product.'], 403);
        }

        // Check for duplicate review
        $existingReview = Review::where('reviewable_id', $request->postId)
            ->where('reviewable_type', BusinessProduct::class)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return response()->json(['error' => 'You have already reviewed this product.'], 400);
        }

        Review::create([
            'reviewable_id' => $request->postId,
            'reviewable_type' => BusinessProduct::class,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'name' => $request->name,
            'email' => $request->email,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Thank you for your review!']);
    }


    // Method for handling AdPost reviews
    public function submitAdPostReview(Request $request, $item_url)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to submit a review.'], 403);
        }

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $adPost = AdPost::where('item_url', $item_url)->first();
        if (!$adPost) {
            return response()->json(['error' => 'Invalid AdPost URL.'], 404);
        }

        if ($adPost->user_id == Auth::id()) {
            return response()->json(['error' => 'You cannot review your own post.'], 403);
        }

        // Check for duplicate review
        $existingReview = Review::where('reviewable_id', $adPost['id'])
            ->where('reviewable_type', AdPost::class)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return response()->json(['error' => 'You have already reviewed this post.'], 400);
        }

        Review::create([
            'reviewable_id' => $adPost['id'],
            'reviewable_type' => AdPost::class,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'name' => $request->name,
            'email' => $request->email,
            'category' => $request->category,
            'description' => $request->description,
            'status' => 1,
        ]);

        return response()->json(['success' => 'Thank you for your review!']);
    }
}
