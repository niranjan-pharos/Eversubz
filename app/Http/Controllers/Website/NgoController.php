<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Ngo;
use App\Models\User;
use App\Models\Event;
use App\Models\NgoCategory;
use App\Models\Fundraising;
use Illuminate\Support\Facades\Auth;
use App\Models\FundraisingImage;
use App\Models\FundraisingCategory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;


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
        ->when(!empty($categories), fn($q) => $q->whereIn('name', $categories))
        ->having('ngos_count', '>', 0)
        ->orderBy('ngos_count', 'desc')
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
                $ngo->member_count = $ngo->totalmember()->count();
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
        ->get();

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
            , 'locations', 'cities', 'ngoNames', 'categories','allTitles'
        ));
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
        $memberCount = $ngo->totalmember()->count();
        $ngoCategories = NgoCategory::all();
        $hasJoined = $joinedNgo == $decryptedId;

        return view('website.ngo.show', compact(
            'ngo',
            'ngoCategories',
            'decryptedId',
            'joinedNgo',
            'memberCount',
            'hasJoined',
            'fundraisings',
            'events'
        ));
    }

    


    public function join(Request $request)
    {
        if (!auth()->check()) {
            \Log::warning('Join attempt by unauthenticated user', ['ip' => $request->ip()]);
            return redirect()->route('user.login')->with('error', 'Please login to join an NGO.');
        }

        try {
            $ngoId = Crypt::decrypt($request->input('ngo_id'));
            \Log::debug('Decrypted NGO ID', ['ngo_id' => $ngoId, 'encrypted' => $request->input('ngo_id')]);
        } catch (DecryptException $e) {
            \Log::error('Failed to decrypt NGO ID', [
                'encrypted' => $request->input('ngo_id'),
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

        if ($user->ngo_id && $user->ngo_id != $ngoId) {
            \Log::info('Clearing existing NGO association for user', [
                'user_id' => $user->id,
                'old_ngo_id' => $user->ngo_id,
                'new_ngo_id' => $ngoId
            ]);
            $user->update(['ngo_id' => null]);
        }

        $user->update([
            'ngo_id' => $ngoId,
            'ngo_join_date' => now(),
        ]);

        \Log::info('User joined NGO successfully', [
            'user_id' => $user->id,
            'ngo_id' => $ngoId,
            'ngo_name' => $ngo->ngo_name
        ]);

        return redirect()->route('ngo.show',['id'=>$request->input('ngo_id')])->with('success', 'You have successfully joined the NGO!');
    }


    public function leave(Request $request)
{
    // Check if the user is authenticated
    if (!auth()->check()) {
        // Redirect to the login page with an error message
        return redirect()->route('user.login')->with('error', 'Please login to leave an NGO.');
    }

    // Validate that ngo_id is provided
    $request->validate([
        'ngo_id' => 'required|exists:ngos,id',
    ]);

    // Get the authenticated user
    $user = auth()->user();

    // Check if the user is currently joined with the specified NGO
    if ($user->ngo_id != $request->input('ngo_id')) {
        // Redirect back with an error message
        return redirect()->back()->with('error', 'You are not a member of this NGO.');
    }

    // Update the user's ngo_id to null, effectively leaving the NGO
    $user->update([
        'ngo_id' => null,
        'ngo_join_date' => null, // Optionally reset the join date
    ]);

    // Redirect to the same page with a success message
    return redirect()->route('ngo.show', ['id' => $request->input('ngo_id')])->with('success', 'You have successfully left the NGO!');
}



}
