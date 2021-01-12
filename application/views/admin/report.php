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
                        <div class="card-header">
                            <div class="row">
                                <div class="form-group col-xl-4 col-xs-12 col-12">
                                    <label for="">Mahasiswa</label>
                                    <select name="nomor_mahasiswa" style="width: 100%;" id="nomor_mahasiswa" class="form-control select2mahasiswas" required></select>
                                </div>
                                <div class="form-group col-xl-4 col-xs-12 col-12">
                                    <label for=""></label><br>
                                    <button type="button" class="btn btn-info btn-flat mt-2" id="refresh"><i class="fas fa-sync-alt fa-spin"></i> </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info" id="buttonprint">
                                        <i class="fa fa-print"> Print Report</i>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning" id="buttonpdf">
                                        <i class="fa fa-download"> Download Pdf Report</i>
                                    </button>
                                </div>
                                <br><br>
                                <table class="table table-hover text-nowrap table-striped table-bordered" id="MyTableReportTranskrip">
                                    <thead>
                                        <tr>
                                            <th>Nomor Mahasiswa</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Semester</th>
                                            <th>Mata Kuliah</th>
                                            <th>Mutu Mata Kuliah</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->