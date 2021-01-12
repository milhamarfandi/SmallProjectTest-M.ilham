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
                                    <a href="javascript:void(0);" class="btn btn-primary" id="add_mahasiswa"><span class="fa fa-plus"></span> Tambah Mahasiswa</a>
                                </h1>
                            </div>
                            <br>
                            <table class="table table-hover text-nowrap table-striped table-bordered" id="MyTableMahasiswa">
                                <thead>
                                    <tr>
                                        <th>Nomor Mahasiswa</th>
                                        <th>Nama</th>
                                        <th>Semester</th>
                                        <th>Jurusan</th>
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
<form id="addMahasiswa" autocomplete="off">
    <div class="modal fade" id="Modal_Add_Mahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6 col-xs-6 col-6">
                            <label for="nomor_mahasiswa">Nomer Mahasiswa</label>
                            <div class="input-group">
                                <input type="text" name="nomor_mahasiswa" class="form-control" value="" id="nomor_mahasiswa" onkeypress="return hanyaAngka(event)" placeholder="Masukkan Nomor Mahasiswa" required>
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-info btn-flat" id="check_nomor"><i class="fas fa-check"></i> </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-6 col-6">
                            <label for="nama">Namahasiswa</label>
                            <div class="input-group">
                                <input type="text" name="nama" class="form-control" value="" id="nama" placeholder="Masukkan Nama Mahasiswa" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-6 col-6">
                            <label for="semester">Semester</label>
                            <select name="semester" class="form-control select2semester" id="semester" required>
                                <option value="">Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6 col-6">
                            <label for="jurusan">Jurusan</label>
                            <select name="kd_jurusan" class="form-control select2jurusan" id="kd_jurusan" required>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="addMahasiswaBtn" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- MODAL EDIT -->
<form id="editMahasiswa" autocomplete="off">
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6 col-xs-6 col-6">
                            <label for="nomor_mahasiswa">Nomer Mahasiswa</label>
                            <div class="input-group">
                                <input type="text" name="nomor_mahasiswa" class="form-control" value="" id="nomor_mahasiswa_edit" onkeypress="return hanyaAngka(event)" placeholder="Masukkan Nomor Mahasiswa" required readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-6 col-6">
                            <label for="nama">Namahasiswa</label>
                            <div class="input-group">
                                <input type="text" name="nama" class="form-control" value="" id="nama_edit" placeholder="Masukkan Nama Mahasiswa" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-6 col-6">
                            <label for="semester">Semester</label>
                            <select name="semester" class="form-control select2semester" id="semester_edit" required>
                                <option value="">Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6 col-6">
                            <label for="jurusan">Jurusan</label>
                            <select name="kd_jurusan" class="form-control select2jurusan" id="kd_jurusan_edit" required>
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
<form id="hapusMahasiswa">
    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Anda Yakin ingin Menghapus <strong id="nama_delete"></strong> ?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="nomor_mahasiswa" id="nomor_mahasiswa_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>