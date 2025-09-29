<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\{Auth, Redirect, Storage, Session, Log, DB};
use App\Models\{Category, SubCategory, ProductImage, BusinessProduct, Event, Review, UserBusinessHour, UserBusinessInfos, Language, AdPost};
use App\Models\StoreOrder;
use App\Models\OrderStatusHistory;
use App\Models\StoreOrderItem;
use App\Models\ContactSeller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Exception; 
use HTMLPurifier;
use HTMLPurifier_Config;
use voku\helper\ASCII;
use voku\helper\UTF8;


class BusinessProductsController extends Controller
{
    public function index()
    { 
        $perPage = request()->query('per_page', config('constants.DEFAULT_PAGINATION'));
        $userId = Auth::id();
        $user = Auth::user();

        $businessInfo = UserBusinessInfos::select('id')->where('user_id', $userId)->first();

        if (!$businessInfo) {
            return redirect()->route('dashboard')->with('error', 'You do not have any active business information.');
        }

        $businessId = $businessInfo->id;

        $query = BusinessProduct::with(['userBusinessHours', 'businessInfo'])
                                ->where('business_id', $businessId)
                                ->orderBy('id', 'desc');

        $products = $query->paginate($perPage);

        if ($products->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'You do not have any active products.');
        }

        $totalAdPosts = AdPost::where('user_id', $userId)->count();

        $businessIds = UserBusinessInfos::where('user_id', $userId)->pluck('id');

        $totalBusinessProducts = BusinessProduct::whereIn('business_id', $businessIds)->count();

        $totalEvents = Event::where('user_id', $userId)->count();

        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 

        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug'); 

