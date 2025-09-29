<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\BusinessProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\StoreOrder;
use App\Models\StoreOrderItem;
use Square\SquareClient;
use Square\Exceptions\ApiException;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\Models\Currency;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessful;
use App\Mail\OrderConfirmationMail;
use App\Mail\VendorOrderNotificationMail;


class CartController extends Controller
{
    
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_slug' => 'nullable|exists:business_products,slug',
            'product_id' => 'nullable|integer|required_without:product_slug',
            'wishable_type' => 'nullable|string|in:App\Models\AdPost,App\Models\BusinessProduct',
        ]);

        DB::beginTransaction();

        try {
            $product = null;

            if ($request->filled('product_slug')) {
                $product = BusinessProduct::where('slug', $request->product_slug)->lockForUpdate()->first();
            } elseif ($request->filled('product_id') && $request->filled('wishable_type')) {
                $product_id = $request->input('product_id');
                $wishable_type = $request->input('wishable_type');
                $product = $wishable_type::find($product_id);
            }

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $cartItem = Cart::get($product->id);
            \Log::info('Cart Item:', ['cart_item' => $cartItem]);

            $max_qty = $product->max_qty;

            if ($cartItem) {
                $currentQuantity = $cartItem->quantity;

                if ($currentQuantity >= $max_qty) {
                    return response()->json(['error' => 'The available quantity has been exceeded. You can only add up to ' . $max_qty . ' items to your cart.'], 400);
                }

                $newQuantity = $currentQuantity + 1;
                if ($newQuantity > $max_qty) {
                    return response()->json(['error' => 'The available quantity has been exceeded. You can only add up to ' . $max_qty . ' items to your cart.'], 400);
                }

                Cart::update($product->id, [
                    'quantity' => [
                        'relative' => false,
                        'value' => $newQuantity,
                    ]
                ]);

            } else {
                Cart::add([
                    'id' => $product->id,
                    'name' => $product->title ?? $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'attributes' => [
                        'image' => $product->primaryImage->url ?? $product->main_image ?? 'default-image-path.jpg',
                        'slug' => $product->slug ?? null
                    ]
                ]);
            }

            $product->save();

            DB::commit();

            $cartItems = Cart::getContent();
            $cartItemCount = Cart::getTotalQuantity();

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart',
                'cartItems' => $cartItems->toArray(),
                'cartItemCount' => $cartItemCount,
                'cartTotal' => (float) \Cart::getTotal(),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function getCartContents()
    {
        $cartItems = Cart::getContent();
        $cartItemCount = $cartItems->count();
        $cartTotal = Cart::getTotal(); 

        return response()->json([
            'cartItems' => $cartItems,
            'cartItemCount' => $cartItemCount,
            'cartTotal' => (float) \Cart::getTotal()
        ]);
    }


    public function showCart()
    {
        $cartItems = Cart::getContent();

        $subtotal = 0;

        $cartItems = $cartItems->map(function($item) use (&$subtotal) {
            $product = BusinessProduct::find($item->id);
            if ($product) {
                $item->max_qty = $product->max_qty; 
            }
            $subtotal += $item->price * $item->quantity;
            return $item;
        });

        $gstPercentage = config('constants.GST_PERCENTAGE', 10);

        $priceBeforeGst = $subtotal / (1 + ($gstPercentage / 100)); 

        $gstAmount = $subtotal - $priceBeforeGst;

        $totalAmount = $priceBeforeGst + $gstAmount;

        return view('website.cart.cart', compact('cartItems', 'subtotal', 'priceBeforeGst', 'gstAmount', 'totalAmount'));
    }



    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Validate inputs
        if (!$productId || !$quantity || $quantity < 1) {
            return response()->json(['success' => false, 'message' => 'Invalid input.']);
        }

        // Update the cart
        Cart::update($productId, [
            'quantity' => [
                'relative' => false,  // Set relative to false to set the exact quantity
                'value' => $quantity, // Set the updated quantity
            ],
        ]);

        return response()->json(['success' => true, 'message' => 'Cart updated successfully.']);
    }




    public function removeFromCart($id)
    {
        try {
            Cart::remove($id);

            $cartItems = Cart::getContent();
            $cartItemCount = $cartItems->count();
            $cartTotal = Cart::getTotal();
            $subTotal = Cart::getSubTotal();
            $total = Cart::getTotal();

            return response()->json([
                'message' => 'Item removed from cart',
                'cartItems' => $cartItems,
                'cartItemCount' => $cartItemCount,
                'cartTotal' => $cartTotal,
                'subTotal' => $subTotal,
                'total' => $total
            ]);

        } catch (\Exception $e) {
            Log::error('Error removing item from cart', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'An error occurred while removing the item from cart'
            ], 500);
        }
    }

    public function remove(Request $request)
    {
        Cart::remove($request->id); 

        return response()->json(['message' => 'Item removed successfully']);
    }

    public function getCart()
    {
        $cartItems = Cart::getContent();
        $cartItemCount = Cart::getTotalQuantity();
    
        // Convert cart items to an array format suitable for JSON response
        $cartItemsArray = $cartItems->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'attributes' => [
                    'image' => $item->attributes->image
                ]
            ];
        })->toArray();
    
        return response()->json([
            'cartItems' => $cartItemsArray,
            'cartItemCount' => $cartItemCount
        ]);
    }
    
    
