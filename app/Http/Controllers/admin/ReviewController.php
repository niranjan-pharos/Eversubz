<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Review;
use App\Models\AdPost;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Reviews';
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Reviews',
                'url' => null
            ],
        ];
        $reviews = Review::all();
        return view('admin.review.index', compact('reviews', 'pageTitle', 'breadcrumbs'));
    }

    

    public function changeReviewStatus(Request $request)
    {
        try {
            $review = Review::findOrFail($request->id);
            $review->status = $request->status;
            $review->save();
            return response()->json(['message' => 'Review status changed successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Error changing review status']);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $review = Review::findOrFail($request->id);
            $review->delete();
            return response()->json(['message' => 'Review deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Error deleting review']);
        }
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
   
}
