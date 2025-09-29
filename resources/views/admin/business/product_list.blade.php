@extends('admin.template.master')

@section('content')
    <div class="search-lists">
        <div class="search-lists">
            <div class="tab-content">

                <div id="messages"></div>
                <div class="row">
                    <div class="col float-right ml-auto">
                        <a href="{{ route('addBusinessProduct',['id' => $id])}}" class="btn btn-primary" style="float:right"><i class="fa fa-arrow"></i> Add Product </a>
                         <a href="{{ route('businessByAdmin')}}" class="btn btn-primary" style="float:right"><i class="fa fa-mail-reply"></i> Back </a>
                        </div> 
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="table table-responsive">
                                    <table class="table custom-table mb-0" id="productTable">
                                        <thead>
                                             <tr>
                                                <th>Image</th>
                                                <th>ProductID</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>MRP</th>
                                                <th>Description</th>
                                                <th>Video URL</th>
                                                <th>Status</th>
                                                <th>Feature</th>
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

    
 

    <!-- Delete confirmation Modal -->
    <div class="modal custom-modal fade" id="delete_category" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Request</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <!-- remove brand modal -->
    <div class="modal custom-modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header remove">

                    <h4 class="modal-title">Remove Product List</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form role="form" action="{{ route('business-product.delete')}}" method="post" id="removeForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">                   
                        <p>Do you really want to remove?</p>
                    </div>
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="modal-footer modal-footer-uniform">
                        <!-- <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-danger submit-btn">Delete Product</button>
                        <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                    </div>
                </form>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- reponse modal --}}
    <div class="modal fade" id="submit_responseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalCenterTitle">Response</h6>
                    <button type="button" class="close " data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                </div>
                <!--end modal-header-->
    
                <div class="modal-body " id="responseMrmEdit">
                    <div id="model_messages"></div>
    
                </div>
                <!--end modal-body-->
                <div class="modal-footer">
                </div>
                <!--end modal-footer-->
    
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end response modal-->

    
 
    <script type="text/javascript">
    var base_url = "{{ url('/admin/') }}";
    var businessId ="{{$id}}";
    console.log(businessId);
    var productTable;
    $(document).ready(function() {
        var url = "{{ route('businessProductListByid', ['id' => ':id']) }}";
        url = url.replace(':id', businessId);
        productTable = $('#productTable').DataTable({
            'ajax':  url,
            'order': [],
        });

 
        $('body').on('click','.product-change-status',function(){
            let isCHecked = $(this).is(':checked');
            let id= $(this).data('id');
            $.ajax({
                url: "{{route('product.changeStatus')}}",
                method : 'PUT',
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: isCHecked,
                    id: id
                },
                success:function(response){
                    console.log(response);
                    toastr.success(response.message)
                }
            })
        });

        $('body').on('click','.product-change-feature',function(){
            let isCHecked = $(this).is(':checked');
            let id= $(this).data('id');
            $.ajax({
                url: "{{route('product.changeFeature')}}",
                method : 'PUT',
                data: {
                    "_token": "{{ csrf_token() }}",
                    feature: isCHecked,
                    id: id
                },
                success:function(response){
                    console.log(response);
                    toastr.success(response.message)
                }
            })
        })

        

    });


    function removeFunc(id) {

        if (id) { 
            alert(id);
            $("#removeForm").on('submit', function() {
                var form = $(this);
                alert("Are your to delete this product");
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: {
                        "_token": "{{ csrf_token() }}",
                        del_id: id,
                        _method: 'DELETE'  
                    },
                    dataType: 'json',
                    success: function(response) {
                        $("#removeModal").modal('hide');

                        if (response.success === true) {
                            toastr.success(response.messages);
                            $('#item-' + id).remove();

                        } else {
                            if (response.error instanceof Array) {
                                    var errorMessages = '';
                                    $.each(response.error, function (key, value) {
                                        errorMessages += value.join('<br>'); 
                                    });
                                    toastr.error(errorMessages);
                                } else {
                                    toastr.error(response.error);
                                }
                                
                                $("#removeModal").modal('hide');
                        
                            }
                        }
                });
 
                return false;
            });
        }
    };


    function viewFunc(id) {
        console.log(id); 
        var url = "{{ route('viewPost', ':id') }}";
        url = url.replace(':id', id); 
        console.log(url); 
        window.open(url, '_blank');
    };


</script>
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

   

    .text-right {
        text-align: right;
    }
</style>
@endsection
