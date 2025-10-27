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
use Barryvdh\DomPDF\Facade\Pdf;
 


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

            if ($status == 'Pending') {
                $statusHtml = '<span class="status-badge bg-warning-faint text-warning-dark">
                                  <span class="status-dot bg-warning-dark"></span> Pending
                               </span>';
            } elseif ($status == 'Completed') {
                $statusHtml = '<span class="status-badge bg-success-faint text-success-dark">
                                  <span class="status-dot bg-success-dark"></span> Completed
                               </span>';
            } elseif ($status == 'Failed') {
                $statusHtml = '<span class="status-badge bg-danger-faint text-danger-dark">
                                  <span class="status-dot bg-danger-dark"></span> Failed
                               </span>';
            } else {
                $statusHtml = '<span class="status-badge bg-secondary-faint text-secondary-dark">
                                  <span class="status-dot bg-secondary-dark"></span>' . ucfirst($status) . '
                               </span>';
            }

            $eventTitle = $order->event->title ?? 'N/A';

            if ($eventTitle === 'EverSabz Launch in Australia') {
                $eventHtml = '<span class="status-badge bg-primary-faint text-primary-dark">
                                 <span class="status-dot bg-primary-dark"></span>' . htmlspecialchars($eventTitle) . '
                              </span>';
            } else {
                $eventHtml = '<span class="status-badge bg-secondary-faint text-secondary-dark">
                                 <span class="status-dot bg-secondary-dark"></span>' . htmlspecialchars($eventTitle) . '
                              </span>';
            }



    
            // Populate the data row, ensuring the order matches the table headers
            $result['data'][] = [
                $order->order_event_unique_id ?? '-',                             // Order ID
                $eventHtml,          // Event
                $order->first_name || $order->last_name
                ? trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? ''))
                : '-',
                (($order->email ?? '-') ?? ($order->guest_email ?? '-')) ?? '-',                  // Order For
                $statusHtml,                                // Status
                optional($order->created_at)->format('d-m-Y'),
                optional($order->updated_at)->format('d-m-Y'),
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
            ->orderBy('created_at', 'desc');
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
            
            $buttons .= '<a href="' . route('orderitem.print', ['id' => $storeOrder->id]) . '" 
                class="btn btn-default btn-sm icon-btn" 
                title="Print Invoice" 
                target="_blank">
                <i class="fa fa-print"></i>
             </a>';

            $buttons .= '<a href="' . route('orderitem.download.pdf', ['id' => $storeOrder->id]) . '" 
                            class="btn btn-default btn-sm icon-btn" 
                            title="Download PDF">
                            <i class="fa fa-file-pdf-o" style="color:red;"></i>
                         </a>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="removeFunc(\'' . $storeOrder->id . '\')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            $itemDetails = $storeOrder->items->map(function ($item) {
                return $item->product->title ?? 'Product not found';

            })->implode(', ');


            $status = strtolower($storeOrder->payment_status);

            if ($status === 'success') {
                $statusHtml = '<span class="status-badge status-success"><span class="status-dot"></span>' . ucfirst($status) . '</span>';
            } elseif ($status === 'failed') {
                $statusHtml = '<span class="status-badge status-failed"><span class="status-dot"></span>' . ucfirst($status) . '</span>';
            } elseif ($status === 'pending') {
                $statusHtml = '<span class="status-badge status-pending"><span class="status-dot"></span>' . ucfirst($status) . '</span>';
            } else {
                $statusHtml = '<span class="status-badge"><span class="status-dot"></span>' . ucfirst($status) . '</span>';
            }

            $itemStatus = strtolower($storeOrder->items->first()->status);

            if ($itemStatus === 'pending') {
                $itemStatusHtml = '<span class="item-status-badge item-status-pending"><span class="item-status-dot"></span>' . ucfirst($itemStatus) . '</span>';
            } elseif ($itemStatus === 'success') {
                $itemStatusHtml = '<span class="item-status-badge item-status-success"><span class="item-status-dot"></span>' . ucfirst($itemStatus) . '</span>';
            } elseif ($itemStatus === 'failed') {
                $itemStatusHtml = '<span class="item-status-badge item-status-failed"><span class="item-status-dot"></span>' . ucfirst($itemStatus) . '</span>';
            } else {
                $itemStatusHtml = '<span class="item-status-badge"><span class="item-status-dot"></span>' . ucfirst($itemStatus) . '</span>';
            }

            $shippingMethod = $storeOrder->shipping_method ?? '-';

            if (strtolower($shippingMethod) === 'eversabz') {
                $shippingHtml = '<span class="shipping-badge shipping-eversabz"><span class="shipping-dot"></span>' . ucfirst($shippingMethod) . '</span>';
            } else {
                $shippingHtml = '<span class="shipping-badge shipping-default"><span class="shipping-dot"></span>' . ucfirst($shippingMethod) . '</span>';
            }

            $businessName = $storeOrder?->business?->business_name ?? '-';

            if ($businessName === 'Everstore Australia') {
                $businessHtml = '<span class="business-badge business-everstore">
                                    <span class="business-dot"></span>' . htmlspecialchars($businessName) . '
                                 </span>';
            } else {
                $businessHtml = '<span class="business-badge business-default">
                                    <span class="business-dot"></span>' . htmlspecialchars($businessName) . '
                                 </span>';
            }


            // ✅ Product count
                $productCount = $storeOrder->items->count();
            
            $result['data'][] = [
                $storeOrder->order_product_unique_id,
                $storeOrder->created_at->format('d-m-Y H:i'),
                $productCount,
                $storeOrder->full_name ?? 'Guest User',
                $businessHtml,
                $statusHtml,
                $itemStatusHtml,
                $shippingHtml,
                optional($storeOrder->created_at)->format('d-m-Y'),
                optional($storeOrder->updated_at)->format('d-m-Y'),
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

    public function printInvoice($id)
    {
        $order = StoreOrder::with(['items.product'])->findOrFail($id);
        return view('admin.order.invoice', compact('order'));
    }

    public function downloadPDF($id)
    {
        $order = StoreOrder::with(['items.product'])->findOrFail($id);

        // Generate PDF
        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ])->loadView('admin.order.invoice', compact('order'))
          ->setPaper('a4', 'portrait');

        // Create file name and path
        $uniqueFileName = 'Order_' . $order->order_product_unique_id . '.pdf';
        $relativePath = 'public/' . $uniqueFileName;
        $fullPath = Storage::path($relativePath);

        // Save PDF to storage
        $pdf->save($fullPath);

        // Check if file exists
        if (!file_exists($fullPath)) {
            return response()->json(['error' => 'PDF not found.'], 404);
        }

        // ✅ Force browser to download instead of view inline
        return response()->download($fullPath, $uniqueFileName, [
            'Content-Type' => 'application/pdf',
        ])->deleteFileAfterSend(false); // Set true if you want to auto-delete after download
    }


}
