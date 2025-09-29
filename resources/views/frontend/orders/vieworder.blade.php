@extends('frontend.template.master')
@section('title', "My Orders")

@section('content')
@include('frontend.template.usermenu')

<style>
    h3,
    h4,
    .card-title {
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 16px;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
    }

    section {
        padding: 30px 0;
    }

    .order-details {
        margin-bottom: 30px;
    }


    /* .card-body .card {
            height: 250px;
        } */

    .card-body {
        padding: 20px;
    }

    .card-header {
        background-color: #007bff36;
        color: #000000;
        font-size: 18px;
        font-weight: bold;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        margin-bottom: 0px;
    }


    .card-title i {
        margin-right: 10px;
        color: #007bff;
    }

    .card p {

        justify-content: space-between;
        margin-bottom: 5px;
    }

    .badge {
        color: #fff;
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 5px;
    }


    .table th {
        background-color: #007bff36;
        color: #000;
        text-transform: uppercase;
        font-size: 14px;
        padding: 10px;
    }

    .table td {
        padding: 10px;
        font-size: 14px;
        vertical-align: middle;
    }

    .odd-row {
        background-color: #f9f9f9;
    }

    .even-row {
        background-color: #ffffff;
    }

    .table tr:hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s ease;
    }

    .custom-table {
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
    }

    .custom-table th,
    .custom-table td {
        border: 1px solid #ddd;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .order-details .card {
        background: transparent;
        border: none;
    }

    .card-body {
        padding: 20px;
    }

    .order-details .card .card-body .card {
        border: none;
        border-radius: 5px;
        background: #fff;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
    }

    .body12 {
        padding: 0px;
    }

    .modal-header {
        background: #BFD9F6;
    }

    @media (max-width: 767.98px) {
        .custom-table thead {
            display: none;
        }

        .custom-table,
        .custom-table tbody,
        .custom-table tr,
        .custom-table td {
            display: block;
            width: 100%;
        }

        .custom-table tr {
            margin-bottom: 1rem;
            border-radius: 8px;
        }

        .custom-table td {
            text-align: right;
            padding-left: 50%;
            position: relative;
        }

        .custom-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 10px;
            top: 10px;
            font-weight: bold;
            text-align: left;
            white-space: nowrap;
        }

    }
