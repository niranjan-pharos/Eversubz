@extends('admin.template.master')

@section('content')
<div class="search-lists">
  <div class="search-lists">
    <div class="tab-content">
      <div id="messages"></div>

      <div class="row">
        <div class="col-md-12">
          <div class="card mb-0"> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table datatable custom-table mb-0" id="userTable">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Address</th>
                      <th>Subject</th>
                      <th>message</th>
                    </tr>
                  </thead>
                  <tbody>
            @foreach($contacts as $key => $contact)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->address }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ $contact->message }}</td>
                </tr>
            @endforeach
        </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Delete confirmation Modal -->

<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th, .custom-table td {
        padding: 8px;
        border: 1px solid #ddd;
        word-wrap: break-word; /* Enable text wrapping */
        white-space: break-spaces;
    }

    .custom-table th {
        background-color: #f2f2f2;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .custom-table tbody tr:hover {
        background-color: #ddd;
    }

    .text-right {
        text-align: right;
    }
</style>






@endsection