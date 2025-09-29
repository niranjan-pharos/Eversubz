@extends('frontend.template.master')
@section('title', "My Tickets")

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
.table th {
    background-color: #007bff;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    padding: 10px;
}
.dataTables_filter {
    display: none;
}

.order .card ul {}

.order .card ul li {}

.order {
    margin-bottom: 20px;
}

#ordersTable {
    background: #fff;
    margin-bottom: 0px;
}
</style>
<section class="inner-section category-part myads-part">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3>My Tickets</h3>
            </div>
            <div class="card col-md-12">
                <div class="card-body">
                    @if($orders->isEmpty())
                    <p>You have no tickets yet.</p>
                    @else
                    <div class="table-responsive">
                        <table id="ordersTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <!-- <th>Tickets</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)

                                <tr class="{{ $loop->odd ? 'odd-row' : 'even-row' }}">
                                    <td>{{ $order->order_event_unique_id }}</td>
                                    <td>{{ $order->event->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->event->from_date_time)->format('d/m/y') }} -
                                        {{ \Carbon\Carbon::parse($order->event->to_date_time)->format('d/m/y') }}</td>
                                        <td>
                                        {{ $order->event->location . ', ' . $order->event->city . ', ' . $order->event->state . ', ' . $order->event->country ?? 'N/A' }}
                                        </td>

                                    <td>{{ $order->status }}</td>
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
                                                @foreach($order->orderTickets as $ticket)
                                                <tr>
                                                
                                                    <td>{{ \Illuminate\Support\Str::limit($ticket->ticket_name, 30) }}
                                                    </td>
                                                    <td>{{ \Illuminate\Support\Str::limit($ticket->ticket_type, 30) }}
                                                    </td>
                                                    <td>{{ $ticket->quantity }}</td>
                                                    <td>${{ number_format($ticket->price, 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td> -->
                                    <td><a href="{{ route('tickets.details', Crypt::encrypt($order->id)) }}">
                                            <i class="fa fa-eye"></i>
                                        </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                {{ $orders->appends(['resultsPerPage' => $resultsPerPage])->links() }}
            </div>
        </div>
    </div>
</section>

@push('scripts')
<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- Initialize DataTables -->
<script>
$(document).ready(function() {
    $('#ordersTable').DataTable({
        responsive: true,
        autoWidth: false,
        columnDefs: [{
            targets: [4],
            orderable: false
        }],
    });
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