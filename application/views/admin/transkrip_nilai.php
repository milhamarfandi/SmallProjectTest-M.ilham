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
                        <div class="card-body table-responsive">
                            <div class="col-md-12">
                                <h1>
                                    <!-- <small>List</small> -->
                                    <a href="javascript:void(0);" class="btn btn-primary" id="add_transkrip_nilai"><span class="fa fa-plus"></span> Tambah Transkrip Nilai</a>
                                </h1>
                            </div>
                            <br>
                            <table class="table table-hover text-nowrap table-striped table-bordered" id="MyTableTranskrip">
                                <thead>
                                    <tr>
                                        <th>Nomor Mahasiswa</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Semester</th>
                                        <th>Mata Kuliah</th>
                                        <th>Mutu Mata Kuliah</th>
                                        <th style="text-align: right;">Actions</th>
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

<!-- MODAL ADD -->
<form id="addTranskripNilai" autocomplete="off">
    <div class="modal fade" id="Modal_Add_TranskripNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Transkrip Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-xl-4 col-xs-6 col-6">
                            <select name="nomor_mahasiswa[]" id="nomor_mahasiswa" class="form-control select2mahasiswa" required></select>
                        </div>
                        <div class="form-group col-xl-4 col-xs-6 col-6">
                            <select name="kd_matakuliah[]" id="kd_matakuliah" class="form-control select2matakuliah" required></select>
                        </div>
                        <div class="form-group col-xl-2 col-xs-10 col-10">
                            <select name="mutu_matakuliah[]" class="form-control select2semester" id="mutu_matakuliah" required>
                                <option value="">Mutu Mata Kuliah</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-xs-2 col-2">
                            <button type="button" id="tambahtranskrip" class="btn btn-success"><i class="fa fa-plus"></i> </button>
                        </div>
                    </div>
                    <div id="sectionadd">

                    </div>
                    <!-- ini untuk max pembelian -->
                    <input type="hidden" id="jmlbarang" value="10">
                    <!-- ini untuk perhitungan looping di for nya -->
                    <input type="hidden" id="jmlbarang1" value="1">
                    <!-- ini untuk index pada pertambahan -->
                    <input type="hidden" id="jmlbarangplus" value="1">
                    <!-- ini untuk index pada pengurangan -->
                    <input type="hidden" id="jmlbarangminus" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- MODAL EDIT -->
<form id="editTranskrip" autocomplete="off">
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Transkrip Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-xl-4 col-xs-6 col-6">
                            <select id="nomor_mahasiswa_edit1" class="form-control select2mahasiswa" required></select>
                            <input type="hidden" name="nomor_mahasiswa" value="" id="nomor_mahasiswa_edit">
                            <input type="hidden" name="kd_transkrip_nilai" value="" id="kd_transkrip_nilai_edit">
                        </div>
                        <div class="form-group col-xl-4 col-xs-6 col-6">
                            <select name="kd_matakuliah" id="kd_matakuliah_edit" class="form-control select2matakuliahedit" required></select>
                        </div>
                        <div class="form-group col-xl-4 col-xs-12 col-12">
                            <select name="mutu_matakuliah" class="form-control select2semester" id="mutu_matakuliah_edit" required>
                                <option value="">Mutu Mata Kuliah</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- MODAL DELETE -->
<form id="hapusTranskrip">
    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Transkrip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Anda Yakin ingin Menghapus <strong id="nm_transkrip_delete"></strong> ?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kd_transkrip_nilai" id="kd_transkrip_nilai_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>