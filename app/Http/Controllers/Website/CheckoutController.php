<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\UserBusinessInfos;
use App\Http\Requests\ProcessPaymentRequest;
use App\Jobs\SendAdminEmail;
use App\Jobs\SendOrderEmail;
use App\Jobs\SendVendorEmail;
use App\Models\AdPost;
use App\Models\User;
use App\Models\UserBusinessHour;
use App\Models\BusinessProduct;
use Square\Models\CheckoutOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Models\Language; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\StoreOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\StoreOrderItem;
use Square\SquareClient;
use Square\Exceptions\ApiException;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\Models\Currency;
use Square\Models\CreatePaymentLinkRequest;
use Square\Models\Order;
use Square\Models\OrderLineItem;
use App\Mail\CustomerOrderConfirmationMail;
use App\Mail\VendorOrderNotificationMail;
use App\Mail\AdminOrderNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;

use Exception;

// there is no link from Orders for checkout. check n remove function there. follwoing is working for checkout

class CheckoutController extends Controller{
    private const LOCK_PREFIX = 'product_stock_';
    private const LOCK_TIMEOUT = 30;

    public function checkout(Request $request)
    {   
        $user = Auth::user();
        $cartItems = Cart::getContent();

        if ($cartItems->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart cannot be empty. Please add items before proceeding.');
        }

        $subTotal = 0;
        $adjusted = false;

        foreach ($cartItems as $item) {
            $product = BusinessProduct::find($item->id);

            if (!$product) {
                continue;
            }

            $maxQty = $product->max_qty;

            if ($item->quantity > $maxQty) {
                Cart::update($item->id, [
                    'quantity' => [
                        'relative' => false,
                        'value' => $maxQty,
                    ],
                ]);
                $adjusted = true;
            }

            $subTotal += $item->price * $item->quantity;
        }

        if ($adjusted) {
            session()->flash('warning', 'Some item quantities were adjusted to the maximum allowed quantity.');
        }

        $gstPercentage = config('constants.GST_PERCENTAGE');
        $gst = $subTotal * $gstPercentage / 100;
        $shipping = config('constants.PRODUCT_SHIPPING');

        $total = $subTotal + $shipping;

        $userId = auth()->check() ? auth()->id() : null;

        $storeOrder = StoreOrder::create([
            'user_id' => $userId,
            'total_amount' => $total,
            'payment_status' => 'pending',
        ]);

        session()->put('pending_order_id', $storeOrder->id);
        Log::info('Pending Order ID set in session: ' . $storeOrder->id);
        Log::info('User_id: ' . $userId);

        $order_id = Crypt::encryptString($storeOrder->id);

        return view('website.cart.checkout', compact('cartItems', 'user','subTotal', 'shipping', 'gst', 'total', 'order_id'));
    }

