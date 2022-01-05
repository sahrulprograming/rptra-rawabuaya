<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class M_update extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function pengurus($ID)
    {
        $foto = $this->M_rptra->upload_foto('foto', 'pengurus');
        if ($foto) {
            $_POST += ['foto' => $foto];
        }
        $this->db->update('users', $_POST, ['ID_user' => $ID]);
        if ($this->db->affected_rows() > 0) {
            $this->rptra->notif_berhasil("Pengurus telah dirubah");
            redirect('admin/lihat/master/pengurus');
        } else {
            $this->rptra->notif_berhasil("Pengurus tidak terubah!");
            redirect(current_url());
        }
    }
}
