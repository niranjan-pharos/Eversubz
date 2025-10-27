<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserBusinessInfos;
use App\Models\UserBusinessHour; 
use App\Models\AdPost; 
use App\Models\BusinessProduct; 
use App\Models\Event; 
use App\Models\NGO; 
use App\Models\NgoMember;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class ProfilesController1 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $totalAdPosts = AdPost::where('user_id', $user->id)->count();
        $businessIds = UserBusinessInfos::where('user_id', $user->id)->pluck('id');
        $ngoInfo = NGO::where('user_id', $user->id)->first();
        $ngoMembers = null;

        $acc_type = '';
        
        if($user->account_type == 1){
            $acc_type = 'User';
        } else if($user->account_type == 2){
            $acc_type = 'Business ';
        } else if($user->account_type == 3){
            $acc_type = 'NGO';
        } else if($user->account_type == 4){
            $acc_type = 'Professional';
        } else{
            $acc_type = 'Unknown user type';
        }

        if ($ngoInfo) {
            $ngoMembers = NgoMember::where('ngo_id', $ngoInfo->id)->get();
        }

        $totalBusinessProducts = BusinessProduct::whereIn('business_id', $businessIds)->count();
        $totalEvents = Event::where('user_id', $user->id)->count();   
        $userDetail = UserDetail::where('user_id', $user->id)->first();
        $businessDetail = UserBusinessInfos::where('user_id', $user->id)->first();
        $businessHour = UserBusinessHour::where('user_id', $user->id)->first();
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 
        $businessName = UserBusinessInfos::where('user_id', $user->id)->value('slug');  

        // Create a response and set headers
        $response = response()->view('frontend.profile.profile1', [
            'user' => $user, 
            'acc_type' => $acc_type,
            'userDetail' => $userDetail,
            'businessDetail' => $businessDetail,
            'businessHour' => $businessHour,
            'totalAdPosts' => $totalAdPosts,
            'totalBusinessProducts' => $totalBusinessProducts,
            'totalEvents' => $totalEvents,
            'businessName' => $businessName,
            'is_approved' => $is_approved,
            'ngoInfo' => $ngoInfo,
            'ngoMembers' => $ngoMembers,
            'account_type' => $user->account_type,
        ]);

        // Prevent caching of the profile page
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');

        return $response;
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
        try {
            $userId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            // Handle the case where decryption fails
            return redirect()->back()->with('error', 'Invalid ID');
        }
    
        $user = User::with('userDetails')->find($userId);
    
        if (!$user) {
            
            return redirect()->back()->with('error', 'User not found');
        }
    
        return view('frontend.profile.view', compact('user'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function makeBusinessAccount(Request $request)
    {
        $user = auth()->user(); 

        if (!$user) {            
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        
        if ($user->account_type == 2) {
            return back()->with('message', 'Your account is already a business account.');
        }
        
        $user->account_type = 2; 
        $user->save(); 
        return back()->with('success', 'Your account has been updated to a business account.');
    }

}
