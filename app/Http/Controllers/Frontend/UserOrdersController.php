<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreOrder;
use App\Models\StoreOrderItem;
use App\Models\OrderStatusHistory;

use App\Models\UserBusinessInfos; 
use App\Models\OrderEvent;
use App\Models\OrderTicket;
use App\Models\OrderEventTicket;
use App\Models\User;
use App\Models\Event; 
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

 
class UserOrdersController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'You need to login first.');
        }

        $userId = Auth::id();
        $user = Auth::user();

        // Get the selected number of results per page, default to 10
        $resultsPerPage = $request->query('resultsPerPage', config('constants.DEFAULT_PAGINATION'));

        // Paginate the user's orders 
        $userOrders = StoreOrder::where('user_id', $userId)
                    ->orderBy('id', 'desc')
                    ->whereHas('items')
                    ->whereHas('user')
                    ->paginate($resultsPerPage);


        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 

        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');
        return view('frontend.orders.index', compact('userOrders', 'is_approved', 'businessName', 'resultsPerPage'));
    }


    public function vieworder($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
    
            if (!Auth::check()) {
                return redirect()->route('user.login')->with('error', 'You need to login first.');
            }
    
            $userId = Auth::id();
    
            $order = StoreOrder::with(['items.product', 'histories'])
                    ->where('user_id', $userId)
                    ->where('id', $decryptedId)
                    ->firstOrFail();

            return view('frontend.orders.vieworder', compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Invalid order ID or access denied.');
        }
    }
    
        
       
    public function updateCustomerOrderItemStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:store_orders,id',
            'seller_id' => 'required|integer',
            'status' => 'required|string',
            'comment' => 'nullable|string',
        ]);
    
        $userId = Auth::id();
    
        $order = StoreOrder::where('id', $request->order_id)
            ->where('user_id', $userId)
            ->first();
    
        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found or access denied.'
            ], 403);
        }
    
        $items = StoreOrderItem::where('store_order_id', $request->order_id)
            ->where('seller_id', $request->seller_id)
            ->get();
    
        if ($items->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No items found for this seller in the order.'
            ], 404);
        }
    
        $oldStatus = $items->first()->customer_status;
    
        if ($items->every(fn($item) => $item->customer_status === $request->status)) {
            return response()->json([
                'status' => 'info',
                'message' => 'Status is already up to date for all items.',
            ]);
        }
    
        foreach ($items as $item) {
            $item->customer_status = $request->status;
            $item->save();
        }
    
        $history = OrderStatusHistory::create([
            'store_order_id' => $request->order_id,
            'seller_id' => $request->seller_id,
            'changed_by_type' => 'customer',
            'changed_by' => $userId,
            'from_status' => $oldStatus ?? 'none',
            'to_status' => $request->status,
            'comment' => $request->comment,
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Customer status updated for all items from this seller.',
            'history' => [
                'from' => ucfirst($history->from_status),
                'to' => ucfirst($history->to_status),
            ]
        ]);
    }
    

    

   public function mytickets(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('user.login')->with('error', 'You need to login first.');
    }

    $userId = Auth::id();
    $user = Auth::user();

    $resultsPerPage = $request->query('resultsPerPage', config('constants.DEFAULT_PAGINATION'));

    $orders = OrderEvent::where('user_id', $userId)
    ->where('status', 'completed')
    ->orderBy('id', 'desc')

    ->with(['event', 'orderTickets.ticketType']) // Eager load relationships
    ->paginate($resultsPerPage);



    $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;

    return view('frontend.orders.myticketsorder', compact('orders', 'is_approved', 'resultsPerPage'));
}

public function viewTicketOrder($id)
{
    try {
        // Decrypt the ID
        $decryptedId = Crypt::decrypt($id);

        // Ensure the user is logged in
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'You need to login first.');
        }

        $userId = Auth::id();

        // Fetch the ticket order details with related data
        $order = OrderEvent::with(['event', 'orderTickets.ticketType'])
            ->where('user_id', $userId)
            ->where('id', $decryptedId)
            ->firstOrFail();

        return view('frontend.orders.ticketorderdetails', compact('order', 'decryptedId'));
    } catch (\Exception $e) {
        // Handle decryption errors or invalid IDs
        return redirect()->route('dashboard')->with('error', 'Invalid ticket order ID or access denied.');
    }
}



}
