<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function index()
    {
        $data['judul'] = "Halaman Report Transkrip Nilai";
        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('admin/report', $data);
        $this->load->view('base/footer');
    }

    public function print($nomor = "0")
    {
        $this->db->select("*");
        $this->db->from('transkrip_nilai');
        $this->db->join('matakuliah', 'matakuliah.kd_matakuliah = transkrip_nilai.kd_matakuliah');
        $this->db->join('mahasiswa', 'mahasiswa.nomor_mahasiswa = transkrip_nilai.nomor_mahasiswa');
        $this->db->join('jurusan', 'jurusan.kd_jurusan = mahasiswa.kd_jurusan');
        if ($nomor != "0") {
            $this->db->where(['transkrip_nilai.nomor_mahasiswa' => $nomor]);
        }
        $this->db->group_by('mahasiswa.nomor_mahasiswa');
        $data['transkrip_group'] = $this->db->get()->result_array();

        $data['judul'] = "Print Transkrip Nilai";
        $this->load->view('report/report_print', $data);
    }

    public function pdf($nomor = "0")
    {
        $this->db->select("*");
        $this->db->from('transkrip_nilai');
        $this->db->join('matakuliah', 'matakuliah.kd_matakuliah = transkrip_nilai.kd_matakuliah');
        $this->db->join('mahasiswa', 'mahasiswa.nomor_mahasiswa = transkrip_nilai.nomor_mahasiswa');
        $this->db->join('jurusan', 'jurusan.kd_jurusan = mahasiswa.kd_jurusan');
        if ($nomor != "0") {
            $this->db->where(['transkrip_nilai.nomor_mahasiswa' => $nomor]);
        }
        $this->db->group_by('mahasiswa.nomor_mahasiswa');
        $data['transkrip_group'] = $this->db->get()->result_array();

        $data['judul'] = "PDF Transkrip Nilai";

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->atch = array("Attachment" => TRUE);
        $this->pdf->filename = "Transkrip-Nilai-" . $nomor . " - " . time() . ".pdf";

        $this->pdf->load_view('report/report_pdf', $data);
    }
}
