@extends('admin.template.master')

@section('content')

<style>
                                    .custom-table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }

                                .custom-table th, .custom-table td {
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
                                .table-bordered td, .table-bordered th {
    border-width: 0px 0px 2px 0px;
    border-color: #aaa;
    border-radius: 0px;
    border-right: 0px;
    padding: 20px 10px;
    border-left: 0px;
    white-space: nowrap;
    color: #595959;
    font-size: 14px;
    }
    .table th {
        background-color: #007bff36 !important;
    color: #000000;
    text-transform: uppercase;
    font-size: 14px;
    padding: 10px;
    }

    button.dt-button.buttons-collection.dropdown-toggle::after {
        display: none !important;
    }

    button.dt-button.buttons-collection.dropdown-toggle::after {
        display: none !important;
    }

    div.dt-button-background {
        display: none !important;
    }

    div.dt-button-collection {
        background: #fff !important;
        border: 1px solid #ddd !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        padding: 0 !important;
    }

    div.dt-button-collection .dt-button {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        background: transparent !important;
        border: none !important;
        padding: 8px 15px !important;
        margin: 0 !important;
        font-size: 14px !important;
        color: #333 !important;
    }

    div.dt-button-collection .dt-button:hover {
        background-color: #f8f9fa !important;
        color: #000 !important;
    }

    .btn-outline-dark:hover {
        color: black !important;
    }



</style>
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">

            <div id="messages"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table custom-table mb-0" id="orderTable">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #007bff36 !important">Order Id</th>
                                            <th>Date</th>
                                            <!-- <th>User ID </th> -->
                                            <th>Product (Total Count)</th>
                                            <th>User</th>
                                            <th>Seller Name </th>
                                            <th>Payment Status</th>
                                            <th>Order Status</th>
                                            <th>Delivary Option</th>
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
    </div>
</div>


<!-- Delete confirmation Modal -->
<div class="modal custom-modal fade" id="delete_category" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Category</h3>
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

                <h4 class="modal-title">Remove Order</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form role="form" action="{{ route('orderItemDelete') }}" method="post" id="removeForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">                   
                    <p>Do you really want to remove?</p>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer modal-footer-uniform">
                    <!-- <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-danger submit-btn">Delete Order</button>
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

<script>
    var orderTable;
    $(document).ready(function() {
        orderTable = $('#orderTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('orderitems.data') }}',
        order: [[0, 'desc']],
        dom: '<"row mb-3" <"col-md-4"l> <"col-md-4 text-center"B> <"col-md-4 d-flex justify-content-end"f> >rtip',
        buttons: [
          {
            extend: 'collection',
            text: '<i class="fa fa-print"></i> Export',
            className: 'btn btn-outline-dark',
            buttons: [
              { extend: 'print', text: 'Print' },
              { extend: 'excelHtml5', text: 'Excel' },
              { extend: 'csvHtml5', text: 'CSV' },
              { extend: 'pdfHtml5', text: 'PDF', orientation: 'landscape', pageSize: 'A4' },
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
    });
    function viewFunc(orderId) {
        alert('View Order ID: ' + orderId);
    }

    $('body').on('click','.change-status',function(){
            let isCHecked = $(this).is(':checked');
            let id= $(this).data('id');
            $.ajax({
                url: "{{route('updateorderItemStatus')}}",
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

    function removeFunc(id) {
        if (id) { 
            $("#removeForm").on('submit', function() {
                var form = $(this);
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
                        orderTable.ajax.reload(null, false);
                        $("#removeModal").modal('hide');
                        if (response.success === true) {
                            toastr.success(response.messages);
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


</script>



@endsection