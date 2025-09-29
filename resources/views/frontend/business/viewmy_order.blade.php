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

  .order-details .card {
    background: transparent;
    border: none;
  }

  .order-details .card .card-body .card {
    border: none;
    border-radius: 5px;
    background: #fff;
    /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
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

  .table {
    margin-top: 20px;
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

  .timeline-wrapper {
    position: relative;
    border-left: 2px dashed rgb(80, 81, 82);
    padding-left: 15px;
  }

  .timeline-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    position: absolute;
    left: -30px;
    top: 0px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 0 3px #fff;
    z-index: 2;
  }

  .timeline-wrapper .card {
    height: auto;
    border-bottom: 1px solid #ccc;
  }

  .timeline-wrapper .card .card-body {
    padding: 10px !important;
  }

  .body12 {
    padding: 0px;
  }

  .status-div .form-control {
    padding: 8px 0px;
    height: auto;
    background: #eee;
  }

  .status-div .card {
    height: auto;
  }

  .card13 {
    max-height: 600px !important;
    overflow-y: scroll;
  }

  /* For WebKit browsers */
  .card13::-webkit-scrollbar {
    width: 3px;
  }

  .card13::-webkit-scrollbar-track {
    background: transparent;
    /* Optional: change if needed */
  }

  .card13::-webkit-scrollbar-thumb {
    background-color: #888;
    /* Customize color */
    border-radius: 10px;
  }

  /* Optional: On hover */
  .card13::-webkit-scrollbar-thumb:hover {
    background: #555;
  }

  @media (max-width: 767.98px) {
    .timeline-wrapper {
      margin-left: 0;
      padding-left: 0;
      border-left: none;
    }

    .timeline-icon {
      position: relative;
      left: 0;
      top: 0;
      margin-bottom: 10px;
    }

    .timeline-block {
      padding-left: 0;
    }

    .timeline-content {
      margin-left: 0 !important;
    }
  }
</style>

<section class="inner-section category-part myads-part">
  <div class="container">
    <div class="row">
      <div class="order-details">
        <h3>Order Details</h3>
        <div class="card">
          <div class="card-header">
            Order ID: {{ $order->order_product_unique_id }}
          </div>

          <div class="row card-body body12">

            <div class="col-md-8 mb-4">
              <div class="row">
                <div class="col-md-12 mb-4 mt-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Order
                        Information
                      </h5>
                      <p><strong>Total Amount:</strong> ${{
                        number_format($order->items->sum(function ($item) {
                        return $item->price * $item->quantity;
                        }), 2) }}
                      </p>
                      <p><strong>Comments:</strong> {{ $order->comments }}</p>
                      <p><strong>Payment Status:</strong> <span class="badge bg-success">{{
                          ucfirst($order->payment_status) }}</span>
                      </p>
                      <p><strong>Payment ID:</strong> {{ $order->payment_id }}</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 mb-3 mt-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><i class="fas fa-map-marker-alt"></i> Shipping
                        Details</h5>
                      <hr>
                      <p><strong>Address:</strong> {{ $order->address }}</p>
                      <p><strong>City:</strong> {{ $order->city }}</p>
                      <p><strong>State:</strong> {{ $order->state }}</p>
                      <p><strong>Zip Code:</strong> {{ $order->zip_code }}</p>
                      <p><strong>Country:</strong> {{ $order->country }}</p>
                    </div>
                  </div>
                </div>
                <!-- User Details -->
                <div class="col-md-6 mb-3 mt-3">
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

                <div class="col-md-12 mt-3">
                  <div class="card">
                    <div class="card-body">
                      <h4>Order Items</h4>
                      <div class="table-responsive">
                        <table class="table table-bordered custom-table">
                          <thead>
                            <tr>
                              <th>Product Name</th>
                              <th>Seller Status</th>
                              <th>Customer Status</th>
                              <th>Quantity</th>
                              <th>Price</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($order->items as $item)
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
                            <tr class="{{ $loop->odd ? 'odd-row' : 'even-row' }}">
                              <td>{{ $item->product->title ?? 'N/A' }}</td>
                              <td><span class="badge bg-{{ $sellerColor }}">{{
                                  ucfirst($item->status) }}</span></td>
                              <td><span class="badge bg-{{ $customerColor }}">{{
                                  $item->customer_status ?? 'N/A' }}</span></td>
                              <td>{{ $item->quantity }}</td>
                              <td>${{ number_format($item->price, 2) }}</td>
                              <td>${{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                              <td colspan="3" class="text-right font-weight-bold">Total:
                              </td>
                              <td>{{ $order->items->sum('quantity') }}</td>
                              <td>${{ number_format($order->items->sum('price'), 2) }}
                              </td>
                              <td>${{ number_format($order->items->sum(function ($item) {
                                return $item->price * $item->quantity;
                                }), 2) }}</td>
                            </tr>
                          </tbody>

                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>

            <div class="col-md-4 mt-4 status-div">
              <div class="card mb-4">
                <div class="card-body">
                  <h4>Change Order Status</h4>
                  <form id="status-change-form">
                    @csrf
                    <label for="order_status" class="col-form-label">Select Status</label>

                    <div class="form-group row mb-0">
                      <div class="col-sm-4" style="padding: 0px 0px 0px 15px;    margin-bottom: 10px;">
                        @php
                        $statuses = ['pending', 'processing', 'shipped', 'delivered',
                        'completed', 'cancelled'];
                        $currentStatus = $order->items->first()->status ?? null; // <-- Get from item @endphp <select
                          id="order_status" name="order_status" class="form-control">
                          @foreach($statuses as $status)
                          <option value="{{ $status }}" {{ $currentStatus===$status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                          </option>
                          @endforeach
                          </select>
                      </div>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="comment" id="comment"
                          placeholder="Optional comment (reason, notes)">
                      </div>
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Change Status</button>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
              <div class="card " style="margin-top: 37px;">
                <div class="card-body card13">
                  <h4 class="mb-2">Order Status</h4>
                  <div class="timeline-wrapper">
                    @foreach ($order->histories->where('changed_by_type', 'seller')->where('changed_by',
                    Auth::id())->sortByDesc('created_at') as $history)
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

                    <div class="timeline-block d-flex position-relative flex-column flex-md-row">
                      <div class="timeline-icon bg-{{ $sellerColor }} flex-shrink-0 mb-2 mb-md-0">
                        <i class="fas fa-exchange-alt text-white"></i>
                      </div>
                      <div class="timeline-content card shadow-sm w-100 ms-md-4">
                        <div class="card-body">
                          <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <h6 class="mb-2 mb-md-0">
                              <span class="badge bg-{{ $sellerColor }} me-2">{{
                                ucfirst($history->to_status) }}</span>

                            </h6>
                            <small class="text-muted">{{ $history->created_at->format('d-m-Y
                              h:i:s A') }}</small>
                          </div>
                          <p class="mt-2 mb-1">
                            Status changed from <strong>{{ ucfirst($history->from_status)
                              }}</strong> to
                            <strong>{{ ucfirst($history->to_status) }}</strong> by
                            <strong>{{ $history->user->name ??
                              'Guest' }}</strong>
                            <small class="text-muted">({{ ucfirst($history->changed_by_type)
                              }})</small>.
                          </p>
                          @if($history->comment)
                          <div class="alert alert-light border mt-2 p-2">
                            <i class="fas fa-comment-alt text-muted me-1"></i>
                            <em>{{ $history->comment }}</em>
                          </div>
                          @endif
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>


            </div>




          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function () {
    $('#orderTable').DataTable({
      responsive: true,
      paging: true,
      searching: true,
      ordering: true,
      info: true
    });
  });
</script>


<!-- Optional: Animate.css for smooth fade-in effect -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script>
  $(document).ready(function () {
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "timeOut": "4000"
    };

    $('#status-change-form').on('submit', function (e) {
      e.preventDefault();

      const selectedStatus = $('#order_status').val();
      const comment = $('#comment').val().trim();

      if (selectedStatus === 'cancelled' && comment === '') {
        toastr.error("Comment is required when cancelling an order.");
        return;
      }

      let formData = {
        _token: '{{ csrf_token() }}',
        order_status: selectedStatus,
        comment: comment
      };

      $.ajax({
        type: 'POST',
        url: '{{ route("orders.changeStatus", $order->id) }}',
        data: formData,
        success: function (response) {
          if (response.status === 'success') {
            toastr.success(response.message);

            const statusColors = {
              pending: 'secondary',
              processing: 'info',
              shipped: 'primary',
              delivered: 'success',
              completed: 'success',
              cancelled: 'danger'
            };

            const toStatus = response.history.to.toLowerCase();
            const color = statusColors[toStatus] ?? 'dark';

            const block = `
                          <div class="timeline-block d-flex position-relative flex-column flex-md-row animate__animated animate__fadeInDown">
                            <div class="timeline-icon bg-${color} flex-shrink-0 mb-2 mb-md-0">
                              <i class="fas fa-exchange-alt text-white"></i>
                            </div>
                            <div class="timeline-content card shadow-sm w-100 ms-md-4">
                              <div class="card-body">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                  <h6 class="mb-2 mb-md-0">
                                    <span class="badge bg-${color} me-2">${response.history.to}</span>
                                    <strong>${response.history.user}</strong>
                                    <small class="text-muted">(${response.history.role})</small>
                                  </h6>
                                  <small class="text-muted">${response.history.date}</small>
                                </div>
                                <p class="mt-2 mb-1">
                                  Status changed from <strong>${response.history.from}</strong> to 
                                  <strong>${response.history.to}</strong>.
                                </p>
                                ${response.history.comment && response.history.comment !== '-' ? `
                                <div class="alert alert-light border mt-2 p-2">
                                  <i class="fas fa-comment-alt text-muted me-1"></i>
                                  <em>${response.history.comment}</em>
                                </div>` : ''}
                              </div>
                            </div>
                          </div>
                        `;

            $('.timeline-wrapper').prepend(block);
            $('#comment').val('');

            $('.custom-table tbody tr').each(function () {
              const firstColText = $(this).find('td:first').text().trim().toLowerCase();
              if (firstColText === 'total:' || firstColText === '') return;

              const statusCell = $(this).find('td:nth-child(2)');
              statusCell.html(`<span class="badge bg-${color}">${response.history.to}</span>`);
            });
          } else {
            toastr.info(response.message);
          }
        },
        error: function (xhr) {
          if (xhr.status === 422) {
            const errors = xhr.responseJSON.errors;
            Object.values(errors).forEach(msgArray => {
              msgArray.forEach(msg => toastr.error(msg));
            });
          } else {
            toastr.error("Something went wrong. Please try again.");
          }
        }
      });
    });
  });
</script>








@endsection