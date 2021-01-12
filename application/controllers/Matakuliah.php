<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matakuliah extends CI_Controller
{
    public function index()
    {
        $data['judul'] = "Halaman Mata Kuliah";
        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('admin/matakuliah', $data);
        $this->load->view('base/footer');
    }

    public function createQrCode($kode, $path)
    {
        $data['data'] = $kode;
        $data['size'] = 7;
        $data['savename'] = FCPATH . 'assets/images/qrcode/' . $path;
        $this->ciqrcode->generate($data);
    }

    public function getKodeOtomatis($kode = null, $tabel = null)
    {
        $this->db->select('right(kd_matakuliah,3) as kode', false);
        $this->db->order_by('kd_matakuliah', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('matakuliah');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = 'MK-' . $kodemax;

        return $kodejadi;
    }

    public function get_datatable()
    {
        $this->datatables->select("kd_matakuliah, semester, nm_matakuliah, jurusan.kd_jurusan, nm_jurusan, jumlah_sks");
        $this->datatables->from('matakuliah');
        $this->datatables->join('jurusan', 'jurusan.kd_jurusan = matakuliah.kd_jurusan');
        $this->db->order_by("kd_matakuliah", "ASC");
        $this->datatables->add_column(
            'aksi',
            '<span data-toggle="tooltip" data-placement="top" title="Edit Mata Kuliah"><a href="javascript:void(0);" class="edit_record btn btn-sm btn-primary" data-id="$1" data-toggle="modal" data-target="#editModal">
             <i class="fas fa-edit"></i> </a> </span>
             <span data-toggle="tooltip" data-placement="top" title="Hapus Mata Kuliah"><a href="javascript:void(0);" class="hapus_record btn btn-sm btn-danger" data-id="$1" data-toggle="modal" data-target="#hapusModal">
             <i class="fas fa-trash"></i> </a> </span>',
            'kd_matakuliah'
        );
        return print_r($this->datatables->generate());
    }

    public function add_matakuliah()
    {
        $data = [
            'kd_matakuliah' => $this->input->post('kd_matakuliah'),
            'semester' => $this->input->post('semester'),
            'nm_matakuliah' => ucfirst($this->input->post('nm_matakuliah')),
            'jumlah_sks' => $this->input->post('jumlah_sks'),
            'kd_jurusan' => $this->input->post('kd_jurusan')
        ];

        $this->db->insert('matakuliah', $data);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Tambah Data Mata Kuliah!');
        } else {
            $data = toast('error', 'Gagal Tambah Data Mata Kuliah!');
        }
        echo json_encode($data);
    }

    public function cek_kodematkul()
    {
        $kd = $this->input->post('kd_matakuliah');

        $cek = $this->db->get_where('matakuliah', ['kd_matakuliah' => $kd])->result_array();
        if (count($cek) > 0) {
            $data = toast('error', 'Maaf, Kode Mata Kuliah Sudah Terdaftar!');
        } else {
            $data = toast('success', 'Kode Mata Kuliah Tersedia!');
        }
        echo json_encode($data);
    }

    public function getMatakuliahById()
    {
        $id = $this->input->post('kd_matakuliah');
        $this->db->select('*');
        $this->db->from('matakuliah');
        $this->db->join('jurusan', 'jurusan.kd_jurusan = matakuliah.kd_jurusan');
        $this->db->where('kd_matakuliah', $id);
        $data = $this->db->get()->row_array();

        echo json_encode($data);
    }

    public function edit_matakuliah()
    {
        $kd = $this->input->post('kd_matakuliah');
        $data = [
            'semester' => $this->input->post('semester'),
            'nm_matakuliah' => $this->input->post('nm_matakuliah'),
            'jumlah_sks' => $this->input->post('jumlah_sks'),
            'kd_jurusan' => $this->input->post('kd_jurusan')
        ];

        $this->db->update('matakuliah', $data, ['kd_matakuliah' => $kd]);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Edit Data Mata Kuliah!');
        } else {
            $data = toast('error', 'Gagal Edit Data Mata Kuliah!');
        }
        echo json_encode($data);
    }

    public function hapusMatakuliah()
    {
        $kd = $this->input->post('kd_matakuliah');
        $this->db->delete('matakuliah', ['kd_matakuliah' => $kd]);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Hapus Data Mata Kuliah!');
        } else {
            $data = toast('error', 'Gagal Hapus Data Mata Kuliah!');
        }
        echo json_encode($data);
    }

    public function get_matakuliah()
    {
        $searchTerm = $this->input->post('searchTerm');

        $nomor_mahasiswa = $this->input->post('nomor_mahasiswa');
        if (!empty($nomor_mahasiswa)) {
            $get = $this->db->get_where('mahasiswa', ['nomor_mahasiswa' => $nomor_mahasiswa])->row_array();
        }

        $this->db->select('*');
        $this->db->from("matakuliah");
        $this->db->like("nm_matakuliah", $searchTerm);
        $this->db->or_like("kd_matakuliah", $searchTerm);
        $fetched_records = $this->db->get();
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            if (!empty($nomor_mahasiswa)) {
                if ($user['semester'] == $get['semester'] && $user['kd_jurusan'] == $get['kd_jurusan']) {
                    $data[] = array("id" => $user['kd_matakuliah'], "text" => $user['kd_matakuliah'] . ' - ' . $user['nm_matakuliah']);
                }
            } else {
                $data[] = array("id" => $user['kd_matakuliah'], "text" => $user['kd_matakuliah'] . ' - ' . $user['nm_matakuliah']);
            }
        }

        echo json_encode($data);
    }

    public function get_matakuliah_edit()
    {
        $searchTerm = $this->input->post('searchTerm');

        $nomor_mahasiswa_edit = $this->input->post('nomor_mahasiswa_edit');
        if (!empty($nomor_mahasiswa_edit)) {
            $get = $this->db->get_where('mahasiswa', ['nomor_mahasiswa' => $nomor_mahasiswa_edit])->row_array();
        }

        $this->db->select('*');
        $this->db->from("matakuliah");
        $this->db->like("nm_matakuliah", $searchTerm);
        $this->db->or_like("kd_matakuliah", $searchTerm);
        $fetched_records = $this->db->get();
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            if (!empty($nomor_mahasiswa_edit)) {
                if ($user['semester'] == $get['semester'] && $user['kd_jurusan'] == $get['kd_jurusan']) {
                    $data[] = array("id" => $user['kd_matakuliah'], "text" => $user['kd_matakuliah'] . ' - ' . $user['nm_matakuliah']);
                }
            } else {
                $data[] = array("id" => $user['kd_matakuliah'], "text" => $user['kd_matakuliah'] . ' - ' . $user['nm_matakuliah']);
            }
        }

        echo json_encode($data);
    }
}
