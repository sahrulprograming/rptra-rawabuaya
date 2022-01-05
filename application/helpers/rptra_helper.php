<?php
ini_set('date.timezone', 'Asia/Jakarta');

class Rptra
{
    function __construct()
    {
        $this->ci3 = get_instance();
    }
    function notif_berhasil($pesan)
    {
        $output = '<div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                <span class="alert-icon align-middle">
                    <span class="material-icons text-md">
                    check
                    </span>
                </span>
                <span class="alert-text"><strong>Berhasil!</strong> ' . $pesan . ' </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        $this->ci3->session->set_flashdata('notif', $output);
    }
    function notif_gagal($pesan)
    {
        $output = '<div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                <span class="alert-icon align-middle">
                    <span class="material-icons text-md">
                    dangerous
                    </span>
                </span>
                <span class="alert-text"><strong>Gagal!</strong> ' . $pesan . '</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        $this->ci3->session->set_flashdata('notif', $output);
    }
    function getRoleByID($ID)
    {
        $data = $this->ci3->db->get_where('role', ['ID_role' => $ID])->row();
        return $data->controller_access;
    }
    function getKategoriByID($ID)
    {
        $data = $this->ci3->db->get_where('kategori', ['ID' => $ID])->row();
        return $data->nama_kategori;
    }
}
