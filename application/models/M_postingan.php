<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class M_postingan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->rptra = new Rptra();
        $this->ID_user = $this->session->userdata('ID_user');
        $this->ID_jbtn = $this->session->userdata('ID_jbtn');
    }
    public function tambah($jenis)
    {
        $gambar = $this->M_rptra->upload_foto('gambar', $jenis);
        $data = [
            'created_at' => time(),
            'created_by' => $this->session->userdata('ID_user'),
            'gambar' => $gambar,
            'content' => str_replace('&nbsp;', '', $this->input->post('content'))
        ];
        unset($_POST['content']);
        $_POST += $data;
        $this->db->insert('postingan', $_POST);
        if ($this->db->affected_rows() > 0) {
            $this->rptra->notif_berhasil("Postingan $jenis telah dibuat");
            redirect('admin/lihat/postingan/' . $jenis);
        } else {
            $this->rptra->notif_berhasil("Postingan $jenis tidak bisa dibuat!");
            redirect(current_url());
        }
    }
    public function rubah($jenis, $ID)
    {
        $gambar = $this->M_rptra->upload_foto('gambar', $jenis);
        if ($gambar) {
            $_POST += ['gambar' => $gambar];
        }
        $data = [
            'content' => str_replace('&nbsp;', '', $this->input->post('content'))
        ];
        unset($_POST['content']);
        $_POST += $data;
        $this->db->update('postingan', $_POST, ['created_at' => $ID]);
        if ($this->db->affected_rows() > 0) {
            $this->rptra->notif_berhasil("Postingan $jenis telah dirubah");
            redirect('admin/lihat/postingan/' . $jenis);
        } else {
            $this->rptra->notif_berhasil("Postingan $jenis tidak bisa dirubah!");
            redirect(current_url());
        }
    }
}
