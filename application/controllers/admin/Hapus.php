<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Hapus extends CI_Controller
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
    public function postingan($jenis = null, $ID)
    {
        $postingan = $this->CRUD->ambilSatuData('postingan', ['created_at' => $ID]);
        if ($postingan) {
            unlink(FCPATH . "./assets/img/" . $jenis . "/" . $postingan['gambar']);
            $this->db->delete('postingan', ['created_at' => $ID]);
            if ($this->db->affected_rows() > 0) {
                $this->rptra->notif_berhasil('postingan ' . $jenis . ' dihapus');
                redirect('admin/lihat/postingan/' . $jenis);
            } else {
                $this->rptra->notif_berhasil('postingan ' . $jenis . ' tidak terhapus');
                redirect('admin/lihat/postingan/' . $jenis);
            }
        } else {
            $this->rptra->notif_gagal('postingan yang dituju tidak ada');
            redirect('admin/home');
        }
    }
    public function kategori($jenis = null, $ID)
    {
        $this->db->delete('kategori', ['ID' => $ID]);
        if ($this->db->affected_rows() > 0) {
            $this->rptra->notif_berhasil('kategori ' . $jenis . ' dihapus');
            redirect('admin/lihat/kategori/' . $jenis);
        } else {
            $this->rptra->notif_gagal('kategori ' . $jenis . ' tidak terhapus');
            redirect('admin/lihat/kategori/' . $jenis);
        }
    }
    public function master($bagian = null, $ID)
    {
        if ($bagian == 'pengurus') {
            $user = $this->db->get_where('users', ['ID_user' => $ID])->row();
            if ($user->foto != 'default-L.png' && $user->foto != 'default-P.png') {
                unlink(FCPATH . "./assets/img/pengurus/" . $user->foto);
            }
            $this->db->delete('users', ['ID_user' => $ID]);
        } elseif ($bagian == 'jabatan') {
            $this->db->delete('jabatan', ['ID_jbtn' => $ID]);
        }
        if ($this->db->affected_rows() > 0) {
            $this->rptra->notif_berhasil($bagian . ' dihapus');
            redirect('admin/lihat/master/' . $bagian);
        } else {
            $this->rptra->notif_gagal($bagian . ' tidak terhapus');
            redirect('admin/lihat/master/' . $bagian);
        }
    }
    public function absensi($ID, $date, $foto)
    {
        $this->db->where('DATE_FORMAT(FROM_UNIXTIME(created_at), \'%d-%M-%Y\') =', $date);
        $this->db->where('ID_user', $ID);
        $this->db->delete('absensi');
        if ($this->db->affected_rows() > 0) {
            unlink(FCPATH . "./assets/img/bukti_absen/$foto");
            $this->rptra->notif_berhasil('Absensi dihapus');
        } else {
            $this->rptra->notif_gagal('Absensi tidak terhapus');
        }
        redirect('admin/lihat/absensi');
    }
}