</style>
<section class="inner-section category-part myads-part">
    <div class="container">
        <div class="row">
            <div class="order-details" style="    width: 100%;">
                <h3>Order Details</h3>
                <div class="card">
                    <div class="card-header">
                        Order ID: {{ $order->order_product_unique_id }}
                    </div>

                    <div class="row card-body body12">
                        <!-- User Details -->
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Order Information</h5>
                                    <hr>
                                    <p><strong>Total Amount:</strong> ${{ number_format($order->items->sum(function
                    ($item) {
                    return $item->price * $item->quantity;
                    }), 2) }}</p>
                                    <p><strong>Comments:</strong> {{ $order->comments }}</p>
                                    <p><strong>Payment Status:</strong> <span class="badge bg-success">{{
                      ucfirst($order->payment_status) }}</span></p>
                                    <p><strong>Payment ID:</strong> {{ $order->payment_id }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-user"></i> Customer Details</h5>
                                    <hr>
                                    <p><strong>Full Name:</strong> {{ $order->full_name }}</p>
                                    <p><strong>User ID:</strong> {{ $order->user_id ?? 'Guest' }}</p>
                                    <p><strong>Email:</strong> {{ $order->email ?? $order->guest_email }}</p>
                                    <p><strong>Phone Number:</strong> {{ $order->phone_number ?? 'N/A' }}</p>
                                    <p><strong>Order Date:</strong> {{ $order->created_at ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- User Address -->
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-map-marker-alt"></i> Shipping Address</h5>
                                    <hr>
                                    <p><strong>Address:</strong> {{ $order->address }}</p>
                                    <p><strong>City:</strong> {{ $order->city }}</p>
                                    <p><strong>State:</strong> {{ $order->state }}</p>
                                    <p><strong>Zip Code:</strong> {{ $order->zip_code }}</p>
                                    <p><strong>Country:</strong> {{ $order->country }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Information -->


                        <!-- Order Items -->
                        <h4>Order Items</h4>
                        @php
                        $itemsBySeller = $order->items->groupBy('seller_id');
                        @endphp

                        @foreach ($itemsBySeller as $sellerId => $sellerItems)
                        @php
                        $sellerName = $sellerItems->first()->product->businessInfo->business_name ?? 'N/A';
                        @endphp

                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title d-flex justify-content-between align-items-center">
                                        Seller: {{ $sellerName }}
                                        <!-- Dynamic Button for Modal -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#sellerModal{{ $sellerId }}">
                                            View
                                        </button>
                                    </h4>

                                    <div class="table-responsive">
                                        <table class="table table-bordered custom-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Status by Seller</th>
                                                    <th>Status by Customer</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sellerItems as $item)
                                                @php
                                                $statusColors = [
                                                'pending' => 'secondary',
                                                'processing' => 'info',
                                                'shipped' => 'primary',
                                                'delivered' => 'success',
                                                'completed' => 'success',
                                                'cancelled' => 'danger',
                                                'received' => 'success',
                                                ];
                                                $sellerColor = $statusColors[$item->status] ?? 'dark';
                                                $customerColor = $statusColors[$item->customer_status] ?? 'dark';
                                                @endphp
                                                <tr>
                                                    <td data-label="Product Name">{{ $item->product->title ?? 'N/A' }}
                                                    </td>
                                                    <td data-label="Status by Seller">
                                                        <span
                                                            class="badge bg-{{ $sellerColor }}">{{ ucfirst($item->status) }}</span>
                                                    </td>
                                                    <td data-label="Status by Customer">
                                                        <span
                                                            class="badge bg-{{ $customerColor }}">{{ ucfirst($item->customer_status ?? 'N/A') }}</span>
                                                    </td>
                                                    <td data-label="Quantity">{{ $item->quantity }}</td>
                                                    <td data-label="Price">${{ number_format($item->price, 2) }}</td>
                                                    <td data-label="Total">${{ number_format($item->total, 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Each Seller -->
                        <div class="modal fade" id="sellerModal{{ $sellerId }}" tabindex="-1"
                            aria-labelledby="sellerModalLabel{{ $sellerId }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sellerModalLabel{{ $sellerId }}">Seller: {{
                             $sellerName }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Seller ID:</strong> {{ $sellerId }}</p>
                                        <p><strong>Total Items:</strong> {{ $sellerItems->count() }}</p>
                                        <ul>
                                            @foreach($sellerItems as $item)
                                            <li>{{ $item->product->title ?? 'N/A' }} — Qty: {{ $item->quantity }},
                                                Price: ${{
                                                 number_format($item->price, 2) }}</li>
                                            @endforeach
                                        </ul>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="update-status-form" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <input type="hidden" name="seller_id" value="{{ $sellerId }}">

                                                    <div class="mb-2">
                                                        <label for="status" class="form-label">Change Status</label>
                                                        <select name="status" class="form-control" required>
                                                            <option value="">-- Select Status --</option>
                                                            <option value="received">Received</option>
                                                            <option value="cancelled">Cancelled</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="comment" class="form-label">Comment
                                                            (optional)</label>
                                                        <textarea name="comment" class="form-control"></textarea>
                                                    </div>

                                                    <button type="submit" class="btn btn-danger btn-sm">Update
                                                        Status</button>
                                                </form>


                                            </div>

                                            <div class="col-md-6">
                                                @php
                                                // Filter histories where:
                                                // - changed_by_type is 'customer'
                                                // - store_order_id and seller_id match
                                                $sellerHistories = $order->histories
                                                ->where('changed_by_type', 'customer')
                                                ->where('store_order_id', $order->id)
                                                ->where('seller_id', $sellerId)
                                                ->sortByDesc('created_at');
                                                @endphp

                                                @if($sellerHistories->isNotEmpty())
                                                <h5>Status History (Customer)</h5>
                                                <ul class="list-group">
                                                    @foreach($sellerHistories as $history)
                                                    <li class="list-group-item">
                                                        <strong>{{ ucfirst($history->from_status) }}</strong> →
                                                        <strong>{{ ucfirst($history->to_status) }}</strong> by You<br>
                                                        <small
                                                            class="text-muted">{{ $history->created_at->format('d-m-Y h:i A') }}</small>
                                                        @if($history->comment)
                                                        <p class="mb-0 mt-1"><em>"{{ $history->comment }}"</em></p>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                <p>No status updates yet.</p>
                                                @endif



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         @endforeach
                  

                        <!-- Grand Total Row -->
                        <div class="text-end mt-3">
                            <h5><strong>Order Grand Total: ${{ number_format($order->items->sum(fn($item) =>
                                $item->price * $item->quantity), 2) }}</strong></h5>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#orderTable').DataTable({
        responsive: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true
    });

</script>

<script>
document.querySelectorAll('.update-status-form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(form);

        fetch("{{ route('customer.order.item.status.update') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    window.location.reload();
                }
            })
            .catch(error => {
                alert('Something went wrong.');
                console.error(error);
            });
    });
});
</script>



@endsection