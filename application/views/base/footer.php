<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="http://adminlte.io">Template By SITI NETWORK</a>.</strong>
    All rights reserved.
    <!-- <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
    </div> -->
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.js"></script>
<!-- DataTables -->
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url(); ?>assets/dist/js/demo.js"></script>
<!-- date-range-picker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url(); ?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url(); ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?= base_url(); ?>assets/dist/js/pages/dashboard2.js"></script>
<!-- Modal js custom -->
<script src="<?= base_url(); ?>assets/js/modaljs.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url(); ?>assets/js/myscript.js"></script>
<script src="<?= base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
<!-- Filterizr-->
<!-- <script src="<?= base_url(); ?>assets/plugins/filterizr/jquery.filterizr.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".rupiah-mask").inputmask({
            alias: 'numeric',
            groupSeparator: ',',
            autoGroup: true,
            digits: 0,
            digitsOptional: false,
            prefix: 'Rp ',
            placeholder: '0',
            rightAlign: false,
            autoUnmask: true,
            removeMaskOnSubmit: true
        });
    });
</script>
<script>
    $(function() {
        $('#example').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
        //Initialize Select2 Elements
        $('.select2biaya').select2();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        show_product(); //call function show all product

        $('#mydata').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });

        //function show all product
        function show_product() {
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('product/product_data') ?>',
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + data[i].product_code + '</td>' +
                            '<td>' + data[i].product_name + '</td>' +
                            '<td>' + data[i].product_price + '</td>' +
                            '<td style="text-align:right;">' +
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-product_code="' + data[i].product_code + '" data-product_name="' + data[i].product_name + '" data-price="' + data[i].product_price + '">Edit</a>' + ' ' +
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-product_code="' + data[i].product_code + '">Delete</a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }

        //Save product
        $('#btn_save').on('click', function() {
            var product_code = $('#product_code').val();
            var product_name = $('#product_name').val();
            var price = $('#price').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('product/save') ?>",
                dataType: "JSON",
                data: {
                    product_code: product_code,
                    product_name: product_name,
                    price: price
                },
                success: function(data) {
                    $('[name="product_code"]').val("");
                    $('[name="product_name"]').val("");
                    $('[name="price"]').val("");
                    $('#Modal_Add').modal('hide');
                    show_product();
                }
            });
            return false;
        });

        //get data for update record
        $('#show_data').on('click', '.item_edit', function() {
            var product_code = $(this).data('product_code');
            var product_name = $(this).data('product_name');
            var price = $(this).data('price');

            $('#Modal_Edit').modal('show');
            $('[name="product_code_edit"]').val(product_code);
            $('[name="product_name_edit"]').val(product_name);
            $('[name="price_edit"]').val(price);
        });

        //update record to database
        $('#btn_update').on('click', function() {
            var product_code = $('#product_code_edit').val();
            var product_name = $('#product_name_edit').val();
            var price = $('#price_edit').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('product/update') ?>",
                dataType: "JSON",
                data: {
                    product_code: product_code,
                    product_name: product_name,
                    price: price
                },
                success: function(data) {
                    $('[name="product_code_edit"]').val("");
                    $('[name="product_name_edit"]').val("");
                    $('[name="price_edit"]').val("");
                    $('#Modal_Edit').modal('hide');
                    show_product();
                }
            });
            return false;
        });

        //get data for delete record
        $('#show_data').on('click', '.item_delete', function() {
            var product_code = $(this).data('product_code');

            $('#Modal_Delete').modal('show');
            $('[name="product_code_delete"]').val(product_code);
        });

        //delete record to database
        $('#btn_delete').on('click', function() {
            var product_code = $('#product_code_delete').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('product/delete') ?>",
                dataType: "JSON",
                data: {
                    product_code: product_code
                },
                success: function(data) {
                    $('[name="product_code_delete"]').val("");
                    $('#Modal_Delete').modal('hide');
                    show_product();
                }
            });
            return false;
        });

    });
</script>