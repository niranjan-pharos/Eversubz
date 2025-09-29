<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBusinessInfos;
use App\Models\Fundraising;
use App\Models\FundraisingImage;
use App\Models\FundraisingCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\NGO;
use App\Models\User;
use App\Models\NgoCategory;
use DateTime; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class FundraisingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'You need to login first.');
        }
     
        // Retrieve all fundraising entries with related images and categories
        $fundraisings = Fundraising::with(['fundraisingImages', 'category'])->where('user_id', Auth::id())->get();
    
        // Fetch all active categories
        $categories = FundraisingCategory::where('status', 1)->get();
    
        $user = Auth::user();
        $userId = Auth::id();
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug'); 
    
        return view('frontend.fundraising.index', compact('user', 'is_approved', 'businessName', 'fundraisings', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
 

    public function add()
    {
        $user = Auth::user();

        $userId = Auth::id();
         
       
        $ngoInfo = NGO::where('user_id', $userId)->first();
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 

        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');

        return view('frontend.fundraising.create', compact('is_approved','businessName', 'ngoInfo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'for' => 'required|string|max:255',
        'amount' => 'nullable|integer',
        'category_id' => 'required|exists:fundraising_categories,id',
        'location' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'fundraising_description' => 'nullable|string',
        'facebook_link' => 'nullable|url|max:255',
        'linkedin_link' => 'nullable|url|max:255',
        'x_link' => 'nullable|url|max:255',
        'copy_fundraising_url' => 'nullable|url|max:255',
        'video_link' => 'nullable|url|max:255',
        'from_date_time' => 'nullable|date',
        'to_date_time' => 'nullable|date|after:from_date_time',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        'ngo_id' => 'required|exists:ngos,id', // Validate ngo_id
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $mainImagePath = $request->file('main_image') ? $request->file('main_image')->store('fundraising_images', 'public') : null;

    $title = $request->input('title', 'No Title');
    $slug = Str::slug($title . '-' . now()->timestamp);

    $fundraising = Fundraising::create([
        'title' => $request->title,
        'for' => $request->for,
        'amount' => $request->amount,
        'category_id' => $request->category_id,
        'location' => $request->location,
        'city' => $request->city,
        'state' => $request->state,
        'country' => $request->country,
        'fundraising_description' => $request->fundraising_description,
        'facebook_link' => $request->facebook_link,
        'linkedin_link' => $request->linkedin_link,
        'x_link' => $request->x_link,
        'copy_fundraising_url' => $request->copy_fundraising_url,
        'video_link' => $request->video_link,
        'from_date_time' => $request->from_date_time,
        'to_date_time' => $request->to_date_time,
        'main_image' => $mainImagePath,
        'slug' => $slug,
        'status' => 'inactive',
        'featured' => false, 
        'user_id' => Auth::id(),
        'ngo_id' => $request->ngo_id, // Save the ngo_id here
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('fundraisingImages', 'public');
            FundraisingImage::create([
                'fundraising_id' => $fundraising->id,
                'image_path' => $imagePath
            ]);
        }
    }

    return response()->json(['success' => 'Fundraising event created successfully!']);
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
    public function edit($slug)
    {
        $fundraising = Fundraising::where('slug', $slug)->with('fundraisingImages')->firstOrFail();
        $categories = FundraisingCategory::where('status', 1)->get();
        $ngoInfo = NGO::where('id', $fundraising->ngo_id)->first();

        return view('frontend.fundraising.edit', compact('fundraising', 'categories', 'ngoInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
{
    $validator = Validator::make($request->all(), [
        'title' => 'nullable|string|max:255',
        'for' => 'nullable|string|max:255',
        'amount' => 'nullable|integer',
        'category_id' => 'nullable|exists:fundraising_categories,id',
        'location' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'fundraising_description' => 'nullable|string',
        'facebook_link' => 'nullable|url|max:255',
        'linkedin_link' => 'nullable|url|max:255',
        'x_link' => 'nullable|url|max:255',
        'copy_fundraising_url' => 'nullable|url|max:255',
        'video_link' => 'nullable|url|max:255',
        'from_date_time' => 'nullable|date',
        'to_date_time' => 'nullable|date|after:from_date_time',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        'images_to_remove' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $fundraising = Fundraising::where('slug', $slug)->firstOrFail();

    $mainImagePath = $request->file('main_image') ? $request->file('main_image')->store('fundraising_images', 'public') : $fundraising->main_image;

    $fundraising->update([
        'title' => $request->input('title', $fundraising->title),
        'for' => $request->input('for', $fundraising->for),
        'amount' => $request->input('amount', $fundraising->amount),
        'category_id' => $request->input('category_id', $fundraising->category_id),
        'location' => $request->input('location', $fundraising->location),
        'city' => $request->input('city', $fundraising->city),
        'state' => $request->input('state', $fundraising->state),
        'country' => $request->input('country', $fundraising->country),
        'fundraising_description' => $request->input('fundraising_description', $fundraising->fundraising_description),
        'facebook_link' => $request->input('facebook_link', $fundraising->facebook_link),
        'linkedin_link' => $request->input('linkedin_link', $fundraising->linkedin_link),
        'x_link' => $request->input('x_link', $fundraising->x_link),
        'copy_fundraising_url' => $request->input('copy_fundraising_url', $fundraising->copy_fundraising_url),
        'video_link' => $request->input('video_link', $fundraising->video_link),
        'from_date_time' => $request->input('from_date_time', $fundraising->from_date_time),
        'to_date_time' => $request->input('to_date_time', $fundraising->to_date_time),
        'main_image' => $mainImagePath,
        'ngo_id' => $request->input('ngo_id', $fundraising->ngo_id),
    ]);

    // Handle image removals
    if ($request->has('images_to_remove')) {
        $imageIds = explode(',', $request->input('images_to_remove'));
        FundraisingImage::whereIn('id', $imageIds)->get()->each(function ($image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        });
    }

    // Handle new images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('fundraisingImages', 'public');
            FundraisingImage::create([
                'fundraising_id' => $fundraising->id,
                'image_path' => $imagePath
            ]);
        }
    }

    return response()->json(['success' => 'Fundraising event updated successfully!']);
}

public function destroy($slug)
{
    $fundraising = Fundraising::where('slug', $slug)->first();

    if ($fundraising) {
        // Perform the deletion
        $fundraising->delete();

        return response()->json(['success' => 'fundraising campaign deleted successfully.']);
    }

    return response()->json(['error' => 'campaign not found.'], 404);
}


    /**
     * Remove the specified resource from storage.
     */
  
}