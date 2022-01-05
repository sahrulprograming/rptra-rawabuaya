<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Rubah extends CI_Controller
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
    public function kategori($jenis = null, $ID = null)
    {
        $this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'required|trim', [
            'required'    => 'Nama kategori wajib di isi',
        ]);
        if ($this->form_validation->run() === false) {
            $data['title'] = 'Tambah Kategori Blog';
            $data['page'] = 'Tambah Kategori Blog';
            $data['label'] = ['Nama Kategori'];
            $data['input'] = ['normal'];
            $data['type'] = ['text'];
            $data['name'] = ['nama_kategori'];
            $data['value'] = $this->db->get_where('kategori', ['ID' => $ID])->row_array();
            $data['button'] = 'Rubah';
            $this->load->view('layouts/dashboard/head', $data);
            $this->load->view('layouts/dashboard/sidebar/admin');
            $this->load->view('layouts/dashboard/navbar');
            $this->load->view('admin/form');
            $this->load->view('layouts/dashboard/footer');
        } else {
            $this->db->update('kategori', $_POST, ['ID' => $ID]);
            if ($this->db->affected_rows() > 0) {
                $this->rptra->notif_berhasil('kategori ' . $jenis . ' dirubah');
                redirect('admin/lihat/kategori/' . $jenis);
            } else {
                $this->rptra->notif_gagal('kategori ' . $jenis . ' tidak berubah');
                redirect('admin/tambah/kategori/' . $jenis);
            }
        }
    }
    public function postingan($jenis = null, $ID = null)
    {
        $data['options'] = $this->CRUD->tb_kategori($jenis);
        $data['tb_option'] = 'kategori';
        $this->form_validation->set_rules('judul', 'judul', 'required|trim', [
            'required'  => 'Judul wajib di isi',
        ]);
        $this->form_validation->set_rules('ID_kategori', 'ID_kategori', 'required|trim', [
            'required'  => 'Kategori wajib di isi',
        ]);
        $this->form_validation->set_rules('content', 'content', 'required|trim', [
            'required'  => 'Content wajib di isi',
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah ' . $jenis;
            $data['page'] = 'Tambah ' . $jenis;
            $data['label'] = ['gambar', 'judul', 'kategori', 'isi'];
            $data['input'] = ['normal', 'normal', 'option', 'textarea'];
            $data['type'] = ['file', 'text', 'option', 'textarea'];
            $data['name'] = ['gambar', 'judul', 'ID_kategori', 'content'];
            $data['value'] = $this->db->get_where('postingan', ['created_at' => $ID])->row_array();
            $data['button'] = 'Rubah';
            $data['tb_option'] = ['kategori'];
            $data['valueText'] = [['ID', 'nama_kategori']];
            $data['folder'] = $jenis;
            $this->load->view('layouts/dashboard/head', $data);
            $this->load->view('layouts/dashboard/sidebar/admin');
            $this->load->view('layouts/dashboard/navbar');
            $this->load->view('admin/form');
            $this->load->view('layouts/dashboard/footer');
        } else {
            $this->M_postingan->rubah($jenis, $ID);
        }
    }
    public function master($bagian, $ID)
    {
        if ($bagian == 'jabatan') {
            // jika bagian adalah jabatan maka gunakan bagian ini
            $this->form_validation->set_rules('posisi', 'posisi', 'required|trim', [
                'required'    => 'Posisi wajib di isi',
            ]);
            $data['label'] = ['Posisi'];
            $data['input'] = ['normal'];
            $data['type'] = ['text'];
            $data['value'] = $this->db->get_where('jabatan', ['ID_jbtn' => $ID])->row_array();
            $data['name'] = ['posisi'];
            $data['button'] = 'Rubah';
        } elseif ($bagian == 'pengurus') {
            // jika bagian adalah pengurus maka gunakan bagian ini
            $data['options'] = [[['jenis_kelamin' => 'Laki - Laki'], ['jenis_kelamin' => 'Perempuan']], $this->db->get('jabatan')->result_array()];
            $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required|trim', [
                'required'    => 'Nama lengap wajib di isi',
                'is_unique'    => 'Nama lengkap tersebut sudah ada'
            ]);
            $this->form_validation->set_rules('ID_jbtn', 'ID_jbtn', 'required|trim', [
                'required'    => 'Jabatan wajib di isi',
            ]);
            $this->form_validation->set_rules('email', 'email', 'required|trim', [
                'required'    => 'Email wajib di isi',
                'is_unique'    => 'Email sudah digunakan'
            ]);
            $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required|trim', [
                'required'    => 'Jenias kelamin wajib di isi',
            ]);
            $data['valueText'] = [['jenis_kelamin', 'jenis_kelamin'], ['ID_jbtn', 'posisi']];
            $data['label'] = ['Nama Pengurus', 'Jenis Kelamin', 'Email', 'instagram', 'Jabatan', 'Foto'];
            $data['input'] = ['normal', 'option', 'normal', 'normal', 'option', 'normal'];
            $data['type'] = ['text', 'option', 'email', 'text', 'option', 'file'];
            $data['folder'] = 'pengurus';
            $data['name'] = ['nama_lengkap', 'jenis_kelamin', 'email', 'instagram', 'ID_jbtn', 'foto'];
            $data['tb_option'] = [null, 'jabatan'];
            $data['value'] = $this->CRUD->ambilSatuData('users', ['ID_user' => $ID]);
            $data['button'] = 'Rubah';
        }
        if ($this->form_validation->run() === false) {
            $data['title'] = "Rubah " . $bagian;
            $data['page'] = $bagian;
            $this->load->view('layouts/dashboard/head', $data);
            $this->load->view('layouts/dashboard/sidebar/admin');
            $this->load->view('layouts/dashboard/navbar');
            $this->load->view('admin/form');
            $this->load->view('layouts/dashboard/footer');
        } else {
            if ($bagian == 'jabatan') {
                $this->db->update('jabatan', $_POST, ['ID_jbtn' => $ID]);
                if ($this->db->affected_rows() > 0) {
                    $this->rptra->notif_berhasil($bagian . ' dirubah');
                    redirect('admin/lihat/master/' . $bagian);
                } else {
                    $this->rptra->notif_gagal($bagian . ' tidak berubah');
                    redirect('admin/tambah/master/' . $bagian);
                }
            } else if ($bagian == 'pengurus') {
                $this->M_update->pengurus($ID);
            }
        }
    }
    public function calender()
    {
        $id = $this->input->post('id');
        if ($this->input->post('delete')) {
            $this->db->delete('events_calender', ['id' => $id]);
            if ($this->db->affected_rows() > 0) {
                $this->rptra->notif_berhasil('Event dihapus');
            } else {
                $this->rptra->notif_gagal('Event tidak terhapus');
            }
        } else {
            unset($_POST['id']);
            $this->db->update('events_calender', $_POST, ['id' => $id]);
            if ($this->db->affected_rows() > 0) {
                $this->rptra->notif_berhasil('Event dirubah');
            } else {
                $this->rptra->notif_gagal('Event tidak terubah');
            }
        }
        redirect('admin/lihat/calender');
    }
}
