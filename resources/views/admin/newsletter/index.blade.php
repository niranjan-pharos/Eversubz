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
                                <table class="table custom-table mb-0" id="newsletterTable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Newsletters as $key => $newsletter)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $newsletter->email }}</td>
                   
                </tr>
            @endforeach
                                        <!-- Data will be dynamically added here using JavaScript -->
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

<!-- <script>
    

    document.addEventListener('DOMContentLoaded', function() {
    fetch('{{ route("admin.newsletters") }}', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        let tableBody = document.querySelector('#newsletterTable tbody');
        tableBody.innerHTML = ''; // Clear existing table rows
        data.forEach((newsletter, index) => {
            let row = `<tr>
                <td>${index + 1}</td>
                <td>${newsletter.email}</td>
            </tr>`;
            tableBody.innerHTML += row;
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

</script> -->





@endsection