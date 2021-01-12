<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    public function index()
    {
        $data['judul'] = "Halaman Jurusan";
        $data['kodeotomatis'] = $this->getKodeOtomatis();
        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('admin/jurusan', $data);
        $this->load->view('base/footer');
    }

    public function getKodeOtomatis($kode = null, $tabel = null)
    {
        $this->db->select('right(kd_jurusan,3) as kode', false);
        $this->db->order_by('kd_jurusan', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('jurusan');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = 'JR-' . $kodemax;

        return $kodejadi;
    }

    public function get_datatable()
    {
        $this->datatables->select("kd_jurusan,  nm_jurusan");
        $this->datatables->from('jurusan');
        $this->db->order_by("kd_jurusan", "ASC");
        $this->datatables->add_column(
            'aksi',
            '<span data-toggle="tooltip" data-placement="top" title="Edit Jurusan"><a href="javascript:void(0);" class="edit_record btn btn-sm btn-primary" data-id="$1" data-toggle="modal" data-target="#editModal">
             <i class="fas fa-edit"></i> </a> </span>
             <span data-toggle="tooltip" data-placement="top" title="Hapus Jurusan"><a href="javascript:void(0);" class="hapus_record btn btn-sm btn-danger" data-id="$1" data-toggle="modal" data-target="#hapusModal">
             <i class="fas fa-trash"></i> </a> </span>',
            'kd_jurusan'
        );
        return print_r($this->datatables->generate());
    }

    public function add_jurusan()
    {
        $jurusan = $this->input->post('nm_jurusan[]');
        for ($i = 0; $i < count($jurusan); $i++) {
            $kd_otomatis = $this->getKodeOtomatis();
            $data = [
                'kd_jurusan' => $kd_otomatis,
                'nm_jurusan' => ucfirst($jurusan[$i]),
            ];

            $this->db->insert('jurusan', $data);
        }

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Tambah Data Jurusan!');
        } else {
            $data = toast('error', 'Gagal Tambah Data Jurusan!');
        }
        echo json_encode($data);
    }

    public function getJurusanById()
    {
        $id = $this->input->post('kd_jurusan');

        $data = $this->db->get_where('jurusan', ['kd_jurusan' => $id])->row_array();

        echo json_encode($data);
    }

    public function edit_jurusan()
    {
        $nm = $this->input->post('nm_jurusan');
        $kd = $this->input->post('kd_jurusan');
        $this->db->update('jurusan', ['nm_jurusan' => $nm], ['kd_jurusan' => $kd]);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Edit Data Jurusan!');
        } else {
            $data = toast('error', 'Gagal Edit Data Jurusan!');
        }
        echo json_encode($data);
    }

    public function hapusJurusan()
    {
        $kd = $this->input->post('kd_jurusan');
        $this->db->delete('jurusan', ['kd_jurusan' => $kd]);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Hapus Data Jurusan!');
        } else {
            $data = toast('error', 'Gagal Hapus Data Jurusan!');
        }
        echo json_encode($data);
    }

    public function get_jurusan()
    {
        $searchTerm = $this->input->post('searchTerm');

        $this->db->select('*');
        $this->db->from("jurusan");
        $this->db->like("nm_jurusan", $searchTerm);
        $this->db->or_like("kd_jurusan", $searchTerm);
        $fetched_records = $this->db->get();
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['kd_jurusan'], "text" => $user['kd_jurusan'] . ' - ' . $user['nm_jurusan']);
        }

        echo json_encode($data);
    }
}