        return view('frontend.business.index', compact('products','totalAdPosts', 'totalBusinessProducts', 'totalEvents','is_approved','businessName'));
    }



    public function create()
    {
        $userId = Auth::id(); 
        $user = Auth::user(); 
        
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;

        if ($is_approved == 0) {
            return redirect()->route('dashboard') 
                ->with('error', 'Your business profile is not activated yet. Please contact the administrator.');
        }

        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');

        return view('frontend.business.add_product', compact('is_approved', 'businessName'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_select' => 'required|exists:categories,id',
            'subcategory' => 'nullable|exists:subcategories,id',
            'amount' => 'required|numeric',
            'mrp' => 'nullable|numeric',
            'max_qty' => 'nullable|numeric|min:1',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'extra_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed for product creation', ['errors' => $validator->errors()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            $userId = Auth::id();

            if (!$userId) {
                \Log::error('User not authenticated for product creation');
                return response()->json(['error' => 'User not authenticated.'], 403);
            }

            $user = Auth::user();
            $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;

            if ($is_approved == 0) {
                \Log::warning('Business profile not approved for user', ['user_id' => $userId]);
                return redirect()->route('dashboard')
                    ->with('error', 'Your business profile is not activated yet. Please contact the administrator.');
            }

            $businessInfo = UserBusinessInfos::where('user_id', $userId)->first();

            if (!$businessInfo) {
                \Log::error('Business information not found for user', ['user_id' => $userId]);
                return response()->json(['error' => 'Business information not found for this user.'], 404);
            }

            $product = new BusinessProduct();
            $product->title = $request->title;
            $product->category_id = $request->category_select;
            $product->subcategory_id = $request->subcategory;
            $product->sku = $request->sku;
            $product->price = $request->amount;
            $product->mrp = $request->mrp;
            $product->max_qty = $request->max_qty;
            $product->sold_qty = 0;
            $product->description = $request->description;
            $product->video_url = $request->video_url;
            $product->business_id = $businessInfo->id;
            $product->user_id = $userId;

            if ($request->hasFile('main_image')) {
                $file = $request->file('main_image');
                $filename = $file->hashName();
                $path = $file->storeAs('products', $filename, 'public');
                $product->main_image = 'products/' . $filename;

                $thumbnailPath = 'products/thumb/' . $filename;
                $thumbnailImage = Image::make($file->getRealPath())
                    ->resize(450, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                Storage::disk('public')->put($thumbnailPath, (string)$thumbnailImage->encode());
            }

            $product->save();

            \Log::info('Product saved successfully', [
                'product_id' => $product->id,
                'title' => $product->title,
                'item_url' => $product->item_url,
                'slug' => $product->slug
            ]);

            if ($request->hasFile('extra_images')) {
                foreach ($request->file('extra_images') as $file) {
                    $path = $file->store('products', 'public');
                    ProductImage::create([
                        'business_product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => 'Product has been successfully created.',
                'redirect_url' => route('business-products.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating product', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }





    public function showByURL($item_url)
    {
        $userId = Auth::id();
        $post = BusinessProduct::with('businessInfo.user')->where('item_url', $item_url)->firstOrFail();

        if ($post->businessInfo->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'You do not have permission to view this product.');
        }

       
        
        if (!$post) {
            return redirect()->route('home')->with('error', "Post deleted or expired");
        }

        return view('frontend.business.details', compact('post'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $item_url)
    {
        $user = Auth::user(); 
        $userId = Auth::id();
        
        $product = BusinessProduct::where('item_url', $item_url)->firstOrFail();

        if ($product->user_id !== $userId) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to edit this product.');
        }
        
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;

        if ($is_approved == 0) {
            return redirect()->route('dashboard') 
                ->with('error', 'Your business profile is not activated yet. Please contact the administrator.');
        }

        $categories = Category::all();
        $subcategories = SubCategory::where('category_id', $product->category_id)->get();
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');

        return view('frontend.business.edit_product', compact('product', 'categories', 'subcategories', 'is_approved', 'businessName'));
    }

     

    public function update(Request $request, string $item_url)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_select' => 'required|exists:categories,id',
            'subcategory' => 'nullable|exists:subcategories,id',
            'amount' => 'required|numeric',
            'mrp' => 'nullable|numeric',
            'max_qty' => 'nullable|numeric|min:1',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'extra_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ], [
            'max_qty.min' => 'The minimum quantity should be at least 1.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $userId = Auth::id();
            $user = Auth::user(); 
            $product = BusinessProduct::where('item_url', $item_url)->firstOrFail();

            // Ensure the user has permission to update the product
            if ($product->businessinfo->user_id !== $userId) {
                return response()->json(['error' => 'You do not have permission to update this product.'], 403);
            }

            // Check if the business profile is approved
            $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;

            if ($is_approved == 0) {
                return redirect()->route('dashboard') 
                    ->with('error', 'Your business profile is not activated yet. Please contact the administrator.');
            }

            // Validate that the max quantity is not less than the quantity already sold
            if ($request->max_qty < $product->sold_qty) {
                return response()->json(['error' => 'Max quantity cannot be less than the quantity already sold.'], 422);
            }

            // Update product fields
            $product->title = $request->title;
            $product->item_url = $product->slug;  // Keep the item URL as the slug
            $product->category_id = $request->category_select;
            $product->subcategory_id = $request->subcategory;
            $product->sku = $request->sku;
            $product->price = $request->amount;
            $product->mrp = $request->mrp;
            $product->max_qty = $request->max_qty;
            $product->description = $request->description;
            $product->video_url = $request->video_url;

            // Sanitize the event description using HTMLPurifier (if needed)
            if ($request->has('description')) {
                $config = HTMLPurifier_Config::createDefault();
                $purifier = new HTMLPurifier($config);
                $product->description = $purifier->purify($request->description);
            }

            // Regenerate slug if the title has changed
            if ($product->title !== $request->title) {
                $slug = Str::slug($request->title);  // Generate slug from the new title
                $slug = UTF8::to_ascii($slug);  // Transliterate to ASCII
                $product->slug = $slug . '-' . rand(1000, 9999);  // Add random number to ensure uniqueness
            }

            // Handle main image upload
            if ($request->hasFile('main_image')) {
                if ($product->main_image && Storage::exists($product->main_image)) {
                    Storage::delete($product->main_image);  // Delete old main image if exists
                }

                $path = $request->file('main_image')->store('products/main_images', 'public');
                $product->main_image = $path;  // Save the new main image path
            }

            // Handle extra images upload
            if ($request->hasFile('extra_images')) {
                foreach ($request->file('extra_images') as $image) {
                    $path = $image->store('products/extra_images', 'public');
                    $product->images()->create(['image_path' => $path]);  // Store extra images
                }
            }

            // Save the updated product
            $product->save();

            return response()->json(['success' => 'Product has been successfully updated.', 'redirect_url' => route('business-products.index')]);
        } catch (Exception $e) {
            \Log::error('Product Update Error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'error' => 'An unexpected error occurred. Please try again.',
            ], 500);
        }
    }

    public function enquiries(Request $request)
    {
        try {
            // Get the authenticated vendor
            $userId = Auth::id();
            $user = Auth::user();

            // Check business information
            $businessInfo = UserBusinessInfos::select('id')->where('user_id', $userId)->first();
            if (!$businessInfo) {
                return redirect()->route('dashboard')->with('error', 'You do not have any active business information.');
            }

            // Check if business profile is approved
            $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;
            if ($is_approved == 0) {
                return redirect()->route('dashboard')
                    ->with('error', 'Your business profile is not activated yet. Please contact the administrator.');
            }

            // Get business ID
            $businessId = $businessInfo->id;

            // Get vendor's product slugs
            $productSlugs = BusinessProduct::where('business_id', $businessId)
                ->pluck('slug')
                ->toArray();

            // If no products, return empty view
            if (empty($productSlugs)) {
                $enquiries = collect([]);
                return view('frontend.business.enquiries', compact('enquiries', 'is_approved'));
            }

            // Fetch enquiries for vendor's products
            $perPage = request()->query('per_page', config('constants.DEFAULT_PAGINATION'));
            $enquiries = ContactSeller::whereIn('product_slug', $productSlugs)
                ->select('id', 'name', 'email', 'phone', 'message', 'product_slug', 'created_at')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            // Get business name for view
            $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');

            return view('frontend.business.enquiries', compact('enquiries', 'is_approved', 'businessName'));

        } catch (\Exception $e) {
            Log::error('BusinessProductsController::enquiries failed: ' . $e->getMessage(), [
                'vendor_id' => $userId,
                'exception' => $e->getTraceAsString()
            ]);
            return redirect()->route('dashboard')->with('error', 'An unexpected error occurred while fetching enquiries.');
        }
    }


    private function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);

        $query = BusinessProduct::where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $count = $query->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        return $slug;
    }



    public function deleteImage(ProductImage $product, Request $request)
    {       
        try {
            Storage::disk('public')->delete($product->image_path);
            $product->delete();

            return response()->json(['success' => 'Image removed successfully.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while removing the image.'], 500);
        }
    }


    
    public function destroy($item_url)
    {
        $product = BusinessProduct::with(['UserBusinessInfos' => function ($query) {
            $query->select('id', 'user_id');
        },
        'images' => function ($query) {
            $query->select('business_product_id', 'image_path'); 
        }])->where('item_url', $item_url)->firstOrFail();
        

        if ($product->UserBusinessInfos->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }        

        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }

        if ($product->Images) {
            foreach ($product->Images as $image) {
                if ($image->image_path) {
                    Storage::disk('public')->delete($image->image_path);
                }
            }
        }

        $product->delete();

        return response()->json(['success' => 'Product deleted successfully!']);
    }



    public function myproductorder()
{
    // Get the logged-in user's ID
    $userId = Auth::id();

    // Fetch the business information for the logged-in user
    $businessInfo = UserBusinessInfos::select('id')->where('user_id', $userId)->first();

    // If no business is found for the logged-in user, redirect with an error
    if (!$businessInfo) {
        return redirect()->route('dashboard')->with('error', 'You do not have any active business information.');
    }

    // Get the business ID of the logged-in user
    $businessId = $businessInfo->id;

    // Retrieve all orders where this business's products are included
    $orders = StoreOrder::whereHas('items.product', function ($query) use ($businessId) {
        $query->where('business_id', $businessId);
    })
    ->with(['items.product' => function ($query) use ($businessId) {
        // Only fetch products belonging to the logged-in business
        $query->where('business_id', $businessId);
    }, 'user'])
 ->orderBy('id', 'desc')

    ->get();
  // If no orders are found, redirect with a message
  if ($orders->isEmpty()) {
    return redirect()->route('dashboard')->with('error', 'No orders found for your products.');
}
    // Pass the filtered orders to the view
    return view('frontend.business.my_orders', compact('orders'));
}

public function viewOrderDetails($id)
{
    try {
        $decryptedId = Crypt::decrypt($id);
        $userId = Auth::id();

        $businessInfo = UserBusinessInfos::select('id')->where('user_id', $userId)->first();
        if (!$businessInfo) {
            return redirect()->route('dashboard')->with('error', 'You do not have any active business information.');
        }

        $order = StoreOrder::with(['items.product', 'user'])->find($decryptedId);
        if (!$order) {
            return redirect()->route('dashboard')->with('error', 'Order not found.');
        }

        $order->setRelation('items', $order->items->filter(function ($item) use ($userId, $businessInfo) {
            return $item->seller_id == $businessInfo->id && $item->user_id == $userId;
        })->values());

        if ($order->items->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'No items in this order match your business.');
        }

        return view('frontend.business.viewmy_order', compact('order'));

    } catch (\Exception $e) {
        return redirect()->route('dashboard')->with('error', 'Invalid order ID.');
    }
}

public function changeOrderStatus(Request $request, $id)
{
    $request->validate([
        'order_status' => 'required|string',
        'comment' => 'nullable|string',
    ]);

    $businessInfo = UserBusinessInfos::where('user_id', Auth::id())->first();

    if (!$businessInfo) {
        return response()->json([
            'status' => 'error',
            'message' => 'No business information found for this user.'
        ]);
    }

    $businessId = $businessInfo->id;

    // Get items for this order owned by current business
    $items = StoreOrderItem::where('store_order_id', $id)
        ->where('seller_id', $businessId)
        ->get();

    if ($items->isEmpty()) {
        return response()->json([
            'status' => 'info',
            'message' => 'No items found in this order belonging to your business.'
        ]);
    }

    // All items should have the same current status
    $oldStatus = $items->first()->status;
    $newStatus = $request->order_status;

    if ($oldStatus === $newStatus) {
        return response()->json([
            'status' => 'info',
            'message' => 'Status is already up to date.'
        ]);
    }

    // Update status for each item
    foreach ($items as $item) {
        $item->status = $newStatus;
        $item->save();
    }

    // Store history once per order
    $history = OrderStatusHistory::create([
        'store_order_id' => $id,
        'changed_by_type' => 'seller',
        'changed_by' => Auth::id(),
        'from_status' => $oldStatus,
        'to_status' => $newStatus,
        'comment' => $request->comment,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Order item status updated successfully.',
        'history' => [
            'date' => $history->created_at->format('d-m-Y H:i'),
            'from' => ucfirst($history->from_status),
            'to' => ucfirst($history->to_status),
            'user' => Auth::user()->name ?? 'Guest',
            'role' => 'Seller',
            'comment' => $history->comment ?? '-',
        ]
    ]);
}




    
    

}
