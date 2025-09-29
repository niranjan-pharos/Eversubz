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

  #ordersTable {
    background: #fff;
    margin-bottom: 0px;
  }

  .inner-section .row {
    background: #fff;
    padding: 20px;
  }
  #ordersTable {
    margin-bottom: 0px;
    border: none;
  }

  #ordersTable .btn-primary {
      color: black;
      background-color: #007bff !important;
      border-color: #007bff !important;
  }
  .text-color-1.text-success {
      background-color: rgba(0, 201, 167, .1) !important;
  }

  .dropdown-toggle::after {
    margin-left: 12px;
  }
</style>

<section class="inner-section category-part myads-part">
  <div class="container">
    <!-- Show a message if no orders or incomplete data -->
    @if($userOrders->isEmpty())
    <p>You have no orders yet.</p>
    @else
    <!-- <p>Please note that some products may have incomplete information.</p> -->
    @endif

    <div class="row">
      <div class="col-md-12 mb-4">
        <h3> Order </h3>
      </div>

      @if($userOrders->isEmpty())
      <p>You have no orders yet.</p>
      @else
      <div class="table-responsive">
        <table id="ordersTable" class="table table-bordered">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Date</th>
              <th> User ID</th>
              <th>Customer Name</th>
              <th>Total Amount</th>
              <th>Payment Status</th>
              <th>Delivary Option</th>
              <!-- <th>Items</th> -->
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($userOrders as $order)
            <tr class="{{ $loop->odd ? 'odd-row' : 'even-row' }}">
              <td>{{ $order->order_product_unique_id }}</td>
              <td>{{ $order->created_at ?? 'N/A' }}</td>
              <td class="text-center"> {{ $order->user->uid }}</td>
              <td>{{ $order->full_name }}</td>
              <td>
                ${{ number_format($order->items->sum(function ($item) {
                return $item->price * $item->quantity;
                }), 2) }}
              </td>
              <td><span class="text-color-1 @if($order->payment_status == 'pending') text-warning 
                           @elseif($order->payment_status == 'success') text-success 
                           @else text-muted @endif">
                  {{ ucfirst($order->payment_status) }}
                </span>
              </td>
              <td class="text-center">{{ $order->shipping_method }}</td>
             
              <td><a
                  href="{{ route('myorders.view', ['id' => \Illuminate\Support\Facades\Crypt::encrypt($order->id)]) }}">
                  <i class="fa fa-eye"></i>
                </a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>

    <div class="row">
      <div class="col-lg-12">
        {{ $userOrders->appends(['resultsPerPage' => $resultsPerPage])->links() }}
      </div>
    </div>
  </div>
</section>

@push('scripts')
<!-- Include DataTables JS -->
<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<!-- DataTables core JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<!-- File export dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Initialize DataTables -->
<script>
  $('#ordersTable').DataTable({
    responsive: true,
    autoWidth: false,
    order: [[0, 'desc']],
    columnDefs: [
      { targets: [4], orderable: false }
    ],
    dom: '<"row mb-3" <"col-md-4"l> <"col-md-4 text-center"B> <"col-md-4 d-flex justify-content-end"f> >rtip',
    buttons: [
      {
        extend: 'collection',
        text: '<i class="fa fa-print"></i> Export',
        className: 'btn btn-primary dropdown-toggle',
        buttons: [
          { extend: 'print', text: 'Print' },
          { extend: 'excelHtml5', title: 'Orders', text: 'Excel' },
          { extend: 'csvHtml5', title: 'Orders', text: 'CSV' },
          { extend: 'pdfHtml5', title: 'Orders', orientation: 'landscape', pageSize: 'A4', text: 'PDF' },
          {
            text: 'Word',
            action: function ( e, dt, node, config ) {
              var data = dt.buttons.exportData();
              var html = '<table border="1">';
              html += '<tr>' + data.header.map(h => '<th>' + h + '</th>').join('') + '</tr>';
              data.body.forEach(row => {
                html += '<tr>' + row.map(cell => '<td>' + cell + '</td>').join('') + '</tr>';
              });
              html += '</table>';
              var blob = new Blob(['\ufeff', html], { type: 'application/msword' });
              var url = URL.createObjectURL(blob);
              var a = document.createElement('a');
              a.href = url;
              a.download = 'Orders.doc';
              document.body.appendChild(a);
              a.click();
              document.body.removeChild(a);
            }
          }
        ]
      }
    ]
  });
</script>


<script>
  function updateResultsPerPage() {
    let resultsPerPage = document.getElementById('resultsPerPage').value;
    window.location.href = `?resultsPerPage=${resultsPerPage}`;
  }
</script>
@endpush
@endsection