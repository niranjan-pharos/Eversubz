<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\StoreOrder;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Exception;



class CleanupController extends Controller{

    public function cleanupPendingOrders()
    {
        $thresholdDate = now()->subHours(24); // Remove orders older than 24 hours
        StoreOrder::where('payment_status', 'pending')
            ->whereNull('total_amount')
            ->whereNull('user_id')
            ->whereNull('guest_email')
            ->where('created_at', '<', $thresholdDate)
            ->delete();
    }


}
