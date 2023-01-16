<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Authentication extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->rptra = new Rptra();
    }
    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email wajib di isi',
            'valid_email' => 'Email yang anda masukan tidak valid'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password wajib di isi',
        ]);
        if ($this->form_validation->run() === false) {
            $data['title'] = 'Login | ' . nama_web();
            $this->load->view('layouts/dashboard/head', $data);
            $this->load->view('auth/login');
            $this->load->view('layouts/dashboard/footer');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->CRUD->ambilSatuData('users', ['email' => $email]);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data_sess = [
                    'ID_user' => $user['ID_user'],
                    'ID_role' => $user['ID_role'],
                    'ID_jbtn' => $user['ID_jbtn'],
                ];
                $role = $this->rptra->getRoleByID($user['ID_role']);
                $this->session->set_userdata($data_sess);
                $this->rptra->notif_berhasil("Login, <br> Selamat Datang " . $user['nama_lengkap']);
                redirect("$role/home");
            } else {
                $this->rptra->notif_gagal('Password salah');
                redirect('authentication/login');
            }
        } else {
            $this->rptra->notif_gagal('email tidak terdaftar');
            redirect('authentication/login');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        $this->rptra->notif_berhasil('Logout Berhasil');
        redirect('login');
    }
}
