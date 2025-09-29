<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\UserBusinessInfos;
use App\Models\AdPost;
use App\Models\User;
use App\Models\UserBusinessHour;
use App\Models\BusinessProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Models\Language; 
use Illuminate\Support\Facades\Storage;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\StoreOrder;
use App\Models\StoreOrderItem;
use Square\SquareClient;
use Square\Exceptions\ApiException;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\Models\Currency;


class CheckoutController extends Controller{

    public function checkout(Request $request)
    {
        $cartItems = Cart::getContent();
        $subTotal = Cart::getSubTotal();
        $total = Cart::getTotal();
        
        $shipping = 0; 
        $total = $total + $shipping;

        $storeOrder = StoreOrder::create([
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'payment_status' => 'pending' 
        ]);

        session()->put('pending_order_id', $storeOrder->id);
        \Log::info('Pending Order ID set in session: ' . $storeOrder->id);

        return view('website.cart.checkout', compact('cartItems', 'subTotal', 'shipping', 'total'));
    }

}