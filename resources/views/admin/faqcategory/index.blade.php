@extends('admin.template.master')

@section('content')
<div class="search-lists">
    <div class="search-lists">
    <div class="tab-content">

<div id="messages"></div>

<div class="row">
    <div class="col float-right ml-auto">
        <button class="btn btn-primary add-btn add-button" data-bs-toggle="modal"
            data-bs-target="#addModalCategory"><i class="fa fa-plus"></i> Add Category </button>
    </div>
    <div class="col-md-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-table mb-0" id="categoryTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


 


        <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th,
        .custom-table td {
            padding: 8px;
            border: 1px solid #ddd;
            word-wrap: break-word;
            /* Enable text wrapping */
            white-space: break-spaces;
        }

        .custom-table th {
            background-color: #f2f2f2 !important;
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

<script>
    $(document).ready(function() {
    categoryTable = $('#categoryTable').DataTable({
        'ajax': "{{ route('faqCategoryList') }}",
        'order': []
    });

   

});
</script>


        @include('admin.faqcategory.create')
        @endsection