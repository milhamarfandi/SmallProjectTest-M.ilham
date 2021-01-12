<!DOCTYPE html>
<html>

<head>

    <title><?= $judul ?></title>
    <style type="text/css">
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
</head>

<body>

    <div class="page-content">
        <div class="container-fluid">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div align="center" class="header-mail">
                                    </div>
                                    <center>
                                        <h5>
                                            <b>DAFTAR TRANSKRIP NILAI MAHASISWA</b><br>
                                            <b>SEKOLAH PASCASARJANA</b><br>
                                            <b>INSTITUT PERTANIAN BOGOR</b><br>
                                        </h5>
                                    </center>
                                    <hr width="100%" color="orange" style="border:solid; color:#000080;">
                                    <?php foreach ($transkrip_group as $tg) { ?>
                                        <table class="table">
                                            <tr style=" width: 100%;">
                                                <th style="width: 20%;">Nomor Mahasiswa</th>
                                                <th style="width: 2%;">:</th>
                                                <th style="width: 780%;"><?= $tg['nomor_mahasiswa']  ?></th>
                                            </tr>
                                            <tr style=" width: 100%;">
                                                <th style="width: 20%;">Nama Mahasiswa</th>
                                                <th style="width: 2%;">:</th>
                                                <th style="width: 780%;"><?= $tg['nama_mahasiswa'] ?></th>
                                            </tr>
                                            <tr style=" width: 100%;">
                                                <th style="width: 20%;">Jurusan</th>
                                                <th style="width: 2%;">:</th>
                                                <th style="width: 780%;"><?= $tg['nm_jurusan'] ?></th>
                                            </tr>
                                            <tr style=" width: 100%;">
                                                <th style="width: 20%;">Semester</th>
                                                <th style="width: 2%;">:</th>
                                                <th style="width: 780%;"><?= $tg['semester'] ?></th>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th style="width: 10%;">No</th>
                                                <th style="width: 20%;">Kode Mata Kuliah</th>
                                                <th style="width: 30%;">Mata Kuliah</th>
                                                <th style="width: 20%;">SKS</th>
                                                <th style="width: 20%;">Huruf Mutu</th>
                                                <th style="width: 20%;">Mutu</th>
                                            </tr>
                                            <tbody>
                                                <?php
                                                $this->db->select("*");
                                                $this->db->from('transkrip_nilai');
                                                $this->db->join('matakuliah', 'matakuliah.kd_matakuliah = transkrip_nilai.kd_matakuliah');
                                                $this->db->join('mahasiswa', 'mahasiswa.nomor_mahasiswa = transkrip_nilai.nomor_mahasiswa');
                                                $this->db->join('jurusan', 'jurusan.kd_jurusan = mahasiswa.kd_jurusan');
                                                $this->db->where(['transkrip_nilai.nomor_mahasiswa' => $tg['nomor_mahasiswa']]);
                                                $transkrip = $this->db->get()->result_array();

                                                $no = 1;
                                                foreach ($transkrip as $t) { ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $t['kd_matakuliah'] ?></td>
                                                        <td><?= $t['nm_matakuliah'] ?></td>
                                                        <td><?= $t['jumlah_sks'] ?></td>
                                                        <td><?= $t['mutu_matakuliah'] ?></td>
                                                        <td>
                                                            <?php if ($t['mutu_matakuliah'] == "A") {
                                                                $mutu = 4 * $t['jumlah_sks'];
                                                            } else if ($t['mutu_matakuliah'] == "B") {
                                                                $mutu = 3 * $t['jumlah_sks'];
                                                            } else if ($t['mutu_matakuliah'] == "C") {
                                                                $mutu = 2 * $t['jumlah_sks'];
                                                            } else if ($t['mutu_matakuliah'] == "D") {
                                                                $mutu = 1 * $t['jumlah_sks'];
                                                            } else {
                                                                $mutu = 0;
                                                            }
                                                            echo $mutu;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <?php
                                                $this->db->select_sum('jumlah_sks');
                                                $this->db->from('transkrip_nilai');
                                                $this->db->join('matakuliah', 'matakuliah.kd_matakuliah = transkrip_nilai.kd_matakuliah');
                                                $this->db->join('mahasiswa', 'mahasiswa.nomor_mahasiswa = transkrip_nilai.nomor_mahasiswa');
                                                $this->db->where(['transkrip_nilai.nomor_mahasiswa' => $tg['nomor_mahasiswa']]);
                                                $total_sks = $this->db->get()->row()->jumlah_sks;

                                                $this->db->select_sum('total_mutu');
                                                $this->db->from('transkrip_nilai');
                                                $this->db->join('matakuliah', 'matakuliah.kd_matakuliah = transkrip_nilai.kd_matakuliah');
                                                $this->db->join('mahasiswa', 'mahasiswa.nomor_mahasiswa = transkrip_nilai.nomor_mahasiswa');
                                                $this->db->where(['transkrip_nilai.nomor_mahasiswa' => $tg['nomor_mahasiswa']]);
                                                $total_mutu = $this->db->get()->row()->total_mutu;
                                                ?>
                                                <tr>
                                                    <td colspan="3" align="right"> Jumlah</td>
                                                    <th><?= $total_sks ?></th>
                                                    <td></td>
                                                    <th><?= number_format($total_mutu) ?></th>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" align="right"> IPK</td>
                                                    <th><?= $total_mutu / $total_sks; ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <br>
                                        <table style="width: 20%; font-weight:600;">
                                            <tr>
                                                <td colspan="3" align="center">Ketentuan Nilai</td>
                                            </tr>
                                            <tr>
                                                <td>NILAI A</td>
                                                <td>:</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <td>NILAI B</td>
                                                <td>:</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>NILAI C</td>
                                                <td>:</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>NILAI D</td>
                                                <td>:</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>NILAI E</td>
                                                <td>:</td>
                                                <td>0</td>
                                            </tr>
                                        </table>
                                        <br><br>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>


    <script>
        window.print();
    </script>

</body>

</html>