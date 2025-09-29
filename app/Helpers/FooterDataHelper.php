<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\UserBusinessInfos;
use App\Models\BusinessProduct;
use App\Models\AdPost;

class FooterDataHelper
{
    public static function getFooterData()
    {
        $registeredBusinessCount = UserBusinessInfos::where('status', 1)->count();
        $productsCount = BusinessProduct::count();
        $activeAdsCount = AdPost::count();

        return [
            'registeredBusinessCount' => $registeredBusinessCount,
            'productsCount' => $productsCount,
            'activeAdsCount' => $activeAdsCount,
        ];
    }
    
}