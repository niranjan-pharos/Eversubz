@extends('frontend.template.master')
@section('title', "My Orders")

@section('content')
@include('frontend.template.usermenu')
<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.1/css/responsive.bootstrap5.min.css">
<style>
  /* Styles here */
  .odd-row {
    background-color: #f9f9f9;
    /* Light gray color for odd rows */
  }

  .even-row {
    background-color: #ffffff;
    /* White color for even rows */
  }

  .order .card {
    padding: 0px 0px 10px;
    border-radius: 4px;
    height: 100%;
  }

  .order .card h3 {
    background: #2D6BB4;
    color: #fff;
    padding: 5px 10px;
    font-size: 20px;
  }

  .order .card hr {
    margin: 8px 0px;
    border-top: 1px solid rgba(0, 0, 0, .3);
  }

  .order .card p {
    font-size: 15px;
    display: flex;
    column-gap: 50px;
    justify-content: space-between;
    padding: 0px 10px;
  }

  .order .card h4 {
    font-size: 18px;
    padding: 0px 10px 10px;
  }

  .order .card ul {}

  .order .card ul li {}

  .order {
    margin-bottom: 20px;
  }

  .table th {
    background-color: #007bff36;
    color: #000000;
    text-transform: uppercase;
    font-size: 14px;
    padding: 10px;
  }

  #ordersTable {
    margin-bottom: 0px;    border: none;
  }
 
  .table-bordered td, .table-bordered th {
    border-width: 0px 0px 2px 0px;
    border-color: #aaa;
    border-radius: 0px;
    border-right: 0px;
    padding: 20px 10px;
    border-left: 0px;
    white-space: nowrap;
    color: #595959;    font-size: 14px;
}
.inner-section .row{background: #fff; padding: 20px;}
.text-color-1.text-success{    background-color: rgba(0, 201, 167, .1) !important;}
</style>
@php use Illuminate\Support\Facades\Crypt; @endphp
<section class="inner-section category-part myads-part">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-4">
        <h3> Order </h3>
      </div>
      @if($orders->isEmpty())
      <p>You have no orders yet.</p>
      @else

      <div class="table-responsive">
        <table id="ordersTable" class="table table-bordered">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Date</th>
              <th>Customer Name</th>
              <th>Total Amount</th>
              <th>Payment Status</th>
              <!-- <th>Items</th> -->
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
            <tr class="{{ $loop->odd ? 'odd-row' : 'even-row' }}">
              <td><strong>{{ $order->order_product_unique_id }}</strong></td>
              <td>{{ $order->created_at ?? 'N/A' }}</td>
              <td>
                {{ $order->full_name ?? $order->user->name ?? 'N/A' }}
              </td> <!-- Display user name -->
              @php
              $orderTotal = 0;
              foreach ($order->items as $item) {
              $orderTotal += $item->price * $item->quantity;
              }
              @endphp
              <td>${{ number_format($orderTotal, 2) }}</td>
              <td><span class="text-color-1 @if($order->payment_status == 'pending') text-warning 
             @elseif($order->payment_status == 'success') text-success 
             @else text-muted @endif">
    {{ ucfirst($order->payment_status) }}
</span></td>
              <!-- <td>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                        @if($item->product)
                                        <tr>
                                            <td>{{ \Illuminate\Support\Str::limit($item->product->title, 25) }}</td>

                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </td> -->
              <td><a href="{{ route('orders.view', ['id' => Crypt::encrypt($order->id)]) }}">
    <i class="fa fa-eye"></i>
</a>
</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </div>
</section>
@push('scripts')
<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- Initialize DataTables -->
<script>
  $(document).ready(function () {
    $('#ordersTable').DataTable({
      responsive: true,
      autoWidth: false,
      order: [[0, 'desc']], 
      columnDefs: [
        {
          targets: [4],
          orderable: false
        },
      ],
    });
  });
</script>


@endpush
@endsection