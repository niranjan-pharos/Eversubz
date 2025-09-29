<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Validator;
use App\Models\{AdPost, Wishlist, Category, Subcategory, Review,User,Tag,Report,Follower,UserBusinessHour,BusinessProduct,ClaimReport,userDetails,UserBusinessInfos};
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class ProductController extends Controller
{

    public function category_index(Request $request, $categorySlug = null, $subcategorySlug = null)
    {
        $viewPreference = $request->query('view', session('viewPreference', '3col'));
        session(['viewPreference' => $viewPreference]);

        $type = $request->query('type', 'all'); 
        $itemsPerRow = 6; 

        // Validate input parameters
        $validated = $request->validate([
            'search_query' => 'nullable|string|max:255',
            'search_city' => 'nullable|string|max:255',
            'search_state' => 'nullable|string|max:255',
            'search_min_price' => 'nullable|numeric|min:0',
            'search_max_price' => 'nullable|numeric|min:0|gte:search_min_price',
            'popularity' => 'nullable|array',
            'subcategories' => 'nullable|array',
            'ad_category' => 'nullable',
            'ratings' => 'nullable|array'
        ]);

        $category = Category::where('slug', $categorySlug)->where('status', 1)->first();
        $subcategory = $subcategorySlug ? Subcategory::where('slug', $subcategorySlug)->where('status', 1)->first() : null;

        $posts = collect();
        $products = collect();

        if ($type === 'all' || $type === 'adposts') {
            $postsQuery = AdPost::where('status', 1)
                        // ->where('expiry_date', '>=', now())
                                ->when($category, function ($query) use ($category) {
                                    $query->where('category_id', $category->id);
                                })
                                ->when($subcategory, function ($query) use ($subcategory) {
                                    $query->where('subcategory_id', $subcategory->id);
                                });

            $this->applyFilters($postsQuery, $validated);
            $posts = $postsQuery->paginate($itemsPerRow);
        }

        if ($type === 'all' || $type === 'products') {
            $productsQuery = BusinessProduct::where('status', 1)
                                ->when($category, function ($query) use ($category) {
                                    $query->where('category_id', $category->id);
                                })
                                ->when($subcategory, function ($query) use ($subcategory) {
                                    $query->where('subcategory_id', $subcategory->id);
                                });

            $this->applyFilters($productsQuery, $validated, 'business_product');
            $products = $productsQuery->paginate($itemsPerRow);
        }

        $ad_categories = AdPost::select('ad_category', DB::raw('COUNT(*) as total'))
                                ->where('status', 1)
                                ->groupBy('ad_category')
                                ->get();

        $activeFilters = $this->prepareActiveFilters($validated);
        $ratingsCount = $this->calculateRatingCounts();
        $adCategory = $validated['ad_category'] ?? null;
        $selectedRatings = $validated['ratings'] ?? [];

        $topSubcategories = $this->fetchTopSubcategoriesQuery();
        $categories = Category::with(['subcategories' => function ($query) {
            $query->withCount(['adPosts as active_posts_count' => function ($query) {
                $query->where('status', '=', 1);
            }]);
        }])->get();

        $topCities = AdPost::select('city', DB::raw('count(*) as count'))
            ->where('status', '=', 1)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->groupBy('city')
            ->orderBy('count', 'desc')
            ->limit(9)
            ->get();

        // Fetch states and their cities
        $statesWithCities = AdPost::select('state', 'city', DB::raw('count(*) as count'))
            ->where('status', '=', 1)
            ->whereNotNull('state')
            ->where('state', '!=', '')
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->groupBy('state', 'city')
            ->orderBy('state', 'asc')
            ->limit(9)
            ->get()
            ->groupBy('state');

  
        $viewName = $this->decideViewName($viewPreference, $request->query('section', ''));
        
        return view($viewName, compact('posts', 'topCities', 'statesWithCities','products', 'topSubcategories', 'categories', 'activeFilters', 'ad_categories', 'adCategory', 'selectedRatings', 'ratingsCount', 'type','categorySlug','subcategorySlug'));
    }



    public function index(Request $request)
    {
        $viewPreference = $request->query('view', session('viewPreference', '3col'));
        session(['viewPreference' => $viewPreference]);

        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));

        $validated = $request->validate([
            'search_query' => 'nullable|string|max:255',
            'search_city' => 'nullable|string|max:255',
            'search_state' => 'nullable|string|max:255',
            'search_min_price' => 'nullable|numeric|min:0',
            'search_max_price' => 'nullable|numeric|min:0|gte:search_min_price',
            'popularity' => 'nullable|array',
            'subcategories' => 'nullable|array',
            'ad_category' => 'nullable',
            'ratings' => 'nullable|array',
            'cities' => 'nullable|array'
        ]);

        $postsQuery = AdPost::where('status', 1)
            ->with(['reviews' => function ($query) {
                $query->select('reviewable_id', 'reviewable_type')
                    ->selectRaw('AVG(rating) as average_rating')
                    ->where('status', '=', 1) 
                    
                    ->where('reviewable_type', 'LIKE', '%AdPost%')
                    ->groupBy('reviewable_id', 'reviewable_type');
            }])
        
             
            ->orderBy('created_at', 'desc');

        $this->applyFilters($postsQuery, $validated);
 
        $posts = $postsQuery->paginate($perPage)->withQueryString();

        $topSubcategories = $this->fetchTopSubcategoriesQuery();

        $categories = Category::with(['subcategories' => function ($query) {
            $query->withCount(['adPosts as active_posts_count' => function ($query) {
                $query->where('status', '=', 1);
            }]);
        }])->get();

        $topCities = AdPost::select('city', DB::raw('count(*) as count'))
            ->where('status', '=', 1)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->groupBy('city')
            ->orderBy('count', 'desc')
            ->limit(9)
            ->get();

        $statesWithCities = AdPost::select('state', 'city', DB::raw('count(*) as count'))
            ->where('status', '=', 1)
            ->whereNotNull('state')
            ->where('state', '!=', '')
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->groupBy('state', 'city')
            ->orderBy('state', 'asc')
            ->limit(9)
            ->get()
            ->groupBy('state');

        $activeFilters = $this->prepareActiveFilters($validated);

        $ratingsCount = $this->calculateRatingCounts();

        $adCategory = $request->input('ad_category', []);

        $selectedRatings = $request->input('ratings', []);

        $ad_categories = AdPost::select('ad_category', DB::raw('COUNT(*) as total'))
            ->where('status', 1)
            ->groupBy('ad_category')
            ->get();

        $viewName = $this->decideAdsViewName($viewPreference, $request->query('section', ''));

        return view($viewName, compact('posts', 'topCities', 'statesWithCities', 'topSubcategories', 'categories', 'activeFilters', 'ad_categories', 'adCategory', 'selectedRatings', 'ratingsCount'));
    }

    private function applyFilters(&$query, $filters)
    {
        if (isset($filters['search_query']) && !empty($filters['search_query'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'LIKE', '%' . $filters['search_query'] . '%')
                    ->orWhere('description', 'LIKE', '%' . $filters['search_query'] . '%');
            });
        }

        if (isset($filters['search_city']) && !empty($filters['search_city'])) {
            $query->where('city', 'LIKE', '%' . $filters['search_city'] . '%');
        }

        if (isset($filters['search_state']) && !empty($filters['search_state'])) {
            $query->where('state', 'LIKE', '%' . $filters['search_state'] . '%');
        }

        if (isset($filters['cities']) && !empty($filters['cities'])) {
            $query->whereIn('city', $filters['cities']);
        }

        if (isset($filters['search_min_price']) && isset($filters['search_max_price'])) {
            $query->whereBetween('price', [$filters['search_min_price'], $filters['search_max_price']]);
        }

        if (isset($filters['ad_category'])) {
            $query->whereIn('ad_category', (array) $filters['ad_category']);
        }

        if (isset($filters['popularity'])) {
            $query->whereHas('subcategory', function ($subQuery) use ($filters) {
                $subQuery->whereIn('slug', $filters['popularity']);
            });
        }

        if (isset($filters['subcategories'])) {
            $query->whereHas('subcategory', function ($subQuery) use ($filters) {
                $subQuery->whereIn('slug', $filters['subcategories']);
            });
        }

        if (isset($filters['ratings'])) {
            $query->whereHas('reviews', function ($reviewQuery) use ($filters) {
                $reviewQuery->whereIn('rating', $filters['ratings'])->where('status', 1);
            });
        }
    }



    private function calculateRatingCounts()
    {
        $query = Review::join('ad_posts', function ($join) {
                $join->on('reviews.reviewable_id', '=', 'ad_posts.id')
                    ->where('reviews.reviewable_type', '=', AdPost::class)
                    ->where('ad_posts.status', '=', 1); 
            })
            ->where('reviews.status', 1) 
            ->groupBy('reviews.rating')
            ->selectRaw('reviews.rating, COUNT(*) as count');

        return $query->pluck('count', 'rating');
    }


    private function prepareActiveFilters($filters)
    {
        $activeFilters = [];
        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $activeFilters[$key] = is_array($value) ? implode(', ', $value) : $value;
            }
        }
        return $activeFilters;
    }

    private function fetchTopSubcategoriesQuery()
    {
        return Subcategory::withCount(['adPosts' => function ($query) {
            $query->where('status', '=', 1);  // Only consider active posts
        }])
        ->orderBy('ad_posts_count', 'desc')  // Sort by the count of active posts
        ->take(10)  // Limit to top 10 subcategories
        ->get();
    }

    private function decideAdsViewName($viewPreference, $section)
    {
        $basePath = 'website.ads-list.';
        
        return $basePath . ($viewPreference === '1col' ? 'singlecolumn' : 'index') . (!empty($section) ? '_section' : '');
    }

    private function decideViewName($viewPreference, $section)
    {
        $basePath = 'website.ads-list.';
        return $basePath . ($viewPreference === '1col' ? 'singlecolumn' : 'category_index') . (!empty($section) ? '_section' : '');
    }

    
    

    public function categoryList() {
        $categories = Category::withCount([
            'adPosts' => function($query) {
                $query->where('status', 1);
            },
            'BusinessProducts' => function($query) {
                $query->where('status', 1); 
            }
        ])->get()->each(function($category) {
            $category->total_count = $category->ad_posts_count + $category->business_products_count;
        })->sortByDesc('total_count')->values(); // Sort and reindex
    
        $subcategories = Subcategory::with('category')
                            ->withCount([
                                'adPosts' => function($query) {
                                    $query->where('status', 1);
                                },
                                'businessProducts' => function($query) {
                                    $query->where('status', 1);
                                }
                            ])->get()->each(function ($subcategory) {
                                $subcategory->total_count = $subcategory->ad_posts_count + $subcategory->business_products_count;
                            })->sortByDesc('total_count')->values(); // Sort and reindex
    
        return view('category_list', compact('categories', 'subcategories'));
    }
    
    

    public function showByURL($item_url)
    {
        
        $userId = Auth::id();
        $query = AdPost::with([
                'tags:id,tag_name,ad_post_id',
                'images:id,url,ad_post_id',
                'category',
                'subcategory',
                'user.businessInfos',
                'languages',
                'reviews' => function ($query) {
                    $query->where('status', 1)
                        ->where('reviewable_type', AdPost::class)
                        ->orderBy('created_at', 'desc')
                        ->take(5);
                }
            ])
            ->where('item_url', $item_url)
            ->whereHas('user', function ($q) {
                // Filter out posts where the user is soft-deleted
                $q->whereNull('deleted_at');
            });

        if (Auth::check()) {
            $query->where(function ($q) use ($userId) {
                $q->where('user_id', $userId)
                ->orWhere(function ($subQuery) use ($userId) {
                    $subQuery->where('user_id', '!=', $userId)
                            ->where('status', '1')
                            ->where('expiry_date', '>=', now()->startOfDay()->toDateTimeString());
                });
            });
        } else {
            $query->where('status', '1');
        }

        $post = $query->first();

        if (!$post) {
            return redirect()->route('home')->with('error', "Post deleted / expired or not approved.");
        }

        // Increment clicks_count for this post
        if ($post->status == 1) {
            $post->increment('clicks_count');
            $post->increment('prview_count');
        }

        $isOwner = $userId == $post->user_id;

        $reports = Report::where('ad_post_id', $post->id)->get();
        $reviewCountForPost = Review::where('reviewable_id', $post->id)
                            ->where('reviewable_type', AdPost::class)
                            ->where('status', 1)
                            ->count();

        $user = $post->user; 
        
        $businessAddress = $user && $user->businessInfos 
                                ? $user->businessInfos->business_address 
                                : ($user ? $user->address : null);

        $hours = $user ? UserBusinessHour::where('user_id', $user->id)->get() : collect();
        $adPostCountForUser = $user ? AdPost::where('user_id', $user->id)->count() : 0;
        $userReviewCount = $user ? $user->reviewsReceived() : 0;

        return view('posts.show', compact('post', 'hours', 'reports', 'reviewCountForPost', 'user', 'adPostCountForUser', 'userReviewCount', 'businessAddress', 'isOwner'));
    }








    public function submitReport(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'item_url' => 'required|string',
            'reason' => 'required',
            'details' => 'nullable|string', 
        ]);

        // Find the AdPost by item_url
        $adPost = AdPost::where('item_url', $validatedData['item_url'])->firstOrFail();
        
        // Create a new report associated with the ad post
        $adPost->reports()->create([
            'reason' => $request->input('reason'),
            'details' => $request->input('details'),
        ]);

        return redirect()->back()->with('success', 'Report submitted successfully!');
    }

    /* no more reuired
    public function viewUserProfile(string $id)
    {
        try {
            $userId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            // Handle the case where decryption fails
            return redirect()->back()->with('error', 'Invalid ID');
        }
    
        $user = User::with('userDetails')->find($userId);
    
        if (!$user) {
            
            return redirect()->back()->with('error', 'User not found');
        }
    
        return view('website.userProfile', compact('user'));
    }
    */
    
    

    // sudha code claim form 
    public function submitClaim(Request $request)
    {dd($request->all());
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneno' => 'required|string|max:20',
            'reason' => 'required|string',
            'item_url' => 'required|string'
        ]);

        // Create a new ClaimReport instance
        $claim = new ClaimReport();
        $claim->name = $request->input('name');
        $claim->address = $request->input('address');
        $claim->email = $request->input('email');
        $claim->phoneno = $request->input('phoneno');
        $claim->reason = $request->input('reason');
        $claim->item_url = $request->input('item_url');

        // Save the claim to the database
        $claim->save();

        // Redirect back with a success message
        return back()->with('success', 'Claim submitted successfully.');
    }
    
   
    // end claim form 
   

}
