<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="http://milhamarfandi.my.id">Mr.i</a>.</strong>
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
<!-- Base URL JS -->
<script src="<?= base_url(); ?>assets/js/base_url.js"></script>
<!-- Select 2 Custom -->
<script src="<?= base_url(); ?>assets/js/select2custom.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url(); ?>assets/js/myscript.js"></script>
<script src="<?= base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script>
    function toast() {
        const flashData = $(".flash-data1").html();
        const errorData = $(".error-data1").html();

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 5000,
        });

        if (flashData == "Login" || flashData == "Logout") {
            Toast.fire({
                icon: "success",
                title: "Anda Berhasil " + flashData,
            });
        } else if (flashData) {
            Toast.fire({
                icon: "success",
                title: flashData,
            });
        } else if (errorData) {
            Toast.fire({
                icon: "error",
                title: errorData,
            });
        }
    }

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    $(window).on('load', function() {
        $('.preloader').fadeOut('slow');
    });

    $(document).ready(function() {

        $('.select2semester').select2();

        // Bagian Matakuliah

        MyTableMatkul();

        function MyTableMatkul() {
            var dataTable = $('#MyTableMatkul').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url("matakuliah/get_datatable") ?>",
                    type: "POST",
                    data: {}
                },
                "columns": [{
                        data: "kd_matakuliah",
                        class: "text_center"
                    },
                    {
                        data: "semester",
                        class: "text_center",
                        render: function(data, type, row) {
                            return "Semester " + data;
                        },
                    },
                    {
                        data: "nm_matakuliah",
                        class: "text_center"
                    },
                    {
                        data: "jumlah_sks",
                        class: "text_center",
                        render: function(data, type, row) {
                            return data + " SKS";
                        },
                    },
                    {
                        data: "nm_jurusan",
                        class: "text_center"
                    },
                    {
                        data: "aksi",
                        class: "text-center",
                        width: 150,
                        orderable: false
                    }
                ],
            });
        }

        $('#add_matakuliah').on('click', function(e) {
            $("#Modal_Add_Matakuliah").modal("show");
        });

        $('#check_kode').on('click', function() {
            var kd = $('#kd_matakuliah').val();
            if (kd != "") {
                $.ajax({
                    url: "<?php echo base_url("Matakuliah/cek_kodematkul") ?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        kd_matakuliah: kd
                    },

                    success: function(data) {
                        if (data.response == "success") {
                            $(".flash-data1").html(data.message);
                            $(".error-data1").html("");
                        } else {
                            $(".error-data1").html(data.message);
                            $(".flash-data1").html("");
                        }
                        toast();
                    }
                });
            } else {
                $(".error-data1").html("Kode Matakuliah Harus Diisi Terlebih dahulu.");
                $(".flash-data1").html("");
                toast();
            }
        })

        $('#addMatakuliah').submit(function(e) {
            e.preventDefault();

            var kd = $('#kd_matakuliah').val();
            $.ajax({
                url: "<?php echo base_url("Matakuliah/cek_kodematkul") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    kd_matakuliah: kd
                },

                success: function(data) {
                    if (data.response == "success") {
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                        toast();

                        let dataString = $('#addMatakuliah').serialize();

                        $.ajax({
                            url: "<?php echo base_url("Matakuliah/add_matakuliah") ?>",
                            type: 'post',
                            dataType: 'json',
                            data: dataString,

                            success: function(data) {
                                if (data.response == "success") {
                                    $('#Modal_Add_Matakuliah').modal('hide');
                                    $('#MyTableMatkul').DataTable().ajax.reload();
                                    $('#addMatakuliah')[0].reset();

                                    $(".flash-data1").html(data.message);
                                    $(".error-data1").html("");
                                } else {
                                    $(".error-data1").html(data.message);
                                    $(".flash-data1").html("");
                                }
                                toast();
                            }
                        });
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                        toast();
                    }
                }
            });


        })

        $('#MyTableMatkul').on('click', '.edit_record', function() {
            let id = $(this).data('id');
            var text = "";
            $.ajax({
                url: "<?php echo base_url("matakuliah/getMatakuliahById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_matakuliah": id
                },
                success: function(data) {
                    $("#kd_matakuliah_edit").val(data.kd_matakuliah);
                    $("#nm_matakuliah_edit").val(data.nm_matakuliah);
                    $("#jumlah_sks_edit").val(data.jumlah_sks);
                    $("#semester_edit").val(data.semester).trigger('change');
                    text += "<option value=" + data.kd_jurusan + " selected>" +
                        data.kd_jurusan + " - " + data.nm_jurusan + "</option>";
                    $('#kd_jurusan_edit').html(text);
                }
            });
            $('#Modal_Edit').modal('show');
        });

        $('#editMatakuliah').submit(function(e) {
            e.preventDefault();

            let dataString = $('#editMatakuliah').serialize();

            $.ajax({
                url: "<?php echo base_url("Matakuliah/edit_matakuliah") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Edit').modal('hide');
                        $('#MyTableMatkul').DataTable().ajax.reload();
                        $('#editMatakuliah')[0].reset();

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        $('#MyTableMatkul').on('click', '.hapus_record', function() {
            let id = $(this).data('id');
            var text = "";
            $.ajax({
                url: "<?php echo base_url("matakuliah/getMatakuliahById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_matakuliah": id
                },
                success: function(data) {
                    $("#kd_matakuliah_delete").val(data.kd_matakuliah);
                }
            });
            $('#hapusModal').modal('show');
        });

        $('#hapusMatakuliah').submit(function(e) {
            e.preventDefault();

            let dataString = $('#hapusMatakuliah').serialize();

            $.ajax({
                url: "<?php echo base_url("Matakuliah/hapusMatakuliah") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#hapusModal').modal('hide');
                        $('#MyTableMatkul').DataTable().ajax.reload();
                        $('#hapusMatakuliah')[0].reset();

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        // END Bagian Mata kuliah

        // Bagian Jurusan
        MyTableJurusan();

        function MyTableJurusan() {
            var dataTable = $('#MyTableJurusan').DataTable({
                // "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url("jurusan/get_datatable") ?>",
                    type: "POST",
                    data: {}
                },
                "columns": [{
                        data: "kd_jurusan",
                        class: "text_center"
                    },
                    {
                        data: "nm_jurusan",
                        class: "text_center"
                    },
                    {
                        data: "aksi",
                        class: "text-center",
                        width: 150,
                        orderable: false
                    }
                ],
            });
        }

        $('#add_jurusan').on('click', function(e) {
            $("#Modal_Add_Jurusan").modal("show");
        });

        $('#addJurusan').submit(function(e) {
            e.preventDefault();

            let dataString = $('#addJurusan').serialize();

            $.ajax({
                url: "<?php echo base_url("Jurusan/add_jurusan") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Add_Jurusan').modal('hide');
                        $('#MyTableJurusan').DataTable().ajax.reload();
                        $('#addJurusan')[0].reset();

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        $('#MyTableJurusan').on('click', '.edit_record', function() {
            let id = $(this).data('id');
            var text = "";
            $.ajax({
                url: "<?php echo base_url("jurusan/getJurusanById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_jurusan": id
                },
                success: function(data) {
                    $("#kd_jurusan_edit").val(data.kd_jurusan);
                    $("#nm_jurusan_edit").val(data.nm_jurusan);
                }
            });
            $('#Modal_Edit').modal('show');
        });

        $('#editJurusan').submit(function(e) {
            e.preventDefault();

            let dataString = $('#editJurusan').serialize();

            $.ajax({
                url: "<?php echo base_url("Jurusan/edit_jurusan") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Edit').modal('hide');
                        $('#MyTableJurusan').DataTable().ajax.reload();
                        $('#editJurusan')[0].reset();

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        $('#MyTableJurusan').on('click', '.hapus_record', function() {
            let id = $(this).data('id');
            var text = "";
            $.ajax({
                url: "<?php echo base_url("jurusan/getJurusanById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_jurusan": id
                },
                success: function(data) {
                    $("#kd_jurusan_delete").val(data.kd_jurusan);
                    $("#nm_jurusan_delete").html(data.nm_jurusan);
                }
            });
            $('#Modal_Delete').modal('show');
        });

        $('#hapusJurusan').submit(function(e) {
            e.preventDefault();

            let dataString = $('#hapusJurusan').serialize();

            $.ajax({
                url: "<?php echo base_url("Jurusan/hapusJurusan") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Delete').modal('hide');
                        $('#MyTableJurusan').DataTable().ajax.reload();
                        $('#hapusJurusan')[0].reset();

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })
        // End Bagian Jurusan

        // Bagian Mahasiswa
        MyTableMahasiswa();

        function MyTableMahasiswa() {
            var dataTable = $('#MyTableMahasiswa').DataTable({
                // "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url("mahasiswa/get_datatable") ?>",
                    type: "POST",
                    data: {}
                },
                "columns": [{
                        data: "nomor_mahasiswa",
                        class: "text_center"
                    },
                    {
                        data: "nama",
                        class: "text_center"
                    },
                    {
                        data: "semester",
                        class: "text_center",
                        render: function(data, type, row) {
                            return "Semester " + data;
                        },
                    },
                    {
                        data: "nm_jurusan",
                        class: "text_center"
                    },
                    {
                        data: "aksi",
                        class: "text-center",
                        width: 150,
                        orderable: false
                    }
                ],
            });
        }

        $('#add_mahasiswa').on('click', function(e) {
            $("#Modal_Add_Mahasiswa").modal("show");
        });

        $('#check_nomor').on('click', function() {
            var kd = $('#nomor_mahasiswa').val();
            if (kd != "") {
                $.ajax({
                    url: "<?php echo base_url("Mahasiswa/cek_nomormahasiswa") ?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        nomor_mahasiswa: kd
                    },

                    success: function(data) {
                        if (data.response == "success") {
                            $(".flash-data1").html(data.message);
                            $(".error-data1").html("");
                        } else {
                            $(".error-data1").html(data.message);
                            $(".flash-data1").html("");
                        }
                        toast();
                    }
                });
            } else {
                $(".error-data1").html("Nomor Mahasiswa Harus Diisi Terlebih dahulu.");
                $(".flash-data1").html("");
                toast();
            }
        })

        $("#addMahasiswaBtn").click(function() {
            var nomor = $("#nomor_mahasiswa").val();

            var pwd2 = /^(?=.*[0-9])/;

            if (nomor.length > 0) {
                if (nomor.length > 0 && nomor.length < 8) {
                    $(".error-data1").html("Nomor Mahasiswa Minimal Harus Tidak Kurang Dari 8 Karakter !");
                    toast();
                    return false;
                }
            }
        })

        $('#addMahasiswa').submit(function(e) {
            e.preventDefault();

            let dataString = $('#addMahasiswa').serialize();

            var kd = $('#nomor_mahasiswa').val();
            if (kd != "") {
                $.ajax({
                    url: "<?php echo base_url("Mahasiswa/cek_nomormahasiswa") ?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        nomor_mahasiswa: kd
                    },

                    success: function(data) {
                        if (data.response == "success") {
                            $(".flash-data1").html(data.message);
                            $(".error-data1").html("");

                            $.ajax({
                                url: "<?php echo base_url("Mahasiswa/addMahasiswa") ?>",
                                type: 'post',
                                dataType: 'json',
                                data: dataString,

                                success: function(data) {
                                    if (data.response == "success") {
                                        $('#Modal_Add_Mahasiswa').modal('hide');
                                        $('#MyTableMahasiswa').DataTable().ajax.reload();
                                        $('#addMahasiswa')[0].reset();
                                        $("#semester").val("").trigger('change');
                                        $("#kd_jurusan").val("").trigger('change');

                                        $(".flash-data1").html(data.message);
                                        $(".error-data1").html("");
                                    } else {
                                        $(".error-data1").html(data.message);
                                        $(".flash-data1").html("");
                                    }
                                    toast();
                                }
                            });
                        } else {
                            $(".error-data1").html(data.message);
                            $(".flash-data1").html("");
                        }
                        toast();
                    }
                });
            } else {
                $(".error-data1").html("Nomor Mahasiswa Harus Diisi Terlebih dahulu.");
                $(".flash-data1").html("");
                toast();
            }
        })

        $('#MyTableMahasiswa').on('click', '.edit_record', function() {
            let id = $(this).data('id');
            var text = "";
            $.ajax({
                url: "<?php echo base_url("mahasiswa/getMahasiswaById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "nomor_mahasiswa": id
                },
                success: function(data) {
                    $("#nomor_mahasiswa_edit").val(data.nomor_mahasiswa);
                    $("#nama_edit").val(data.nama);
                    $("#semester_edit").val(data.semester).trigger('change');
                    text += "<option value=" + data.kd_jurusan + " selected>" +
                        data.kd_jurusan + " - " + data.nm_jurusan + "</option>";
                    $('#kd_jurusan_edit').html(text);
                }
            });
            $('#Modal_Edit').modal('show');
        });

        $('#editMahasiswa').submit(function(e) {
            e.preventDefault();

            let dataString = $('#editMahasiswa').serialize();

            $.ajax({
                url: "<?php echo base_url("Mahasiswa/edit_mahasiswa") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Edit').modal('hide');
                        $('#MyTableMahasiswa').DataTable().ajax.reload();
                        $('#editMahasiswa')[0].reset();

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        $('#MyTableMahasiswa').on('click', '.hapus_record', function() {
            let id = $(this).data('id');
            var text = "";
            $.ajax({
                url: "<?php echo base_url("mahasiswa/getMahasiswaById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "nomor_mahasiswa": id
                },
                success: function(data) {
                    $("#nomor_mahasiswa_delete").val(data.nomor_mahasiswa);
                    $("#nama_delete").html(data.nama);
                }
            });
            $('#Modal_Delete').modal('show');
        });

        $('#hapusMahasiswa').submit(function(e) {
            e.preventDefault();

            let dataString = $('#hapusMahasiswa').serialize();

            $.ajax({
                url: "<?php echo base_url("Mahasiswa/hapusMahasiswa") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Delete').modal('hide');
                        $('#MyTableMahasiswa').DataTable().ajax.reload();
                        $('#hapusMahasiswa')[0].reset();

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })
        // End Bagian Mahasiswa

        // Bagian Transkrip Nilai
        MyTableTranskrip();

        function MyTableTranskrip() {
            var dataTable = $('#MyTableTranskrip').DataTable({
                // "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url("transkrip_nilai/get_datatable") ?>",
                    type: "POST",
                    data: {}
                },
                "columns": [{
                        data: "nomor_mahasiswa",
                        class: "text_center"
                    },
                    {
                        data: "nama_mahasiswa",
                        class: "text_center"
                    },
                    {
                        data: "semester",
                        class: "text_center",
                        render: function(data, type, row) {
                            return "Semester " + data;
                        },
                    },
                    {
                        data: "nm_matakuliah",
                        class: "text_center"
                    },
                    {
                        data: "mutu_matakuliah",
                        class: "text_center"
                    },
                    {
                        data: "aksi",
                        class: "text-center",
                        width: 150,
                        orderable: false
                    }
                ],
            });
        }

        $('#add_transkrip_nilai').on('click', function(e) {
            $("#Modal_Add_TranskripNilai").modal("show");
        });

        $('#addTranskripNilai').submit(function(e) {
            e.preventDefault();

            let dataString = $('#addTranskripNilai').serialize();

            $.ajax({
                url: "<?php echo base_url("transkrip_nilai/addTranskripNilai") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Add_TranskripNilai').modal('hide');
                        $('#MyTableTranskrip').DataTable().ajax.reload();
                        $('#addTranskripNilai')[0].reset();
                        $("#nomor_mahasiswa").val("").trigger('change');
                        $("#kd_matakuliah").val("").trigger('change');
                        $("#mutu_matakuliah").val("").trigger('change');

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    $("#jmlbarang1").val(1);
                    $("#jmlbarangplus").val(1);
                    $("#jmlbarangminus").val(1);
                    toast();
                }
            });

        })

        $('#MyTableTranskrip').on('click', '.edit_record', function() {
            let id = $(this).data('id');
            var text = "";
            var text1 = "";
            $.ajax({
                url: "<?php echo base_url("transkrip_nilai/getTranskripById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_transkrip_nilai": id
                },
                success: function(data) {
                    $("#kd_transkrip_nilai_edit").val(data.kd_transkrip_nilai);
                    $("#mutu_matakuliah_edit").val(data.mutu_matakuliah).trigger('change');
                    $("#nomor_mahasiswa_edit").val(data.nomor_mahasiswa).trigger('change');
                    $('#nomor_mahasiswa_edit1').attr('disabled', true);

                    text1 += "<option value=" + data.kd_matakuliah + " selected>" +
                        data.kd_matakuliah + " - " + data.nm_matakuliah + "</option>";
                    $('#kd_matakuliah_edit').html(text1);

                    text += "<option value=" + data.nomor_mahasiswa + " selected>" +
                        data.nomor_mahasiswa + " - " + data.nama_mahasiswa + '( Semester' + data.semester + ' )' + "</option>";
                    $('#nomor_mahasiswa_edit1').html(text);
                }
            });
            $('#Modal_Edit').modal('show');
        });

        $('#editTranskrip').submit(function(e) {
            e.preventDefault();

            let dataString = $('#editTranskrip').serialize();

            $.ajax({
                url: "<?php echo base_url("transkrip_nilai/edit_transkrip") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Edit').modal('hide');
                        $('#MyTableTranskrip').DataTable().ajax.reload();
                        $('#editTranskrip')[0].reset();

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        $('#MyTableTranskrip').on('click', '.hapus_record', function() {
            let id = $(this).data('id');
            var text = "";
            $.ajax({
                url: "<?php echo base_url("transkrip_nilai/getTranskripById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_transkrip_nilai": id
                },
                success: function(data) {
                    $("#kd_transkrip_nilai_delete").val(data.kd_transkrip_nilai);
                }
            });
            $('#Modal_Delete').modal('show');
        });

        $('#hapusTranskrip').submit(function(e) {
            e.preventDefault();

            let dataString = $('#hapusTranskrip').serialize();

            $.ajax({
                url: "<?php echo base_url("Transkrip_nilai/hapusTranskrip") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Delete').modal('hide');
                        $('#MyTableTranskrip').DataTable().ajax.reload();
                        $('#hapusTranskrip')[0].reset();

                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })
        // End Bagian Transkrip Nilai

        // Bagian Report Transkrip Nilai
        MyTableReportTranskrip();

        function MyTableReportTranskrip(nomor = '') {
            var dataTable = $('#MyTableReportTranskrip').DataTable({
                // "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url("transkrip_nilai/get_datatable") ?>",
                    type: "POST",
                    data: {
                        nomor_mahasiswa: nomor
                    }
                },
                "columns": [{
                        data: "nomor_mahasiswa",
                        class: "text_center"
                    },
                    {
                        data: "nama_mahasiswa",
                        class: "text_center"
                    },
                    {
                        data: "semester",
                        class: "text_center",
                        render: function(data, type, row) {
                            return "Semester " + data;
                        },
                    },
                    {
                        data: "nm_matakuliah",
                        class: "text_center"
                    },
                    {
                        data: "mutu_matakuliah",
                        class: "text_center"
                    }
                ],
            });
        }

        $('#nomor_mahasiswa').on('change', function() {
            var nomor = $('#nomor_mahasiswa').val();
            $('#MyTableReportTranskrip').DataTable().destroy();
            MyTableReportTranskrip(nomor);
        });

        $('#refresh').click(function() {
            window.location.href = "<?php echo base_url() ?>report";
        })

        $('#buttonprint').click(function() {
            var nomor = $('#nomor_mahasiswa').val();
            if (nomor == "" || nomor == null) {
                nomor = "0";
            }
            window.location.href = "<?php echo base_url() ?>report/print/" + nomor;
        });

        $('#buttonpdf').click(function() {
            var nomor = $('#nomor_mahasiswa').val();
            if (nomor == "" || nomor == null) {
                nomor = "0";
            }
            window.location.href = "<?php echo base_url() ?>report/pdf/" + nomor;
        });
        // End Bagian Report Transkrip Nilai
    });
</script>