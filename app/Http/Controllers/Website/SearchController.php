<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{AdPost, Wishlist, Category, Subcategory, Review,User,Tag,Report,Follower,UserBusinessHour,BusinessProduct,ClaimReport,userDetails,UserBusinessInfos};

class SearchController extends Controller
{
    public function headerSearch(Request $request)
    {
        $searchTerm = $request->input('search_term');
        $searchCity = $request->input('search_city');
        $searchState = $request->input('search_state');
        $searchMinPrice = $request->input('search_min_price');
        $searchMaxPrice = $request->input('search_max_price');

        $adPostQuery = AdPost::with('primaryImage')->where('status', 1);

        if (!empty($searchTerm)) {
            $adPostQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        if (!empty($searchCity)) {
            $adPostQuery->where('city', 'like', '%' . $searchCity . '%');
        }

        if (!empty($searchState)) {
            $adPostQuery->where('state', 'like', '%' . $searchState . '%');
        }

        if (!empty($searchMinPrice)) {
            $adPostQuery->where('price', '>=', $searchMinPrice);
        }

        if (!empty($searchMaxPrice)) {
            $adPostQuery->where('price', '<=', $searchMaxPrice);
        }

        $posts = $adPostQuery->take(9)->get();

        $businessProductQuery = BusinessProduct::where(['business_products.status'=> 1, 'user_business_infos.status' => 1])
            ->select('business_products.*', 'user_business_infos.business_city as city', 'user_business_infos.business_state as state')
            ->join('user_business_infos', 'business_products.business_id', '=', 'user_business_infos.id');

        if (!empty($searchTerm)) {
            $businessProductQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        if (!empty($searchCity) || !empty($searchState)) {
            $businessProductQuery->whereHas('userBusinessInfos', function ($subQuery) use ($searchCity, $searchState) {
                if (!empty($searchCity)) {
                    $subQuery->where('business_city', 'like', '%' . $searchCity . '%');
                }
                if (!empty($searchState)) {
                    $subQuery->where('business_state', 'like', '%' . $searchState . '%');
                }
            });
        }

        if (!empty($searchMinPrice)) {
            $businessProductQuery->where('price', '>=', $searchMinPrice);
        }

        if (!empty($searchMaxPrice)) {
            $businessProductQuery->where('price', '<=', $searchMaxPrice);
        }

        $businessProducts = $businessProductQuery->take(9)->get();

        $businessQuery = UserBusinessInfos::where('status', 1);

        if (!empty($searchTerm)) {
            $businessQuery->where('business_name', 'like', '%' . $searchTerm . '%');
        }

        if (!empty($searchCity)) {
            $businessQuery->where('business_city', 'like', '%' . $searchCity . '%');
        }

        if (!empty($searchState)) {
            $businessQuery->where('business_state', 'like', '%' . $searchState . '%');
        }

        $businesses = $businessQuery->take(9)->get();
        
        return view('website.search.results', compact('posts', 'businessProducts', 'businesses', 'searchTerm'));
    }


    public function suggestSearch(Request $request)
    {
        $searchTerm = $request->input('search_term');
    
        $posts = AdPost::where('status', 1)
                ->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('description', 'like', "%{$searchTerm}%");
                })
                ->take(3)
                ->get();
    
        $products = BusinessProduct::where('status', 1)
            ->where('title', 'like', "%{$searchTerm}%")
            ->take(3)
            ->get();
    
        $businesses = UserBusinessInfos::where('status', 1)
            ->where('business_name', 'like', "%{$searchTerm}%")
            ->take(3)
            ->get();
    
        return view('website.search.dropdown', compact('posts', 'products', 'businesses'));
    }
    

    public function moreAdPosts(Request $request)
    {
        $searchTerm = $request->input('search_term');
        $posts = AdPost::where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->where('status', 1)
                    ->paginate(10); // Adjust pagination as needed

        return view('website.search.more_ad_posts', compact('posts'));
    }

    public function moreBusinesses(Request $request)
    {
        $searchTerm = $request->input('search_term');
        $searchCity = $request->input('search_city');
        $searchState = $request->input('search_state');

        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION', 12));

        $businessQuery = UserBusinessInfos::where('status', 1);

        if (!empty($searchTerm)) {
            $businessQuery->where('business_name', 'like', '%' . $searchTerm . '%');
        }

        if (!empty($searchCity)) {
            $businessQuery->where('business_city', 'like', '%' . $searchCity . '%');
        }

        if (!empty($searchState)) {
            $businessQuery->where('business_state', 'like', '%' . $searchState . '%');
        }

        $businesses = $businessQuery->paginate($perPage);

        return view('website.search.more_businesses', compact('businesses', 'searchTerm', 'searchCity', 'searchState'));
    }



    public function moreBusinessProducts(Request $request)
    {
        $searchTerm = $request->input('search_term');
        $posts = BusinessProduct::where('title', 'like', '%' . $searchTerm . '%')
                                ->orWhere('description', 'like', '%' . $searchTerm . '%')
                                ->where('status', 1)
                                ->paginate(10); // Adjust pagination as needed

        return view('website.search.more_business_products', compact('posts'));
    }


}
