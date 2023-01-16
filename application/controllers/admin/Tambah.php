<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Tambah extends CI_Controller
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
    public function kategori($jenis)
    {
        $this->form_validation->set_rules('Nama_Kategori', 'nama_kategori', 'required|trim', [
            'required'    => 'Nama kategori wajib di isi',
        ]);
        if ($this->form_validation->run() === false) {
            $data['title'] = 'Tambah Kategori ' . $jenis;
            $data['page'] = 'Tambah Kategori ' . $jenis;
            $data['label'] = ['Nama Kategori'];
            $data['input'] = ['normal'];
            $data['type'] = ['text'];
            $data['name'] = ['Nama_Kategori'];
            $data['button'] = 'Tambah';
            $this->load->view('layouts/dashboard/head', $data);
            $this->load->view('layouts/dashboard/sidebar/admin');
            $this->load->view('layouts/dashboard/navbar');
            $this->load->view('admin/form');
            $this->load->view('layouts/dashboard/footer');
        } else {
            $_POST += ['jenis' => $jenis];
            $this->db->insert('kategori', $_POST);
            if ($this->db->affected_rows() > 0) {
                $this->rptra->notif_berhasil('kategori ' . $jenis . ' ditambahkan');
                redirect('admin/lihat/kategori/' . $jenis);
            } else {
                $this->rptra->notif_berhasil('kategori ' . $jenis . ' tidak bertambah');
                redirect('admin/tambah/kategori/' . $jenis);
            }
        }
    }
    public function postingan($jenis = null)
    {
        $data['options'] = [$this->CRUD->tb_kategori($jenis)];
        if (!$data['options'][0]) {
            $this->rptra->notif_gagal('Mohon tambahkan kategori terlebih dahulu!!');
            redirect('admin/tambah/kategori/' . $jenis);
        }
        $this->form_validation->set_rules('judul', 'judul', 'required|trim|is_unique[postingan.judul]', [
            'required'  => 'Judul wajib di isi',
            'is_unique' => 'Judul tersebut sudah sudah ada'
        ]);
        $this->form_validation->set_rules('ID_kategori', 'ID_kategori', 'required|trim', [
            'required'  => 'Kategori wajib di isi',
        ]);
        $this->form_validation->set_rules('content', 'content', 'required|trim', [
            'required'  => 'Content wajib di isi',
        ]);
        if ($this->form_validation->run() == false) {
            $data['valueText'] = [['ID', 'nama_kategori']];
            $data['title'] = 'Tambah ' . $jenis;
            $data['page'] = 'Tambah ' . $jenis;
            $data['label'] = ['gambar', 'judul', 'kategori', 'isi'];
            $data['input'] = ['normal', 'normal', 'option', 'textarea'];
            $data['type'] = ['file', 'text', 'option', 'textarea'];
            $data['name'] = ['gambar', 'judul', 'ID_kategori', 'content'];
            $data['placeholder'] = ['', '', '', 'Masukan content ' . $jenis];
            $data['button'] = 'Tambah';
            $this->load->view('layouts/dashboard/head', $data);
            $this->load->view('layouts/dashboard/sidebar/admin');
            $this->load->view('layouts/dashboard/navbar');
            $this->load->view('admin/form');
            $this->load->view('layouts/dashboard/footer');
        } else {
            $this->M_postingan->tambah($jenis);
        }
    }
    public function master($bagian)
    {
        if ($bagian == 'jabatan') {
            // jika bagian adalah jabatan maka gunakan bagian ini
            $this->form_validation->set_rules('posisi', 'posisi', 'required|trim', [
                'required'    => 'Posisi wajib di isi',
            ]);
            $data['label'] = ['Posisi'];
            $data['input'] = ['normal'];
            $data['type'] = ['text'];
            $data['name'] = ['posisi'];
            $data['button'] = 'Tambah';
        } elseif ($bagian == 'pengurus') {
            // jika bagian adalah pengurus maka gunakan bagian ini
            $data['options'] = [[['jenis_kelamin' => 'Laki - Laki'], ['jenis_kelamin' => 'Perempuan']], $this->db->get('jabatan')->result_array(), $this->db->get('rptra')->result_array()];
            $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required|trim|is_unique[users.nama_lengkap]', [
                'required'    => 'Nama lengap wajib di isi',
                'is_unique'    => 'Nama lengkap tersebut sudah ada'
            ]);
            $this->form_validation->set_rules('ID_jbtn', 'ID_jbtn', 'required|trim', [
                'required'    => 'Jabatan wajib di isi',
            ]);
            $this->form_validation->set_rules('email', 'email', 'required|trim|is_unique[users.email]', [
                'required'    => 'Email wajib di isi',
                'is_unique'    => 'Email sudah digunakan'
            ]);
            $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required|trim', [
                'required'    => 'Jenias kelamin wajib di isi',
            ]);
            $data['valueText'] = [['jenis_kelamin', 'jenis_kelamin'], ['ID_jbtn', 'posisi'], ['ID_rptra', 'nama']];
            $data['label'] = ['Nama Pengurus', 'Jenis Kelamin', 'Email', 'instagram', 'Jabatan', 'Asal rptra', 'Foto'];
            $data['input'] = ['normal', 'option', 'normal', 'normal', 'option', 'option', 'normal'];
            $data['type'] = ['text', 'option', 'email', 'text', 'option', 'option', 'file'];
            $data['name'] = ['nama_lengkap', 'jenis_kelamin', 'email', 'instagram', 'ID_jbtn', 'ID_rptra', 'foto'];
            $data['tb_option'] = [null, 'jabatan', 'rptra'];
            $data['button'] = 'Tambah';
        } elseif ($bagian == 'rptra') {
            $this->form_validation->set_rules('nama', 'nama', 'required|trim|is_unique[rptra.nama]', [
                'required'    => 'Nama Rptra wajib di isi',
                'is_unique'    => 'Nama Rptra tersebut sudah ada'
            ]);
            $this->form_validation->set_rules('alamat', 'alamat', 'required|trim', [
                'required'    => 'Alamat wajib di isi',
            ]);
            $data['label'] = ['Nama Rptra', 'instagram', 'Alamat', 'Logo'];
            $data['input'] = ['normal', 'normal', 'textarea', 'normal'];
            $data['type'] = ['text', 'text', 'text', 'file'];
            $data['name'] = ['nama', 'instagram', 'alamat', 'logo'];
            $data['placeholder'] = ['', '', 'Masukan alamat RPTRA', ''];
            $data['button'] = 'Tambah';
        }
        if ($this->form_validation->run() === false) {
            $data['title'] = "Data $bagian";
            $data['page'] = $bagian;
            $this->load->view('layouts/dashboard/head', $data);
            $this->load->view('layouts/dashboard/sidebar/admin');
            $this->load->view('layouts/dashboard/navbar');
            $this->load->view('admin/form');
            $this->load->view('layouts/dashboard/footer');
        } else {
            if ($bagian == 'jabatan') {
                $this->db->insert('jabatan', $_POST);
                if ($this->db->affected_rows() > 0) {
                    $this->rptra->notif_berhasil($bagian . ' ditambahkan');
                    redirect('admin/lihat/master/' . $bagian);
                } else {
                    $this->rptra->notif_gagal($bagian . ' tidak bertambah');
                    redirect('admin/tambah/master/' . $bagian);
                }
            } else if ($bagian == 'pengurus') {
                $this->M_create->pengurus();
            } else if ($bagian == 'rptra') {
                $this->M_create->rptra();
            }
        }
    }
    public function calender()
    {
        $this->db->insert('events_calender', $_POST);
        if ($this->db->affected_rows() > 0) {
            $this->rptra->notif_berhasil('Event ditambahkan');
            redirect('admin/lihat/calender');
        } else {
            $this->rptra->notif_gagal('Event tidak bertambah');
            redirect('admin/lihat/calender');
        }
    }
    public function content()
    {
        $this->M_create->content();
    }
}
