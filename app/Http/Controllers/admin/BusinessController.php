<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BusinessProduct;
use App\Models\BusinessCategory;
use App\Models\Category; 
use App\Models\Subcategory;
use App\Models\UserBusinessInfos;
use App\Models\Deal;
use App\Models\Language;
use App\Models\UserBusinessHour; 
use App\Models\Enquiry;
use App\Models\BusinessImage;
use App\Models\ProductImage;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use HTMLPurifier;
use HTMLPurifier_Config;
use voku\helper\UTF8;
use App\Models\ContactSeller;

class BusinessController extends Controller
{
    public function index()
    {
        $users = User::whereRaw('CHAR_LENGTH(password) <= 12')->get();

            foreach ($users as $user) {
            $user->password = Hash::make('@12345678');
            $user->save();
        }
        
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'User Business List',
                'url' => null
            ],
        ];
        return view('admin.business.index', compact('breadcrumbs'));
    }

    // User Business Request
    public function fetchTableData()
    {
        $result = ['data' => []];

        $posts = User::select('users.id','users.uid', 'users.name', 'users.email', 'users.is_admin_approved')
            ->where('account_type', 2)
            ->with(['businessInfos:id,business_name,user_id,status,feature'])
            ->orderBy('id', 'desc')
            ->get();

        foreach ($posts as $key => $post) {
            $businessId = $post->businessInfos->id ?? null;

            $status = $post->is_admin_approved == 1
                ? '<div class="form-check form-switch"><input class="form-check-input change-business-status" data-id="' . $post->id . '" type="checkbox" role="switch" checked></div>'
                : '<div class="form-check form-switch"><input class="form-check-input change-business-status" data-id="' . $post->id . '" type="checkbox" role="switch"></div>';

            $feature = $post->businessInfos && $post->businessInfos->feature == 1
                ? '<div class="form-check form-switch"><input class="form-check-input change-feature-status" data-id="' . $businessId . '" type="checkbox" role="switch" checked></div>'
                : '<div class="form-check form-switch"><input class="form-check-input change-feature-status" data-id="' . $businessId . '" type="checkbox" role="switch"></div>';

            $dropdown = '<div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">';

            if ($businessId) {
                $dropdown .= '<a class="dropdown-item" href="' . route('listBusinessProduct', ['id' => $businessId]) . '"><i class="fa fa-list m-r-5"></i> Product List</a>';
                $dropdown .= '<a class="dropdown-item" href="#" onclick="removeBusinessFunc(' . $businessId . ')" data-bs-toggle="modal" data-bs-target="#removeBusinessModal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
            }

            $dropdown .= '</div></div>';

            $result['data'][] = [
                $dropdown,
                $post->uid,
                $post->name,
                $post->email,
                $post->businessInfos->business_name ?? '-',
                $status,
                $feature
            ];
        }
       
        return response()->json($result);
    }
    

    public function changeBusinessFeature(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'feature' => 'required|in:true,false,1,0,"1","0"',
        ]);
        
        $business = UserBusinessInfos::findOrFail($request->id);
        $business->feature = $request->feature == 'true' ? 1 : 0;
        $business->save();

        return response(['message' => 'Feature Status changed']);
    }

    public function changeBusinessStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|in:true,false,1,0,"1","0"',
        ]);

        try {
            Log::info('Incoming request data', $request->all());

            $user = User::findOrFail($request->id);

            $businessInfo = UserBusinessInfos::where('user_id', $request->id)->first();

            if ($user && $businessInfo) {
            
                $newStatus = $user->is_admin_approved == 0 ? 1 : 0;

                $businessInfo->status = $newStatus;
                $businessInfo->save();

                $user->is_admin_approved = $newStatus;
                $user->save();

                Log::info('Business status updated', ['business_id' => $businessInfo->id, 'new_status' => $newStatus]);

                return response()->json(['message' => 'User Business Status changed']);
            } else {
                return response()->json(['error' => 'Business information not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error updating business status', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while updating the status.'], 500);
        }
    }



    public function listProduct(Request $request){
        
        $id = $request->id;
        $businessInfo = UserBusinessInfos::find($id);

        $business_name =$businessInfo->business_name;
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Business List',
                'url' => route('businessByAdmin')
            ],
            [
                'label' => "$business_name - Product List",
                'url' => null
            ],
        ];
        
        return view('admin.business.product_list',compact('breadcrumbs','id','business_name'));
    }

    function utf8ize($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $k => $v) {
                $mixed[$k] = utf8ize($v);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, 'UTF-8', 'UTF-8');
        }
        return $mixed;
    }

    

    public function fetchBusinessProductData(Request $request) {
        $result = ['data' => []];  
        $id = $request->id;
    
        // Fetch data and force encoding to UTF-8
        $posts = BusinessProduct::select('id', 'title', 'product_id','category_id', 'price', 'mrp', 'description', 'main_image', 'video_url', 'status', 'feature')
            ->with(['Category' => function($query) {
                $query->select('id', 'name'); 
            }])
            ->where('business_id', $id)
            ->get()
            ->map(function ($post) {
                // Force encoding to UTF-8 for both title and description
                $post->title = utf8_encode($post->title);
                $post->description = utf8_encode($post->description);
                return $post;
            });
    
        foreach ($posts as $key => $post) {
            $buttons = ''; 
    
            // Clean the title and description
            $cleanedTitle = $this->cleanText($post->title);
            $cleanedDescription = $this->cleanText($post->description);
    
            // Handle main image (with fallback)
            if (!empty($post->main_image)) {
                $icon = '<img class="img img-thumbnail" src="' . asset('storage/' . $post->main_image) . '" style="width:60px; height:60px;">';
            } else {
                $icon = '<img class="img img-thumbnail" src="' . asset('storage/no-image.jpg') . '" style="width:60px; height:60px;">';
            }
    
            // Buttons for actions
            $buttons .= '<a href="' . route('editBusinessProductData', ['bid' => $id, 'id' => $post->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil" title="Edit products"></i></a>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $post->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';
    
            // Status & Feature switch
            $status = $post->status == 1
                ? '<div class="form-check form-switch"><input class="form-check-input product-change-status" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>' 
                : '<div class="form-check form-switch"><input class="form-check-input product-change-status" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked"></div>';
    
            $feature = $post->feature == 1 
                ? '<div class="form-check form-switch"><input class="form-check-input product-change-feature" data-id="'.$post->id.'" type="checkbox" role="switch" checked></div>' 
                : '<div class="form-check form-switch"><input class="form-check-input product-change-feature" data-id="'.$post->id.'" type="checkbox" role="switch"></div>';
    
            // Final data structure
            $result['data'][$key] = [
                'DT_RowId' => 'item-' . $post->id,
                $icon,
                $post->product_id,
                $cleanedTitle,  // Cleaned title
                $post->Category->name,
                $post->price,
                $post->mrp,
                strlen($cleanedDescription) > 150 ? substr($cleanedDescription, 0, 150) . '...' : $cleanedDescription,  // Cleaned description
                $post->video_url,
                $status,
                $feature,
                $buttons,
            ];
        }
    
        // Force the response to be in UTF-8
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE)
                        ->header('Content-Type', 'application/json; charset=utf-8');
    }
    
    
    
    
    // private function cleanText($text) {
    //     // Ensure the text is in UTF-8 encoding
    //     $text = mb_convert_encoding($text, 'UTF-8', 'auto');
        
    //     // Remove unwanted characters
    //     return preg_replace('/[\x00-\x1F\x7F\xA0\x200B\x200C\x200D\x2028\x2029\xFEFF]/u', '', $text);
    // }

    

    public function addProduct(Request $request){
        $business_id = $request->id;
        $businessInfo = UserBusinessInfos::find($business_id);
        $business_name =$businessInfo->business_name;
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Business List',
                'url' => route('businessByAdmin')
            ],
            [
                'label' => "Add Product for - $business_name",
                'url' => null 
            ]
        ];
        return view('admin.business.add_product',compact('breadcrumbs','business_id'));
    }

    public function storeProduct(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'subcategory_id' => 'required|integer|exists:subcategories,id',
                'price' => 'required|numeric',
                'mrp' => 'nullable|numeric',
                'video_url' => 'nullable|url',
                'description' => 'nullable|string',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'business_id' => 'required|integer|exists:user_business_infos,id',
                'sku' => 'nullable|string|max:255',
                'feature' => 'boolean',
                'orderby' => 'nullable|integer',
                'max_qty' => 'nullable|integer',
                'extra_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $validatedData = $validator->validated();

            $validatedData['item_url'] = Str::slug($validatedData['title']);

            $businessInfo = UserBusinessInfos::findOrFail($validatedData['business_id']);

            $validatedData['user_id'] = $businessInfo->user_id;

            if ($request->hasFile('main_image')) {
                $file = $request->file('main_image');
                $filename = $file->hashName();
                $path = $file->storeAs('products', $filename, 'public');
                $validatedData['main_image'] = 'products/' . $filename;

                $thumbnailPath = 'products/thumb/' . $filename;
                $thumbnailImage = Image::make($file->getRealPath())
                    ->resize(450, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                Storage::disk('public')->put($thumbnailPath, (string)$thumbnailImage->encode());
            }

            $validatedData['status'] = 1;

            $product = BusinessProduct::create($validatedData);

            if ($request->hasFile('extra_images')) {
                foreach ($request->file('extra_images') as $file) {
                    $path = $file->store('products', 'public');
                    ProductImage::create([
                        'business_product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

            return response()->json([
                'message' => 'Product successfully saved!',
                'product' => $product
            ], 200);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }


    public function editBusinessProduct(Request $request)
    {
        $bid = $request->bid;
        $product_id = $request->id;
        

        $productInfo = BusinessProduct::findOrFail($product_id);
        // dd($productInfo);
        if (!$productInfo) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $categories = Category::all();
        $subcategories = Subcategory::all();
        $product_title = $productInfo->title;
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('adminDashboard')],
            ['label' => 'Business List', 'url' => route('businessByAdmin')],
            ['label' => 'Product List', 'url' => route('admin.allProducts')],
            ['label' => "Edit Product - $product_title", 'url' => null]
        ];
        $languages = $productInfo->languages; 
        return view('admin.business.edit_product', compact('breadcrumbs','productInfo', 'categories', 'subcategories', 'bid'));
    }

    public function updateProduct(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'title' => 'required|string|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'subcategory_id' => 'required|integer|exists:subcategories,id',
                'price' => 'required|numeric|min:0',
                'mrp' => 'nullable|numeric|min:0',
                'video_url' => 'nullable|url',
                'description' => 'nullable|string',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'sku' => 'nullable|string|max:255',
                'feature' => 'boolean',
                'orderby' => 'integer',
                'max_qty' => 'nullable|integer',
                'extra_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ];
    
            $validatedData = $request->validate($rules);
            $product = BusinessProduct::findOrFail($request->product_id);
            
            if ($product->title != $request->input('title')) {
                $slug = Str::slug($request->input('title'));
                $slug = transliterator_transliterate('Any-Latin; Latin-ASCII', $slug);
                $slug = $slug . '-' . rand(1000, 9999);
                $product->slug = $slug; 
            }
    
            // Handle main image update (same logic as store)
            if ($request->hasFile('main_image')) {
                $image = $request->file('main_image');
    
                if ($image->getSize() > 5120 * 5120) {
                    return response()->json([
                        'error' => 'The image size should not exceed 5 MB.'
                    ], 422);
                }
    
                if ($product->main_image) {
                    Storage::disk('public')->delete($product->main_image);
    
                    $oldThumbnailPath = 'products/thumb/' . basename($product->main_image);
                    Storage::disk('public')->delete($oldThumbnailPath);
                }
    
                $imagePath = $image->store('products', 'public');
                $validatedData['main_image'] = $imagePath;
    
                $thumbnailPath = 'products/thumb/' . basename($imagePath);
    
                $thumbnailImage = Image::make(storage_path('app/public/' . $imagePath))
                    ->resize(450, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
    
                Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
            }
    
            $validatedData['status'] = 1; 

            $product->fill($validatedData);
    
            
            if ($request->hasFile('extra_images')) {
                $existingExtraImages = $product->extraImages ?? [];
    
                foreach ($existingExtraImages as $existingImage) {
                    Storage::disk('public')->delete($existingImage->image_path);
                    $existingImage->delete();
                }
    
                foreach ($request->file('extra_images') as $file) {
                    $path = $file->store('products', 'public');
                    ProductImage::create([
                        'business_product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }
    
            $product->save();
            DB::commit();
    
            return response()->json(['success' => 'Product updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update product: ' . $e->getMessage()], 500);
        }
    }
    
 
    public function deleteproductImage(Request $request)
    {
        try {
            $imageId = $request->input('image_id');
            $image = ProductImage::findOrFail($imageId);

            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            $image->delete();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the image.'], 500);
        }
    }
    
    public function destroyProduct(Request $request)
    {
        try {
            $productId = $request->input('del_id');
            $product = BusinessProduct::find($productId);

            if (!$product) {
                return response()->json(['error' => false, 'messages' => 'Product not found']);
            }

            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }

            // Now delete the AdProduct
            $product->delete();

            return response()->json(['success' => true, 'messages' => 'Product deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => false, 'messages' => "Error deleting Product"]);
        }
    }

    public function businessByAdmin(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Add Business By Admin',
                'url' => null
            ],
        ];
        
        return view('admin.business.business_list',compact('breadcrumbs'));
    }

    public function fetchBusinessData(){
        $result = ['data' => []]; 

        $posts = UserBusinessInfos::where('created_by_admin',1)->orderBy('id', 'desc')->get();
  
        foreach ($posts as $key => $post) {
            $buttons = ''; 
    
            $buttons .= '<a href="' . route('editBusinessData', ['id' => $post->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil" title="Edit products"></i></a>';

            $buttons .= '<a href="' . route('addBusinessProduct', ['id' => $post->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-plus" title="add products"></i></a>';

            $buttons .= '<a href="' . route('listBusinessProduct', ['id' => $post->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-eye" title="View products"></i></a>';


            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $post->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            
            if($post->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-business-status" data-id="'.$post->user_id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{ 
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-business-status" data-id="'.$post->user_id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }
            

            if($post->feature == 1) {
                $feature = '<div class="form-check form-switch">
                <input class="form-check-input change-business-feature" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{ 
                $feature = '<div class="form-check form-switch">
                <input class="form-check-input change-business-feature" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }
            
            $icon = '<img class="img img-thumbnail business_list_logo" src="' . asset('storage/' . $post->logo_path) . '" >' .$post->business_name;

            $address = mb_strlen($post->business_address) > 25 ? mb_substr($post->business_address, 0, 25) . '...' : $post->business_address;

           
            $dropdown = '
            <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"><span class="text-ehite"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-25px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="' . route('editBusinessData', ['id' => $post->id]) . '" ><i class="fa fa-pencil m-r-5"></i> Edit Business</a>
                    <a class="dropdown-item" href="' . route('addBusinessProduct', ['id' => $post->id]) . '" ><i class="fa fa-plus m-r-5"></i> Add Product</a>
                    <a class="dropdown-item" href="' . route('listBusinessProduct', ['id' => $post->id]) . '" ><i class="fa fa-list m-r-5"></i> Product List</a>
                    <a class="dropdown-item" href="#"  onclick="removeBusinessFunc(' . $post->id . ')" data-bs-toggle="modal" data-bs-target="#removeBusinessModal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
            </div>';
            
            $result['data'][$key] = [
                'DT_RowId' => 'item-' . $post->id, 
                $dropdown,
                $icon, 
                $post->establish_year,
                $post->contact_email,
                $post->contact_phone,
                $address,
                $status,
                $feature
            ];
        }

        return response()->json($result);
    }

    public function changeProductStatus(Request $request){
        $post = BusinessProduct::findOrFail($request->id);

        $newStatus = $post->status == 0 ? 1 : 0;
        $post->status = $newStatus;
        $post->save();
    
        return response(['message' => 'Status changed']);
    }

    public function changeProductFeature(Request $request){
        $post = BusinessProduct::findOrFail($request->id);
        $post->feature = $request->feature == 'true' ? 1 : 0;
        $post->save();

        return response(['message' => 'Feature status changed']);
    }

    public function addBusiness(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Business List',
                'url' => route('businessByAdmin')
            ],
            [
                'label' => 'Add Business',
                'url' => null
            ],
        ];
        return view('admin.business.add_business',compact('breadcrumbs'));
    }

    public function storeBusiness(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255|unique:user_business_infos,business_name',
            'contact_email' => 'nullable|string|max:255',
            'business_category' => 'required|string|max:255|exists:business_categories,id',
            'establish_year' => 'nullable|date_format:Y',
            'deals' => 'nullable|array',
            'languages' => 'nullable|array',
            'deals.*' => 'string|max:255',
            'abn' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'website_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'business_address' => 'nullable|string',
            'business_city' => 'required|string', 
            'business_state' => 'nullable|string',
            'business_country' => 'nullable|string', 
            'business_description' => 'nullable|string',
            'feature' => 'boolean',
            'orderby' => 'integer',
            'created_by_admin' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'other_images' => 'nullable|array',
            'other_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'monday_start' => 'nullable|string',
            'monday_end' => 'nullable|string',
            'tuesday_start' => 'nullable|string',
            'tuesday_end' => 'nullable|string',
            'wednesday_start' => 'nullable|string',
            'wednesday_end' => 'nullable|string',
            'thursday_start' => 'nullable|string',
            'thursday_end' => 'nullable|string',
            'friday_start' => 'nullable|string',
            'friday_end' => 'nullable|string',
            'saturday_start' => 'nullable|string',
            'saturday_end' => 'nullable|string',
            'sunday_start' => 'nullable|string',
            'sunday_end' => 'nullable|string',
        ]);
     
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        if (!empty($request->abn) && UserBusinessInfos::where('abn', $request->abn)->exists()) {
            return response()->json(['errors' => ['abn' => 'ABN already exists.']], 422);
        }
    
        $validatedData = $validator->validated();
    
        $user = User::create([ 
            'name' => $validatedData['business_name'],
            'email' => $validatedData['contact_email'],
            'password' => Hash::make('@12345678'),
            'account_type' => 2,
            'is_admin_approved' => 1,
        ]);
    
        $businessInfo = new UserBusinessInfos($validatedData);
        $businessInfo->user_id = $user->id;
        $businessInfo->slug = Str::slug($validatedData['business_name']);
    
        if ($request->has('business_description')) {
            $businessInfo->business_description = $request->business_description;
        }
    
        if ($request->hasFile('image')) {
            $businessInfo->logo_path = $request->image->store('logos', 'public');
        }
    
        $businessInfo->status = 1;
        $businessInfo->save();
    
        // Save business hours
        $businessHours = new UserBusinessHour([
            'user_business_info_id' => $businessInfo->id,
            'user_id' => $user->id,
            'monday' => $request->monday_start . ' - ' . $request->monday_end,
            'tuesday' => $request->tuesday_start . ' - ' . $request->tuesday_end,
            'wednesday' => $request->wednesday_start . ' - ' . $request->wednesday_end,
            'thursday' => $request->thursday_start . ' - ' . $request->thursday_end,
            'friday' => $request->friday_start . ' - ' . $request->friday_end,
            'saturday' => $request->saturday_start . ' - ' . $request->saturday_end,
            'sunday' => $request->sunday_start . ' - ' . $request->sunday_end,
        ]);
        $businessHours->save();
    
        // Attach languages
        if ($request->has('languages')) {
            foreach ($request->languages as $languageName) {
                $language = new Language(['name' => $languageName]);
                $businessInfo->languages()->save($language);
            }
        }
    
        // Save deals if provided
        if ($request->has('deals') && is_array($request->deals)) {
            foreach ($request->deals as $dealName) {
                $deal = new Deal(['deal' => $dealName]);
                $businessInfo->deals()->save($deal);
            }
        }
    
        // Handle other images if uploaded
        if ($request->hasFile('other_images')) {
            foreach ($request->file('other_images') as $file) {
                $path = $file->store("business_images/{$businessInfo->id}", 'public');
                BusinessImage::create([
                    'user_business_infos_id' => $businessInfo->id,
                    'image_path' => $path,
                ]);
            }
        }
    
        return response()->json(['success' => 'Business information and user created successfully.']);
    }
    
    
    
    

    public function updateUserBusinessInfos() {
        DB::beginTransaction();
    
        try {
            $businessInfos = UserBusinessInfos::whereNull('user_id')->get();
            $updatedRecords = [];
    
            foreach ($businessInfos as $info) {
                $user = User::create([
                    'name' => $info->business_name,
                    'email' => $info->contact_email,
                    'password' => Hash::make('@12345678'),
                ]);
    
                $info->update(['user_id' => $user->id]);
    
                $updatedRecords[] = $info->id;
            }
    
            DB::commit();
    
            Log::info('Updated user_business_infos record IDs:', $updatedRecords);
    
            return response()->json(['message' => 'User IDs updated successfully', 'updated_records' => $updatedRecords], 200);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json(['message' => 'Failed to update user IDs', 'error' => $e->getMessage()], 500);
        }
    }
 

    public function deals()
    {
        return $this->hasMany(Deal::class, 'user_business_info_id');
    }

    // Define the relationship to business hours
    public function businessHours()
    {
        return $this->hasMany(UserBusinessHour::class, 'user_business_info_id');
    }


    public function viewBusiness(Request $request){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Business List',
                'url' => route('businessByAdmin')
            ],
            [
                'label' => 'Business Details',
                'url' => null
            ],
        ];
    
        // Get the business ID from the request
        $business_id = $request->id;
    
        // Fetch the business information
        $businessInfo = UserBusinessInfos::with(['deals', 'businessHours', 'languages', 'user'])->find($business_id);
    
        // Fetch the related business category
        $businessCategory = BusinessCategory::find($businessInfo->business_category);
    
        // Fetch related business products
        $businessProducts = BusinessProduct::where('business_id', $business_id)->get();
        // dd($businessCategory);
        // Pass all data to the view
        return view('admin.business.view_business', compact('breadcrumbs', 'businessInfo', 'businessProducts', 'businessCategory'));
    }  
     
    public function editBusiness(Request $request){
        // dd($request);
        $business_id = $request->id;
        $businessInfo = UserBusinessInfos::with('businessHours', 'deals','businessCategory')->findOrFail($business_id);
        
        $allPossibleDeals = Deal::all();
    
        $selectedDealsIds = $businessInfo->deals->pluck('id');
    
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Business List',
                'url' => route('businessByAdmin')
            ],
            [
                'label' => 'Edit Business',
                'url' => null
            ],
        ];
        $selectedDeals = $businessInfo->deals()->get(['deal as id', 'deal as text'])->toArray();
        $allLanguages = Language::distinct()->get(['name']);
        $selectedLanguages = $businessInfo->languages->pluck('name')->toArray();


        return view('admin.business.edit_business', compact('breadcrumbs', 'businessInfo', 'allPossibleDeals', 'selectedDealsIds','selectedDeals','allLanguages','selectedLanguages'));
    }


    public function updateBusiness(Request $request, $id) {
        $businessInfo = UserBusinessInfos::findOrFail($id);
    
        // Fields to update, similar to the store method
        $fieldsToUpdate = [
            'business_name', 'establish_year', 'abn', 'sku',
            'contact_email', 'contact_phone', 'website_url', 'facebook_url', 'twitter_url',
            'instagram_url', 'linkedin_url', 'business_address', 'business_city', 'business_state',
            'business_country', 'business_description', 'feature', 'orderby'
        ];
    
        foreach ($fieldsToUpdate as $field) {
            if ($request->has($field)) {
                $businessInfo->$field = $request->input($field);
                if ($field === 'business_name') {
                    $businessInfo->slug = Str::slug($request->input('business_name'));
                }
            } else {
                $businessInfo->$field = null;
            }
        }
    
        if ($request->hasFile('image')) {
            $businessInfo->logo_path = $request->image->store('logos', 'public');
        }
    
        if ($request->hasFile('other_images')) {
            foreach ($request->file('other_images') as $image) {
                $imagePath = $image->store('business_images', 'public');
                $businessInfo->images()->create(['image_path' => $imagePath]);
            }
        }
    
        $businessInfo->save();
    
        $businessHours = $businessInfo->businessHours()->firstOrCreate(['user_business_info_id' => $id]);
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    
        foreach ($daysOfWeek as $day) {
            $fromInput = $request->input($day . '_from');
            $toInput = $request->input($day . '_to');
    
            if ($fromInput && $toInput) {
                $timeString = $fromInput . ' - ' . $toInput;
                $businessHours->{$day} = $timeString;
            } else {
                $businessHours->{$day} = null; 
            }
        }
    
        $businessHours->save();
    
        $businessInfo->deals()->delete();
        if (!empty($request->deals)) {
            foreach ($request->deals as $dealName) {
                if ($dealName !== '0') { 
                    $businessInfo->deals()->create(['deal' => $dealName]);
                }
            }
        }
    
        $businessInfo->languages()->delete();
        if ($request->has('languages')) {
            foreach ($request->languages as $languageName) {
                $language = new Language(['name' => $languageName]);
                $businessInfo->languages()->save($language);
            }
        } 
    
        return response()->json(['success' => 'Business information updated successfully.']);
    }
    public function deleteImage($id)
    {
        $image = BusinessImage::findOrFail($id);

        Storage::disk('public')->delete($image->image_path);

        $image->delete();

        return response()->json(['success' => 'Image deleted successfully.']);
    }

    public function destroyBusiness(Request $request)
    {
        try {
            $business = UserBusinessInfos::findOrFail($request->del_id);

            $products = $business->products;

            if ($products->isNotEmpty()) {
                return response()->json(['error' => 'Cannot delete this business because it has associated products.'], 422);
            }

            $business->deals()->delete();

            $business->languages()->delete();

            if ($business->logo_path && \Storage::exists($business->logo_path)) {
                \Storage::delete($business->logo_path);
            }

            $business->delete();

            $user = User::findOrFail($business->user_id);
            $user->account_type = 1;
            $user->is_admin_approved = 0;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Business deleted successfully.']);
        } catch (\Exception $e) {
            \Log::error('Error deleting business: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while deleting the business. Please try again.'], 500);
        }
    }



    public function enquiries()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Business',
                'url' => null
            ],
        ];

        return view('admin.business.business_enquiries', compact('breadcrumbs'));
    }

    public function getBusinessEnquiries()
    {
        $enquiries = Enquiry::with('enquiryable')
                            ->where('module', 'business')
                            ->orderBy('created_at', 'desc')
                            ->get();
                            
        return response()->json($enquiries);
    }

    
    public function deleteEnquiry($id) 
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return response()->json(['success' => 'Enquiry deleted successfully.']);
    }

    public function allProducts(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'All Products',
                'url' => null
            ],
        ];
        
        return view('admin.business.all_product_list',compact('breadcrumbs'));
    }

    public function fetchAllProductsData()
    {
        try {
            $result = ['data' => []];

            $posts = BusinessProduct::select('id', 'title', 'business_id', 'product_id', 'category_id', 'price', 'mrp', 'description', 'main_image', 'video_url', 'status', 'feature')
                ->with(['Category' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($post) {
                    $post->title = $this->sanitizeUtf8($post->title);
                    $post->description = $this->sanitizeUtf8($post->description);
                    $post->video_url = $this->sanitizeUtf8($post->video_url);
                    return $post;
                });

            foreach ($posts as $key => $post) {
                $categoryName = $this->sanitizeUtf8($post->Category->name ?? 'N/A');

                $icon = !empty($post->main_image)
                    ? '<img class="img img-thumbnail" src="' . asset('storage/' . $post->main_image) . '" style="width:60px; height:60px;">'
                    : '<img class="img img-thumbnail" src="' . asset('storage/no-image.jpg') . '" style="width:60px; height:60px;">';

                $buttons = '';
                $buttons .= '<a href="' . route('editBusinessProductData', ['bid' => $post->business_id, 'id' => $post->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil" title="Edit products"></i></a>';
                $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $post->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

                $status = $post->status == 1
                    ? '<div class="form-check form-switch"><input class="form-check-input product-change-status" data-id="' . $post->id . '" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>'
                    : '<div class="form-check form-switch"><input class="form-check-input product-change-status" data-id="' . $post->id . '" type="checkbox" role="switch" id="flexSwitchCheckChecked"></div>';

                $feature = $post->feature == 1
                    ? '<div class="form-check form-switch"><input class="form-check-input product-change-feature" data-id="' . $post->id . '" type="checkbox" role="switch" checked></div>'
                    : '<div class="form-check form-switch"><input class="form-check-input product-change-feature" data-id="' . $post->id . '" type="checkbox" role="switch"></div>';

                $cleanedTitle = $this->cleanText($post->title);
                $cleanedDescription = $this->cleanText($post->description);

                $charLimit = 70;
                $shortDescription = mb_strlen($cleanedDescription, 'UTF-8') > $charLimit
                    ? mb_substr($cleanedDescription, 0, $charLimit, 'UTF-8') . '...'
                    : $cleanedDescription;

                $result['data'][$key] = [
                    'DT_RowId' => 'item-' . $post->id,
                    $icon,
                    $post->product_id,
                    $cleanedTitle,
                    $categoryName,
                    $post->price,
                    $post->mrp,
                    $shortDescription,
                    $post->video_url,
                    $status,
                    $feature,
                    $buttons,
                ];
            }

            return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            \Log::error('Error in fetchAllProductsData: ' . $e->getMessage(), [
                'exception' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }


    private function sanitizeUtf8($string)
    {
        if (is_null($string) || $string === '') {
            return '';
        }

        return mb_convert_encoding(
            preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]|[\x{FFFD}-\x{FFFF}]|[\x{10000}-\x{10FFFF}]/u', '', $string),
            'UTF-8',
            'UTF-8'
        );
    }

    private function cleanText($text)
    {
        if (is_null($text) || $text === '') {
            return '';
        }

        return htmlspecialchars(strip_tags($text), ENT_QUOTES, 'UTF-8');
    }


    public function business_product_enquiries(Request $request)
    {
        try {
            $breadcrumbs = [
                [
                    'label' => 'Dashboard',
                    'url' => route('adminDashboard')
                ],
                [
                    'label' => 'Business Product Enquiries',
                    'url' => null
                ],
            ];

            $perPage = $request->query('per_page', config('constants.DEFAULT_PAGINATION'));
            $enquiries = ContactSeller::select('id', 'name', 'email', 'phone', 'message', 'product_slug', 'created_at')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            return view('admin.business.business_products_enquiries', compact('breadcrumbs', 'enquiries'));

        } catch (\Exception $e) {
            Log::error('BusinessController::business_product_enquiries failed: ' . $e->getMessage(), [
                'exception' => $e->getTraceAsString()
            ]);
            return redirect()->route('adminDashboard')->with('error', 'An unexpected error occurred while fetching product enquiries.');
        }
    }

}