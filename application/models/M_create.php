<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class M_create extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function pengurus()
    {
        $foto = $this->M_rptra->upload_foto('foto', 'pengurus');
        if ($foto) {
            $_POST += ['foto' => $foto];
        } else {
            $foto = strtolower($this->input->post('jenis_kelamin')) == 'perempuan' ? 'default-P.png' : 'default-L.png';
            $_POST += ['foto' => $foto];
        }
        $data = [
            'ID_user' => $this->M_rptra->generateIDUser(2),
            'ID_role' => 2,
            'created_at' => time(),
            'is_active' => 1,
            'password' => password_hash('cempaka2021', PASSWORD_DEFAULT)
        ];
        $_POST += $data;
        $this->db->insert('users', $_POST);
        if ($this->db->affected_rows() > 0) {
            $this->rptra->notif_berhasil("Pengurus telah ditambah");
            redirect('admin/lihat/master/pengurus');
        } else {
            $this->rptra->notif_berhasil("Pengurus tidak bertambah!");
            redirect(current_url());
        }
    }
}
