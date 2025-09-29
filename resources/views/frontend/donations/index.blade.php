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
  .text-color-1.text-success {
      background-color: rgba(0, 201, 167, .1) !important;
  }
  mute {
    text-transform: lowercase;
  }

  mute::first-letter {
      text-transform: uppercase;
  }
</style>

<section class="inner-section category-part myads-part">
    <div class="container">
  
      <div class="row">
        <div class="col-md-12 mb-4">
          <h3> Donations </h3>
        </div>
  
        @if($userDonations->isEmpty())
        <p>You have no donations yet.</p>
        @else
        <div class="table-responsive">
          <table id="donationsTable" class="table table-bordered">
            <thead>
              <tr>
                <th>Donation Number</th>
                <th>Date</th>
                <th>Donor Name</th>
                <th>Amount</th>
                <th>
                  Support Amount<br />
                  <mute>Amount+Transaction Fee</mute>
              </th>              
                <th>Tip</th>
                <th>Payment Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($userDonations as $donation)
              <tr class="{{ $loop->odd ? 'odd-row' : 'even-row' }}">
                <td>{{ $donation->donation_number }}</td>
                <td>{{ $donation->created_at ?? 'N/A' }}</td>
                <td>{{ $donation->first_name }} {{ $donation->last_name }}</td>
                <td>${{ number_format($donation->amount, 2) }}</td>
                <td>${{ number_format($donation->amount+$donation->transaction_fee, 2) }}</td>
                <td>${{ number_format($donation->tip, 2) }}</td>
                <td>
                  <span class="text-color-1 @if($donation->payment_status == 'pending') text-warning 
                  @elseif($donation->payment_status == 'success') text-success 
                  @else text-muted @endif">
                  {{ ucfirst($donation->payment_status) }}
                  </span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>
  
      <div class="row">
        <div class="col-lg-12">
          {{ $userDonations->appends(['resultsPerPage' => $resultsPerPage])->links() }}
        </div>
      </div>
    </div>
  </section>

  @push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <!-- Initialize DataTables -->
  <script>
    $(document).ready(function () {
      $('#donationsTable').DataTable({
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
  <script>
    function updateResultsPerPage() {
      let resultsPerPage = document.getElementById('resultsPerPage').value;
      window.location.href = `?resultsPerPage=${resultsPerPage}`;
    }
  </script>
  @endpush
@endsection