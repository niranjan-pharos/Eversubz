@extends('admin.template.master')

@section('content')


<div class="search-lists">
    <div class="tab-content">
        <div id="messages"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="add-link-button">
                            <a href="{{ route('adminBlogAdd') }}" class="btn btn-primary" style="float:right"><i class="fa fa-arrow"></i> Add Blog </a>
                            </div>
                            <table class="table datatable custom-table mb-0" id="enquiryTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Blog Title</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated here by JavaScript -->
                                </tbody>
                            </table>
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

.custom-table th,
.custom-table td {
    padding: 8px;
    border: 1px solid #ddd;
    word-wrap: break-word;
    /* Enable text wrapping */
    white-space: normal;
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
.table td a{margin-right: 5px;}
</style>


<script>
        $(document).ready(function() {
            function fetchBlogs() {
                $.ajax({
                    url: '{{ route("blogs.list") }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tableBody = $('#enquiryTable tbody');
                        tableBody.empty();

                        $.each(data, function(index, blog) {
                            var row = '<tr data-id="' + blog.id + '">' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + blog.title + '</td>' +
                                '<td>' + blog.date + '</td>' +
                                '<td><img src="{{ asset("storage/blog_images/") }}/' + blog.blog_image + '" alt="' + blog.alt_text + '" style="width: 50px; height: auto;"></td>' +
                                '<td>' +
                                    
                                    '<a href="{{ url("admin/blog/edit") }}/' + blog.id + '" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>' +
                                    '<button class="btn btn-danger delete-blog" data-id="' + blog.id + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                                '</td>' +
                            '</tr>';
                            tableBody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            };

            fetchBlogs(); 

            $(document).on('click', '.delete-blog', function() {
                var blogId = $(this).data('id');
                if (confirm('Are you sure you want to delete this blog?')) {
                    $.ajax({
                        url: '{{ url("admin/blog") }}/' + blogId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            alert('Blog deleted successfully');
                            $('tr[data-id="' + blogId + '"]').remove(); 
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            alert('Failed to delete the blog. Please try again.');
                        }
                    });
                }
            });
        });
    </script>

    

@endsection