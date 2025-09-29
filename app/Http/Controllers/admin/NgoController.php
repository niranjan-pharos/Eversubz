<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\Language;
use App\Models\Ngo;
use App\Models\User; 
use App\Models\NgoImage; 
use App\Models\NgoCategory;

class NgoController extends Controller
{
    public function ngoByAdmin(){
        $breadcrumbs = [ 
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Add NGO By Admin',
                'url' => null
            ],
        ]; 
        
        return view('admin.ngo.ngo_list',compact('breadcrumbs'));
        
    }

    public function fetchNgoData(){
        $result = ['data' => []]; 

        $posts = Ngo::where('created_by_admin',1)->orderBy('id', 'desc')->get();
  
        foreach ($posts as $key => $post) {
            $buttons = ''; 
    
            // $buttons .= '<a href="' . route('editNgoData', ['id' => $post->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil" title="Edit products"></i></a>';

            // $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $post->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            
            if($post->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-ngo-status" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{ 
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-ngo-status" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }
            
            $image = (!empty($post->logo_path) ? asset('storage/'.$post->logo_path) :  asset('storage/no-image.jpg'));

            if($post->feature == 1) {
                $feature = '<div class="form-check form-switch">
                <input class="form-check-input change-ngo-feature" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{ 
                $feature = '<div class="form-check form-switch">
                <input class="form-check-input change-ngo-feature" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }
            
            $icon = '<img class="img img-thumbnail ngo_list_logo" style="width:70px; height:70px;" src="' . $image . '" >' ."&nbsp;". $post->ngo_name;

            $address = mb_strlen($post->ngo_address) > 25 ? mb_substr($post->ngo_address, 0, 25) . '...' : $post->ngo_address;

           
            $dropdown = '
            <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"><span class="text-ehite"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-25px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="' . route('admin.addNgoMember', ['id' => $post->id]) . '" ><i class="fa fa-user m-r-5"></i> List Team Members</a>
                    <a class="dropdown-item" href="' . route('editNgoData', ['id' => $post->id]) . '" ><i class="fa fa-pencil m-r-5"></i> Edit Ngo</a>
                    <a class="dropdown-item" href="' . route('showNgoData', ['id' => $post->id]) . '" ><i class="fa fa-eye m-r-5"></i> View Ngo</a>
                    <a class="dropdown-item" href="#"  onclick="removeNgoFunc(' . $post->id . ')" data-bs-toggle="modal" data-bs-target="#removeNgoModal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
            </div>'; 

            $result['data'][$key] = [
                'DT_RowId' => 'item-' . $post->id,
                $dropdown,
                $post->user_id,                 // Actions
                $icon,     // NGO Name (use ngo_name, not ->name)
                $post->establishment,      // Establish
                $post->contact_email,      // Email
                $post->contact_phone,      // Contact
                $address,                  // Address
                $status,                   // Status
                $feature                   // Feature
            ];


        }

        return response()->json($result);
    }

    public function addNgo(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'NGO List',
                'url' => route('ngoByAdmin')
            ],
            [
                'label' => 'Add NGO',
                'url' => null
            ],
        ];
        return view('admin.ngo.ngo_list',compact('breadcrumbs'));
    }


    public function storeNgo(Request $request)
    {
            // Log the incoming request for debugging
            Log::info('NGO Creation Request Received', [
                'user_agent' => $request->userAgent(),
                'ip' => $request->ip(),
                'input_data' => $request->except(['password', '_token']), // Exclude sensitive data
                'has_files' => [
                    'logo_path' => $request->hasFile('logo_path'),
                    'other_images' => $request->hasFile('other_images') ? count($request->file('other_images')) : 0
                ]
            ]);

            $validator = Validator::make($request->all(), [
                'ngo_name' => 'required|string|max:255',
                'contact_email' => 'nullable|max:255|unique:users,email',
                'cat_id' => 'required|integer',
                'establishment' => 'nullable|date_format:Y',
                'languages' => 'nullable|array',
                'languages.*' => 'string|max:255',
                'abn' => 'nullable|string|max:255',
                'acnc' => 'nullable|string|max:255',
                'gst' => 'nullable|string|max:255',
                'ngo_address' => 'nullable|string|max:255',
                'ngo_city' => 'required|string|max:255',
                'ngo_state' => 'nullable|string|max:255',
                'ngo_country' => 'nullable|string|max:255',
                'contact_phone' => 'nullable|string|max:20', 
                'website_url' => 'nullable|url|max:255',
                'facebook_url' => 'nullable|url|max:255',
                'twitter_url' => 'nullable|url|max:255',
                'instagram_url' => 'nullable|url|max:255',
                'linkedin_url' => 'nullable|url|max:255',
                'feature' => 'nullable|boolean',
                'orderby' => 'nullable|integer',
                'size' => 'nullable|string',
                'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'other_images' => 'nullable|array',
                'other_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'ngo_description' => 'nullable|string',
                'status' => 'nullable|in:0,1',
            ], [
                'ngo_name.required' => 'The name of the NGO is required.',
                'ngo_name.string' => 'The NGO name must be a valid string.',
                'ngo_name.max' => 'The NGO name cannot be longer than 255 characters.',
                
                'contact_email.email' => 'Please provide a valid email address.',
                'contact_email.max' => 'The email address cannot be longer than 255 characters.',
                'contact_email.unique' => 'This email address is already taken by another user.',
                
                'cat_id.required' => 'Category field is required.',
                'cat_id.integer' => 'The category ID must be a valid integer.',
                
                'establishment.date_format' => 'The establishment year must be in the format YYYY.',
                
                'languages.array' => 'Languages must be an array.',
                'languages.*.string' => 'Each language must be a valid string.',
                'languages.*.max' => 'Each language cannot be longer than 255 characters.',
                
                'abn.string' => 'ABN must be a valid string.',
                'abn.max' => 'ABN cannot be longer than 255 characters.',
                
                'acnc.string' => 'ACNC must be a valid string.',
                'acnc.max' => 'ACNC cannot be longer than 255 characters.',
                
                'gst.string' => 'GST must be a valid string.',
                'gst.max' => 'GST cannot be longer than 255 characters.',
                
                'ngo_address.string' => 'The address must be a valid string.',
                'ngo_address.max' => 'The address cannot be longer than 255 characters.',
                
                'ngo_city.required' => 'The city of the NGO is required.',
                'ngo_city.string' => 'The city name must be a valid string.',
                'ngo_city.max' => 'The city name cannot be longer than 255 characters.',
                
                'ngo_state.string' => 'The state name must be a valid string.',
                'ngo_state.max' => 'The state name cannot be longer than 255 characters.',
                
                'ngo_country.string' => 'The country name must be a valid string.',
                'ngo_country.max' => 'The country name cannot be longer than 255 characters.',
                
                'contact_phone.string' => 'The contact phone number must be a valid string.',
                'contact_phone.max' => 'The contact phone number cannot be longer than 20 characters.',
                
                'website_url.url' => 'The website URL must be a valid URL.',
                'website_url.max' => 'The website URL cannot be longer than 255 characters.',
                
                'facebook_url.url' => 'The Facebook URL must be a valid URL.',
                'facebook_url.max' => 'The Facebook URL cannot be longer than 255 characters.',
                
                'twitter_url.url' => 'The Twitter URL must be a valid URL.',
                'twitter_url.max' => 'The Twitter URL cannot be longer than 255 characters.',
                
                'instagram_url.url' => 'The Instagram URL must be a valid URL.',
                'instagram_url.max' => 'The Instagram URL cannot be longer than 255 characters.',
                
                'linkedin_url.url' => 'The LinkedIn URL must be a valid URL.',
                'linkedin_url.max' => 'The LinkedIn URL cannot be longer than 255 characters.',
                
                'feature.boolean' => 'Feature field must be true or false.',
                
                'orderby.integer' => 'Order field must be a valid integer.',
                
                'size.string' => 'Size must be a valid string.',
                
                'logo_path.image' => 'The logo must be an image.',
                'logo_path.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, svg.',
                'logo_path.max' => 'The logo image size cannot exceed 5MB.',
                
                'other_images.array' => 'Other images must be an array.',
                'other_images.*.image' => 'Each other image must be an image.',
                'other_images.*.mimes' => 'Each other image must be of type: jpeg, png, jpg, gif, svg.',
                'other_images.*.max' => 'Each other image size cannot exceed 5MB.',
                
                'ngo_description.string' => 'The NGO description must be a valid string.',
                
                'status.in' => 'Status must be either 0 (inactive) or 1 (active).',
            ]);

            // Log validation result before checking
            Log::info('Validation completed for NGO creation', [
                'passes' => $validator->passes(),
                'fails' => $validator->fails(),
                'validation_rules' => $validator->getRules()
            ]);

            if ($validator->fails()) {
                // Log detailed validation errors
                $errors = $validator->errors();
                $failedFields = [];
                
                foreach ($errors->toArray() as $field => $messages) {
                    $failedFields[$field] = [
                        'messages' => $messages,
                        'input_value' => $request->input($field),
                        'rule_violations' => []
                    ];
                    
                    // Log specific rule violations
                    foreach ($messages as $message) {
                        // Extract the rule that was violated from the message
                        if (preg_match('/(required|integer|string|url|date_format|boolean|array|image|mimes|max|unique|in)/i', $message, $matches)) {
                            $failedFields[$field]['rule_violations'][] = $matches[1];
                        }
                    }
                }

                Log::warning('NGO Creation Validation Failed', [
                    'request_id' => uniqid('ngo_'),
                    'timestamp' => now()->toISOString(),
                    'failed_fields' => $failedFields,
                    'total_errors' => count($errors->toArray()),
                    'error_summary' => $errors->all(),
                    'user_agent' => $request->userAgent(),
                    'ip_address' => $request->ip()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed. Please check the form and try again.',
                    'errors' => $errors,
                    'debug' => [
                        'failed_fields_count' => count($errors->toArray()),
                        'request_id' => uniqid('ngo_')
                    ]
                ], 422);
            }

            // Log successful validation
            Log::info('NGO Creation Validation Passed', [
                'validated_data' => $request->only(array_keys($validator->getRules())),
                'files_present' => [
                    'logo_path' => $request->hasFile('logo_path'),
                    'other_images_count' => $request->hasFile('other_images') ? count($request->file('other_images')) : 0
                ]
            ]);

            DB::beginTransaction();

            try {
                Log::info('Starting NGO creation process', ['transaction_id' => DB::getPdo()->lastInsertId()]);

                // Create User
                Log::info('Creating user for NGO');
                $userData = [
                    'name' => $request->input('ngo_name'),
                    'email' => $request->input('contact_email'),
                    'password' => Hash::make('@12345678'),
                    'account_type' => 3,
                    'is_admin_approved' => 1,
                ];
                
                Log::debug('User creation data', $userData);
                $user = User::create($userData);
                Log::info('User created successfully', ['user_id' => $user->id]);

                // Create NGO
                Log::info('Creating NGO record');
                $ngoData = [
                    'user_id' => $user->id,
                    'cat_id' => $request->cat_id,
                    'ngo_name' => $request->ngo_name,
                    'size' => $request->size,
                    'contact_email' => $request->contact_email,
                    'establishment' => $request->establishment,
                    'abn' => $request->abn,
                    'acnc' => $request->acnc,
                    'gst' => $request->gst,
                    'ngo_address' => $request->ngo_address,
                    'ngo_city' => $request->ngo_city,
                    'ngo_state' => $request->ngo_state,
                    'ngo_country' => $request->ngo_country,
                    'contact_phone' => $request->contact_phone,
                    'website_url' => $request->website_url,
                    'facebook_url' => $request->facebook_url,
                    'twitter_url' => $request->twitter_url,
                    'instagram_url' => $request->instagram_url,
                    'linkedin_url' => $request->linkedin_url,
                    'feature' => intval($request->feature ?? 0),
                    'orderby' => intval($request->orderby ?? 0),
                    'ngo_description' => $request->ngo_description,
                    'status' => $request->status ?? 1,
                    'created_by_admin' => '1',
                ];

                if ($request->hasFile('logo_path')) {
                    $logoPath = $request->file('logo_path')->store('ngo', 'public');
                    $ngoData['logo_path'] = $logoPath;
                    Log::info('Logo uploaded', ['path' => $logoPath, 'size' => $request->file('logo_path')->getSize()]);
                }

                Log::debug('NGO creation data', $ngoData);
                $ngo = new Ngo();
                $ngo->fill($ngoData);
                $ngo->save();
                
                Log::info('NGO record created successfully', [
                    'ngo_id' => $ngo->id,
                    'user_id' => $user->id
                ]);

                // Handle languages
                if ($request->has('languages') && is_array($request->languages)) {
                    Log::info('Processing languages', ['language_count' => count($request->languages)]);
                    $languageCount = 0;
                    foreach ($request->languages as $languageName) {
                        if (!empty(trim($languageName))) {
                            $ngo->languages()->create(['name' => trim($languageName)]);
                            $languageCount++;
                        }
                    }
                    Log::info('Languages processed', [
                        'total_processed' => $languageCount,
                        'total_received' => count($request->languages)
                    ]);
                }

                // Handle other images
                if ($request->hasFile('other_images')) {
                    $imageCount = 0;
                    Log::info('Processing other images', ['image_count' => count($request->file('other_images'))]);
                    
                    foreach ($request->file('other_images') as $file) {
                        try {
                            $imagePath = $file->store('ngo', 'public');
                            $ngo->images()->create(['image_path' => $imagePath]);
                            $imageCount++;
                            Log::debug('Other image uploaded', [
                                'path' => $imagePath,
                                'size' => $file->getSize(),
                                'mime_type' => $file->getMimeType()
                            ]);
                        } catch (\Exception $fileException) {
                            Log::error('Failed to upload other image', [
                                'file_name' => $file->getClientOriginalName(),
                                'error' => $fileException->getMessage(),
                                'line' => $fileException->getLine()
                            ]);
                            continue; // Continue with other images
                        }
                    }
                    
                    Log::info('Other images processing completed', [
                        'successful_uploads' => $imageCount,
                        'total_files' => count($request->file('other_images'))
                    ]);
                }

                DB::commit();
                
                Log::info('NGO creation completed successfully', [
                    'ngo_id' => $ngo->id,
                    'user_id' => $user->id,
                    'total_languages' => $request->has('languages') ? count($request->languages) : 0,
                    'total_images' => $request->hasFile('other_images') ? count($request->file('other_images')) : 0
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'NGO has been added successfully.',
                    'data' => [
                        'ngo_id' => $ngo->id,
                        'user_id' => $user->id,
                        'ngo_name' => $ngo->ngo_name
                    ]
                ]);

            } catch (\Illuminate\Database\QueryException $dbException) {
                DB::rollBack();
                
                Log::error('Database error during NGO creation', [
                    'ngo_id' => $ngo->id ?? 'not_created',
                    'user_id' => $user->id ?? 'not_created',
                    'error' => $dbException->getMessage(),
                    'sql' => $dbException->getSql(),
                    'bindings' => $dbException->getBindings(),
                    'error_code' => $dbException->getCode(),
                    'line' => $dbException->getLine(),
                    'file' => $dbException->getFile(),
                    'trace' => $dbException->getTraceAsString()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Database error occurred. Please try again.',
                    'error_code' => 'DB_ERROR'
                ], 500);

            } catch (\Illuminate\Filesystem\FilesystemException $fileException) {
                DB::rollBack();
                
                Log::error('File system error during NGO creation', [
                    'user_id' => $user->id ?? 'not_created',
                    'ngo_id' => $ngo->id ?? 'not_created',
                    'error' => $fileException->getMessage(),
                    'line' => $fileException->getLine(),
                    'file' => $fileException->getFile()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'File upload error occurred. Please try again.',
                    'error_code' => 'FILE_ERROR'
                ], 500);

            } catch (\Exception $e) {
                DB::rollBack();
                
                Log::error('Unexpected error during NGO creation', [
                    'user_id' => $user->id ?? 'not_created',
                    'ngo_id' => $ngo->id ?? 'not_created',
                    'error' => $e->getMessage(),
                    'error_code' => $e->getCode(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                    'trace' => $e->getTraceAsString(),
                    'request_data' => $request->except(['password', '_token'])
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while creating the NGO. Please try again.',
                    'error_code' => 'GENERAL_ERROR'
                    ], 500);
                }
            }


    public function changeNgoStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|in:true,false,1,0,"1","0"',
        ]);

        try {
            $ngo = Ngo::findOrFail($request->id);

            $newStatus = $ngo->status == 0 ? 1 : 0;

            $ngo->status = $newStatus;
            $ngo->save();

            return response()->json(['message' => 'NGO Status changed']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the status.'], 500);
        }
    }


    public function changeNgoFeature(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'feature' => 'required|in:true,false,1,0,"1","0"',
        ]);

        try {
            $ngo = Ngo::findOrFail($request->id);

            $newStatus = $ngo->feature == 0 ? 1 : 0;

            $ngo->feature = $newStatus;
            $ngo->save();

            return response()->json(['message' => 'NGO feature changed']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the feature.'], 500);
        }
    }

    public function editNgo(Request $request)
    {
        $ngo_id = $request->id;

        // Eager load the 'languages' and 'images' relationships with only the required columns
        $ngoInfo = Ngo::with([
            'languages:id,languageable_id,languageable_type,name', 
            'images:id,ngo_id,image_path'
        ])->find($ngo_id);
        
        if (!$ngoInfo) {
            return redirect()->route('ngoByAdmin')->with('error', 'NGO not found.');
        }

        // Fetch all distinct language names
        $allLanguages = Language::select('name', 'id')
                        ->groupBy('name')
                        ->distinct()
                        ->get();

        // Check if languages relationship is loaded and not null
        $selectedLanguages = DB::table('languages')
                        ->where('languageable_id', $ngo_id)
                        ->where('languageable_type', 'App\Models\Ngo')
                        ->distinct()
                        ->pluck('name')
                        ->toArray();

        // Fetch categories
        $categories = NgoCategory::all();

        // Define breadcrumbs for navigation
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'NGO List',
                'url' => route('ngoByAdmin')
            ],
            [
                'label' => 'Edit NGO',
                'url' => null
            ],
        ];

        return view('admin.ngo.edit_ngo', compact('breadcrumbs', 'allLanguages', 'selectedLanguages', 'ngoInfo', 'categories'));
    }



    public function updateNgo(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'ngo_name' => 'required|string|max:255',
                'contact_email' => 'required|email|max:255',
                'establishment' => 'nullable|integer',
                'cat_id' => 'required|integer',
                'languages' => 'nullable|array',
                'languages.*' => 'string|max:255',
                'abn' => 'nullable|string|max:255',
                'acnc' => 'nullable|string|max:255',
                'gst' => 'nullable|string|max:255',
                'ngo_address' => 'nullable|string|max:255',
                'ngo_city' => 'required|string|max:255',
                'ngo_state' => 'nullable|string|max:255',
                'ngo_country' => 'nullable|string|max:255',
                'contact_phone' => 'nullable|string|max:20',
                'website_url' => 'nullable|url|max:255',
                'facebook_url' => 'nullable|url|max:255',
                'twitter_url' => 'nullable|url|max:255',
                'instagram_url' => 'nullable|url|max:255',
                'linkedin_url' => 'nullable|url|max:255',
                'feature' => 'nullable|boolean',
                'size' => 'nullable|string',
                'orderby' => 'nullable|integer',
                'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'other_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'ngo_description' => 'nullable|string',
            ], [
                'ngo_name.required' => 'The NGO name is required.',
                'ngo_name.string' => 'The NGO name must be a valid string.',
                'ngo_name.max' => 'The NGO name cannot exceed 255 characters.',
                'contact_email.required' => 'The contact email is required.',
                'contact_email.email' => 'Please provide a valid email address.',
                'contact_email.max' => 'The contact email cannot exceed 255 characters.',
                'cat_id.required' => 'The category ID is required.',
                'cat_id.integer' => 'The category ID must be a valid number.',
                'ngo_city.required' => 'The city is required.',
                'ngo_city.string' => 'The city must be a valid string.',
                'ngo_city.max' => 'The city name cannot exceed 255 characters.',
                'languages.array' => 'Languages must be provided as an array.',
                'languages.*.string' => 'Each language must be a valid string.',
                'languages.*.max' => 'Each language name cannot exceed 255 characters.',
                'logo_path.image' => 'The logo must be a valid image file.',
                'logo_path.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif.',
                'logo_path.max' => 'The logo file size cannot exceed 5MB.',
                'other_images.*.image' => 'Each additional image must be a valid image file.',
                'other_images.*.mimes' => 'Additional images must be of type: jpeg, png, jpg, gif.',
                'other_images.*.max' => 'Each additional image file size cannot exceed 5MB.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $ngo = Ngo::findOrFail($id);

            $ngo->ngo_name = $request->ngo_name;
            $ngo->contact_email = $request->contact_email;
            $ngo->cat_id = $request->cat_id;
            $ngo->establishment = $request->establishment;
            $ngo->abn = $request->abn;
            $ngo->acnc = $request->acnc;
            $ngo->gst = $request->gst;
            $ngo->size = $request->size;
            $ngo->ngo_address = $request->ngo_address;
            $ngo->ngo_city = $request->ngo_city;
            $ngo->ngo_state = $request->ngo_state;
            $ngo->ngo_country = $request->ngo_country;
            $ngo->contact_phone = $request->contact_phone;
            $ngo->website_url = $request->website_url;
            $ngo->facebook_url = $request->facebook_url;
            $ngo->twitter_url = $request->twitter_url;
            $ngo->instagram_url = $request->instagram_url;
            $ngo->linkedin_url = $request->linkedin_url;
            $ngo->feature = $request->feature ?? 0;
            $ngo->orderby = $request->orderby;
            $ngo->ngo_description = $request->ngo_description;

            if ($request->hasFile('logo_path')) {
                if ($ngo->logo_path && Storage::disk('public')->exists($ngo->logo_path)) {
                    Storage::disk('public')->delete($ngo->logo_path);
                }
                $ngo->logo_path = $request->logo_path->store('ngo', 'public');
            }

            $ngo->save();

            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $file) {
                    $imagePath = $file->store('ngo', 'public');
                    $ngo->images()->create(['image_path' => $imagePath]);
                }
            }

            if ($request->has('languages')) {
                $ngo->languages()->where('languageable_id', $ngo->id)->delete();
                foreach ($request->languages as $languageName) {
                    $ngo->languages()->create(['name' => $languageName]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'NGO updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating NGO', ['error' => $e->getMessage(), 'ngo_id' => $id]);
            return response()->json(['error' => 'An error occurred while updating the NGO'], 500);
        }
    }

    public function viewNgo(Request $request){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Ngo List',
                'url' => route('ngoByAdmin')
            ],
            [
                'label' => 'NGO Details',
                'url' => null
            ],
        ];
    
        $ngo_id = $request->id; 
    
        $ngoInfo = Ngo::with(['languages'])->find($ngo_id);
        
        return view('admin.ngo.view_ngo', compact('breadcrumbs', 'ngoInfo'));
    }  

    public function searchCategory(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $categories = NgoCategory::where('name', 'like', '%' . $searchTerm . '%')->get();

        $result = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'text' => $category->name,
            ];
        });

        return response()->json($result);
    }


    public function destroyNgo(Request $request)
    {
        try {
            $ngo = Ngo::findOrFail($request->del_id);

            $ngo->languages()->delete();

            if ($ngo->logo_path && \Storage::exists($ngo->logo_path)) {
                \Storage::delete($ngo->logo_path);
            }

            foreach ($ngo->images as $image) {
                if (\Storage::exists($image->image_path)) {
                    \Storage::delete($image->image_path);
                }

                $image->delete();
            }

            $ngo->delete();

            $user = User::findOrFail($ngo->user_id);
            $user->delete();

            return response()->json(['success' => true, 'message' => 'NGO deleted successfully.']);
        } catch (\Exception $e) {
            \Log::error('Error deleting NGO: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while deleting the NGO. Please try again.'], 500);
        }
    }

    public function deletengoImage(Request $request)
    {
        try {
            $imageId = $request->input('image_id');
    
            $image = NgoImage::findOrFail($imageId);
    
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
    
            $image->delete();
    
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function ngoRequest()
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
        return view('admin.ngo.ngo_request', compact('breadcrumbs'));
    }


    public function fetchTableData()
    {
        $result = ['data' => []];
    
        $posts = User::select('users.id', 'users.uid' ,'users.name', 'users.email', 'users.is_admin_approved')
            ->where('account_type', 3)
            ->with(['ngoInfos:id,ngo_name,user_id'])
            ->orderBy('id', 'desc')
            ->get();
    
        foreach ($posts as $key => $post) {
            $ngoId = $post->ngoInfos->id ?? null;
    
            $buttons = '';
            if ($ngoId) {
                $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeBusinessRequestFunc(' . $ngoId . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
    
            $status = $post->is_admin_approved == 1
                ? '<div class="form-check form-switch"><input class="form-check-input changed-ngo-status" data-id="' . $post->id . '" type="checkbox" role="switch" checked></div>'
                : '<div class="form-check form-switch"><input class="form-check-input changed-ngo-status" data-id="' . $post->id . '" type="checkbox" role="switch"></div>';
    
            $dropdown = '<div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">';
    
            if ($ngoId) {
                
                $dropdown .= '<a class="dropdown-item" href="#" onclick="removeBusinessFunc(' . $ngoId . ')" data-bs-toggle="modal" data-bs-target="#removeBusinessModal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                $dropdown .='<a class="dropdown-item" href="' . route('showNgoData', ['id' => $ngoId]) . '" ><i class="fa fa-eye m-r-5"></i> View Ngo</a>';
                $dropdown .=' <a class="dropdown-item" href="' . route('admin.addNgoMember', ['id' => $ngoId]) . '" ><i class="fa fa-user m-r-5"></i> Add Team Members</a>';
            }
    
            $dropdown .= '</div></div>';
    
            $result['data'][] = [
                $dropdown,
                $post->uid,
                $post->name,
                $post->email,
                $post->ngoInfos->ngo_name ?? '-',
                $status,
                $buttons,
            ];
        }
    
        return response()->json($result);
    }
        


    public function changeNgosStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|in:true,false,1,0,"1","0"',
        ]);

        try {
            Log::info('Incoming request data', $request->all());

            $user = User::findOrFail($request->id);

            $ngoInfo = Ngo::where('user_id', $request->id)->first();

            if ($user && $ngoInfo) {
            
                $newStatus = $user->is_admin_approved == 0 ? 1 : 0;

                $ngoInfo->status = $newStatus;
                $ngoInfo->save();

                $user->is_admin_approved = $newStatus;
                $user->save();

                Log::info('Business status updated', ['business_id' => $ngoInfo->id, 'new_status' => $newStatus]);

                return response()->json(['message' => 'User Business Status changed']);
            } else {
                return response()->json(['error' => 'Business information not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error updating business status', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while updating the status.'], 500);
        }
    }

}

