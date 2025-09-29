<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\UserBusinessInfos;
use App\Models\AdPost;
use App\Models\User;
use App\Models\UserBusinessHour;
use App\Models\BusinessProduct;
use App\Models\Event;
use App\Models\Enquiry;
use App\Models\BusinessCategory;
use Illuminate\Support\Facades\Crypt;
use App\Models\BusinessImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Models\Language; 
use Illuminate\Support\Facades\Storage;

class BusinessInfoController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = Auth::user();
        
        $businessDetail = UserBusinessInfos::with('languages', 'deals')->where('user_id', $userId)->first();

        $businessHour = null;
        $hours = [];
        $selectedLanguages = [];
        $deals = [];
        $selectedCategoryId = null;

        if ($businessDetail) {
            $businessHour = UserBusinessHour::where('user_business_info_id', $businessDetail->id)->first();

            if ($businessHour) {
                $hours = [
                    'monday' => $this->splitTime($businessHour->monday),
                    'tuesday' => $this->splitTime($businessHour->tuesday),
                    'wednesday' => $this->splitTime($businessHour->wednesday),
                    'thursday' => $this->splitTime($businessHour->thursday),
                    'friday' => $this->splitTime($businessHour->friday),
                    'saturday' => $this->splitTime($businessHour->saturday),
                    'sunday' => $this->splitTime($businessHour->sunday),
                ];
            }

            $selectedLanguages = $businessDetail->languages->pluck('name')->toArray();
            $deals = $businessDetail->deals->pluck('deal');
            $selectedCategoryId = $businessDetail->business_category;
        }

        $allLanguages = Language::where('languageable_type', UserBusinessInfos::class)->distinct()->get(['name']);

        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');

        return view('frontend.business.business_info', compact('businessDetail', 'businessHour', 'hours', 'deals', 'allLanguages', 'selectedLanguages', 'selectedCategoryId','is_approved','businessName'));
    }

    private function splitTime($timeRange)
    {
        if ($timeRange === '24 Hours') {
            return [
                'start' => '',
                'end' => '',
                'is_24h' => true,
            ];
        } elseif ($timeRange) {
            $times = explode(' - ', $timeRange);
            return [
                'start' => $times[0] ?? '',
                'end' => $times[1] ?? '',
                'is_24h' => false,
            ];
        }

        return [
            'start' => '',
            'end' => '',
            'is_24h' => false,
        ];
    }


 
    public function store(Request $request)
    {
        $userid = Auth::id();
        if (!$userid) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255',
            'business_category' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'establish_year' => 'nullable|date_format:Y',
            'deals' => 'nullable|array',
            'languages' => 'nullable|array',
            'languages.*' => 'string|max:255',
            'abn' => 'nullable|string|max:20',
            'business_address' => 'nullable|string|max:255',
            'business_city' => 'required|string|max:255',
            'business_state' => 'nullable|string|max:255',
            'business_country' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'business_description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'other_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'monday_start' => 'nullable|string',
            'monday_end' => 'nullable|string',
            'monday_24h' => 'nullable|boolean',
            'tuesday_start' => 'nullable|string',
            'tuesday_end' => 'nullable|string',
            'tuesday_24h' => 'nullable|boolean',
            'wednesday_start' => 'nullable|string',
            'wednesday_end' => 'nullable|string',
            'wednesday_24h' => 'nullable|boolean',
            'thursday_start' => 'nullable|string',
            'thursday_end' => 'nullable|string',
            'thursday_24h' => 'nullable|boolean',
            'friday_start' => 'nullable|string',
            'friday_end' => 'nullable|string',
            'friday_24h' => 'nullable|boolean',
            'saturday_start' => 'nullable|string',
            'saturday_end' => 'nullable|string',
            'saturday_24h' => 'nullable|boolean',
            'sunday_start' => 'nullable|string',
            'sunday_end' => 'nullable|string',
            'sunday_24h' => 'nullable|boolean',
        ],[
            'logo.max' => 'Logo size must not exceed 5 MB.',
            'logo.image' => 'Logo must be a valid image file.',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg, gif, webp.',
        
            'other_images.*.max' => 'Each image size must not exceed 5 MB.',
            'other_images.*.image' => 'Each file must be a valid image.',
            'other_images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif, webp.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        try {
            if ($request->hasFile('logo')) {
                $validated['logo_path'] = $request->file('logo')->store("logos/{$userid}", 'public');
            }

            $validated['user_id'] = $userid;
            $validated['status'] = 0;
            $validated['slug'] = $this->generateUniqueSlug($validated['business_name']);

            $businessInfo = UserBusinessInfos::create($validated);

            if ($request->has('languages')) {
                $languages = array_map(fn($name) => ['name' => $name], $request->languages);
                $businessInfo->languages()->createMany($languages);
            }

            if ($request->has('deals')) {
                $deals = array_map(fn($deal) => ['deal' => $deal], $request->deals);
                $businessInfo->deals()->createMany($deals);
            }

            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $file) {
                    $path = $file->store("business_images/{$businessInfo->id}", 'public');
                    BusinessImage::create([
                        'user_business_infos_id' => $businessInfo->id,
                        'image_path' => $path,
                    ]);
                }
            }

            $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
            $hourData = [
                'user_business_info_id' => $businessInfo->id,
                'user_id' => $userid,
            ];
            foreach ($days as $day) {
                $is24h = $request->boolean($day . '_24h');
                $start = $request->input($day . '_start');
                $end = $request->input($day . '_end');
                if ($is24h) {
                    $hourData[$day] = "24 Hours";
                } elseif ($start && $end) {
                    $hourData[$day] = $start . ' - ' . $end;
                } elseif ($start || $end) {
                    $hourData[$day] = trim($start . ' - ' . $end, ' -');
                } else {
                    $hourData[$day] = null;
                }
            }

            \Log::info('Saving business hours for business_info_id: ' . $businessInfo->id);
            \Log::info('Hour data:', $hourData);

            UserBusinessHour::updateOrCreate(
                ['user_business_info_id' => $businessInfo->id],
                $hourData
            );

            $hours = UserBusinessHour::where('user_business_info_id', $businessInfo->id)->first();
            \Log::info('Hours after save:', $hours ? $hours->toArray() : []);

            User::where('id', $userid)->update(['account_type' => 2]);
            

            return response()->json([
                'message' => 'Business information saved successfully.',
                'business_id' => Crypt::encrypt($businessInfo->id),
                'status' => 'success'
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while saving business information.', 'error' => $e->getMessage()], 500);
        }
    }


    private function generateUniqueSlug($businessName)
    {
        $slug = Str::slug($businessName);
        $count = UserBusinessInfos::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }



    public function update(Request $request, $id)
    {
        try {
            $id = Crypt::decrypt($request->input('id'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid business ID.'], 422);
        }

        $userid = Auth::id();
        $businessInfo = UserBusinessInfos::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255',
            'business_category' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'establish_year' => 'nullable|date_format:Y',
            'deals' => 'nullable|array',
            'languages' => 'nullable|array',
            'abn' => 'nullable|string|max:20',
            'business_address' => 'nullable|string|max:255',
            'business_city' => 'required|string|max:255',
            'business_state' => 'nullable|string|max:255',
            'business_country' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'business_description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'other_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'monday_start' => 'nullable|string',
            'monday_end' => 'nullable|string',
            'monday_24h' => 'nullable|boolean',
            'tuesday_start' => 'nullable|string',
            'tuesday_end' => 'nullable|string',
            'tuesday_24h' => 'nullable|boolean',
            'wednesday_start' => 'nullable|string',
            'wednesday_end' => 'nullable|string',
            'wednesday_24h' => 'nullable|boolean',
            'thursday_start' => 'nullable|string',
            'thursday_end' => 'nullable|string',
            'thursday_24h' => 'nullable|boolean',
            'friday_start' => 'nullable|string',
            'friday_end' => 'nullable|string',
            'friday_24h' => 'nullable|boolean',
            'saturday_start' => 'nullable|string',
            'saturday_end' => 'nullable|string',
            'saturday_24h' => 'nullable|boolean',
            'sunday_start' => 'nullable|string',
            'sunday_end' => 'nullable|string',
            'sunday_24h' => 'nullable|boolean',
        ], [
            'logo.max' => 'Logo size must not exceed 5 MB.',
            'logo.image' => 'Logo must be a valid image file.',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg, gif, webp.',

            'other_images.*.max' => 'Each image size must not exceed 5 MB.',
            'other_images.*.image' => 'Each file must be a valid image.',
            'other_images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif, webp.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        if ($request->hasFile('logo')) {
            if ($businessInfo->logo_path) {
                Storage::delete($businessInfo->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        $businessInfo->fill($validated)->save();

        if ($request->has('languages')) {
            $existingLanguages = $businessInfo->languages()->pluck('name')->toArray();
            $newLanguages = $request->input('languages', []);

            $languagesToDelete = array_diff($existingLanguages, $newLanguages);
            $businessInfo->languages()->whereIn('name', $languagesToDelete)->delete();

            $languagesToAdd = array_diff($newLanguages, $existingLanguages);
            foreach ($languagesToAdd as $languageName) {
                $businessInfo->languages()->create(['name' => $languageName]);
            }
        }

        if ($request->has('deals')) {
            $existingDeals = $businessInfo->deals()->pluck('deal')->toArray();
            $newDeals = $request->input('deals', []);

            $dealsToDelete = array_diff($existingDeals, $newDeals);
            $businessInfo->deals()->whereIn('deal', $dealsToDelete)->delete();

            $dealsToAdd = array_diff($newDeals, $existingDeals);
            foreach ($dealsToAdd as $deal) {
                $businessInfo->deals()->create(['deal' => $deal]);
            }
        }

        if ($request->hasFile('other_images')) {
            foreach ($request->file('other_images') as $file) {
                $path = $file->store('public/business');
                BusinessImage::create([
                    'user_business_infos_id' => $businessInfo->id,
                    'image_path' => $path,
                ]);
            }
        }

        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        $hourData = [
            'user_business_info_id' => $businessInfo->id,
            'user_id' => $userid,
        ];

        foreach ($days as $day) {
            $is24h = $request->boolean($day . '_24h');
            $start = $request->input($day . '_start');
            $end = $request->input($day . '_end');
            if ($is24h) {
                $hourData[$day] = "24 Hours";
            } elseif ($start && $end) {
                $hourData[$day] = $start . ' - ' . $end;
            } elseif ($start || $end) {
                $hourData[$day] = trim($start . ' - ' . $end, ' -');
            } else {
                $hourData[$day] = null;
            }
        }

        UserBusinessHour::updateOrCreate(
            ['user_business_info_id' => $businessInfo->id],
            $hourData
        );

        return response()->json(['message' => 'Business information updated successfully.']);
    }



    public function deleteImage(Request $request)
    {
        $imageId = $request->input('image_id');
        
        $image = BusinessImage::find($imageId);

        if (!$image) {
            return response()->json(['error' => 'Image not found.'], 404);
        }

        if (Storage::exists($image->image_path)) {
            Storage::delete($image->image_path);
        }

        $image->delete();

        return response()->json(['message' => 'Image deleted successfully.']);
    }



    public function storeHour(Request $request)
    {
        $userId = Auth::id();

        // Find the user's business info record
        $userBusinessInfo = UserBusinessInfos::where('user_id', $userId)->first();

        if (!$userBusinessInfo) {
            return response()->json(['error' => 'Business information not found.'], 404);
        }

        // Validate the request data
        $validated = $request->validate([
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
            'monday' => 'nullable|string',
            'tuesday' => 'nullable|string',
            'wednesday' => 'nullable|string',
            'thursday' => 'nullable|string',
            'friday' => 'nullable|string',
            'saturday' => 'nullable|string',
            'sunday' => 'nullable|string',
        ]);

        $validated['user_business_info_id'] = $userBusinessInfo->id;

        // Create new business hours
        UserBusinessHour::create($validated);

        return response()->json(['message' => 'Business hours saved successfully.']);
    }
    

    

    public function updateHour(Request $request, $id)
    {
        $userId = Auth::id();

        $userBusinessInfo = UserBusinessInfos::where('user_id', $userId)->first();

        if (!$userBusinessInfo) {
            return response()->json(['error' => 'Business information not found.'], 404);
        }

        // Validate the request data
        $validated = $request->validate([
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
            'monday' => 'nullable|string',
            'tuesday' => 'nullable|string',
            'wednesday' => 'nullable|string',
            'thursday' => 'nullable|string',
            'friday' => 'nullable|string',
            'saturday' => 'nullable|string',
            'sunday' => 'nullable|string',
        ]);

        $validated['user_id'] = $userId;

        $businessHoursData = [
            'monday' => $validated['monday'] ?? "{$validated['monday_start']} - {$validated['monday_end']}",
            'tuesday' => $validated['tuesday'] ?? "{$validated['tuesday_start']} - {$validated['tuesday_end']}",
            'wednesday' => $validated['wednesday'] ?? "{$validated['wednesday_start']} - {$validated['wednesday_end']}",
            'thursday' => $validated['thursday'] ?? "{$validated['thursday_start']} - {$validated['thursday_end']}",
            'friday' => $validated['friday'] ?? "{$validated['friday_start']} - {$validated['friday_end']}",
            'saturday' => $validated['saturday'] ?? "{$validated['saturday_start']} - {$validated['saturday_end']}",
            'sunday' => $validated['sunday'] ?? "{$validated['sunday_start']} - {$validated['sunday_end']}",
            'user_business_info_id' => $userBusinessInfo->id,
            'user_id' => $userId,
        ];

        $businessHour = UserBusinessHour::where('user_business_info_id', $userBusinessInfo->id)->first();

        if ($businessHour) {
            $businessHour->update($businessHoursData);
            return response()->json(['message' => 'Business hours updated successfully.']);
        } else {
            UserBusinessHour::create($businessHoursData);
            return response()->json(['message' => 'Business hours created successfully.']);
        }
    }



    protected function validateBusinessInfo(Request $request, $businessInfoId = null)
    {
        $rules = [
            'business_name' => 'required|string|max:255',
            'business_type' => 'nullable|string|max:255',
            'business_address' => 'nullable|string|max:255',
            'business_description' => 'nullable|string',
            'website_url' => 'nullable|string|max:255',
            'social_media_links' => 'nullable|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:255',
            'abn' => 'nullable|string|max:255|unique:user_business_infos,abn,' . $businessInfoId,
            'acn' => 'nullable|string|max:255|unique:user_business_infos,acn,' . $businessInfoId,
            'gst' => 'nullable|string|max:255|unique:user_business_infos,gst,' . $businessInfoId,
            'vat' => 'nullable|string|max:255|unique:user_business_infos,vat,' . $businessInfoId,
            'logo' => 'nullable|image|max:5120',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            \Log::error('Validation failed: ', $validator->errors()->toArray());
            
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }

    protected function validateHourInfo(Request $request, $businessInfoId = null)
    {
        $rules = [
            'monday' => 'nullable|string|max:255',
            'tuesday' => 'nullable|string|max:255',
            'wednesday' => 'nullable|string|max:255',
            'thursday' => 'nullable|string|max:255',
            'friday' => 'nullable|string|max:255',
            'saturday' => 'nullable|string|max:255',
            'sunday' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            \Log::error('Validation failed: ', $validator->errors()->toArray());
            
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }

    public function productDetailsByURL($itemUrl)
    {
        $validator = Validator::make(['item_url' => $itemUrl], [
            'item_url' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = BusinessProduct::where('item_url', $itemUrl)
                          ->with(['UserBusinessInfos', 'category', 'subcategory'])
                          ->firstOrFail();

        // Check product status and owner
    if ($product->status == 0) {
        $userId = auth()->id();
        if (!$userId || $product->UserBusinessInfos->user_id != $userId) {
            return redirect()->route('home')->with('error', 'You do not have permission to view this product.');
        }
    }
    
        $totalProductCount = 0;
        if ($product->UserBusinessInfos) {
            $totalProductCount = $product->UserBusinessInfos->products->count();
        }

        return view('website.business.product.details', compact('product','totalProductCount'));
    }


    public function showBusinessEnquiries(Request $request, $business_name) {
        // Retrieve the business details by the slug (business_name)
        $business = UserBusinessInfos::where('slug', $business_name)->firstOrFail();
        // Retrieve the enquiries related to the business with 'businessappointment' module
        $enquiries = Enquiry::with('enquiryable')
            ->where('enquiryable_id', $business->id)
            ->where('module', 'businessappointment')  // Ensure you're filtering by 'businessappointment' module
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Get the current authenticated user
        $user = Auth::user();
        $userId = Auth::id();
    
        // Check if the user is approved by the admin
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;
    
        // Get the business name associated with the authenticated user
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');
    
        // Pass the data to the view
        return view('frontend.business.business_enquiries', compact('business', 'enquiries', 'business_name', 'is_approved', 'businessName'));
    }
    
    
    public function deleteEnquiry($id) {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();
        
        return response()->json(['success' => 'Enquiry deleted successfully.']);
    }

    public function searchBusinessCategory(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $categories = BusinessCategory::where('name', 'like', '%' . $searchTerm . '%')->get();

        $result = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'text' => $category->name,
            ];
        });

        return response()->json($result);
    }


    
}
