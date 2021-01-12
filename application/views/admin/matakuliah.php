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
                                    <a href="javascript:void(0);" class="btn btn-primary" id="add_matakuliah"><span class="fa fa-plus"></span> Tambah Mata Kuliah</a>
                                </h1>
                            </div>
                            <br>
                            <table class="table table-hover text-nowrap table-striped table-bordered" id="MyTableMatkul">
                                <thead>
                                    <tr>
                                        <th>Kode Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>Nama Mata Kuliah</th>
                                        <th>Jumlah SKS </th>
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
<form id="addMatakuliah" autocomplete="off">
    <div class="modal fade" id="Modal_Add_Matakuliah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-8 col-xs-8 col-8">
                            <label for="kd_matakuliah">Kode Mata Kuliah</label>
                            <div class="input-group">
                                <input type="text" name="kd_matakuliah" class="form-control" value="" id="kd_matakuliah" placeholder="Masukkan Kode Mata Kuliah" required>
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-info btn-flat" id="check_kode"><i class="fas fa-check"></i> </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-xs-4 col-4">
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
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8 col-xs-8 col-8">
                            <label for="nm_matakuliah">Nama Mata Kuliah</label>
                            <input type="text" name="nm_matakuliah" class="form-control" id="nm_matakuliah" placeholder="Masukkan Nama Mata Kuliah" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-4 col-4">
                            <label for="jumlah_sks">Jumlah SKS</label>
                            <input type="number" name="jumlah_sks" class="form-control" id="jumlah_sks" placeholder="Masukkan Jumlah SKS" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select name="kd_jurusan" class="form-control select2jurusan" id="kd_jurusan" required>
                        </select>
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
<!--END MODAL ADD-->

<!-- MODAL EDIT -->
<form id="editMatakuliah" autocomplete="off">
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-8 col-xs-8 col-8">
                            <label for="kd_matakuliah">Kode Mata Kuliah</label>
                            <input type="text" name="kd_matakuliah" class="form-control" id="kd_matakuliah_edit" placeholder="Masukkan Kode Mata Kuliah" required readonly>
                        </div>
                        <div class="form-group col-md-4 col-xs-4 col-4">
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
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8 col-xs-8 col-8">
                            <label for="nm_matakuliah">Nama Mata Kuliah</label>
                            <input type="text" name="nm_matakuliah" class="form-control" id="nm_matakuliah_edit" placeholder="Masukkan Nama Mata Kuliah" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-4 col-4">
                            <label for="jumlah_sks">Jumlah SKS</label>
                            <input type="number" name="jumlah_sks" class="form-control" id="jumlah_sks_edit" placeholder="Masukkan Jumlah SKS" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select name="kd_jurusan" class="form-control select2jurusan" id="kd_jurusan_edit" required>
                        </select>
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
<!--END MODAL EDIT-->

<!--MODAL DELETE-->
<form id="hapusMatakuliah">
    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kd_matakuliah" id="kd_matakuliah_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL DELETE-->