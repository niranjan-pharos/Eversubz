<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\{RedirectResponse, Request, UploadedFile};
use Illuminate\Support\Facades\{Auth, Redirect, Storage, Session, Log, DB};
use Illuminate\View\View;
use App\Models\{Category, SubCategory, AdPost, PostAuthor, Tag, Language, Review, UserBusinessInfos, BusinessProduct, Event, Report};
use App\Models\Enquiry;

use Carbon\Carbon;
use App\Helper\Helpers;
use Illuminate\Support\Facades\Cache;

use Validator;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
 

class AdPostController extends Controller
{
 
    public function index()
    {
        $perPage = request()->query('per_page', config('constants.DEFAULT_PAGINATION'));
        $filter = request()->query('filter');
        $userId = Auth::id();
        $now = now()->format('Y-m-d H:i:s');

        $query = AdPost::with(['tags', 'primaryImage', 'reports', 'languages']) 
                    ->orderBy('expiry_date');

        $query->where(function ($q) use ($userId, $now) {
            $q->where('user_id', $userId);
        });

        if ($filter !== null && $filter !== 'all') {
            $query->where('ad_category', $filter);
        }

        $posts = $query->paginate($perPage);

        if ($posts->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'You do not have any active posts.');
        }

        $totalAdPosts = AdPost::where('user_id', $userId)->count();

        $businessIds = UserBusinessInfos::where('user_id', $userId)->pluck('id');

        $is_approved = true;
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');

        $totalBusinessProducts = BusinessProduct::whereIn('business_id', $businessIds)->count();
        $totalEvents = Event::where('user_id', $userId)->count();

