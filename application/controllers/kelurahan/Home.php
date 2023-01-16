<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_akses();
        $this->rptra = new Rptra();
        $this->ID_user = $this->session->userdata('ID_user');
        $this->ID_role = $this->session->userdata('ID_role');
        $this->ID_jbtn = $this->session->userdata('ID_jbtn');
    }
    public function index()
    {
        $data['title'] = 'Dashboard | Admin';
        $data['page'] = 'Dashboard';
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/kelurahan');
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('admin/dashboard');
        $this->load->view('layouts/dashboard/footer');
    }
    public function absensi($ID_rptra)
    {
        $data['title'] = "Data absensi";
        $data['page'] = 'Absensi';
        $data['ID_rptra'] = $ID_rptra;
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/kelurahan');
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('kelurahan/absensi');
        $this->load->view('layouts/dashboard/footer');
    }
}
