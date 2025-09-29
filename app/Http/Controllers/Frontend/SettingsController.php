<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserBusinessInfos; 
use App\Models\UserDetail;
use App\Models\NGO;
use App\Models\NgoImage;
use App\Models\NgoCategory;
use App\Models\NgoMember;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index() 
    {
        $user = Auth::user();
        $userId = Auth::id();
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug'); 
        $userDetail = UserDetail::where('user_id', $user->id)->first(); 
        return view('frontend.settings.index', compact('user', 'userDetail', 'is_approved', 'businessName'));
    }
    
    public function updateBasicInfo(Request $request)
    {
        $user = Auth::user();

        // Validation rules using Rule::unique() to ignore the current user's ID
        $rules = [
            'name' => 'required|string|max:255',
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'phone' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }

            // Store the new image
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->image = $path;
        }

        // Update the user's information
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;

        $user->save();

        // Generate the image URL
        $imageUrl = $user->image ? asset('storage/' . $user->image) : null;

        // Return a success response
        return response()->json([
            'message' => 'Profile updated successfully.',
            'status' => 'success',
            'imageUrl' => $imageUrl,
            'name' => $user->name,
            'username' => $user->username,
            'phone' => $user->phone
        ]);
    }

    public function billing()
    {
        
        $user = auth()->user(); 
        $user = Auth::user();
        $userId = Auth::id();
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');
        $userDetail = UserDetail::where('user_id', $user->id)->first(); 
    
        return view('frontend.settings.billing', compact('user', 'userDetail', 'is_approved', 'businessName'));
    } 

    public function billingUpdate(Request $request)
    {
        $user = auth()->user();

        $UserDetail = $user->userDetails()->firstOrCreate([
            'user_id' => $user->id,
        ]);

        $rules = [
            'billing_address' => 'nullable|string|max:255',
            'billing_city' => 'nullable|string|max:255',
            'billing_state' => 'nullable|string|max:255',
            'billing_postcode' => 'nullable|string|max:55',
            'billing_country' => 'nullable|string|max:55',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update the billings's information
        $UserDetail->billing_address = $request->billing_address;
        $UserDetail->billing_city = $request->billing_city;
        $UserDetail->billing_state = $request->billing_state;
        $UserDetail->billing_postcode = $request->billing_postcode;
        $UserDetail->billing_country = $request->billing_country;

        $UserDetail->save();


        // Return a success response
        return response()->json([
            'message' => 'Billing updated successfully.',
            'status' => 'success',
            'billing_address' => $UserDetail->billing_address,
            'billing_city' => $UserDetail->billing_city,
            'billing_state' => $UserDetail->billing_state,
            'billing_postcode' => $UserDetail->billing_postcode,
            'billing_country' => $UserDetail->billing_country,
        ]);
    }

    public function shipping()
    {
        
        $user = auth()->user(); 
        $user = auth()->user(); 
        $user = Auth::user();
        $userId = Auth::id();
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');
        $userDetail = UserDetail::where('user_id', $user->id)->first(); 
    
        return view('frontend.settings.shipping', compact('user', 'userDetail', 'is_approved', 'businessName'));
    } 

    public function shippingUpdate(Request $request)
    {
        $user = auth()->user();

        $UserDetail = $user->userDetails()->firstOrCreate([
            'user_id' => $user->id,
        ]);

        $rules = [
            'shipping_address' => 'nullable|string|max:255',
            'shipping_city' => 'nullable|string|max:255',
            'shipping_state' => 'nullable|string|max:255',
            'shipping_postcode' => 'nullable|string|max:55',
            'shipping_country' => 'nullable|string|max:55',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update the billings's information
        $UserDetail->shipping_address = $request->shipping_address;
        $UserDetail->shipping_city = $request->shipping_city;
        $UserDetail->shipping_state = $request->shipping_state;
        $UserDetail->shipping_postcode = $request->shipping_postcode;
        $UserDetail->shipping_country = $request->shipping_country;

        $UserDetail->save();


        // Return a success response
        return response()->json([
            'message' => 'Shipping updated successfully.',
            'status' => 'success',
            'shipping_address' => $UserDetail->shipping_address,
            'shipping_city' => $UserDetail->shipping_city,
            'shipping_state' => $UserDetail->shipping_state,
            'shipping_postcode' => $UserDetail->shipping_postcode,
            'shipping_country' => $UserDetail->shipping_country,
        ]);
    }

    public function setting()
    {
        
        $user = auth()->user(); 
        $userDetail = UserDetail::where('user_id', $user->id)->first(); 
    
        return view('frontend.settings.settings', ['user' => $user, 'userDetail' => $userDetail]);
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
  

     public function update(Request $request): RedirectResponse
{
    try {
        // Get the authenticated user's ID
        $userId = auth()->user()->id;

        // Validate the input with unique constraint ignoring the current user's username
        $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Find the user by ID
        $user = User::findOrFail($userId);

        // Update basic user details
        $user->name = $request->input('name', $user->name);
        $user->phone = $request->input('phone', $user->phone);
        $user->username = $request->input('username', $user->username);
        $user->save();

        // Update user details in the user_details table
        UserDetail::updateOrCreate(
            ['user_id' => $userId],
            $request->only([
                'company', 'website', 'billing_address', 'billing_city', 'billing_state', 'billing_country', 'billing_postcode',
                'shipping_address', 'shipping_city', 'shipping_state', 'shipping_country', 'shipping_postcode'
            ])
        );

        // Handle profile image upload if provided
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = $userId . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_images', $imageName);
            $user->image = 'profile_images/' . $imageName;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    } catch (\Exception $e) {
        \Log::error('Error updating profile: ' . $e->getMessage());

        return redirect()->back()->with('error', 'An error occurred while updating profile.');
    }
}



    public function ngo()
    {
        $userId = Auth::id();
        $ngoInfo = NGO::where('user_id', $userId)
                    ->select( 'establishment', 'abn', 'acnc', 'gst', 'size')
                    ->first();
    
        return view('frontend.settings.ngo_info', compact('ngoInfo'));
    } 
     

    public function ngoUpdate(Request $request)
    {
        $userId = Auth::id();

        $rules = [
            'establishment' => 'nullable|string|max:10',
            'abn' => 'nullable|string|max:55',
            'acnc' => 'nullable|string|max:55',
            'gst' => 'nullable|string|max:55',
            'size' => 'nullable|string|max:55',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $ngoInfo = NGO::where('user_id', $userId)->first();

        if ($ngoInfo) {
            $ngoInfo->update([
                'establishment' => $request->input('establishment'),
                'abn' => $request->input('abn'),
                'acnc' => $request->input('acnc'),
                'gst' => $request->input('gst'),
                'size' => $request->input('size'),
            ]);

            $ngoInfo = NGO::where('user_id', $userId)->first();

            return response()->json([
                'message' => 'NGO info updated successfully.',
                'status' => 'success',
                'establishment' => $ngoInfo->establishment,
                'abn' => $ngoInfo->abn,
                'acnc' => $ngoInfo->acnc,
                'gst' => $ngoInfo->gst,
                'size' => $ngoInfo->size,
            ]);
        }

        return response()->json([
            'message' => 'NGO not found.',
            'status' => 'error',
        ], 404);
    }

  

    public function ngoMain()
    {
        $userId = Auth::id();
        
        $ngoInfo = NGO::where('user_id', $userId)
                    ->with('images') 
                    ->select('id', 'ngo_name', 'logo_path', 'cat_id', 'ngo_description') 
                    ->first();
        
        $categories = NgoCategory::all();
        
        return view('frontend.settings.ngo_main', compact('ngoInfo', 'categories'));
    }
        
    public function ngoMainInfoUpdate(Request $request)
    {
        $userId = Auth::id();

        $rules = [
            'ngo_name' => 'required|string|max:255',
            'category' => 'nullable|exists:ngo_categories,id',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'other_images' => 'nullable|array',
            'other_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'ngo_description' => 'nullable|string',
            'images_to_remove' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $ngoInfo = NGO::where('user_id', $userId)->first();

        if ($ngoInfo) {
            // Update existing NGO record
            $logoPath = $ngoInfo->logo_path;

            if ($request->hasFile('logo_path')) {
                if ($ngoInfo->logo_path && Storage::disk('public')->exists($ngoInfo->logo_path)) {
                    Storage::disk('public')->delete($ngoInfo->logo_path);
                }

                $logoPath = $request->file('logo_path')->store('ngo', 'public');
            }

            $ngoInfo->update([
                'ngo_name' => $request->input('ngo_name'),
                'cat_id' => $request->input('category'),
                'logo_path' => $logoPath,
                'ngo_description' => $request->input('ngo_description'),
            ]);

            // Handle image removal
            if ($request->input('images_to_remove')) {
                $imagesToRemove = explode(',', $request->input('images_to_remove'));
                foreach ($imagesToRemove as $imageId) {
                    $image = NgoImage::find($imageId);
                    if ($image) {
                        // Delete the image file from storage
                        if (Storage::disk('public')->exists($image->image_path)) {
                            Storage::disk('public')->delete($image->image_path);
                        }

                        $image->delete();
                    }
                }
            }

           if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $file) {
                    $imagePath = $file->store('ngo', 'public');
                    $ngoInfo->images()->create(['image_path' => $imagePath]);
                }
            }

            return response()->json([
                'message' => 'NGO info updated successfully.',
                'status' => 'success',
                'ngo_info' => $ngoInfo->load('images', 'category')
            ]);
        } else {
            $logoPath = null;

            if ($request->hasFile('logo_path')) {
                $logoPath = $request->file('logo_path')->store('ngo', 'public');
            }

            $ngoInfo = NGO::create([
                'ngo_name' => $request->input('ngo_name'),
                'user_id' => $userId,
                'cat_id' => $request->input('category'),
                'logo_path' => $logoPath,
                'ngo_description' => $request->input('ngo_description'),
            ]);

            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $file) {
                    $imagePath = $file->store('ngo', 'public');
                    $ngoInfo->images()->create(['image_path' => $imagePath]);
                }
            }

            return response()->json([
                'message' => 'NGO info added successfully.',
                'status' => 'success',
                'ngo_info' => $ngoInfo->load('images', 'category')
            ]);
        }
    }




    public function ngoAddress()
    {
        $userId = Auth::id();
        $ngoInfo = NGO::where('user_id', $userId)
                    ->select( 'ngo_address', 'ngo_city','ngo_state','ngo_country','contact_phone')
                    ->first();
    
        return view('frontend.settings.ngo_address', compact('ngoInfo'));
    }

    public function ngoAddressUpdate(Request $request)
    {
        $userId = Auth::id();

        $rules = [
            'ngo_address' => 'nullable|string|max:255',
            'ngo_city' => 'nullable|string|max:255',
            'ngo_state' => 'nullable|string|max:255',
            'ngo_country' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:25',  // Corrected this rule
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $ngoInfo = NGO::where('user_id', $userId)->first();

        if ($ngoInfo) {
            $ngoInfo->update([
                'ngo_address' => $request->input('ngo_address'),
                'ngo_city' => $request->input('ngo_city'),
                'ngo_state' => $request->input('ngo_state'),
                'ngo_country' => $request->input('ngo_country'),
                'contact_phone' => $request->input('contact_phone'),
            ]);

            // Return the updated data without re-fetching from the database
            return response()->json([
                'message' => 'NGO info updated successfully.',
                'status' => 'success',
                'ngo_address' => $ngoInfo->ngo_address,
                'ngo_city' => $ngoInfo->ngo_city,
                'ngo_state' => $ngoInfo->ngo_state,
                'ngo_country' => $ngoInfo->ngo_country,
                'contact_phone' => $ngoInfo->contact_phone,
            ]);
        }

        return response()->json([
            'message' => 'NGO not found.',
            'status' => 'error',
        ], 404);
    }

    public function ngoSocial()
    {
        $userId = Auth::id();
        $ngoInfo = NGO::where('user_id', $userId)
                    ->select( 'website_url', 'facebook_url','twitter_url','instagram_url','linkedin_url')
                    ->first();
    
        return view('frontend.settings.ngo_social', compact('ngoInfo'));
    }

    public function ngoSocialUpdate(Request $request)
    {
        $userId = Auth::id();

        $rules = [
            'website_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $ngoInfo = NGO::where('user_id', $userId)->first();

        if ($ngoInfo) {
            $ngoInfo->update($request->only([
                'website_url',
                'facebook_url',
                'twitter_url',
                'instagram_url',
                'linkedin_url',
            ]));

            return response()->json([
                'message' => 'NGO Social info updated successfully.',
                'status' => 'success',
                'data' => $ngoInfo,
            ]);
        }

        return response()->json([
            'message' => 'NGO not found.',
            'status' => 'error',
        ], 404);
    }


    public function ngoTeamMembers()
    {
        
        $user = Auth::user();
        $userId = Auth::id();
        
        $ngoInfo = NGO::where('user_id', $userId)->first();
        
        $ngoMembers = null;

        if ($ngoInfo) {
            $ngoMembers = NgoMember::where('ngo_id', $ngoInfo->id)->get();
        }
        // Pass both to the view
        return view('frontend.settings.ngo_team', compact('ngoMembers', 'ngoInfo'));
    }

    public function addMember(Request $request)
    {
        $validated = $request->validate([
            'ngo_id' => 'required|exists:ngos,id',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $ngoMember = new NgoMember();
        $ngoMember->ngo_id = $validated['ngo_id'];
        $ngoMember->name = $validated['name'];
        $ngoMember->designation = $validated['designation'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/ngo_members', 'public');
            $ngoMember->image = $imagePath;
        }

        $ngoMember->save();

        return response()->json([
            'message' => 'Member added successfully.',
            'status' => 'success',
            'member' => $ngoMember,
            'image_url' => $ngoMember->image ? asset('storage/' . $ngoMember->image) : null,
        ]);
    }


    public function editMember($id)
{
    $member = NgoMember::findOrFail($id);
    return view('frontend.settings.edit_member', compact('member'));
}

public function updateMember(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'designation' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $member = NgoMember::findOrFail($id);
    $member->name = $request->input('name');
    $member->designation = $request->input('designation');

    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($member->image && Storage::exists($member->image)) {
            Storage::delete($member->image);
        }
        // Store new image
        $imagePath = $request->file('image')->store('images/ngo_members', 'public');
        $member->image = $imagePath;
    }

    $member->save();

    return redirect()->route('ngo.team')->with('success', 'Member updated successfully.');
}

public function deleteMember($id)
{
    $member = NgoMember::findOrFail($id);

    // Delete image if it exists
    if ($member->image && Storage::exists($member->image)) {
        Storage::delete($member->image);
    }

    $member->delete();

    return redirect()->route('ngo.team')->with('success', 'Member deleted successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //
    }
}
