<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreOrder;
use App\Models\StoreOrderItem;
use App\Models\OrderStatusHistory;

use App\Models\UserBusinessInfos; 
use App\Models\OrderEvent;
use App\Models\OrderTicket;
use App\Models\OrderEventTicket;
use App\Models\User;
use App\Models\Donation; 
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

 
class DonationController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'You need to login first.');
        }

        $userId = Auth::id();
        $user = Auth::user();

        $resultsPerPage = $request->query('resultsPerPage', config('constants.DEFAULT_PAGINATION'));

        $userDonations = Donation::where('user_id', $userId)
                                ->orderBy('created_at', 'desc') 
                                ->paginate($resultsPerPage);

        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;

        return view('frontend.donations.index', compact('userDonations', 'is_approved', 'resultsPerPage'));
    }


}
