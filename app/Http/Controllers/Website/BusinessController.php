<?php

namespace App\Http\Controllers\Website; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBusinessInfos;
use App\Models\BusinessProduct;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\ProductImage;
use App\Models\BusinessCategory;
use App\Models\BusinessImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BusinessController extends Controller
{
    public function listBusinesses(Request $request)
    {
        
        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));
        $sortBy = $request->query('sortBy');
        $selectedCategories = $request->query('categories', []);
        $selectedCities = $request->query('cities', []);
        $selectedStates = $request->query('states', []);

        // Main business query with consistent filtering
        $query = UserBusinessInfos::with(['businessHours', 'deals', 'businessCategory'])
            ->where('status', 1);

        // Filter by selected categories if any
        if (!empty($selectedCategories)) {
            $query->whereHas('businessCategory', function ($q) use ($selectedCategories) {
                $q->whereIn('slug', $selectedCategories);
            });
        }

        // Filter by selected cities if any
        if (!empty($selectedCities)) {
            $query->whereIn('business_city', $selectedCities);
        }

        // Filter by selected states if any
        if (!empty($selectedStates)) {
            $query->whereIn('business_state', $selectedStates);
        }

        // Handle sorting
        switch ($sortBy) {
            case '1': // A-Z
                $query->orderBy('business_name', 'asc');
                break;
            case '2': // Z-A
                $query->orderBy('business_name', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $businessInfos = $query->paginate($perPage)->withQueryString();

        // Fetch categories and their business counts with consistent filtering
        $categories = BusinessCategory::withCount(['userBusinessInfos' => function ($query) use ($selectedCities, $selectedStates) {
            $query->where('status', 1);
            if (!empty($selectedCities)) {
                $query->whereIn('business_city', $selectedCities);
            }
            if (!empty($selectedStates)) {
                $query->whereIn('business_state', $selectedStates);
            }
        }])->get();

        // Fetch top cities and their business counts with consistent filtering
        $topCities = UserBusinessInfos::select('business_city', DB::raw('count(*) as business_count'))
            ->where('status', '=', 1)
            ->when(!empty($selectedStates), function ($query) use ($selectedStates) {
                return $query->whereIn('business_state', $selectedStates);
            })
            ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                return $query->whereHas('businessCategory', function ($q) use ($selectedCategories) {
                    $q->whereIn('slug', $selectedCategories);
                });
            })
            ->whereNotNull('business_city')
            ->where('business_city', '!=', '')
            ->groupBy('business_city')
            ->orderBy('business_count', 'desc')
            ->limit(9)
            ->get();

        // Fetch states and their cities with consistent filtering
        $statesWithCities = UserBusinessInfos::select('business_state', 'business_city', DB::raw('count(*) as business_count'))
            ->where('status', '=', 1)
            ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                return $query->whereHas('businessCategory', function ($q) use ($selectedCategories) {
                    $q->whereIn('slug', $selectedCategories);
                });
            })
            ->whereNotNull('business_state')
            ->where('business_state', '!=', '')
            ->whereNotNull('business_city')
            ->where('business_city', '!=', '')
            ->groupBy('business_state', 'business_city')
            ->get()
            ->groupBy('business_state');

        return view('website.business.list', [
            'businessInfos' => $businessInfos,
            'topCities' => $topCities,
            'categories' => $categories,
            'statesWithCities' => $statesWithCities
        ]);
    }




    private function calculateRatingCounts()
    {
        $query = Review::where('status', 1)
                    ->where('reviewable_type', BusinessProduct::class)
                    ->groupBy('rating')
                    ->selectRaw('rating, COUNT(*) as count');
        return $query->pluck('count', 'rating');
    }


    public function filterProducts(Request $request)
    {
        $userId = Auth::id();
        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));
        $sortBy = $request->query('sortBy');
        $selectedSubCategories = $request->query('subcategories', []);
        $selectedCities = $request->query('cities', []);
        $selectedRatings = $request->query('ratings', []);
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');

        $query = \App\Models\BusinessProduct::with([
            'businessInfo',
            'wishlists' => function($query) use ($userId) {
                $query->where('user_id', $userId);
            }
        ])
        ->where('status', 1)
        ->whereHas('businessInfo', function ($q) {
            $q->where('status', 1)
              ->whereHas('user', function ($qq) {
                  $qq->where('is_admin_approved', 1);
              });
        });
        if (!empty($selectedSubCategories)) {
            $query->whereHas('subcategory', function ($q) use ($selectedSubCategories) {
                $q->whereIn('slug', $selectedSubCategories)
                  ->where('status', 1);
            });
        }
        

        if (!empty($selectedCities)) {
            $query->whereHas('businessInfo', function ($q) use ($selectedCities) {
                $q->where('status', 1)
                  ->whereIn('business_city', $selectedCities);
            });
        }
        

        // Filter by selected ratings if any
        if (is_array($selectedRatings) && !empty($selectedRatings)) {
            $query->whereHas('reviews', function ($q) use ($selectedRatings) {
                $q->whereIn('rating', $selectedRatings)
                    ->where('status', 1);
            });
        }

        // Filter by price range if specified
        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Handle sorting
        switch ($sortBy) {
            case '1': // A-Z
                $query->orderBy('title', 'asc');
                break;
            case '2': // Z-A
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Get paginated products
        $products = $query->paginate($perPage)->withQueryString();

        $products->each(function ($product) use ($userId) {
            $product->isInWishlist = $product->wishlists->where('user_id', $userId)->isNotEmpty();
        });

        // Fetch categories and their product counts
        $categories = Category::withCount(['businessProducts' => function ($query) {
            $query->where('status', 1)
                  ->whereHas('businessInfo', function ($q) {
                      $q->where('status', 1)
                        ->whereHas('user', function ($qq) {
                            $qq->where('is_admin_approved', 1);
                        });
                  });
        }])->get();

        // Fetch categories with subcategories and their product counts
        $subcategories = Subcategory::withCount(['businessProducts' => function ($query) {
            $query->where('status', 1)
                  ->whereHas('businessInfo', function ($q) {
                      $q->where('status', 1)
                        ->whereHas('user', function ($qq) {
                            $qq->where('is_admin_approved', 1);
                        });
                  });
        }])->get();
        



        // Fetch top cities and their product counts with consistent filtering
        $topCities = UserBusinessInfos::select('business_city', DB::raw('count(*) as business_count'))
                    ->join('business_products', 'user_business_infos.id', '=', 'business_products.business_id')
                    ->join('users', 'user_business_infos.user_id', '=', 'users.id') 
                    ->where('business_products.status', 1)
                    ->where('users.is_admin_approved', 1)
                    ->whereNotNull('business_city')
                    ->where('business_city', '!=', '')
                    ->groupBy('business_city')
                    ->orderBy('business_count', 'desc')
                    ->limit(9)
                    ->get();

        // Fetch states and their cities with consistent filtering
        $statesWithCities = UserBusinessInfos::select('business_state', 'business_city', DB::raw('count(*) as business_count'))
                            ->join('business_products', 'user_business_infos.id', '=', 'business_products.business_id')
                            ->join('users', 'user_business_infos.user_id', '=', 'users.id')
                            ->where('business_products.status', 1)
                            ->where('users.is_admin_approved', 1)
                            ->whereNotNull('business_state')
                            ->where('business_state', '!=', '')
                            ->whereNotNull('business_city')
                            ->where('business_city', '!=', '')
                            ->groupBy('business_state', 'business_city')
                            ->get()
                            ->groupBy('business_state');

        return view('website.business.product.index', [
            'products' => $products,
            'topCities' => $topCities,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'statesWithCities' => $statesWithCities,
            'selectedRatings' => $selectedRatings,
            'ratingsCount' => $this->calculateRatingCounts()
        ]);
    }





    public function viewBusiness(UserBusinessInfos $businessInfo)
    {
        $businessInfo = $businessInfo->load([
            'businessHours', 
            'deals', 
            'user.userDetails', 
            'businessCategory',
            'languages'
        ])->loadCount(['products' => function ($query) {
            $query->where('status', 1);
        }]);

        $user = $businessInfo->user;
        $businessCategory = $businessInfo->businessCategory;

        // Calculate the average rating of the business's products
        $averageRating = \DB::table('reviews')
            ->join('business_products', 'business_products.id', '=', 'reviews.reviewable_id')
            ->where('business_products.business_id', $businessInfo->id)
            ->where('reviews.reviewable_type', BusinessProduct::class)
            ->avg('reviews.rating');
            // dd($businessInfo);
        if ($businessInfo->status == 1) {
            // dd($businessInfo);
            return view('website.business.details', [
                'businessInfo' => $businessInfo,
                'businessCategory' => $businessCategory,
                'productCount' => $businessInfo->products_count, // This will give the count of products where status = 1
                'averageRating' => $averageRating,
                'languages' => $businessInfo->languages // Pass the languages to the view
            ]);
        } else {
            return redirect()->route('business.list')->with('error', 'The requested business information is not available.');
        }
    }

    public function claimBusiness(Request $request)
{

    $validator = Validator::make($request->all(), [
        'business_id' => 'required|exists:user_business_infos,id',
        'claimant_name' => 'required|string|max:255',
        'claimant_email' => 'required|email|max:255',
        'claimant_phone' => 'nullable|string|max:20',
        'claim_reason' => 'required|string|max:1000',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 422);
    }

    try {
        BusinessClaim::create([
            'business_id' => $request->business_id,
            'user_id' => Auth::id(),
            'claimant_name' => $request->claimant_name,
            'claimant_email' => $request->claimant_email,
            'claimant_phone' => $request->claimant_phone,
            'claim_reason' => $request->claim_reason,
            'status' => 'pending',
        ]);

        
        // \Notification::route('mail', 'admin@example.com')->notify(new BusinessClaimSubmitted($claim));

        return response()->json([
            'success' => true,
            'message' => 'Your claim has been submitted successfully. We will review it soon.',
        ]);
    } catch (\Exception $e) {
        Log::error('Error submitting business claim: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while submitting your claim. Please try again.',
        ], 500);
    }
}
    public function showBySlug($slug)
    {
        $businessInfo = UserBusinessInfos::where('slug', $slug)->firstOrFail();

        $businessInfo->load([
            'businessHours', 
            'deals', 
            'user.userDetails', 
            'businessCategory',
            'languages',
            'images',
        ])->loadCount(['products' => function ($query) {
            $query->where('status', 1);
        }]);

        $user = $businessInfo->user;
        $businessCategory = $businessInfo->businessCategory;
        $averageRating = \DB::table('reviews')
            ->join('business_products', 'business_products.id', '=', 'reviews.reviewable_id')
            ->where('business_products.business_id', $businessInfo->id)
            ->where('reviews.reviewable_type', BusinessProduct::class)
            ->avg('reviews.rating');

        if ($businessInfo->status == 1) {
            return view('website.business.details', [
                'businessInfo' => $businessInfo,
                'businessCategory' => $businessCategory,
                'productCount' => $businessInfo->products_count, 
                'averageRating' => $averageRating,
                'languages' => $businessInfo->languages
            ]);
        } else {
            return redirect()->route('business.list')->with('error', 'The requested business information is not available.');
        }
    }




    // product by busines
    public function listProductByBusiness(Request $request, \App\Models\UserBusinessInfos $businessInfo)
    {
        $request->validate([
            'min_price' => 'numeric|nullable',
            'max_price' => 'numeric|nullable',
            'subcategories' => 'array|nullable',
            'subcategories.*' => 'exists:subcategories,slug',
            'sortBy' => 'in:1,2|nullable',
            'perPage' => 'integer|nullable',
            'cities' => 'array|nullable',
            'cities.*' => 'string|nullable',
            'states' => 'array|nullable',
            'states.*' => 'string|nullable'
        ]);

        $query = \App\Models\BusinessProduct::with([
            'category',
            'subcategory',
            'businessInfo',
            'reviews' => function ($query) {
                $query->select('reviewable_id', 'reviewable_type')
                      ->selectRaw('AVG(rating) as average_rating')
                      ->where('status', '=', 1)
                      ->where('reviewable_type', \App\Models\BusinessProduct::class)
                      ->groupBy('reviewable_id', 'reviewable_type');
            }
        ])
        ->where('business_id', $businessInfo->id)
        ->where('status', 1);
        

        if ($request->filled('subcategories')) {
            $subcatIds = \App\Models\Subcategory::whereIn('slug', $request->input('subcategories'))->pluck('id');
            $query->whereIn('subcategory_id', $subcatIds);
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [
                $request->input('min_price'),
                $request->input('max_price')
            ]);
        }

        $topCities = UserBusinessInfos::select('business_city', DB::raw('count(*) as business_count'))
            ->where('status', '=', 1)
            ->whereNotNull('business_city')
            ->where('business_city', '!=', '')
            ->groupBy('business_city')
            ->orderBy('business_count', 'desc')
            ->limit(9)
            ->get();

        if ($request->filled('states')) {
            $query->whereHas('businessInfo', function ($q) use ($request) {
                $q->whereIn('business_state', $request->input('states'));
            });
        }

        if ($request->filled('cities')) {
            $query->whereHas('businessInfo', function ($q) use ($request) {
                $q->whereIn('business_city', $request->input('cities'));
            });
        }

        $statesWithCities = UserBusinessInfos::select('business_state', 'business_city', DB::raw('count(*) as business_count'))
            ->where('status', '=', 1)
            ->whereNotNull('business_state')
            ->where('business_state', '!=', '')
            ->whereNotNull('business_city')
            ->where('business_city', '!=', '')
            ->groupBy('business_state', 'business_city')
            ->get()
            ->groupBy('business_state');

        switch ($request->input('sortBy')) {
            case '1':
                $query->orderBy('title');
                break;
            case '2':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $selectedRatings = $request->input('ratings', []);

        $ratingsCount = $this->calculateRatingCounts();

        $perPage = $request->input('perPage', config('constants.DEFAULT_PAGINATION'));

        $products = $query->paginate($perPage);

        $categoryCounts = Category::with(['subcategories' => function ($query) {
            $query->withCount(['businessProducts' => function ($productQuery) {
                $productQuery->where('status', 1);
            }]);
        }])->get();

        $subcategories = \App\Models\Subcategory::withCount(['businessProducts' => function ($q) {
            $q->where('status', 1);
        }])->get();

        return view('website.business.product.index', compact(
            'products', 'topCities', 'statesWithCities', 'categoryCounts', 'subcategories',
            'businessInfo', 'selectedRatings', 'ratingsCount'
        ));
    }  

    public function productDetailsByURL($itemUrl)
    {
        \Log::info('Incoming product details request:', ['url' => $itemUrl]);

        $validator = Validator::make(['item_url' => $itemUrl], [
            'item_url' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            \Log::warning('Validation failed for product details.', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = BusinessProduct::where('item_url', $itemUrl)
            ->whereHas('UserBusinessInfos.user', function($query) {
                $query->where('is_admin_approved', 1);
            })
            ->with(['UserBusinessInfos', 'category', 'subcategory', 'images'])
            ->first();

        if (!$product) {
            \Log::warning("No product found or business/user not approved for URL: " . $itemUrl);
            return redirect()->route('home')->with('error', 'The product is no longer available. The business profile may be inactive.');
        }

        $product->increment('clicks_count');
        $product->increment('prview_count');

        $totalProductCount = 0;
        if ($product->UserBusinessInfos) {
            $totalProductCount = $product->UserBusinessInfos->products->count();
        }

        return view('website.business.product.details', compact('product', 'totalProductCount'));
    }



    public function checkIfPurchased(Request $request)
    {
        $user = Auth::user();
        $productId = $request->postId;

        // Check if the user has purchased the product
        $hasPurchased = $user->purchases()->where('product_id', $productId)->exists();

        return response()->json(['purchased' => $hasPurchased]);
    }

    



}
