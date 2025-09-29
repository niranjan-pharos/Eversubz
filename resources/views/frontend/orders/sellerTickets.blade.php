@extends('frontend.template.master')
@section('title', "My Event Tickets")

@section('content')
@include('frontend.template.usermenu')

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<style>
.ticket-card {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}
table.dataTable tbody td{padding: 5px !important; font-size: 14px;}
table.dataTable thead th{padding: 5px !important; font-size: 14px;}

.ticket-card h3 {
    margin: 0 0 10px;
    font-size: 20px;
}

.pdate {
    font-size: 15px;
    color: #555;
    margin: 5px 0;
}

.OrderReceipt {
    font-weight: bold;
    margin-top: 10px;
}

.ticket-info table {
    width: 100%;
    border-collapse: collapse;
}

.ticket-info th,
.ticket-info td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.total-amount1 {
    margin: 10px 0;
    font-size: 19px;
    font-weight: 700;
}

.pagination {
    margin-top: 20px;
    justify-content: center;
}
.table th {
    background-color: #007bff;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    padding: 10px;
}
@media only screen and (max-width: 767px){
    .myads-part{margin-bottom: 75px;}
}
</style>

<section class="inner-section category-part myads-part">
    <div class="container">

        <!-- Table for Event Orders -->
        <div class="row">
            <div class="card col-md-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ordersTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>User Name</th>
                                    <th>Payment</th>
                                    <th>Location</th>
                                    <!-- <th>Ticket Information</th> -->
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($formattedOrders as $order)
                                <tr>
                                    <td>{{ $order['event']['title'] }}</td>
                                    <td>{{ $order['buyer_name'] }}</td>
                                    <td>{{ $order['status'] }}</td>
                                    <td>{{ $order['event']['location'] }}, {{ $order['event']['city'] }},
                                        {{ $order['event']['state'] }}, {{ $order['event']['country'] }}</td>
                                    <!-- <td>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Ticket</th>
                                                    <th>Ticket Type</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order['tickets'] as $ticket)
                                                <tr>
                                                    <td>{{ $ticket['ticket_name'] }}</td>
                                                    <td>{{ $ticket['ticket_type'] }}</td>
                                                    <td>{{ $ticket['quantity'] }}</td>
                                                    <td>${{ number_format($ticket['price'], 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td> -->
                                    <td>${{ number_format($order['total_amount'], 2) }}</td>
                                    <td><a
                                            href="{{ route('order.details', ['encryptedOrderId' => Crypt::encryptString($order['order_id'])]) }}">
                                            <i class="fa fa-eye"></i></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No tickets available for your events.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $paginationLinks }}
            </div>
        </div> -->
    </div>
</section>

<script>
$(document).ready(function() {
    $('#ordersTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "pageLength": 10,
        "lengthMenu": [10, 20, 30],
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "columnDefs": [{
            "targets": 5,
            "orderable": false
        }]
    });
});
</script>
@endsection