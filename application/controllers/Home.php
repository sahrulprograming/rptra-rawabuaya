<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $pengunjung = $this->CRUD->ambilSatuData('pengunjung', ['ip_address' => get_client_ip()]);
        if (!$pengunjung) {
            $this->db->insert('pengunjung', ['ip_address' => get_client_ip(), 'created_at' => time()]);
        }
        $data['title'] = 'RPTRA CEMPAKA';
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(1);
        $data['berita_terbaru'] = $this->CRUD->tb_postingan('berita');
        if ($data['berita_terbaru']) {
            $this->db->where('p.created_at !=', $data['berita_terbaru'][0]['created_at']);
            $this->db->order_by('created_at', 'DESC');
            $this->db->limit(3);
        }
        $data['berita'] = $this->CRUD->tb_postingan('berita');
        $data['pengurus'] = $this->CRUD->tb_user('pengurus');
        $this->load->view('layouts/default/head', $data);
        $this->load->view('layouts/default/navbar');
        $this->load->view('v_home');
        $this->load->view('layouts/default/footer');
    }
    public function coba()
    {
        if (date('H:i') < '06:30') {
            if (date('H:i') >= '19:10') {
                echo 'selesai';
            } else {
                echo 'absen';
            }
        }
    }
}
