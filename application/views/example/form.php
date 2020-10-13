<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                        </div> -->
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= base_url('admin/pembelian/addPembelian') ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kd_pembelian">Kode Pembelian</label>
                                    <input type="text" name="kd_pembelian" class="form-control" id="kd_pembelian" placeholder="" value="" readonly required>
                                    <input type="hidden" class="form-control" id="ceklokasi" value="1">
                                </div>
                                <div class="form-group">
                                    <label for="no_invoice">Nomor Invoice</label>
                                    <input type="text" name="no_invoice" class="form-control" id="no_invoice" placeholder="Masukkan Nomor Invoice" required>
                                </div>
                                <div class="form-group">
                                    <label for="kd_supplier">Supplier</label>
                                    <select class="form-control select2sup" name="supplier" id="supplier1" style="width: 100%;" required>
                                        <option value="Pilih Supplier">Pilih Supplier</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pembelian</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="tgl_pembelian" id="datepickersingle" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                        </div> -->
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <!-- <input type="text" id="coba" value=""> -->
                            <div class="form-group" id="fieldawalbarang">
                                <label for="kd_supplier">Barang</label>
                                <div class="row" id="form-repeat">
                                    <div class="col-md-5">
                                        <select class="form-control select2barpembelian" name="barang[]" id="barang" style="width: 100%;" required>
                                            <option value="">Pilih Barang</option>
                                            <option>Alaska</option>
                                            <option>California</option>
                                            <option>Delaware</option>
                                            <option>Tennessee</option>
                                            <option>Texas</option>
                                            <option>Washington</option>
                                        </select>
                                        <!-- <input type="text" name="kd_supplier" class="form-control" id="kd_supplier" placeholder=""> -->
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" name="jenis" id="jenis" value="modal">
                                        <input type="text" name="harga[]" id="harga" class="form-control" placeholder="Harga" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" min="0" max="100" name="qty[]" id="qty" class="form-control cek-qty" placeholder="Qty" readonly onkeypress="return hanyaAngka(event)" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="sub_total[]" id="sub_total" class="form-control" placeholder="Sub Total" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="javascript:void(0)" class="btn btn-success" id="tambahfieldbarang"> <i class="fa fa-plus"></i> </a>
                                    </div>
                                </div>
                            </div>

                            <!-- ini untuk max pembelian -->
                            <input type="hidden" id="jmlbarang" value="10">
                            <!-- ini untuk perhitungan looping di for nya -->
                            <input type="hidden" id="jmlbarang1" value="1">
                            <!-- ini untuk index pada pertambahan -->
                            <input type="hidden" id="jmlbarangplus" value="1">
                            <!-- ini untuk index pada pengurangan -->
                            <input type="hidden" id="jmlbarangminus" value="1">


                            <div class="form-group">
                                <label for="total_harga">Total Harga</label>
                                <input type="text" name="total_harga" class="form-control" id="total_harga" placeholder="" value="Rp. 0" readonly>
                            </div>
                            <!-- <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                    <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                                </div> -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                        </form>
                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->