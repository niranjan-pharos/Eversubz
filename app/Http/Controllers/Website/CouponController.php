<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function validateCoupon(Request $request)
    {
        $couponCode = $request->input('coupon');
        $couponModule = $request->input('module');

        // Validate input values
        if (empty($couponCode) || empty($couponModule)) {
            return response()->json(['valid' => false, 'message' => 'Invalid coupon code or module.'], 400);
        }

        // Use the scope and find method to get the coupon
        $coupon = Coupon::where('code', $couponCode)
                        ->forModule($couponModule) // Using the custom scope
                        ->first();

        // Check if the coupon exists and is valid using the isValid method
        if ($coupon && $coupon->isValid()) {
            // Coupon is valid
            return response()->json(['valid' => true, 'discount' => $coupon->discount, 'message' => 'Coupon applied successfully.']);
        } else {
            // Coupon is not valid
            return response()->json(['valid' => false, 'message' => 'Invalid or expired coupon code.'], 400);
        }
    }


}
