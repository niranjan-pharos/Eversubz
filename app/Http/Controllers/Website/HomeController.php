<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\AdPost;
use App\Models\Event;
use App\Models\User;
use App\Models\Ngo;
use App\Models\NgoCategory;
use App\Models\UserBusinessInfos;
use App\Models\BusinessProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, Redirect, Storage, Session, Log, DB};
use Illuminate\Support\Facades\Crypt;
use App\Helper\Helpers;
use Validator;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{

    public function index(Request $request) 
    {

        $userId = Auth::id();
        $city = $request->input('city', null); 
        $selectedUser = $request->input('user_id', null);

        $postsQuery = AdPost::with(['category:id,slug', 'subcategory:id,slug,name', 'primaryImage', 'wishlists' => function($query) use ($userId) {
            $query->where('user_id', $userId);
        }])
        ->where(['status' => 1]);
        
        if ($city) {
            $postsQuery->where('city', $city);
        }

        if ($selectedUser) { 
            $postsQuery->where('user_id', Crypt::decryptString($selectedUser));
        }

        $posts = AdPost::where('status', 1)
        ->with('tags', 'primaryImage')
        ->take(6)
        ->orderBy('created_at', 'desc')
        ->get();
        $posts->each(function ($post) use ($userId) {
            $post->isInWishlist = $post->wishlists->where('user_id', $userId)->isNotEmpty();
        });

        $businessesQuery = UserBusinessInfos::select('id', 'business_name', 'slug', 'logo_path', 'business_city', 'business_state', 'business_category')
            ->with(['businessCategory:id,name,slug'])
            ->where('status', 1)
            ->where('feature', 1);

        if ($city) {
            $businessesQuery->where('business_city', $city);
        }

        if ($selectedUser) {
            $businessesQuery->where('user_id', Crypt::decryptString($selectedUser));
        }

        $businesses = $businessesQuery->orderBy('created_at', 'desc')->take(6)->get();

        $topProductsQuery = BusinessProduct::where('business_products.feature', 1)
        ->with(['wishlists' => function($query) use ($userId) {
            $query->where('user_id', $userId);
        }])
        ->where('business_products.status', 1)

        ->where('user_business_infos.status', 1)
        ->join('user_business_infos', 'business_products.business_id', '=', 'user_business_infos.id');

        if ($city) {
            $topProductsQuery->where('user_business_infos.business_city', $city);
        }

        if ($selectedUser) {
            $topProductsQuery->where('user_business_infos.user_id', Crypt::decryptString($selectedUser));
        }

        $topProducts = $topProductsQuery->orderBy('business_products.orderby')->take(8)->get([
            'business_products.*',
            'user_business_infos.business_city',
            'user_business_infos.business_state', 
            'user_business_infos.user_id',
        ]);

        $eventsQuery = Event::select('id', 'title', 'host_name', 'slug', 'main_image', 'price', 'city', 'state', 'from_date_time')
            ->where('status', 1)
            ->where('from_date_time', '>', Carbon::now());

        if ($city) {
            $eventsQuery->where('city', $city);
        }

        if ($selectedUser) {
            $eventsQuery->where('user_id', Crypt::decryptString($selectedUser));
        } 

        $events = $eventsQuery->orderBy('from_date_time', 'asc')->take(8)->get();
        
        $topCities = AdPost::select('city', DB::raw('count(*) as total'))
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->where('status', '1')
            ->groupBy('city')
            ->orderBy('total', 'desc')
            ->take(8)
            ->get();
        

        $featured = AdPost::where(['status'=> 1, 'featured' => 1])
            ->with('tags', 'primaryImage', 'category', 'subcategory')
            ->withAvg('reviews as average_rating', 'rating')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();


        $users = User::select('users.*', DB::raw('COUNT(ad_posts.id) as ad_posts_count'))
            ->leftJoin('ad_posts', 'ad_posts.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->orderBy('ad_posts_count', 'desc')
            ->with('userDetails')
            ->take(10)
            ->get();

            $ngos = Ngo::with(['category', 'images', 'languages', 'members'])
            ->where('status',1)
            ->where('feature',1)
            ->orderBy('created_at', 'desc')
            ->get();
       
        return view('website.index', compact('posts', 'businesses', 'topProducts', 'events', 'topCities', 'featured', 'users', 'ngos'));
    }

    public function userProfile($slug) 
    {
        $nameOrSlug = str_replace('-', ' ', $slug);

        $business = UserBusinessInfos::where('slug', $slug)->first();
        
        if ($business) {
            
            $user_id = $business->user_id;

            $user = User::with([
                'adPosts' => function ($query) use ($user_id) {
                    $query->where('ad_posts.user_id', $user_id)->latest()->take(2);
                },
                'events' => function ($query) use ($user_id) {
                    $query->where('events.user_id', $user_id)->latest()->take(2);
                }
            ])->findOrFail($user_id);

            $business->load([
                'products' => function ($query) {
                    $query->latest()->take(2);
                },
                'deals'
            ]);

            $totalAdPosts = $user->adPosts()->where('status', 1)->count();
            $totalProducts = $business->products()->where('status', 1)->count();
            $totalEvents = $user->events()->where('status', 1)->count();

            $profileType = 'business';

            return view('website.users.profile_timeline', compact('user', 'business', 'profileType', 'totalAdPosts', 'totalProducts', 'totalEvents'));
        } else {
            $user = User::where('name', $nameOrSlug)->firstOrFail();

            $user_id = $user->id;

            $user->load([
                'adPosts' => function ($query) use ($user_id) {
                    $query->where('ad_posts.user_id', $user_id)->latest()->take(2);
                },
                'events' => function ($query) use ($user_id) {
                    $query->where('events.user_id', $user_id)->latest()->take(2);
                },
                'userDetails' 
            ]);

            $totalAdPosts = $user->adPosts()->where('status', 1)->count();
            $totalProducts = 0;
            $totalEvents = $user->events()->where('status', 1)->count();

            $profileType = 'user';

            return view('website.users.profile_timeline', compact('user', 'profileType', 'totalAdPosts', 'totalProducts', 'totalEvents'));
        }
    }

    protected function createNGOThumbnails()
{
    $ngps = Ngo::whereNotNull('logo_path')->get();

    foreach ($ngps as $ngo) {
        if ($ngo->logo_path) {
            \Log::info('Processing logo for user ID: ' . $ngo->id);
            $this->resizeAndSaveImage($ngo->logo_path, 'ngo'); // Correct target folder name
        } else {
            \Log::warning('No logo path found for ngo ID: ' . $ngo->id);
        }
    }

    \Log::info('Thumbnail creation completed for all ngo logos.');
}

protected function resizeAndSaveImage($imagePath, $targetFolder)
{
    // Define the target width and the thumb folder
    $targetWidth = 450;
    $thumbFolder = $targetFolder . '/thumb/'; // Adjusted to point to public directory

    // Ensure the thumb folder exists
    if (!Storage::disk('public')->exists($thumbFolder)) {
        Storage::disk('public')->makeDirectory($thumbFolder);
    }

    // Full path to the image in the storage/app/public directory
    $fullImagePath = storage_path('app/public/' . $imagePath);

    // Log the full image path
    \Log::info('Full image path: ' . $fullImagePath);

    // Check if the file exists before trying to open it
    if (!file_exists($fullImagePath)) {
        \Log::error('Image file not found: ' . $fullImagePath);
        return; // Exit the function if the file does not exist
    }

    // Resize and save the image with error handling
    try {
        $thumbnailImage = Image::make($fullImagePath)
            ->resize($targetWidth, null, function ($constraint) {
                $constraint->aspectRatio(); // Maintain aspect ratio
                $constraint->upsize(); // Prevent upsizing
            });

        // Get the filename
        $filename = basename($imagePath);

        // Correct path to save the thumbnail
        $thumbnailPath = $thumbFolder . $filename;

        // Save the resized image to the thumb folder
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());

        \Log::info('Thumbnail created successfully: ' . $thumbnailPath);
    } catch (\Intervention\Image\Exception\NotReadableException $e) {
        \Log::error('Image source not readable for path: ' . $fullImagePath);
    } catch (\Exception $e) {
        \Log::error('Error creating thumbnail: ' . $e->getMessage());
    }
}


    



}