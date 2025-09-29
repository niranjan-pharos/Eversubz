<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\{AdPost, Wishlist, Category, Subcategory, Review,User,Tag,Report,UserBusinessInfos,BusinessProduct,Event};


class WishlistController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));

        $user_id = Auth::id();

        $user = Auth::user();

        $wishlists = Wishlist::where('user_id', $user_id)
            ->with(['wishable' => function ($query) {
                $query->when($query->getModel() instanceof \App\Models\AdPost, function ($q) {
                    $q->with(['primaryImage', 'category', 'subcategory', 'reviews'])
                    ->withAvg('reviews as average_rating', 'rating');
                })->when($query->getModel() instanceof \App\Models\BusinessProduct, function ($q) {
                    $q->with(['category', 'subcategory', 'reviews'])
                    ->withAvg('reviews as average_rating', 'rating');
                });
            }])
            ->whereHas('wishable') // Ensures only existing related models are fetched
            ->paginate($perPage)
            ->withQueryString();

        // Modify wishlists to include primary image for BusinessProduct
        $wishlists->getCollection()->transform(function ($wishlist) {
            if ($wishlist->wishable_type == \App\Models\BusinessProduct::class) {
                $wishlist->wishable->primaryImage = $wishlist->wishable->images ? $wishlist->wishable->images->first() : null;
            }
            return $wishlist;
        });

        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 

        $businessName = UserBusinessInfos::where('user_id', $user_id)->value('slug');

        return view('frontend.wishlist.wishlist', compact('wishlists','is_approved','businessName'));
    }




    public function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You need to log in to add items to the wishlist'], 401);
        }

        $user = Auth::user();
        $wishableId = Crypt::decryptString($request->input('wishable_id'));
        $wishableType = $request->input('wishable_type');

        // Check if the item already exists in the wishlist
        $existingWishlist = Wishlist::where('user_id', $user->id)
            ->where('wishable_id', $wishableId)
            ->where('wishable_type', $wishableType)
            ->first();

        if ($existingWishlist) {
            return response()->json(['error' => 'Item already in wishlist'], 400);
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'wishable_id' => $wishableId,
            'wishable_type' => $wishableType,
        ]);

        return response()->json(['message' => 'Added to wishlist']);
    }


    public function getCount()
    {
        $wishlistCount = 0;

        if (Auth::check()) {
            $wishlistCount = Wishlist::whereHas('wishable', function($query) {
            })->where('user_id', Auth::id())->count();
        }

        return response()->json(['count' => $wishlistCount]);
    }


    public function removeFromWishlist(Request $request)
    {
        try {

            $wishableId = Crypt::decryptString($request->input('wishable_id'));
            $wishableType = $request->input('wishable_type');
            
            $user_id = Auth::id();
            
// dd($wishableId."=====".$wishableType."******".$user_id);
            $wishlistItem = Wishlist::where('user_id', $user_id)
                ->where('wishable_id', $wishableId)
                ->where('wishable_type', $wishableType)
                ->first();

            if ($wishlistItem) {
                $wishlistItem->delete();
                return response()->json(['message' => 'Item removed from wishlist']);
            } else {
                return response()->json(['message' => 'Item not found in wishlist'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error removing item from wishlist: ' . $e->getMessage());
            return response()->json(['message' => 'Error removing item from wishlist'], 500);
        }
    }

    // direct delete from list
    public function directDelete(Request $request)
    {
        try {
            $encryptedId = $request->input('wishable_id');
            $wishableId = Crypt::decryptString($encryptedId);
            $wishableType = $request->input('wishable_type');
            
            $user_id = Auth::id();

            $deleted = Wishlist::where('user_id', $user_id)
                ->where('id', $wishableId)
                ->where('wishable_type', $wishableType)
                ->delete();

            // Log the result of the deletion query
            Log::info('Delete result', ['deleted_count' => $deleted]);

            if ($deleted) {
                return response()->json(['message' => 'Item removed from wishlist']);
            } else {
                return response()->json(['error' => 'Failed to remove item from wishlist or item not found'], 404);
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error in directDelete', ['exception' => $e]);
            return response()->json(['error' => 'An error occurred while removing the item from wishlist'], 500);
        }
    }

}
