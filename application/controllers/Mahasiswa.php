<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function index()
    {
        $data['judul'] = "Halaman Mahasiswa";
        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('admin/mahasiswa', $data);
        $this->load->view('base/footer');
    }

    public function get_datatable()
    {
        $this->datatables->select("nomor_mahasiswa, nama, semester, jurusan.kd_jurusan, nm_jurusan");
        $this->datatables->from('mahasiswa');
        $this->datatables->join('jurusan', 'jurusan.kd_jurusan = mahasiswa.kd_jurusan');
        $this->db->order_by("nomor_mahasiswa", "ASC");
        $this->datatables->add_column(
            'aksi',
            '<span data-toggle="tooltip" data-placement="top" title="Edit Mahasiswa"><a href="javascript:void(0);" class="edit_record btn btn-sm btn-primary" data-id="$1" data-toggle="modal" data-target="#editModal">
             <i class="fas fa-edit"></i> </a> </span>
             <span data-toggle="tooltip" data-placement="top" title="Hapus Mahasiswa"><a href="javascript:void(0);" class="hapus_record btn btn-sm btn-danger" data-id="$1" data-toggle="modal" data-target="#hapusModal">
             <i class="fas fa-trash"></i> </a> </span>',
            'nomor_mahasiswa'
        );
        return print_r($this->datatables->generate());
    }

    public function cek_nomormahasiswa()
    {
        $kd = $this->input->post('nomor_mahasiswa');

        $cek = $this->db->get_where('mahasiswa', ['nomor_mahasiswa' => $kd])->result_array();
        if (count($cek) > 0) {
            $data = toast('error', 'Maaf, Nomor Mahasiswa Sudah Terdaftar!');
        } else {
            $data = toast('success', 'Nomor Mahasiswa Tersedia!');
        }
        echo json_encode($data);
    }

    public function addMahasiswa()
    {
        $data = [
            'nomor_mahasiswa' => $this->input->post('nomor_mahasiswa'),
            'nama' => ucfirst($this->input->post('nama')),
            'semester' => $this->input->post('semester'),
            'kd_jurusan' => $this->input->post('kd_jurusan')
        ];

        $this->db->insert('mahasiswa', $data);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Tambah Data Mahasiswa!');
        } else {
            $data = toast('error', 'Gagal Tambah Data Mahasiswa!');
        }
        echo json_encode($data);
    }

    public function getMahasiswaById()
    {
        $id = $this->input->post('nomor_mahasiswa');
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('jurusan', 'jurusan.kd_jurusan = mahasiswa.kd_jurusan');
        $this->db->where('nomor_mahasiswa', $id);
        $data = $this->db->get()->row_array();

        echo json_encode($data);
    }

    public function edit_mahasiswa()
    {
        $where = ['nomor_mahasiswa' => $this->input->post('nomor_mahasiswa')];
        $data = [
            'nama' => ucfirst($this->input->post('nama')),
            'semester' => $this->input->post('semester'),
            'kd_jurusan' => $this->input->post('kd_jurusan')
        ];

        $this->db->update('mahasiswa', $data, $where);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Tambah Data Mahasiswa!');
        } else {
            $data = toast('error', 'Gagal Tambah Data Mahasiswa!');
        }
        echo json_encode($data);
    }

    public function hapusMahasiswa()
    {
        $kd = $this->input->post('nomor_mahasiswa');
        $this->db->delete('mahasiswa', ['nomor_mahasiswa' => $kd]);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Hapus Data Mata Kuliah!');
        } else {
            $data = toast('error', 'Gagal Hapus Data Mata Kuliah!');
        }
        echo json_encode($data);
    }

    public function get_mahasiswa()
    {
        $searchTerm = $this->input->post('searchTerm');

        $this->db->select('*');
        $this->db->from("mahasiswa");
        $this->db->like("nama", $searchTerm);
        $this->db->or_like("nomor_mahasiswa", $searchTerm);
        $this->db->or_like("semester", $searchTerm);
        $fetched_records = $this->db->get();
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['nomor_mahasiswa'], "text" => $user['nomor_mahasiswa'] . ' - ' . $user['nama'] . ' ( Semester ' . $user['semester'] . ' ) ');
        }

        echo json_encode($data);
    }

    public function get_mahasiswa_semester()
    {
        $searchTerm = $this->input->post('searchTerm');
        $semester = $this->input->post('semester');

        $this->db->select('*');
        $this->db->from("mahasiswa");
        if (!empty($semester)) {
            $this->db->where(['semester' => $semester]);
        }
        $this->db->like("nama", $searchTerm);
        $this->db->or_like("nomor_mahasiswa", $searchTerm);
        $this->db->or_like("semester", $searchTerm);
        $fetched_records = $this->db->get();
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['nomor_mahasiswa'], "text" => $user['nomor_mahasiswa'] . ' - ' . $user['nama'] . ' ( Semester ' . $user['semester'] . ' ) ');
        }

        echo json_encode($data);
    }
}
