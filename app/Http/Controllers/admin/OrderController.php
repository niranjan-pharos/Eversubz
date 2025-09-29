<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\OrderEvent;
use App\Models\OrderTicket;
use App\Models\User;
use App\Models\Event; 
use App\Models\StoreOrder;
use App\Models\StoreOrderItem;
 


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        //
    }

    public function orderticket()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Events Tickets Orders',
                'url' => null
            ],
        ];
        $orders = OrderEvent::with(['event:id,title', 'user:id,name']) // Fetch related Event and User data
        ->orderBy('id', 'desc')
        ->get();
     
        return view('admin.order.ordertickets', compact('breadcrumbs', 'orders'));
    }
    
    

    public function fetchTableData()
    { 
        $result = ['data' => []];  
        $orders = OrderEvent::with(['event:id,title', 'user:id,name']) // Fetch related Event and User data
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($orders as $order) {
            $buttons = '';
    
            // Define action buttons
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="viewFunc(' . $order->id . ')"><i class="fa fa-eye"></i></button>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="removeFunc(\'' . $order->id . '\')" ><i class="fa fa-trash"></i></button>';
    
            // Show the status directly as text 
            $status = ucfirst($order->status); // Capitalize the first letter for display
    
            // Populate the data row, ensuring the order matches the table headers
            $result['data'][] = [
                $order->order_event_unique_id,                             // Order ID
                $order->event->title ?? 'N/A',          // Event
                $order->first_name || $order->last_name
    ? trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? ''))
    : 'N/A',
                $order->email ?? $order->guest_email,                  // Order For
                $status,                                // Status
                $buttons                                // Action
            ]; 
        }
    
        return response()->json($result);
    }
    
    public function viewOrder($orderId)
    {

        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Events Tickets Orders',
                'url' => null
            ],
        ];  
        try { 
            $order = OrderEvent::with(['orderTickets', 'event', 'user'])->findOrFail($orderId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }
        return view('admin.order.viewticketorder', compact('breadcrumbs', 'order'));
    }


    public function orderitem()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Items Orders',
                'url' => null
            ],
        ];
    
        return view('admin.order.orderitems', compact('breadcrumbs'));
    }
    
    public function fetchOrderItemsData(Request $request)
    {
        $result = ['data' => []];

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $storeOrdersQuery = StoreOrder::whereHas('items')
            ->with(['items.product','business','user'])
            ->orderBy('id', 'desc');
        if ($request->has('search') && $request->input('search')['value']) {
            $search = $request->input('search')['value'];
            $storeOrdersQuery->where(function ($query) use ($search) {
                $query->where('id', 'like', "%$search%")
                    ->orWhere('full_name', 'like', "%$search%")
                    ->orWhere('phone_number', 'like', "%$search%");
            });
        }

        $storeOrders = $storeOrdersQuery->skip($start)->take($length)->get();
        $totalRecords = StoreOrder::whereHas('items')->count();
        
        foreach ($storeOrders as $storeOrder) {
            
            $buttons  = '<a href="' . route('orderitem.view', ['id' => $storeOrder->id]) . '" class="btn btn-default btn-sm icon-btn"><i class="fa fa-eye"></i></a>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="removeFunc(\'' . $storeOrder->id . '\')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            $itemDetails = $storeOrder->items->map(function ($item) {
                return $item->product->title ?? 'Product not found';

            })->implode(', ');

            // ✅ Product count
                $productCount = $storeOrder->items->count();
            
            $result['data'][] = [
                $storeOrder->order_product_unique_id,
                $storeOrder->created_at->format('d-m-Y H:i'),
                // $storeOrder->user->uid,
                $productCount,
                $storeOrder->full_name ?? 'Guest User',
                // $storeOrder->email ?? $storeOrder->guest_email,
                $storeOrder?->business?->business_name ?? '-',
                ucfirst($storeOrder->payment_status),
                ucfirst($storeOrder->items->first()->status),
                $storeOrder->shipping_method ?? '-',
                $buttons
            ];
        }
        
        $result['recordsTotal'] = $totalRecords;
        $result['recordsFiltered'] = $totalRecords;
        Log::info('DataTable Response for Orders:', $result);
        return response()->json($result);
    }

    public function vieworderitem($id)
    {
        
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'items orders',
                'url' => route('orderitem')
            ],
            [
                'label' => ' Order details',
                'url' => null
            ],
        ];  
        // Fetch the order with its items and related product details
        // $order = StoreOrder::with(['items.product'])->findOrFail($id);
        $order = StoreOrder::with([
            'items.product.businessInfo' 
        ])->findOrFail($id);
        if ($order && $order->user_id) {
            $user = DB::table('users')->where('id', $order->user_id)->first();
            $uid = $user ? $user->uid : null;
        } else {
            $uid = null;
        }

        return view('admin.order.vieworderitem', compact('breadcrumbs', 'order'));
    }
    

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('del_id');
            $order = StoreOrder::with(['items', 'histories'])->find($id); 
        
            if (!$order) {
                return response()->json(['error' => true, 'messages' => 'Store Order not found']);
            }

            
            $order->items()->delete(); 
            $order->histories()->delete();

            $order->delete();
        
            return response()->json(['success' => true, 'messages' => 'Store Order deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'messages' => 'Error deleting Store Order', 'exception' => $e->getMessage()]);
        }
    }

   
}
