<?php
namespace App\Services;

use App\Models\AdPost;
use App\Models\UserBusinessInfos;
use App\Models\BusinessProduct;
use App\Models\Event;

class CountService
{
    public static function getCounts($user_id)
    {
        $totalAdPosts = AdPost::where('user_id', $user_id)->count();
        $businessIds = UserBusinessInfos::where('user_id', $user_id)->pluck('id');
        $totalBusinessProducts = BusinessProduct::whereIn('business_id', $businessIds)->count();
        $totalEvents = Event::where('user_id', $user_id)->count();

        return [
            'totalAdPosts' => $totalAdPosts,
            'totalBusinessProducts' => $totalBusinessProducts,
            'totalEvents' => $totalEvents,
        ];
    }
}

?>