/*
   
    public function processPayment(Request $request)
    {
        Log::info('Incoming request data for payment: ', $request->all());

        // Check if the user is not logged in
        if (!auth()->check()) {
            $guestEmail = $request->input('guest_email');
        
            if (empty($guestEmail)) {
                return response()->json(['error' => 'Please log in or provide a guest email to complete your order.'], 400);
            }
        
            if (!filter_var($guestEmail, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['error' => 'Please provide a valid email address.'], 400);
            }
        }

        DB::beginTransaction();
        try {
            // Get or create the pending order
            if (!$request->session()->has('pending_order_id')) {
                $storeOrder = StoreOrder::create([
                    'user_id' => auth()->check() ? auth()->id() : null,
                    'full_name' => $request->input('full_name'),
                    'email' => auth()->check() ? auth()->user()->email : ($request->input('email') ?? $request->input('guest_email')),
                    'phone_number' => $request->input('phone_number'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'zip_code' => $request->input('zip_code'),
                    'country' => $request->input('country'),
                    'payment_status' => 'pending',
                    'total_amount' => collect($request->input('cartItems'))->reduce(function ($carry, $item) {
                        return $carry + ($item['price'] * $item['quantity']);
                    }, 0),
                ]);

                $request->session()->put('pending_order_id', $storeOrder->id);
                Log::info('Pending Order ID set in session: ', ['order_id' => $storeOrder->id]);
            } else {
                $storeOrder = StoreOrder::find($request->session()->get('pending_order_id'));

                if (!$storeOrder) {
                    return redirect()->back()->withErrors(['error' => 'Invalid pending order.']);
                }

                // Update the order details
                $storeOrder->update([
                    'full_name' => $request->input('full_name'),
                    'email' => auth()->check() ? auth()->user()->email : ($request->input('email') ?? $request->input('guest_email')),
                    'phone_number' => $request->input('phone_number'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'zip_code' => $request->input('zip_code'),
                    'country' => $request->input('country'),
                ]);
                Log::info('Order updated with user/guest details: ', $storeOrder->toArray());
            }

            // Store items in the store_order_items table
            $cartItems = $request->input('cartItems', []);
            $groupedItems = [];

            foreach ($cartItems as &$item) {
                $price = (float) $item['price'];
                $quantity = (int) $item['quantity'];
                $total = $price * $quantity;

                $productData = DB::table('business_products')
                    ->where('id', $item['product_id'])
                    ->select('title', 'business_id')
                    ->first();

                $item['title'] = $productData->title ?? 'Unknown Product';

                StoreOrderItem::create([
                    'order_id' => $storeOrder->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $total,
                ]);

                $vendorData = DB::table('user_business_infos')
                    ->where('id', $productData->business_id ?? null)
                    ->select('contact_email')
                    ->first();

                if ($vendorData) {
                    $vendorEmail = $vendorData->contact_email;

                    if (!isset($groupedItems[$vendorEmail])) {
                        $groupedItems[$vendorEmail] = [];
                    }

                    $groupedItems[$vendorEmail][] = array_merge($item, [
                        'business_id' => $productData->business_id ?? null,
                        'total' => $total,
                    ]);
                }
            }
            unset($item);

            Log::info('Order items saved for order ID: ', ['order_id' => $storeOrder->id]);

            // Process payment via gateway
            $paymentResponse = $this->processPaymentGateway($request);

            if ($paymentResponse->success) {
                $storeOrder->update([
                    'payment_status' => 'success',
                    'payment_id' => $paymentResponse->payment_id,
                ]);

                Log::info('Payment successful for order ID: ', ['order_id' => $storeOrder->id]);

                $request->session()->forget('pending_order_id');

                DB::commit();

                // Send emails
                if (!empty($storeOrder->email) && filter_var($storeOrder->email, FILTER_VALIDATE_EMAIL)) {
                    // Mail::to($storeOrder->email)->send(new OrderConfirmationMail($storeOrder, $cartItems));
                    Log::info("Email sent to user: {$storeOrder->email}");
                } else {
                    Log::error('Invalid user email address: ', ['email' => $storeOrder->email]);
                }

                foreach ($groupedItems as $vendorEmail => $items) {
                    if (filter_var($vendorEmail, FILTER_VALIDATE_EMAIL)) {
                        // Mail::to($vendorEmail)->send(new VendorOrderNotificationMail($storeOrder, $items));
                        Log::info("Email sent to vendor: $vendorEmail", ['order_id' => $storeOrder->id]);
                    } else {
                        Log::error('Invalid vendor email address: ', ['email' => $vendorEmail]);
                    }
                }

                $request->session()->forget('cart');

                return redirect()->route(auth()->check() ? 'dashboard' : 'thank-you')
                    ->with('success', 'Your order has been placed and paid successfully!');
            } else {
                $storeOrder->update(['payment_status' => 'failed']);
                DB::rollback();
                \Log::error('Payment failed error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Payment failed. Please try again.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Payment processing error: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred during payment processing. Please try again.');
        }
    }






    private function processPaymentGateway(Request $request)
    {
        $nonce = $request->input('nonce'); // Payment nonce

        Log::info('Nonce received: ', ['nonce' => $nonce]);

        $cartItems = $request->input('cartItems', []);
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $gst = $subtotal * 0.10; // Apply GST
        $totalAmount = $subtotal + $gst; // Final amount including GST

        // Convert total amount to cents (Square expects amounts in the smallest currency unit)
        $amountInCents = intval($totalAmount * 100);

        Log::info('Processing payment with amount (in cents): ', ['amount' => $amountInCents]);

        // Initialize Square Client
        $client = new SquareClient([
            'accessToken' => env('SQUARE_ACCESS_TOKEN'),
            'environment' => env('SQUARE_ENVIRONMENT', 'sandbox'), // Default to sandbox
        ]);

        $paymentsApi = $client->getPaymentsApi();

        // Create a Money object for the amount
        $money = new Money();
        $money->setAmount($amountInCents); // Amount in cents
        $money->setCurrency('AUD'); // Currency

        // Create the payment request
        $paymentRequest = new CreatePaymentRequest($nonce, uniqid());
        $paymentRequest->setAmountMoney($money);

        try {
            // Process the payment
            $response = $paymentsApi->createPayment($paymentRequest);

            if ($response->isSuccess()) {
                $payment = $response->getResult()->getPayment();
                Log::info('Payment successful: ', ['payment_id' => $payment->getId()]);

                return (object)[
                    'success' => true,
                    'payment_id' => $payment->getId(),
                ];
            } else {
                Log::error('Payment failed: ', ['errors' => $response->getErrors()]);

                return (object)[
                    'success' => false,
                    'error_message' => $response->getErrors(),
                ];
            }
        } catch (ApiException $e) {
            Log::error('Payment processing error: ' . $e->getMessage());

            return (object)[
                'success' => false,
                'error_message' => $e->getMessage(),
            ];
        }
    }



    public function setIntendedUrl(Request $request)
    {
        $request->validate([
            'intended_url' => 'required|url'
        ]);

        $intendedUrl = $request->input('intended_url', route('redirect.to.payment')); 
        session()->put('url.intended', $intendedUrl);
        return response()->json(['success' => true]);
    }

    public function redirectToPayment(Request $request)
    {
        // Get the pending order ID from the session
        $pendingOrderId = session()->get('pending_order_id');

        // If no pending order ID is found, redirect the user back to the checkout page with an error message
        if (!$pendingOrderId) {
            return redirect()->route('checkout')->withErrors(['error' => 'No pending order found.']);
        }

        // Render a view that submits a form to the process.payment route (POST)
        return view('website.cart.redirectToPayment', compact('pendingOrderId'));
    }

*/
    
}
