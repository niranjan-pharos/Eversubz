<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Ngo;
use App\Models\User;
use App\Models\Event;
use App\Models\DonationPackage;
use App\Models\DonatePackage;
use App\Models\NgoCategory;
use App\Models\Fundraising;
use Illuminate\Support\Facades\Auth;
use App\Models\FundraisingImage;
use App\Models\FundraisingCategory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Square\SquareClient;
use Square\Models\Money;
use Illuminate\Support\Facades\Mail;
use Square\Models\CreatePaymentRequest;
use Square\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class NgoController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->get('search');
        $states     = $request->get('locations', []); 
        $cities     = $request->get('cities', []);
        $categories = $request->get('categories', []);
        $ngos       = $request->get('ngos', []);
        $titles   = $request->get('titles', []);

        $ngoCategories = NgoCategory::with(['ngos' => function ($query) use ($search, $states, $cities, $ngos) {
            $query->where('status', 1)
                  ->when($search, function ($q) use ($search) {
                      $q->where('ngo_name', 'like', "%{$search}%")
                        ->orWhere('ngo_city', 'like', "%{$search}%")
                        ->orWhere('ngo_state', 'like', "%{$search}%");
                  })
                  ->when(!empty($states), fn($q) => $q->whereIn('ngo_state', $states))
                  ->when(!empty($cities), fn($q) => $q->whereIn('ngo_city', $cities))
                  ->when(!empty($ngos), fn($q) => $q->whereIn('ngo_name', $ngos));
        }])
        ->withCount(['ngos' => function ($query) use ($search, $states, $cities, $ngos) {
            $query->where('status', 1)->take(4)
                  ->when($search, function ($q) use ($search) {
                      $q->where('ngo_name', 'like', "%{$search}%")
                        ->orWhere('ngo_city', 'like', "%{$search}%")
                        ->orWhere('ngo_state', 'like', "%{$search}%");
                  })
                  ->when(!empty($states), fn($q) => $q->whereIn('ngo_state', $states))
                  ->when(!empty($cities), fn($q) => $q->whereIn('ngo_city', $cities))
                  ->when(!empty($ngos), fn($q) => $q->whereIn('ngo_name', $ngos));
        }])
        ->when(!empty($categories), fn($q) => $q->whereIn('name', $categories))
        ->having('ngos_count', '>', 0)
        ->orderBy('ngos_count', 'desc')
        ->get();

        $donationPackages = DonationPackage::select('id', 'name', 'image','status', 'price', 'quantity', 'status', 'created_at', 'updated_at', 'ngo_id')->where('status',1)
            ->orderBy('id', 'desc')
            ->get();


        $locations   = Ngo::where('status', 1)->select('ngo_state')->distinct()->pluck('ngo_state')->filter()->values();

        $cities      = Ngo::where('status', 1)->select('ngo_city')->distinct()->pluck('ngo_city');
        $ngoNames    = Ngo::where('status', 1)->select('ngo_name')->distinct()->pluck('ngo_name');
        $categories  = NgoCategory::select('name')->distinct()->pluck('name');


        // NGOs list
        $ngos = Ngo::with(['category', 'images', 'languages', 'totalmember'])
            ->where('status', '1')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('ngo_name', 'like', "%{$search}%")   
                      ->orWhere('ngo_city', 'like', "%{$search}%") 
                      ->orWhere('ngo_state', 'like', "%{$search}%") 
                      ->orWhereHas('category', function ($q2) use ($search) {
                          $q2->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($ngo) {
                $ngo->member_count = $ngo->user()->count();
                return $ngo;
            });


        // Fundraising campaigns
        $fundraisings = Fundraising::with(['fundraisingImages', 'category'])
        ->where('status', 1)
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('for', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        })
        ->when(!empty($titles), function ($query) use ($titles) {
            $query->whereIn('title', $titles);
        })
        ->when(!empty($categories), function($query) use ($categories) {
            $query->whereHas('category', fn($q) => $q->whereIn('name', $categories));
        })
        ->orderBy('id', 'desc')
        ->paginate(6); // ✅ Load 6 records per page

        // ✅ AJAX response (return HTML snippet directly)
        if ($request->ajax()) {
            $html = '';
            foreach ($fundraisings as $fundraising) {
                $html .= '
                <div class="flex md:items-center space-x-4 p-4 rounded-md box">
                    <div class="sm:w-20 w-14 sm:h-20 h-14 flex-shrink-0 rounded-lg relative">
                        <img loading="eager" src="'.asset('storage/' . $fundraising->main_image).'"
                             class="absolute w-full h-full inset-0 rounded-md object-cover shadow-sm"
                             alt="fundraising image">
                    </div>
                    <div class="flex-1">
                        <a href="'.route('fundaraising.show', $fundraising->slug).'"
                           class="md:text-lg text-base font-semibold capitalize text-black">
                            '.$fundraising->title.'
                        </a>
                        <div class="items-center text-sm font-normal">
                            <div>For - '.$fundraising->for.'</div>
                            <div>Category - '.($fundraising->category->name ?? '-').'</div>
                        </div>
                    </div>
                    <a href="'.route('fundaraising.show', $fundraising->slug).'"
                       class="button bg-primary-soft text-primary gap-1 max-md:hidden">
                        <ion-icon name="add-circle" class="text-xl -ml-1"></ion-icon> View
                    </a>
                </div>
                ';
            }

            return response()->json([
                'html' => $html,
                'hasMore' => $fundraisings->hasMorePages(),
                'nextPage' => $fundraisings->currentPage() + 1,
            ]);
        }


        // get distinct titles and categories for dropdown/filters
        $allTitles = Fundraising::where('status', 1)->pluck('title')->unique();
    


        $joinedNgo       = auth()->check() ? auth()->user()->ngo_id : null;
        $isAuthenticated = Auth::check();
        $isVerified      = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        if ($isAuthenticated && !$is_module_visible) {
            return redirect()->route('user.pending-approval');
        }

        if (! ($isAuthenticated && $isVerified && $is_module_visible)) {
            $ngos          = collect();
            $ngoCategories = collect();
            $fundraisings  = collect();
        }

        if ($request->ajax()) {
            $hasResults = false;
            $html = '';

            $filtersApplied = !empty($search) || !empty($states) || !empty($cities) || !empty($ngos) || !empty($titles) || !empty($categories);

            // Fundraising results only if no filters are applied
            if (!$filtersApplied) {
                foreach ($fundraisings as $fundraising) {
                    if (!$hasResults) {
                        $hasResults = true;
                        $html .= '<div class="grid md:grid-cols-2 md:gap-2 gap-3" id="donorList">';
                    }
                    $html .= '<div class="flex md:items-center space-x-4 p-4 rounded-md box relative">
                                <!-- Top-right badge -->
                                <span class="absolute top-2 right-2 bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full font-bold" style="margin-top: -13%;">
                                    Campaign
                                </span>
                                <div class="sm:w-20 w-14 sm:h-20 h-14 flex-shrink-0 rounded-lg relative">
                                    <img loading="eager" src="' . asset('storage/' . $fundraising->main_image) . '"
                                         class="absolute w-full h-full inset-0 rounded-md object-cover shadow-sm"
                                         alt="fundraising image">
                                </div>
                                <div class="flex-1">
                                    <a href="' . route('fundaraising.show', $fundraising->slug) . '"
                                       class="md:text-lg text-base font-semibold capitalize text-black">
                                        ' . htmlspecialchars($fundraising->title) . '
                                    </a>
                                    <div class="items-center text-sm font-normal">
                                        <div>For - ' . htmlspecialchars($fundraising->for) . '</div>
                                        <div>Category - ' . htmlspecialchars($fundraising->category->name ?? '-') . '</div>
                                    </div>
                                </div>
                                <a href="' . route('fundaraising.show', $fundraising->slug) . '"
                                   class="button bg-primary-soft text-primary gap-1 max-md:hidden">
                                    <ion-icon name="add-circle" class="text-xl -ml-1"></ion-icon> View
                                </a>
                            </div>';
                }
            }

            // NGO results grouped by category (always display)
            foreach ($ngoCategories as $ngoCategorie) {
                foreach ($ngoCategorie->ngos->where('status', 1) as $ngo) {
                    if (!$hasResults) {
                        $hasResults = true;
                        $html .= '<div class="grid md:grid-cols-2 md:gap-2 gap-3" id="donorList">';
                    }
                    $html .= '<div class="flex md:items-center space-x-4 p-4 rounded-md box relative">
                                <!-- Top-right badge -->
                                <span class="absolute top-2 right-2 bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full font-bold" style="margin-top: -13%;">
                                    NGO
                                </span>
                                <div class="sm:w-20 w-14 sm:h-20 h-14 flex-shrink-0 rounded-lg relative">
                                    <img loading="eager" src="' . asset('storage/' . $ngo->logo_path) . '"
                                         alt="' . htmlspecialchars($ngo->ngo_name) . '"
                                         class="absolute w-full h-full inset-0 rounded-md object-cover shadow-sm">
                                </div>
                                <div class="flex-1">
                                    <a href="' . route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) . '"
                                       class="md:text-lg text-base font-semibold capitalize text-black">
                                        ' . htmlspecialchars($ngo->ngo_name) . '
                                    </a>
                                    <div class="items-center text-sm font-normal">
                                        <div>
                                            <a href="' . route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) . '"
                                               class="text-blue-600">
                                                ' . $ngo->members->count() . ' Members
                                            </a>
                                        </div>
                                        <div>' . htmlspecialchars($ngo->ngo_city ?? '-') . ', ' . htmlspecialchars($ngo->ngo_state ?? '-') . '</div>
                                    </div>
                                </div>
                            </div>';
                }
            }

            // No results case
            if (!$hasResults) {
                $html .= '<div class="grid md:grid-cols-1 gap-3" id="donorList">
                            <div class="col-12">
                                <div class="card shadow-sm border-0 text-center p-5">
                                    <div class="card-body">
                                        <h3 class="text-dark mb-2">No results found</h3>
                                        <p class="text-muted mb-0">
                                            We couldn\'t find anything matching your search.  
                                            Try adjusting your keywords or explore other categories.
                                        </p>
                                    </div>
                                </div>
                            </div>
                          </div>';
            } else {
                $html .= '</div>';
            }

            return response()->json(['html' => $html]);
        }

        return view('website.ngo.index', compact(
            'ngos',
            'ngoCategories',
            'joinedNgo',
            'fundraisings',
            'isAuthenticated',
            'isVerified',
            'search'
            , 'locations', 'cities', 'ngoNames', 'categories','allTitles','donationPackages'
        ));
    }

    public function register(Request $request){
        return view('website.ngo.register');
    }

    public function storeNGO(Request $request)
    {
        // Custom messages (optional)
        $messages = [
            'ngo_name.required' => 'NGO Name is required.',
            'ngo_city.required' => 'City is required.',
            'cat_id.required' => 'Category is required.',
            'contact_email.email' => 'Please enter a valid email address.',
            'logo_path.image' => 'Logo must be an image file.',
            'logo_path.mimes' => 'Logo must be a jpeg, png, jpg, or gif file.',
            'other_images.*.image' => 'Each image must be an image file.',
            'other_images.*.mimes' => 'Images must be jpeg, png, jpg, or gif.',
        ];

        // Validation
        $validated = $request->validate([
            'ngo_name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'establishment' => 'nullable|digits:4|integer',
            'languages' => 'nullable|array',
            'cat_id' => 'required|integer',
            'abn' => 'nullable|string|max:50',
            'acnc' => 'nullable|string|max:50',
            'gst' => 'nullable|string|max:50',
            'ngo_address' => 'nullable|string|max:255',
            'ngo_city' => 'required|string|max:100',
            'ngo_state' => 'nullable|string|max:100',
            'ngo_country' => 'nullable|string|max:100',
            'contact_phone' => 'nullable|string|max:20',
            'website_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'feature' => 'nullable|boolean',
            'orderby' => 'nullable|integer',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'other_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ngo_description' => 'nullable|string|max:5000',
        ], $messages);

        // Store authenticated user ID
        $validated['user_id'] = auth()->user()->id;

        // Logo Upload
        if ($request->hasFile('logo_path')) {
            $validated['logo_path'] = $request->file('logo_path')->store('ngo', 'public');
        }

        // Multiple Images Upload
        if ($request->hasFile('other_images')) {
            $images = [];
            foreach ($request->file('other_images') as $image) {
                $images[] = $image->store('ngo_images', 'public');
            }
            $validated['other_images'] = json_encode($images);
        }

        // Encode languages array
        $validated['languages'] = $request->languages ? json_encode($request->languages) : json_encode([]);

        // Checkbox handling
        $validated['feature'] = $request->has('feature') ? 1 : 0;

        // Default values
        $validated['created_by_admin'] = $request->created_by_admin ?? 0;
        $validated['status'] = $request->status ?? 1;
        $validated['orderby'] = $request->orderby ?? 0;

        // Create NGO
        $ngo = Ngo::create($validated);

        // Update user's account_type to 3
        $user = auth()->user();
        $user->account_type = 3;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'NGO registered successfully!'
        ]);
    }





    public function searchCategories(Request $request)
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

    public function show($id)
    {
        try {
            $decrypted = Crypt::decryptString(urldecode($id));
            if (preg_match('/^i:(\d+);$/', $decrypted, $matches)) {
                $decryptedId = $matches[1];
            } else {
                $decryptedId = $decrypted;
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404, 'Invalid ID.');
        }

        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        $title = 'Subz Future List';
        $breadcrumbs = [
            route('home') => 'Home',
            '' => 'Subz Future List'
        ];

        if ($isAuthenticated && !$is_module_visible) {
            session()->flash('title', $title);
            session()->flash('breadcrumbs', $breadcrumbs);
            return redirect()->route('user.pending-approval');
        }

        $ngo = Ngo::with(['category', 'images', 'languages', 'members', 'user', 'totalmember'])->findOrFail($decryptedId);

        $uid = User::where('id', $ngo->user_id)->value('uid');

        $fundraisings = Fundraising::with(['fundraisingImages', 'category'])
                        ->withSum('donations', 'amount')
                        ->where('ngo_id', $decryptedId)
                        ->where('status', 1)
                        ->get();

        $events = Event::with(['images', 'users', 'eventTags', 'user'])
            ->whereHas('user', function ($query) use ($decryptedId) {
                $query->where('ngo_id', $decryptedId);
            })
            ->where('status', 1)
            ->get();

        $joinedNgo = $isAuthenticated ? auth()->user()->ngo_id : null;
        $memberCount = $ngo->user()->count();
        $ngoCategories = NgoCategory::all();
        $hasJoined = $joinedNgo == $decryptedId;

        return view('website.ngo.show', compact(
            'ngo',
            'uid',
            'ngoCategories',
            'decryptedId',
            'joinedNgo',
            'memberCount',
            'hasJoined',
            'fundraisings',
            'events'
        ));
    }


    public function donationpkg($id)
    {
        try {
            // Decode and decrypt the incoming ID
            $decryptedId = Crypt::decryptString(urldecode($id));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404, 'Invalid ID.');
        }

        // Authentication and email verification checks
        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated && Auth::user()->hasVerifiedEmail();
        $is_module_visible = $isAuthenticated && Auth::user()->is_module_visible == 1;

        // Page data
        $title = 'Subz Future List';
        $breadcrumbs = [
            route('home') => 'Home',
            '' => 'Subz Future List',
        ];

        // Fetch the donation package by decrypted ID
        $donationPackages = DonationPackage::with('gallery')->select(
                'id',
                'name',
                'image',
                'price',
                'quantity',
                'status',
                'created_at',
                'updated_at',
                'ngo_id',
                'description',
                'in_packages'
            )
            ->where('id', $decryptedId)
            ->orderBy('id', 'desc')
            ->firstOrFail();


            $purchesedqty = (int) DonatePackage::where('donatepkg_id', $donationPackages->id)->sum('quantity');
            $totalquantity = (int) $donationPackages->quantity;
            $percentage = (($purchesedqty / $totalquantity) * 100) ?? 0;

            $encryptedId = encrypt($donationPackages->id);

            $topDonors = DonatePackage::with('user')
                ->where('donatepkg_id', $donationPackages->id)
                ->orderByDesc('quantity')
                ->get()
                ->unique('user_id')
                ->take(5)
                ->values();

        $allDonors = DonatePackage::where('donatepkg_id', $donationPackages->id)
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(10);

        // Pass all necessary variables to the Blade
        return view('website.ngo.donationpkg', compact(
            'donationPackages',
            'title',
            'breadcrumbs',
            'isAuthenticated',
            'isVerified',
            'is_module_visible',
            'topDonors',
            'allDonors',
            'encryptedId',
            'purchesedqty',
            'totalquantity',
            'percentage'
        ));
    }


    public function support($id, $price = '0.00', $quantity = 0){

        try {
            $decrypted = Crypt::decryptString(urldecode($id));
            if (preg_match('/^i:(\d+);$/', $decrypted, $matches)) {
                $decryptedId = $matches[1];
            } else {
                $decryptedId = $decrypted;
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404, 'Invalid ID.');
        }

        $encryptedId = $id;

        $donationPackages = DonationPackage::select(
                'id',
                'name',
                'image',
                'price',
                'quantity',
                'status',
                'created_at',
                'updated_at',
                'ngo_id',
                'description'
            )
            ->where('id', $decryptedId)
            ->orderBy('id', 'desc')
            ->firstOrFail();

        return view('website.ngo.donatepackage', compact('donationPackages', 'price','id','encryptedId','quantity'));
    }


    


    public function join(Request $request)
    {
        if (!auth()->check()) {
            \Log::warning('Join attempt by unauthenticated user', ['ip' => $request->ip()]);
            return redirect()->route('user.login')->with('error', 'Please login to join an NGO.');
        }

        $inputId = $request->input('ngo_id');
        $ngoId = null;

        // Try to decrypt only if the value looks encrypted
        try {
            if (!is_numeric($inputId)) {
                $ngoId = Crypt::decrypt($inputId);
                \Log::debug('Decrypted NGO ID', ['ngo_id' => $ngoId, 'encrypted' => $inputId]);
            } else {
                $ngoId = (int) $inputId;
                \Log::debug('NGO ID is numeric, using as-is', ['ngo_id' => $ngoId]);
            }
        } catch (DecryptException $e) {
            \Log::error('Failed to decrypt NGO ID', [
                'encrypted' => $inputId,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Invalid NGO ID.');
        }

        $ngo = Ngo::find($ngoId);
        if (!$ngo) {
            \Log::error('NGO not found for ID', ['ngo_id' => $ngoId]);
            return redirect()->back()->with('error', 'The specified NGO does not exist.');
        }

        $user = auth()->user();

        // If user already joined another NGO, clear it first
        if ($user->ngo_id && $user->ngo_id != $ngoId) {
            \Log::info('Clearing existing NGO association for user', [
                'user_id' => $user->id,
                'old_ngo_id' => $user->ngo_id,
                'new_ngo_id' => $ngoId
            ]);
            $user->update(['ngo_id' => null]);
        }

        // Join new NGO
        $user->update([
            'ngo_id' => $ngoId,
            'ngo_join_date' => now(),
        ]);

        \Log::info('User joined NGO successfully', [
            'user_id' => $user->id,
            'ngo_id' => $ngoId,
            'ngo_name' => $ngo->ngo_name
        ]);

        return redirect()
            ->route('ngo.show', ['id' => encrypt($ngoId)])
            ->with('success', 'You have successfully joined the NGO!');
    }



    public function leave(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('user.login')->with('error', 'Please login to leave an NGO.');
        }

        $inputId = $request->input('ngo_id');
        $ngoId = null;

        // Decrypt if necessary
        try {
            $ngoId = is_numeric($inputId) ? (int)$inputId : Crypt::decryptString($inputId);
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Invalid NGO ID.');
        }

        $user = auth()->user();

        if ($user->ngo_id != $ngoId) {
            return redirect()->back()->with('error', 'You are not a member of this NGO.');
        }

        $user->update([
            'ngo_id' => null,
            'ngo_join_date' => null,
        ]);

        // ✅ Encrypt properly before redirect
        $encryptedId = Crypt::encryptString($ngoId);

        return redirect()
            ->route('ngo.show', ['id' => $encryptedId])
            ->with('success', 'You have successfully left the NGO!');
    }

    public function saveDonation(Request $request){
        $userId = Auth::id();
        
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'You need to be logged in to make a donation.'
            ], 401); 
        }

        $rules = [
            'nonce' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'tipPercentage' => 'required|numeric|min:0',
            'coverTransactionCosts' => 'required|in:0,1',
            'anonymous' => 'nullable|in:0,1',
            'first_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:100',
            'message' => 'nullable|string|max:1000',
            'fundraising_id' => 'required',
            'quantity' => 'required|numeric|min:1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed. Please check the highlighted fields.',
            ], 422);
        }

        $fundraisingId = Crypt::decrypt($request->input('fundraising_id'));
        $quantity = $request->input('quantity');
        $validatedData = $validator->validated();

        $anonymous = isset($validatedData['anonymous']) && $validatedData['anonymous'] == 1 ? 1 : 0;

        $donationAmount = $validatedData['amount'];
        $tipAmount = $donationAmount * ($validatedData['tipPercentage'] / 100);
        $transactionFee = $donationAmount * 0.029 + 0.30; 
        $totalAmount = $donationAmount + $tipAmount;

        if ($validatedData['coverTransactionCosts']) {
            $totalAmount += $transactionFee;
        }

        try {
            DB::beginTransaction();

            $donationNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $donation = \App\Models\DonatePackage::create([
                'user_id' => $userId,
                'donatepkg_id' => $fundraisingId,
                'name' => $validatedData['first_name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'country' => $validatedData['country'],
                'message' => $validatedData['message'] ?? null,
                'amount' => $donationAmount,
                'quantity' =>$quantity,
                'tip' => $tipAmount,
                'transaction_fee' => $transactionFee,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'anonymous' => $anonymous,
                'donation_number' => $donationNumber,
            ]);

            $paymentResponse = $this->createPayment($validatedData['nonce'], $totalAmount, $donation->id);

            if ($paymentResponse['success']) {
                try {
                    $donation->update([
                        'status' => 'successful', 
                        'payment_id' => $paymentResponse['payment_id'],  
                    ]);

                    // Store session variables
                    session()->put('donation_number', $donation->donation_number);
                    session()->put('donation_amount', $donation->amount);
                    session()->put('tip_amount', $donation->tip);
                    session()->put('transaction_fee', $donation->transaction_fee);
                    session()->put('total_amount', $donation->total_amount);

                    DB::commit();

                    $userEmail = Auth::check() ? Auth::user()->email : null;
                    if ($userEmail && filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                        Mail::to($userEmail)->send(new \App\Mail\DonationPackageMail($donation));
                    } else {
                        Log::warning('User email is invalid or missing', ['user_id' => Auth::id(), 'email' => $userEmail]);
                    }

                    $adminEmail = config('constants.ADMIN_EMAIL');
                    if ($adminEmail && filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
                        Mail::to($adminEmail)->send(new \App\Mail\AdminDonationPackageNotificationMail($donation));
                    } else {
                        Log::error('Admin email is invalid or missing', ['admin_email' => $adminEmail]);
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Donation successful!',
                        'redirect_url' => route('donations.success'), 
                    ]);
                } catch (\Exception $e) {
                    DB::rollBack(); 

                    return response()->json([
                        'success' => false,
                        'message' => 'An error occurred while updating donation status.' . $e->getMessage(),
                    ], 500);
                }
            } else {
                DB::rollBack(); 
                Mail::to($validatedData['email'])->send(new \App\Mail\DonationPackageFailureMail($donation));

                return response()->json([
                    'success' => false,
                    'message' => 'Donation failed. Please try again.',
                ], 500);
            }

        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the donation: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function createPayment($nonce, $totalAmount, $donationId)
    {
        try {
            $square = new \Square\SquareClient([
                'accessToken' => config('services.square.access_token'),
                'environment' => config('services.square.environment'),
            ]);

            $paymentsApi = $square->getPaymentsApi();

            $amountInCents = (int) round($totalAmount * 100);
            Log::info('Converted amount to cents', ['total_amount' => $totalAmount, 'amount_in_cents' => $amountInCents]);

            $money = new \Square\Models\Money();
            $money->setAmount($amountInCents);
            $money->setCurrency('AUD');
            Log::info('Money object created', ['amount' => $money->getAmount(), 'currency' => $money->getCurrency()]);

            $paymentRequest = new \Square\Models\CreatePaymentRequest(
                $nonce,
                uniqid()
            );
            
            $paymentRequest->setAmountMoney($money);

            Log::info('Payment request prepared', ['request' => json_encode($paymentRequest->jsonSerialize())]);

            $paymentResponse = $paymentsApi->createPayment($paymentRequest);

            if ($paymentResponse->isSuccess()) {
                return [
                    'success' => true,
                    'payment_id' => $paymentResponse->getResult()->getPayment()->getId(),
                ];
            } else {
                Log::error('Payment failed', ['errors' => $paymentResponse->getErrors()]);
                return [
                    'success' => false,
                    'message' => $paymentResponse->getErrors(),
                ];
            }
        } catch (Exception $e) {
            Log::error('Error processing payment with Square', ['error_message' => $e->getMessage(), 'stack_trace' => $e->getTraceAsString()]);
            return [
                'success' => false,
                'message' => 'Payment processing error. Please try again.',
            ];
        }
    }
}
