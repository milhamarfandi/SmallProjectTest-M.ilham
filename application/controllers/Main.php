<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function index()
    {
        $data['judul'] = "Halaman Dashboard";
        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('example/dashboard', $data);
        $this->load->view('base/footer');
    }

    public function datatable()
    {
        $data['judul'] = "Halaman Data Table";
        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('example/datatable', $data);
        $this->load->view('base/footer');
    }

    public function form()
    {
        $data['judul'] = "Halaman Form";
        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('example/form', $data);
        $this->load->view('base/footer');
    }
}
