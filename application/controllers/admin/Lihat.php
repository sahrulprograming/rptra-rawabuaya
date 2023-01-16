<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Lihat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_akses();
        $this->ID_user = $this->session->userdata('ID_user');
        $this->ID_role = $this->session->userdata('ID_role');
        $this->ID_jbtn = $this->session->userdata('ID_jbtn');
    }
    public function postingan($jenis)
    {
        $data['title'] = 'Semua ' . $jenis;
        $data['page'] = $jenis;
        $data['data'] = $this->CRUD->tb_postingan($jenis);
        $data['card'] = [
            'ID' => 'created_at',
            'judul' => 'judul',
            'gambar' => 'gambar',
            'content' => 'content',
        ];
        $data['folder'] = $jenis;
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/admin');
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('admin/v_card');
        $this->load->view('layouts/dashboard/footer');
    }
    public function kategori($jenis)
    {
        $data['title'] = 'Daftar Kategori ' . $jenis;
        $data['page'] = 'Kategori ' . $jenis;
        $data['data'] = $this->CRUD->tb_kategori($jenis);
        $fields = $this->db->list_fields('kategori');
        $data['fields'] = array_slice($fields, 1, 2);
        $data['ID'] = $fields[0];
        $data['ths'] = ['Jenis Kategori', 'Nama Kategori'];
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/admin');
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('admin/v_table');
        $this->load->view('layouts/dashboard/footer');
    }
    public function master($bagian)
    {
        if ($bagian == 'jabatan') {
            $data['data'] = $this->db->get($bagian)->result_array();
            $data['fields'] = ['posisi'];
            $data['ID'] = "ID_jbtn";
            $data['ths'] = ['Posisi'];
        } elseif ($bagian == 'pengurus') {
            $this->db->order_by('rp.ID_rptra', 'ASC');
            $this->db->order_by('j.ID_jbtn', 'ASC');
            $data['data'] = $this->CRUD->tb_user($bagian);
            $data['fields'] = ['foto', 'nama_lengkap', 'posisi', 'email', 'nama_rptra'];
            $data['ID'] = "ID_user";
            $data['ths'] = ['Foto', 'Nama Lengkap', 'Posisi', 'email', 'Asal rptra'];
        } elseif ($bagian == 'rptra') {
            $data['data'] = $this->db->get($bagian)->result_array();
            $data['fields'] = ['logo', 'nama', 'instagram', 'alamat'];
            $data['ID'] = "ID_rptra";
            $data['ths'] = ['logo', 'Nama Rptra', 'instagram', 'alamat'];
        }

        $data['title'] = "Data $bagian";
        $data['page'] = $bagian;
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/admin');
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('admin/v_table');
        $this->load->view('layouts/dashboard/footer');
    }
    public function absensi($ID_rptra)
    {
        $data['title'] = "Data absensi";
        $data['page'] = 'Absensi';
        $data['ID_rptra'] = $ID_rptra;
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/admin');
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('admin/absensi');
        $this->load->view('layouts/dashboard/footer');
        $this->session->set_userdata('kembali', current_url());
    }
    public function laporan_absensi($ID_rptra = null)
    {
        $cek_ID_rptra = $this->CRUD->ambilSatuData('rptra', ['ID_rptra' => $ID_rptra]);
        if (!$ID_rptra && !$cek_ID_rptra) {
            $this->rptra->notif_gagal('RPTRA tidak terdaftar / ID salah');
            redirect($this->session->userdata('kembali'));
        }
        $data['title'] = "Laporan absen bulanan";
        $data['page'] = 'Lapora absen bulanan';
        $data['ID_rptra'] = $ID_rptra;
        $data['nama_rptra'] = $this->M_rptra->getByID('rptra', ['ID_rptra' => $ID_rptra], "nama");
        $data['users'] = $this->db->get_where('users', ['ID_rptra' => $ID_rptra])->result();
        $data['bulan'] = $this->input->post('bulan-export');
        $data['tahun'] = $this->input->post('tahun-export');
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('admin/laporan_absen');
        $this->load->view('layouts/dashboard/footer');
    }
    public function lokasi($lat = null, $lng = null)
    {
        $data['title'] = "Lacak Lokasi";
        $data['page'] = 'Lokasi Pengurus';
        $data['lat'] = $lat;
        $data['lng'] = $lng;
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/admin');
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('map');
        $this->load->view('layouts/dashboard/footer');
    }
    public function calender()
    {
        $data['title'] = "Calender RPTRA";
        $data['page'] = 'Calender';
        $data['events'] = $this->db->get('events_calender')->result_array();
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/admin');
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('calender', $data);
        $this->load->view('layouts/dashboard/footer');
    }
}
