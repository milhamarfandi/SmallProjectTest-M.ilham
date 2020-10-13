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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add-biayalain">
                                <i class="fa fa-plus"></i> Tambah Biaya Lain
                            </button><br><br> -->
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kode</th>
                                        <th>Nama Biaya</th>
                                        <th>Total Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="javascript:;" data-id="" data-toggle="modal" data-target="#modal-edit-biayalain">
                                                <button data-toggle="modal-lihat" data-target="#lihat-data-semester" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button></a>
                                            <a href="<?= base_url('admin/pembelian/deletebiayalain/') ?>" class="btn btn-sm btn-danger tombol-hapus"> <i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->