</div>
<!-- /Main Wrapper -->
<style type="text/css">
    .arrow-pseudo-element,
table.dataTable thead th.sorting:before,
table.dataTable thead th.sorting:after,
th.sorting_asc:before,
th.sorting_asc:after,
th.sorting_desc:before,
th.sorting_desc:after,
th.sorting_asc_disabled:before,
th.sorting_desc_disabled:after {
content: '' !important;
display: block;
position: absolute !important;
float: right;
right: 0.3em !important;
}
/* table.dataTable thead th.sorting {
background: none !important;
} */
table.dataTable thead th.sorting:before {
width: 0;
height: 0;
border-left: 6px solid transparent;
border-right: 6px solid transparent;
border-bottom: 6px solid silver;
bottom: 1.5em !important;
}
table.dataTable thead th.sorting:after {
width: 0;
height: 0;
border-left: 6px solid transparent;
border-right: 6px solid transparent;
border-top: 6px solid silver;
}
th.sorting_asc {
background: none !important;
}
th.sorting_asc:before {
width: 0;
height: 0;
border-left: 6px solid transparent;
border-right: 6px solid transparent;
border-bottom: 6px solid blue;
bottom: 1.5em !important;
}
th.sorting_asc:after {
width: 0;
height: 0;
border-left: 6px solid transparent;
border-right: 6px solid transparent;
border-top: 6px solid silver;
}
th.sorting_desc {
background: none !important;
}
th.sorting_desc:before {
width: 0;
height: 0;
border-left: 6px solid transparent;
border-right: 6px solid transparent;
border-bottom: 6px solid silver;
bottom: 1.5em !important;
}
th.sorting_desc:after {
width: 0;
height: 0;
border-left: 6px solid transparent;
border-right: 6px solid transparent;
border-top: 6px solid blue;
}
th.sorting_asc_disabled {
background: none !important;
}
th.sorting_asc_disabled:before {
width: 0;
height: 0;
border-left: 6px solid transparent;
border-right: 6px solid transparent;
border-bottom: 6px solid blue;
}
th.sorting_desc_disabled {
background: none !important;
}
th.sorting_desc_disabled:after {
width: 0;
height: 0;
border-left: 6px solid transparent;
border-right: 6px solid transparent;
border-top: 6px solid blue;
}
table.dataTable thead th {
padding-right: 1.5em !important;
}.breadcrumb .active {
    color: #000000;
}

</style>

<script src="{{ asset('admin_assets/js/moment.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/custom/places.js') }}"></script> --}}
<script src="{{ asset('admin_assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

<script src="{{ asset('admin_assets/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin_assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<!-- Bootstrap Core JS -->
<script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/printThis.js') }}"></script>
<!-- Slimscroll JS -->
<script src="{{ asset('admin_assets/js/jquery.slimscroll.min.js') }}"></script>

<!-- Chart JS -->
<!-- <script src="<?php //echo base_url() 
                    ?>admin_assets/plugins/morris/morris.min.js"></script>
<script src="<?php //echo base_url() 
                ?>admin_assets/plugins/raphael/raphael.min.js"></script>
<script src="<?php // echo base_url() 
                ?>admin_assets/js/chart.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('admin_assets/js/app.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker-iconset-all.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.min.js"></script> --}}

    @include('layouts.common-footer')
</body>

</html>