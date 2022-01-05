<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Lihat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->ID_user = $this->session->userdata('ID_user');
        $this->ID_role = $this->session->userdata('ID_role');
        $this->ID_jbtn = $this->session->userdata('ID_jbtn');
    }
    public function postingan($jenis, $ID)
    {
        $data['title'] = 'Baca ' . $jenis;
        $data['page'] = $jenis;
        $data['data'] = $this->CRUD->tb_postingan($jenis, ['p.created_at' => $ID]);
        $data['folder'] = $jenis;
        $this->load->view('layouts/default/head', $data);
        $this->load->view('layouts/default/navbar');
        $this->load->view('postingan/baca');
        $this->load->view('layouts/default/footer');
    }
    public function semua_postingan($jenis)
    {
        $data['title'] = 'Semua ' . $jenis;
        $data['page'] = $jenis;
        $this->db->order_by('created_at', 'DESC');
        $data['data'] = $this->CRUD->tb_postingan($jenis);
        $data['folder'] = $jenis;
        $this->load->view('layouts/default/head', $data);
        $this->load->view('layouts/default/navbar');
        $this->load->view('postingan/index');
        $this->load->view('layouts/default/footer');
    }
    public function profile()
    {
        $data['jenis_kelamin'] = $this->M_rptra->getByID('users', ['ID_user' => $this->ID_user], 'jenis_kelamin');
        $data['title'] = 'Profile | ' . $this->M_rptra->getByID('role', ['ID_role' => $this->session->userdata('ID_role')], 'role');
        $data['page'] = 'Profile ' . $this->M_rptra->getByID('role', ['ID_role' => $this->session->userdata('ID_role')], 'role');
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/' . $this->M_rptra->getByID('role', ['ID_role' => $this->session->userdata('ID_role')], 'role'));
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('profile');
        $this->load->view('layouts/dashboard/footer');
    }
}
