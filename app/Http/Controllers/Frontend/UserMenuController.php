<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDetail;

class UserMenuController extends Controller
{
    
    public function showHeader()
    {
        // Retrieve the authenticated user
        $user = auth()->user();
        // dd($user);
        
        // Retrieve user details if available
        $userDetail = UserDetail::where('user_id', $user->id)->first();
        
        // Return the header view with user information
        return view('frontend.template.usermenu', ['user' => $user, 'userDetail' => $userDetail]);
    }
}
