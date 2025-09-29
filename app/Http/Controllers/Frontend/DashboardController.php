<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdPost;
use App\Models\BusinessProduct;
use App\Models\UserBusinessInfos;
use App\Models\AdminMessage;
use App\Models\Event;
use Illuminate\Support\Facades\{Auth, Redirect, Storage, Session, Log, DB};

class DashboardController extends Controller
{
    public function index()
    {
        
        $user = Auth::user();
        $userId = $user->id;
        
        $announcements = AdminMessage::where('status', 1)
            ->orderBy('orderby')
            ->get();
        
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 

        $acc_type = '';

        if($user->account_type == 1){
            $acc_type = 'User';
        } else if($user->account_type == 2){
            $acc_type = 'Business';
        } else if($user->account_type == 3){
            $acc_type = 'NGO';
        } else if($user->account_type == 4){
            $acc_type = 'Professional';
        } else{
            $acc_type = 'Unknown user type';
        }

        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug'); 

        return view('frontend.dashboard', compact('announcements', 'user', 'is_approved', 'businessName','acc_type'));
    }

}
