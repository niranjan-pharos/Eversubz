@extends('admin.template.master')

@section('content')

<div class="search-lists">
    <div class="tab-content">
        <div id="messages"></div>

        <div class="row">
            <div class="col float-right ml-auto">
                <a href="{{ route('faqAdd')}}" class="btn btn-primary" style="float:right"><i class="fa fa-arrow"></i> Add FAQ </a>
            </div>
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0" id="faqTable">
                                <thead>
                                    <tr>
                                        <th>FAQ</th>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated by AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
  $(document).ready(function() {
    faqTable = $('#faqTable').DataTable({
        'ajax': "{{ route('faq.fetchData') }}",
        'order': []
    });

   

});
</script>

@endsection