        return view('frontend.ad-post.index', compact('posts', 'totalAdPosts', 'totalBusinessProducts', 'totalEvents', 'is_approved', 'businessName'));
    }





    public function showReport($id)
    {
        $adPost = AdPost::with('reports')->findOrFail($id);
    
        return view('frontend.ad-post.specific_ads_report', compact('adPost'));
    }
    
    public function deleteReport($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return response()->json(['success' => 'Report deleted successfully.']);
    }

    public function create()
    {
        $userId = Auth::id(); 
        $user = Auth::user();

        $totalAdPosts = AdPost::where('user_id', $userId)->count();

        $businessIds = UserBusinessInfos::where('user_id', $userId)->pluck('id');

        $totalBusinessProducts = BusinessProduct::whereIn('business_id', $businessIds)->count();

        $totalEvents = Event::where('user_id', $userId)->count();

        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;
        
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');  

        return view('frontend.ad-post.ad_post',compact('totalAdPosts','totalBusinessProducts','totalEvents','is_approved','businessName'));
    }

  

    public function store(Request $request)
    {
        try {
            $rules = [
                'title' => 'required|string|min:5|max:255',
                'category_select' => 'required|exists:categories,id',
                'amount' => 'required|numeric',
                'video_url' => 'nullable|url',
                'category' => 'required|string',
                'ad_category' => 'required|string',
                'price_condition' => 'required|string',
                'product_condition' => 'required|string',
                'description' => 'nullable|string',
                'author_name' => 'nullable|string|max:255',
                'author_email' => 'nullable|email|max:255',
                'author_phone' => 'nullable|string|max:20',
                'author_address' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'url' => 'nullable|url',
                'abn' => 'nullable|max:255',
                'terms' => 'required|accepted',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'languages.*' => 'nullable|string|max:255',
                'tags.*' => 'nullable|string|max:255',
            ];
    
            $messages = [
                'category_select.exists' => 'The selected category does not exist.',
                // 'subcategory.exists' => 'The selected subcategory does not exist.',
                'images.*.image' => 'The file must be an image.',
                'images.*.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'images.*.max' => 'The image may not be greater than 5MB.',
            ];
    
            // Perform validation
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            $category = Category::findOrFail($request->input('category_select'));
            $adPost = new AdPost();
            $adPost->category_id = $category->id;
            $categorySlug = $category->slug;
    
            $exp_date = Carbon::now()->addDays(config('constants.POST_EXPIRED'));
            $slug = sanitizeData($request->input('title'));
            $datetime = now()->format('mdHis');
            $url = "{$categorySlug}/{$slug}/{$datetime}";
            $item_url = str_replace(':', '-', $url);
    
            $adPost->title = $request->input('title');
            $adPost->category_id = $request->input('category_select');
            $adPost->subcategory_id = $request->input('subcategory');
            $adPost->price = $request->input('amount');
            $adPost->price_condition = $request->input('price_condition');
            $adPost->ad_category = $request->input('ad_category');
            $adPost->product_condition = $request->input('product_condition');
            $adPost->description = $request->input('description');
            $adPost->location = $request->input('location');
            $adPost->city = $request->input('city');
            $adPost->state = $request->input('state');
            $adPost->country = $request->input('country');
            $adPost->video_url = $request->input('video_url');
            $adPost->author_name = $request->input('author_name');
            $adPost->author_email = $request->input('author_email');
            $adPost->author_phone = $request->input('author_phone');
            $adPost->author_address = $request->input('author_address');
            $adPost->abn = $request->input('abn');
            $adPost->item_url = $item_url;
            $adPost->expiry_date = $exp_date;
            $adPost->ad_id = $datetime;
            $adPost->user_id = Auth::id();
            $adPost->save();
    
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $onlyOneImage = count($images) === 1;
                $primaryImageSet = false;
            
                foreach ($images as $key => $image) {
                    $extension = strtolower($image->getClientOriginalExtension());
                    $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extension;
                    $path = $image->storeAs('adpost', $fileName, 'public');
            
                    $isPrimary = $onlyOneImage ? true : $request->input('is_primary') == ($key + 1);
            
                    if (!$onlyOneImage && !$primaryImageSet && $key == 0 && !$request->has('is_primary')) {
                        $isPrimary = true;
                        $primaryImageSet = true;
                    }
            
                    $thumbnailPath = 'adpost/thumb/' . basename($path);
                    $thumbnailImage = Image::make(storage_path('app/public/' . $path))
                        ->resize(450, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
            
                    if ($isPrimary) {
                        $primaryImageSet = true;
                    }
            
                    $adPost->images()->create([
                        'url' => $path,
                        'is_primary' => $isPrimary,
                    ]);
                }
            }
            
    
            if ($request->has('tags')) {
                $tagNames = $request->input('tags');
                foreach ($tagNames as $tagName) {
                    $tag = new Tag(['tag_name' => $tagName]);
                    $adPost->tags()->save($tag);
                }
            }
    
            if ($request->has('languages')) {
                $languageNames = $request->input('languages');
                foreach ($languageNames as $langName) {
                    $lang = new Language(['name' => $langName]);
                    $adPost->languages()->save($lang);
                }
            }
    
            return response()->json([
                'success' => 'Ad post created successfully!',
                'redirect' => route('ad-post.index') 
            ], 200);    
             
        } catch (ValidationException $e) {
            Log::error('Ad post creation failed: ' . $e->getMessage());
            // Log the validation error messages
            return response()->json(['error' => 'Ad post creation failed. Please try again.'], 500);
        }
    }


    public function showDetails($ad_id)
    {
        try {
            $userId = Auth::id();

            $query = AdPost::where('ad_id', $ad_id)
                ->with('tags', 'primaryImage', 'images','languages');

            if (!Auth::check() || (Auth::check() && $query->where('user_id', '!=', $userId)->exists())) {
                $query->where('status', '1')
                    ->whereDate('expiry_date', '>', now());
            }

            $post = $query->first();

            if (!$post) {
                return redirect()->route('dashboard')->with('error', "Post not found for ID: $ad_id");
            }
            
            $reviews = Review::where('reviewable_id', $post->id)
                     ->where('reviewable_type', AdPost::class) 
                     ->get();
            $reviewCountForPost = $reviews->count();
            $reviewCountForUser = Review::where('user_id', $userId)->count();
            $count = AdPost::where('user_id', $userId)->where('status', 1)->count();

        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
        }
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');  
        return view('frontend.ad-post.details', compact('post', 'reviews', 'reviewCountForPost', 'reviewCountForUser', 'count', 'is_approved','businessName'));
    }


    public function showBySlug($item_url)
    { 
        $post = AdPost::with(['reviews' => function ($query) {
            $query->where('status', 1)
                ->where('reviewable_type', AdPost::class)
                ->orderBy('created_at', 'desc');
        },'languages'])->where('item_url', $item_url)->first();

        // Check if the post is null
        if ($post === null) {
            return redirect()->route('dashboard')->with('error', "Post not found.");
        } 

        $reviews = Review::where('reviewable_id', $post->id)
                     ->where('reviewable_type', AdPost::class) 
                     ->get();
        $reviewCountForPost = $reviews->count();
        $reviewCountForUser = 0;

        $count = AdPost::where('user_id', Auth::id())
                        ->where('status', 1)
                        ->count();

        return view('frontend.ad-post.details', compact('post', 'count','reviewCountForPost','reviewCountForUser','reviews'));
    }


    public function edit($category, $slug, $datetime)
    {
        $userId = Auth::id();
        $user = Auth::user();

        $item_url = "{$category}/{$slug}/{$datetime}";
       
        try {
            $adPost = AdPost::where('user_id', $userId)
                            ->where('item_url', $item_url)
                            ->with('tags', 'primaryImage', 'images', 'category', 'subcategory','languages')
                            ->first();

            if ($adPost === null) {
                return redirect()->route('dashboard')->with('error', "Post not found");
            }
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error occurred while fetching post.');
        }

        
        $languages = Language::all()->filter(function ($language) {
            return !empty($language->name); 
        })->map(function ($language) {
            $language->name = strtolower($language->name); 
            return $language;
        })->unique('name'); 

        $selectedLanguages = $adPost->languages->pluck('id')->toArray();

        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug'); 
        $categories = Category::all();
        $subcategories = SubCategory::where('category_id', $adPost->category_id)->get();
        return view('frontend.ad-post.edit', compact('adPost', 'categories', 'subcategories', 'is_approved','businessName','languages','selectedLanguages'));
    }

    public function update(Request $request, $category, $slug, $datetime)
    {
        $item_url = "{$category}/{$slug}/{$datetime}";

        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'subcategory' => 'required|exists:subcategories,id',
                'price' => 'required|numeric|min:0',
                'ad_category' => 'required|string|max:255',
                'product_condition' => 'required|string|max:255',
                'languages' => 'array|nullable',
                'languages.*' => 'exists:languages,id',
                'tags' => 'array|nullable',
                'images' => 'nullable|array',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ], [
                'images.*.max' => 'Each image must not be greater than 5MB.',
                'images.*.image' => 'Each file must be a valid image.',
                'images.*.mimes' => 'Allowed image types are jpeg, png, jpg, gif, webp.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validatedData = $validator->validated();

            $adPost = AdPost::where('item_url', $item_url)->firstOrFail();
            $request->merge(['subcategory_id' => $request->input('subcategory')]);

            $adPost->update($request->except(['tags', 'languages', 'images', 'is_primary', 'subcategory']));

            if (!empty($request->tags)) {
                $adPost->tags()->delete();
                foreach ($request->tags as $tagId) {
                    $adPost->tags()->create(['tag_name' => $tagId]);
                }
            }

            if ($request->has('languages')) {
                $adPost->languages()->sync($request->languages);
            }

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $onlyOneImage = count($images) === 1;
                $primaryImageSet = false;
            
                foreach ($images as $key => $image) {
                    $extension = strtolower($image->getClientOriginalExtension());
                    $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extension;
                    $path = $image->storeAs('adpost', $fileName, 'public');
            
                    $isPrimary = $onlyOneImage ? true : $request->input('is_primary') == $key;
            
                    if (!$onlyOneImage && !$primaryImageSet && $key == 0 && !$request->has('is_primary')) {
                        $isPrimary = true;
                        $primaryImageSet = true;
                    }
            
                    if ($isPrimary) {
                        $primaryImageSet = true;
                        $thumbnailPath = 'adpost/thumb/' . basename($path);
                        $thumbnailImage = Image::make(storage_path('app/public/' . $path))
                            ->resize(450, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
                    }
            
                    $adPost->images()->create([
                        'url' => $path,
                        'is_primary' => $isPrimary,
                    ]);
                }
            }
            

            return response()->json([
                'status' => 'success',
                'message' => 'AdPost updated successfully.',
                'redirect_url' => route('ad-post.index')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred. Please try again.'
            ], 500);
        }
    }



    private function handleImages(Request $request, AdPost $adPost)
    {
        if ($request->has('deleted_images')) {
            $deletedImageIds = json_decode($request->deleted_images);
            $adPost->images()->whereIn('id', $deletedImageIds)->delete();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('public/ad_images');

                $adPost->images()->create([
                    'url' => $path,
                    'is_primary' => false
                ]);
            }
        }

        if ($request->has('selected_image')) {
            $adPost->images()->update(['is_primary' => false]);
            $primaryImage = $adPost->images()->find($request->selected_image);

            if ($primaryImage) {
                $primaryImage->update(['is_primary' => true]);
            }
        }
    }
 
    

    public function destroy($item_url)
    {
        Log::info('Attempting to delete ad post with item_url: ' . $item_url);
    
        try {
            // Retrieve the ad post with related images and tags
            $adPost = AdPost::with(['images', 'tags'])->where('item_url', $item_url)->firstOrFail();
    
            // Check if the authenticated user is authorized to delete this ad post
            if ($adPost->user_id !== Auth::id()) {
                Log::warning('Unauthorized access attempt to delete ad post: ' . $adPost->id);
                return response()->json(['error' => 'Unauthorized'], 403);
            }
    
            Log::info('Found ad post: ' . $adPost->id);
    
            // Begin a transaction for safe deletion
            DB::beginTransaction();
    
            // Delete related images
            foreach ($adPost->images as $image) {
                if ($image->url) {
                    Storage::disk('public')->delete('adpost/' . $image->url); // Delete the file
                }
                $image->delete(); // Delete the record in the database
            }
    
            // Delete related tags
            foreach ($adPost->tags as $tag) {
                $tag->delete();
            }
    
            // Delete the ad post itself
            $adPost->delete();
    
            DB::commit(); // Commit the transaction
    
            Log::info('Successfully deleted ad post: ' . $adPost->id);
    
            // Clear cache safely
            if (Cache::has('adpost_' . $adPost->id)) {
                Cache::forget('adpost_' . $adPost->id);
            }
    
            return response()->json(['status' => 'success', 'message' => 'AdPost deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction on error
            Log::error('Error deleting ad post: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
    
            // Return a JSON response with error details
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the AdPost.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

     
   
    

    // getcategory
    public function categoryList(){
        $categories = Category::where('status', '1')
                        ->select('id', 'name AS text')
                        ->get();

        return response()->json(['categories' => $categories]);

    }

    // getsubcategory
    public function subcategoryList(Request $request){
        $searchTerm = $request->input('searchTerm');
        $catId = $request->input('cat_id');

        $categories = Subcategory::searchCat($searchTerm, $catId);


        return response()->json($categories);

    } 

    
    public function deleteImage(Request $request)
    {
        try {
            $adId = $request->input('ad_id');
            $imageId = $request->input('image_id');

            $adPost = AdPost::where('ad_id', $adId)->firstOrFail();

            $image = $adPost->images()->findOrFail($imageId);
            Log::info('Image found', ['image' => $image]);

            if ($image->is_primary) {
                return response()->json(['error' => 'The primary image cannot be deleted.'], 422);
            }

            // Delete the image file from storage
            Storage::delete('public/' . $image->url);

            $image->delete();

            return response()->json(['success' => 'Image deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error deleting image', ['message' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);
            return response()->json(['error' => 'An error occurred while deleting the image.'], 500);
        }
    }


    
    public function showPostsEnquiries(Request $request, $post_slug) {
        // Retrieve logged-in user details
        $user = Auth::user();
        $userId = Auth::id();
        // Retrieve the ad post using its full `item_url`
        $adpost = AdPost::where('item_url', $post_slug)->firstOrFail();
    
        // Retrieve related enquiries for this AdPost
        $enquiries = Enquiry::where('enquiryable_id', $adpost->id)
            ->where('enquiryable_type', AdPost::class)
            ->where('module', 'adpost') // Ensure this column exists in DB
            ->latest()
            ->get();
     
    
        // Ensure `$business_name` is defined (modify logic based on your project)
        $business_name = $adpost->author_name ?? 'Unknown'; 
    
        // Check if the user is admin-approved
        $is_approved = $user->is_admin_approved ?? 0;
    
        return view('frontend.ad-post.post_enquiries', compact('adpost', 'enquiries', 'business_name', 'is_approved'));
    }
    

    
}
