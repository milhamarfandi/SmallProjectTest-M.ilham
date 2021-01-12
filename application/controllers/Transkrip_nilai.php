<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transkrip_nilai extends CI_Controller
{
    public function index()
    {
        $data['judul'] = "Halaman Transkrip Nilai";
        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('admin/transkrip_nilai', $data);
        $this->load->view('base/footer');
    }

    public function get_datatable()
    {
        $nomor = $this->input->post('nomor_mahasiswa');
        $this->datatables->select("kd_transkrip_nilai, transkrip_nilai.nomor_mahasiswa, nama_mahasiswa, transkrip_nilai.semester, nm_matakuliah, mutu_matakuliah");
        $this->datatables->from('transkrip_nilai');
        $this->datatables->join('matakuliah', 'matakuliah.kd_matakuliah = transkrip_nilai.kd_matakuliah');
        $this->datatables->join('mahasiswa', 'mahasiswa.nomor_mahasiswa = transkrip_nilai.nomor_mahasiswa');
        $this->datatables->join('jurusan', 'jurusan.kd_jurusan = mahasiswa.kd_jurusan');
        if (!empty($nomor)) {
            $this->db->where(['mahasiswa.nomor_mahasiswa' => $nomor]);
        }
        $this->db->order_by("kd_transkrip_nilai", "ASC");
        $this->datatables->add_column(
            'aksi',
            '<span data-toggle="tooltip" data-placement="top" title="Edit Transkrip Nilai"><a href="javascript:void(0);" class="edit_record btn btn-sm btn-primary" data-id="$1" data-toggle="modal" data-target="#editModal">
             <i class="fas fa-edit"></i> </a> </span>
             <span data-toggle="tooltip" data-placement="top" title="Hapus Transkrip Nilai"><a href="javascript:void(0);" class="hapus_record btn btn-sm btn-danger" data-id="$1" data-toggle="modal" data-target="#hapusModal">
             <i class="fas fa-trash"></i> </a> </span>',
            'kd_transkrip_nilai'
        );
        return print_r($this->datatables->generate());
    }

    public function addTranskripNilai()
    {
        $count = count($this->input->post('nomor_mahasiswa[]'));

        $nomor_mahasiswa = $this->input->post('nomor_mahasiswa[]');
        $kd_matakuliah = $this->input->post('kd_matakuliah[]');
        $mutu_matakuliah = $this->input->post('mutu_matakuliah[]');

        for ($i = 0; $i < $count; $i++) {
            $get_m = $this->db->get_where('mahasiswa', ['nomor_mahasiswa' => $nomor_mahasiswa[$i]])->row_array();
            $get_mk = $this->db->get_where('matakuliah', ['kd_matakuliah' => $kd_matakuliah[$i]])->row_array();

            $cek = $this->db->get_where('transkrip_nilai', ['nomor_mahasiswa' => $nomor_mahasiswa[$i], 'kd_matakuliah' => $kd_matakuliah[$i]])->result_array();
            if (count($cek) == 0) {
                if ($mutu_matakuliah[$i] == "A") {
                    $mutu = 4 * $get_mk['jumlah_sks'];
                } else if ($mutu_matakuliah[$i] == "B") {
                    $mutu = 3 * $get_mk['jumlah_sks'];
                } else if ($mutu_matakuliah[$i] == "C") {
                    $mutu = 2 * $get_mk['jumlah_sks'];
                } else if ($mutu_matakuliah[$i] == "D") {
                    $mutu = 1 * $get_mk['jumlah_sks'];
                } else {
                    $mutu = 0;
                }
                $data = [
                    'nomor_mahasiswa' => $nomor_mahasiswa[$i],
                    'nama_mahasiswa' => $get_m['nama'],
                    'semester' => $get_m['semester'],
                    'kd_matakuliah' => $kd_matakuliah[$i],
                    'mutu_matakuliah' => $mutu_matakuliah[$i],
                    'total_mutu' => $mutu
                ];

                $this->db->insert('transkrip_nilai', $data);
                $data_toast = toast('success', 'Berhasil Tambah Data Transkrip Nilai!');
            } else {
                $data_toast = toast('error', 'Gagal Tambah Data Duplikat!');
            }
        }
        echo json_encode($data_toast);
    }

    public function getTranskripById()
    {
        $id = $this->input->post('kd_transkrip_nilai');
        $this->db->select('*');
        $this->db->from('transkrip_nilai');
        $this->db->join('matakuliah', 'matakuliah.kd_matakuliah = transkrip_nilai.kd_matakuliah');
        $this->db->where('kd_transkrip_nilai', $id);
        $data = $this->db->get()->row_array();

        echo json_encode($data);
    }

    public function edit_transkrip()
    {
        $kd_transkrip_nilai = $this->input->post('kd_transkrip_nilai');
        $nomor_mahasiswa = $this->input->post('nomor_mahasiswa');
        $kd_matakuliah = $this->input->post('kd_matakuliah');
        $mutu_matakuliah = $this->input->post('mutu_matakuliah');

        $get_t = $this->db->get_where('transkrip_nilai', ['kd_transkrip_nilai' => $kd_transkrip_nilai])->row_array();
        $get_mk = $this->db->get_where('matakuliah', ['kd_matakuliah' => $kd_matakuliah])->row_array();
        $get_m = $this->db->get_where('mahasiswa', ['nomor_mahasiswa' => $nomor_mahasiswa])->row_array();

        $cek = $this->db->get_where('transkrip_nilai', ['nomor_mahasiswa' => $nomor_mahasiswa, 'kd_matakuliah' => $kd_matakuliah])->result_array();
        if (count($cek) == 0) {
            if ($mutu_matakuliah == "A") {
                $mutu = 4 * $get_mk['jumlah_sks'];
            } else if ($mutu_matakuliah == "B") {
                $mutu = 3 * $get_mk['jumlah_sks'];
            } else if ($mutu_matakuliah == "C") {
                $mutu = 2 * $get_mk['jumlah_sks'];
            } else if ($mutu_matakuliah == "D") {
                $mutu = 1 * $get_mk['jumlah_sks'];
            } else {
                $mutu = 0;
            }

            $data = [
                'nomor_mahasiswa' => $nomor_mahasiswa,
                'nama_mahasiswa' => $get_m['nama'],
                'semester' => $get_m['semester'],
                'kd_matakuliah' => $kd_matakuliah,
                'mutu_matakuliah' => $mutu_matakuliah,
                'total_mutu' => $mutu
            ];

            $this->db->update('transkrip_nilai', $data, ['kd_transkrip_nilai' => $kd_transkrip_nilai]);
            $data = toast('success', 'Berhasil Edit Data Transkrip Nilai!');
        } else {
            if ($get_t['kd_matakuliah'] == $kd_matakuliah) {
                if ($mutu_matakuliah == "A") {
                    $mutu = 4 * $get_mk['jumlah_sks'];
                } else if ($mutu_matakuliah == "B") {
                    $mutu = 3 * $get_mk['jumlah_sks'];
                } else if ($mutu_matakuliah == "C") {
                    $mutu = 2 * $get_mk['jumlah_sks'];
                } else if ($mutu_matakuliah == "D") {
                    $mutu = 1 * $get_mk['jumlah_sks'];
                } else {
                    $mutu = 0;
                }
                $data = [
                    'nomor_mahasiswa' => $nomor_mahasiswa,
                    'nama_mahasiswa' => $get_m['nama'],
                    'semester' => $get_m['semester'],
                    'kd_matakuliah' => $kd_matakuliah,
                    'mutu_matakuliah' => $mutu_matakuliah,
                    'total_mutu' => $mutu
                ];

                $this->db->update('transkrip_nilai', $data, ['kd_transkrip_nilai' => $kd_transkrip_nilai]);
                $data = toast('success', 'Berhasil Edit Data Transkrip Nilai!');
            } else {
                $data = toast('error', 'Gagal Edit Data Duplikat!');
            }
        }

        echo json_encode($data);
    }

    public function hapusTranskrip()
    {
        $kd = $this->input->post('kd_transkrip_nilai');
        $this->db->delete('transkrip_nilai', ['kd_transkrip_nilai' => $kd]);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Hapus Data Transkrip Nilai!');
        } else {
            $data = toast('error', 'Gagal Hapus Data Transkrip Nilai!');
        }
        echo json_encode($data);
    }
}