    public function processPayment(ProcessPaymentRequest $request): JsonResponse
    {
        if (Cart::isEmpty()) {
            Log::warning('Payment attempted with empty cart', ['user_id' => $this->getUserId()]);
            return $this->errorResponse('Your cart cannot be empty.', 400);
        }

        try {
            DB::beginTransaction();
            Log::info('Processing multi-vendor order', ['user_id' => $this->getUserId()]);

            $validatedData = $request->validated();
            $decryptedCartItems = $this->decryptProductIds($validatedData['cartItems']);
            $vendorOrders = $this->processCartItems($request, $validatedData, $decryptedCartItems);
            $totalAmount = $this->calculateTotalAmount($vendorOrders);
            
            $this->validatePaymentAmount($totalAmount);
            $this->createOrderItems($vendorOrders);
            
            $paymentResponse = $this->handlePayment($validatedData, $vendorOrders, $totalAmount);

            if ($paymentResponse['success']) {
                $this->updateOrdersWithPayment($vendorOrders, $paymentResponse);
                Cart::clear();
                DB::commit();
                
                $this->dispatchNotifications($vendorOrders, $validatedData);
                
                return $this->successResponse($paymentResponse);
            }

            throw new Exception($paymentResponse['message']);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Payment processing failed', [
                'error' => $e->getMessage(),
                'user_id' => $this->getUserId(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    private function decryptProductIds(array $cartItems): array
    {
        $decryptedItems = [];
        
        foreach ($cartItems as $index => $item) {
            try {
                $productId = Crypt::decryptString($item['product_id']);
                $decryptedItems[] = array_merge($item, ['decrypted_product_id' => $productId]);
            } catch (\Exception $e) {
                Log::error('Failed to decrypt product ID', [
                    'item_index' => $index,
                    'error' => $e->getMessage()
                ]);
                throw new Exception('Invalid product data provided.');
            }
        }
        
        return $decryptedItems;
    }

    private function processCartItems($request, array $validatedData, array $cartItems): array
    {
        $vendorOrders = [];
        $processedProductIds = [];

        foreach ($cartItems as $cartItem) {
            $productId = $cartItem['decrypted_product_id'];
            
            if (in_array($productId, $processedProductIds)) {
                throw new Exception('Duplicate product detected in cart.');
            }
            $processedProductIds[] = $productId;

            $lockKey = self::LOCK_PREFIX . $productId;
            
            $lock = Cache::lock($lockKey, self::LOCK_TIMEOUT);
            
            if (!$lock->get()) {
                throw new Exception('Product is being processed by another transaction. Please try again.');
            }

            try {
                $product = BusinessProduct::with('UserBusinessInfos.user')->findOrFail($productId);
                $this->validateStock($product, $cartItem);
                
                $itemTotal = $cartItem['price'] * $cartItem['quantity'];
                if ($itemTotal <= 0) {
                    throw new Exception('Invalid item total calculated.');
                }

                $product->increment('sold_qty', $cartItem['quantity']);
                
                $this->addToVendorOrder($vendorOrders, $product, $cartItem, $itemTotal, $request, $validatedData);
                
            } finally {
                $lock->release();
            }
        }

        return $vendorOrders;
    }

    private function validateStock(BusinessProduct $product, array $cartItem): void
    {
        $availableStock = $product->max_qty - $product->sold_qty;
        
        if ($cartItem['quantity'] > $availableStock) {
            Log::warning('Insufficient stock', [
                'product_name' => $product->name,
                'requested' => $cartItem['quantity'],
                'available' => $availableStock
            ]);
            throw new Exception("Insufficient stock for {$product->name}. Available: {$availableStock}");
        }
    }

    private function addToVendorOrder(array &$vendorOrders, BusinessProduct $product, array $cartItem, float $itemTotal, $request, array $validatedData): void
    {
        $sellerId = $product->business_id;
        $userBusinessInfo = $product->UserBusinessInfos;
        $sellerEmail = $userBusinessInfo->user->email ?? null;

        if (!isset($vendorOrders[$sellerId])) {
            $vendorOrders[$sellerId] = [
                'order' => $this->createPendingOrder($request, $validatedData, $sellerId),
                'items' => [],
                'email' => $sellerEmail,
                'subtotal' => 0,
                'all_items' => [],
            ];
            
            Log::info('Created order for vendor', [
                'seller_id' => $sellerId,
                'order_id' => $vendorOrders[$sellerId]['order']->id
            ]);
        }

        $orderItem = [
            'product_id' => $product->id,
            'quantity' => $cartItem['quantity'],
            'price' => $cartItem['price'],
            'total' => $itemTotal,
            'seller_id' => $sellerId,
            'user_id' => $userBusinessInfo->user_id ?? null,
        ];

        $vendorOrders[$sellerId]['items'][] = $orderItem;
        $vendorOrders[$sellerId]['subtotal'] += $itemTotal;
        $vendorOrders[$sellerId]['all_items'][] = (object) $orderItem;
    }

    private function calculateTotalAmount(array $vendorOrders): float
    {
        $totalAmount = 0;
        
        foreach ($vendorOrders as $sellerId => $vendorData) {
            if ($vendorData['subtotal'] <= 0) {
                Log::error('Invalid vendor subtotal', [
                    'seller_id' => $sellerId,
                    'subtotal' => $vendorData['subtotal']
                ]);
                throw new Exception('Invalid order calculation detected.');
            }
            $totalAmount += $vendorData['subtotal'];
        }
        
        return $totalAmount;
    }

    private function validatePaymentAmount(float $totalAmount): void
    {
        $maxAmount = config('payment.max_payment_amount');
        
        if ($totalAmount <= 0 || $totalAmount > $maxAmount) {
            Log::error('Invalid payment amount', ['total_amount' => $totalAmount]);
            throw new Exception('Invalid payment amount.');
        }
    }

    private function createOrderItems(array $vendorOrders): void
    {
        foreach ($vendorOrders as $sellerId => $vendorData) {
            $vendorData['order']->update(['total_amount' => $vendorData['subtotal']]);
            
            foreach ($vendorData['items'] as $item) {
                if (empty($item['seller_id'])) {
                    Log::warning('Skipping item with missing seller_id');
                    continue;
                }
                
                StoreOrderItem::create([
                    'store_order_id' => $vendorData['order']->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['total'],
                    'seller_id' => $item['seller_id'],
                    'user_id' => $item['user_id'],
                ]);
            }
        }
    }

    private function handlePayment(array $validatedData, array $vendorOrders, float $totalAmount): array
    {
        $orderIds = collect($vendorOrders)->pluck('order.id')->implode(',');
        $truncatedOrderIds = substr($orderIds, 0, 40);
        
        Log::info('Processing payment', [
            'order_count' => count($vendorOrders),
            'total_amount' => number_format($totalAmount, 2)
        ]);
        
        return $this->createPayment($validatedData['nonce'], $totalAmount, $truncatedOrderIds);
    }

    private function updateOrdersWithPayment(array $vendorOrders, array $paymentResponse): void
    {
        foreach ($vendorOrders as $vendorData) {
            $vendorData['order']->update([
                'payment_id' => $paymentResponse['payment_id'],
                'payment_status' => 'success',
            ]);
        }
        
        Log::info('Orders updated with payment', [
            'payment_id' => $paymentResponse['payment_id'],
            'order_count' => count($vendorOrders)
        ]);
    }

    private function dispatchNotifications(array $vendorOrders, array $validatedData): void
    {
        $recipientEmail = auth()->check() ? auth()->user()->email : $validatedData['email'];
        $firstOrder = $vendorOrders[array_key_first($vendorOrders)]['order'] ?? null;
        $adminEmail = config('payment.admin_email');
        $allItems = collect($vendorOrders)->flatMap(fn($vendor) => $vendor['all_items']);

        // Customer Order Confirmation Email
        try {
            // Get all items for the customer email (similar to admin email)
            $customerItems = $allItems;
            $firstProduct = $customerItems->first() ?? null;

            Mail::to($recipientEmail)->send(new CustomerOrderConfirmationMail(
                $firstOrder,
                $firstProduct,
                auth()->user() ?? (object)['email' => $recipientEmail]
            ));

            Log::info('Customer order confirmation email sent successfully', [
                'recipient' => $recipientEmail,
                'order_id' => $firstOrder->id ?? 'unknown'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send customer order confirmation email', [
                'recipient' => $recipientEmail,
                'order_id' => $firstOrder->id ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }

        // Vendor Order Notification Emails
        foreach ($vendorOrders as $sellerId => $vendorData) {
            if (empty($vendorData['email'])) {
                Log::warning('Vendor email missing, skipping notification', [
                    'seller_id' => $sellerId,
                    'order_id' => $vendorData['order']->id ?? 'unknown'
                ]);
                continue;
            }

            try {
                $vendorItems = StoreOrderItem::where('store_order_id', $vendorData['order']->id)->get();
                
                Mail::to($vendorData['email'])->send(new VendorOrderNotificationMail(
                    $vendorData['order'],
                    $vendorData['email'],
                    $vendorItems
                ));

                Log::info('Vendor order notification email sent successfully', [
                    'seller_id' => $sellerId,
                    'vendor_email' => $vendorData['email'],
                    'order_id' => $vendorData['order']->id
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send vendor order notification email', [
                    'seller_id' => $sellerId,
                    'vendor_email' => $vendorData['email'],
                    'order_id' => $vendorData['order']->id ?? 'unknown',
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        // Admin Order Notification Email
        if ($adminEmail && !empty($adminEmail)) {
            try {
                // Get all items for admin email
                $adminItems = $allItems;
                $firstProduct = $adminItems->first() ?? null;

                Mail::to($adminEmail)->send(new AdminOrderNotificationMail(
                    $firstOrder,
                    auth()->user() ?? (object)['email' => $recipientEmail],
                    $firstProduct
                ));

                Log::info('Admin order notification email sent successfully', [
                    'admin_email' => $adminEmail,
                    'order_id' => $firstOrder->id ?? 'unknown'
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send admin order notification email', [
                    'admin_email' => $adminEmail,
                    'order_id' => $firstOrder->id ?? 'unknown',
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        } else {
            Log::warning('Admin email not configured, skipping admin notification', [
                'config_key' => 'payment.admin_email'
            ]);
        }
    }

    private function getUserId(): ?int
    {
        return auth()->id();
    }

    private function successResponse(array $paymentResponse): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Payment successful!',
            'data' => [
                'payment_id' => $paymentResponse['payment_id'],
                'redirect_url' => route('checkout.success', ['payment_id' => $paymentResponse['payment_id']]),
            ]
        ]);
    }

    private function errorResponse(string $message, int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null
        ], $code);
    }


    // Square working code
    /*
    public function processPayment(ProcessPaymentRequest $request)
    {
        $validatedData = $request->validate([
            'nonce' => 'required|string',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'comments' => 'nullable|string|max:1000',
            'shipping_method' => 'required|string|in:eversabz,seller',
            'cartItems' => 'required|array',
            'cartItems.*.product_id' => 'required|string|distinct', // Add uniqueness
            'cartItems.*.quantity' => 'required|integer|min:1',
            'cartItems.*.price' => 'required|numeric|min:0',
        ]);
    
        if (Cart::isEmpty()) {
            Log::error('Cart is empty, cannot proceed with payment.', ['user_id' => auth()->id() ?? null]);
            return response()->json(['success' => false, 'message' => 'Your cart cannot be empty.'], 400);
        }
    
        try {
            DB::beginTransaction();
            Log::info('Processing multi-vendor order.', ['user_id' => auth()->id() ?? null]);
    
            $vendorOrders = [];
            $totalAmount = 0;
            $allItems = [];
    
            foreach ($validatedData['cartItems'] as $cartItem) {
                try {
                    Log::info('Processing cart item', [
                        'product_id' => $cartItem['product_id'],
                        'quantity' => $cartItem['quantity'],
                        'price' => $cartItem['price']
                    ]);
    
                    $productId = Crypt::decryptString($cartItem['product_id']);
                    $itemTotal = $cartItem['price'] * $cartItem['quantity'];
                    if ($itemTotal < 0) {
                        Log::error('Invalid item total', ['product_id' => $productId, 'item_total' => $itemTotal]);
                        throw new Exception("Invalid item total for product ID: {$productId}");
                    }
    
                    $product = BusinessProduct::with('UserBusinessInfos.user')->findOrFail($productId);
                    $availableStock = $product->max_qty - $product->sold_qty;
                    if ($cartItem['quantity'] > $availableStock) {
                        Log::error('Insufficient stock', [
                            'product_id' => $productId,
                            'requested_quantity' => $cartItem['quantity'],
                            'available_stock' => $availableStock
                        ]);
                        throw new Exception("The requested quantity for {$product->name} exceeds available stock: {$availableStock}.");
                    }
    
                    $product->increment('sold_qty', $cartItem['quantity']);
    
                    $sellerId = $product->business_id;
                    $userBusinessInfo = $product->UserBusinessInfos;
                    $sellerEmail = $userBusinessInfo->user->email ?? null;
    
                    if (!isset($vendorOrders[$sellerId])) {
                        $vendorOrders[$sellerId] = [
                            'order' => $this->createPendingOrder($request, $validatedData, $sellerId),
                            'items' => [],
                            'email' => $sellerEmail,
                            'subtotal' => 0,
                        ];
                        Log::info('Created pending order for vendor', [
                            'seller_id' => $sellerId,
                            'order_id' => $vendorOrders[$sellerId]['order']->id
                        ]);
                    }
    
                    $vendorOrders[$sellerId]['items'][] = [
                        'product_id' => $product->id,
                        'quantity' => $cartItem['quantity'],
                        'price' => $cartItem['price'],
                        'total' => $itemTotal,
                        'seller_id' => $sellerId,
                        'user_id' => $userBusinessInfo->user_id ?? null,
                    ];
                    $vendorOrders[$sellerId]['subtotal'] += $itemTotal;
                    $totalAmount += $itemTotal;
    
                    $allItems[] = (object) [
                        'product_id' => $product->id,
                        'quantity' => $cartItem['quantity'],
                        'price' => $cartItem['price'],
                        'total' => $itemTotal,
                        'seller_id' => $sellerId,
                        'user_id' => $userBusinessInfo->user_id ?? null,
                    ];
                } catch (\Exception $e) {
                    Log::error('Error processing cart item', [
                        'product_id' => $cartItem['product_id'] ?? 'unknown',
                        'error' => $e->getMessage(),
                    ]);
                    throw $e;
                }
            }
    
            foreach ($vendorOrders as $sellerId => $vendorData) {
                if ($vendorData['subtotal'] <= 0) {
                    Log::error('Invalid subtotal for vendor order', [
                        'seller_id' => $sellerId,
                        'subtotal' => $vendorData['subtotal'],
                        'order_id' => $vendorData['order']->id,
                    ]);
                    throw new Exception("Invalid subtotal for vendor order with seller_id: {$sellerId}");
                }
            }
    
            if ($totalAmount <= 0 || $totalAmount > 99999999.99) {
                Log::error('Invalid payment amount', ['total_amount' => $totalAmount]);
                throw new Exception('Invalid payment amount.');
            }
    
            foreach ($vendorOrders as $sellerId => $vendorData) {
                try {
                    $vendorData['order']->update(['total_amount' => $vendorData['subtotal']]);
                    foreach ($vendorData['items'] as $item) {
                        if (!$item['seller_id']) {
                            Log::warning('Missing seller_id for item', ['item' => $item]);
                            continue;
                        }
                        StoreOrderItem::create([
                            'store_order_id' => $vendorData['order']->id,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'total' => $item['total'],
                            'seller_id' => $item['seller_id'],
                            'user_id' => $item['user_id'],
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('Error creating StoreOrderItem records', [
                        'seller_id' => $sellerId,
                        'order_id' => $vendorData['order']->id,
                        'error' => $e->getMessage(),
                    ]);
                    throw $e;
                }
            }
    
            Log::info('Overall order total amount calculated: $' . number_format($totalAmount, 2));
    
            $orderIds = substr(collect($vendorOrders)->pluck('order.id')->implode(','), 0, 40);
            Log::info('Processing payment with nonce: ' . $validatedData['nonce'], ['order_ids' => $orderIds]);
            $paymentResponse = $this->createPayment($validatedData['nonce'], $totalAmount, $orderIds);
    

            if ($paymentResponse['success']) {
                Log::info('Payment successful. Updating orders and sending notifications.', [
                    'payment_id' => $paymentResponse['payment_id'],
                    'order_ids' => $orderIds
                ]);

                foreach ($vendorOrders as $vendorData) {
                    $vendorData['order']->update([
                        'payment_id' => $paymentResponse['payment_id'],
                        'payment_status' => 'success',
                    ]);
                }

                $recipientEmail = auth()->check() ? auth()->user()->email : $validatedData['email'];
                $firstOrder = $vendorOrders[array_key_first($vendorOrders)]['order'] ?? null;
                $adminEmail = config('constants.ADMIN_EMAIL');

                // Customer email (send immediately)
                try {
                    SendOrderEmail::dispatch($recipientEmail, [
                        'firstOrder' => $firstOrder,
                        'allItems' => collect($allItems),
                        'user' => auth()->user(),
                    ]);
                } catch (\Exception $e) {
                    Log::error('Customer email sending failed', ['email' => $recipientEmail, 'error' => $e->getMessage()]);
                }

                foreach ($vendorOrders as $sellerId => $vendorData) {
                    $vendorSpecificItems = StoreOrderItem::where('store_order_id', $vendorData['order']->id)->get();

                    Log::info('Sending vendor notification to: ' . $vendorData['email'], [
                        'seller_id' => $sellerId,
                        'order_id' => $vendorData['order']->id
                    ]);

                    try {
                        SendVendorEmail::dispatch($vendorData['email'], [
                            'order' => $vendorData['order'],
                            'email' => $vendorData['email'],
                            'items' => $vendorSpecificItems,
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Vendor email sending failed', [
                            'email' => $vendorData['email'],
                            'seller_id' => $sellerId,
                            'order_id' => $vendorData['order']->id,
                            'error' => $e->getMessage()
                        ]);
                    }
                }

                try {
                    SendAdminEmail::dispatch($adminEmail, [
                        'firstOrder' => $firstOrder,
                        'user' => auth()->user(),
                        'allItems' => collect($allItems),
                    ]);
                } catch (\Exception $e) {
                    Log::error('Admin email sending failed', ['email' => $adminEmail, 'error' => $e->getMessage()]);
                }

                Cart::clear();
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful!',
                    'redirect_url' => route('checkout.success', ['payment_id' => $paymentResponse['payment_id']]),
                ]);
            } else {
                Log::error('Payment failed', ['payment_response' => $paymentResponse, 'order_ids' => $orderIds]);
                throw new Exception($paymentResponse['message']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error processing multi-vendor payment', [
                'error_message' => $e->getMessage(),
                'user_id' => auth()->id() ?? null,
                'order_ids' => isset($orderIds) ? $orderIds : null
            ]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    */
        


/*
    private function createCommWebPayment($sessionId, $totalAmount)
    {
        $merchantId = config('commweb.merchant_id');
        $apiUrl = "https://paymentgateway.commbank.com.au/api/rest/version/72/merchant/{$merchantId}/transaction";

        $data = [
            'transaction' => [
                'session' => ['id' => $sessionId],
                'order' => [
                    'amount' => $totalAmount,
                    'currency' => 'USD'
                ],
                'apiOperation' => 'PAY'
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(config('commweb.api_username') . ':' . config('commweb.api_password')),
            'Content-Type' => 'application/json'
        ])->post($apiUrl, $data);

        if ($response->successful()) {
            return [
                'success' => true,
                'payment_id' => $response->json('transaction.id')
            ];
        }

        return [
            'success' => false,
            'message' => $response->json('error.explanation') ?? 'Payment failed.'
        ];
    }*/


    private function createPendingOrder(Request $request, array $validatedData, $sellerId = null)
    {
        $userId = auth()->id();
        $guestEmail = $userId ? null : ($validatedData['email'] ?? null);

        $orderData = [
            'user_id' => $userId,
            'guest_email' => $guestEmail,
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'shipping_method' => $validatedData['shipping_method'],
            'address' => $validatedData['address'],
            'city' => $validatedData['city'],
            'state' => $validatedData['state'],
            'zip_code' => $validatedData['zip_code'],
            'country' => $validatedData['country'],
            'comments' => $validatedData['comments'] ?? null,
            'payment_status' => 'pending',
            'total_amount' => 0,
            'seller_id' => $sellerId,
        ];

        return DB::transaction(function () use ($userId, $guestEmail, $orderData, $sellerId) {
            $existingOrder = StoreOrder::where('payment_status', 'pending')
                ->when($userId, fn($q) => $q->where('user_id', $userId))
                ->when(!$userId, fn($q) => $q->where('guest_email', $guestEmail))
                ->when($sellerId, fn($q) => $q->where('seller_id', $sellerId))
                ->first();

            if ($existingOrder) {
                Log::info('Updating existing pending order for vendor', [
                    'order_id' => $existingOrder->id,
                    'seller_id' => $sellerId,
                    'user_id' => $userId,
                    'guest_email' => $guestEmail
                ]);
                $existingOrder->update($orderData);

                if (empty($existingOrder->order_product_unique_id)) {
                    $existingOrder->order_product_unique_id = $this->generateUniqueSixDigitIdWithRetry();
                    $existingOrder->save();
                }

                session(["order_id_{$sellerId}" => $existingOrder->id]);
                return $existingOrder;
            }

            Log::info('Creating new pending order for vendor', [
                'seller_id' => $sellerId,
                'user_id' => $userId,
                'guest_email' => $guestEmail
            ]);

            $newOrder = StoreOrder::create($orderData);
            $newOrder->order_product_unique_id = $this->generateUniqueSixDigitIdWithRetry();
            $newOrder->save(); // Ensure save is called

            session(["order_id_{$sellerId}" => $newOrder->id]);
            return $newOrder;
        });
    }

    private function generateUniqueSixDigitIdWithRetry(int $maxRetries = 5): string
    {
        $attempt = 0;

        while ($attempt < $maxRetries) {
            try {
                $id = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

                if (!StoreOrder::where('order_product_unique_id', $id)->exists()) {
                    return $id;
                }

            } catch (QueryException $e) {
                if ($e->getCode() == '23000') {
                    $attempt++;
                    continue;
                }
                throw $e;
            }

            $attempt++;
        }

        throw new \Exception("Could not generate a unique 6-digit ID after {$maxRetries} attempts.");
    }
    



    private function createPayment($nonce, $totalAmount, $orderId)
    {
        try {
            $client = new \Square\SquareClient([
                'accessToken' => config('services.square.access_token'),
                'environment' => config('services.square.environment', 'production'),
            ]);

            $money = new \Square\Models\Money();
            $money->setAmount((int) ($totalAmount * 100));
            $money->setCurrency('AUD');

            $paymentRequest = new \Square\Models\CreatePaymentRequest(
                $nonce,
                uniqid()
            );

            $paymentRequest->setAmountMoney($money);
            $paymentRequest->setReferenceId((string) $orderId);

            $paymentsApi = $client->getPaymentsApi();
            $response = $paymentsApi->createPayment($paymentRequest);

            if ($response->isSuccess()) {
                $payment = $response->getResult()->getPayment();
                return [
                    'success' => true,
                    'payment_id' => $payment->getId(),
                ];
            } else {
                $errors = $response->getErrors();
                return [
                    'success' => false,
                    'message' => $errors ? $errors[0]->getDetail() : 'Payment failed.',
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }


    public function handlePaymentSuccess(Request $request)
    {
        \Log::info('Entered handlePaymentSuccess with request:', $request->all());

        $paymentId = $request->query('payment_id');

        if (!$paymentId) {
            \Log::error('Missing payment_id in request.');
            return redirect()->route('order.failed')->with('error', 'Payment ID is missing.');
        }

        $client = new \Square\SquareClient([
            'accessToken' => config('services.square.access_token'),
            'environment' => config('services.square.environment', 'sandbox'),
        ]);

        try {
            $paymentsApi = $client->getPaymentsApi();
            $paymentResponse = $paymentsApi->getPayment($paymentId);

            if (!$paymentResponse->isSuccess()) {
                \Log::error('Failed to fetch payment details from Square API:', $paymentResponse->getErrors());
                return redirect()->route('order.failed')->with('error', 'Unable to retrieve payment details.');
            }

            $payment = $paymentResponse->getResult()->getPayment();
            \Log::info('Square payment fetched:', $payment->jsonSerialize());

            if ($payment->getStatus() === 'COMPLETED') {
                $orderId = $payment->getReferenceId();
                $storeOrder = StoreOrder::where('id', $orderId)
                ->with(['items.product'])

                ->firstOrFail();
                \Log::info('Order found:', $storeOrder->toArray());

                if ($storeOrder->payment_id !== $paymentId) {
                    $storeOrder->update([
                        'payment_id' => $paymentId,
                        'payment_status' => 'success',
                    ]);
                    \Log::info('Order updated with payment details.');
                }

                return view('website.thank-you', [
                    'paymentId' => $paymentId,
                    'storeOrder' => $storeOrder,
                ]);
            } else {
                return redirect()->route('checkout.failed')->with('error', 'Payment is not completed.');
            }
        } catch (\Exception $e) {
            \Log::error('Error in handlePaymentSuccess:', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('checkout.failed')->with('error', 'An error occurred while processing payment.');
        }
    }


    public function handlePaymentFailed(Request $request)
    {
        return view('website.failed');
    }


    public function handlePaymentCancel(Request $request)
    {
        $orderId = $request->query('order_id'); 
        $storeOrder = StoreOrder::find($orderId);

        if ($storeOrder) {
            // Log or update the order as "Cancelled"
            \Log::info('Payment was cancelled for order ID: ' . $orderId);
            $storeOrder->update(['payment_status' => 'CANCELLED']);
        }

        return view('website.cancel', [
            'order_id' => $orderId,
            'message' => 'Your payment has been cancelled. Please try again or contact support.',
        ]);
    }


}
