<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class M_rptra extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->rptra = new Rptra();
    }
    function upload_foto($name, $folder, $index_ke = null)
    {
        if ($_FILES[$name]['name']) {
            if (is_array($_FILES[$name]['name'])) {
                $_FILES[$name . $index_ke]['name'] = $_FILES[$name]['name'][$index_ke];
                $_FILES[$name . $index_ke]['type'] = $_FILES[$name]['type'][$index_ke];
                $_FILES[$name . $index_ke]['tmp_name'] = $_FILES[$name]['tmp_name'][$index_ke];
                $_FILES[$name . $index_ke]['error'] = $_FILES[$name]['error'][$index_ke];
                $_FILES[$name . $index_ke]['size'] = $_FILES[$name]['size'][$index_ke];
                $path = FCPATH . "./assets/img/" . $folder;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = $path;
                $config['file_name'] = time();
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($name . $index_ke)) {
                    $this->rptra->notif_gagal($this->upload->display_errors());
                    redirect(current_url());
                }
                $foto_lama = $this->input->post('foto_lama', TRUE);
                if ($foto_lama) {
                    unlink(FCPATH . "./assets/img/" . $folder . "/$foto_lama");
                }
                return $this->upload->data('file_name');
            } else {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = FCPATH . "./assets/img/" . $folder;
                $config['file_name'] = time();
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($name)) {
                    $this->rptra->notif_gagal($this->upload->display_errors());
                    redirect(current_url());
                }
                $foto_lama = $this->input->post('foto_lama', TRUE);
                if ($foto_lama && $foto_lama != 'default-L.png' && $foto_lama != 'default-P.png') {
                    unlink(FCPATH . "./assets/img/" . $folder . "/$foto_lama");
                }
                return $this->upload->data('file_name');
            }
        } else {
            return false;
        }
    }
    public function getNamaByID($ID)
    {
    }
    public function generateIDUser($roleID)
    {
        $this->db->like('ID_user', $roleID, 'after');
        $this->db->order_by('ID_user', 'DESC');
        $user = $this->db->get('users')->row();
        if ($user) {
            $ID = (int)$user->ID_user + 1;
        } else {
            $ID = $roleID . date("ym") . '001';
        }
        return $ID;
    }
    public function getByID($table, $where, $output)
    {
        $data = $this->db->get_where($table, $where)->row_array();
        if ($data) {
            return $data[$output];
        }
    }
    public function cek_libur($date)
    {
        $this->db->where('DATE_FORMAT(start, "%d-%M-%Y") <=', $date);
        $this->db->where('DATE_FORMAT(end, "%d-%M-%Y") >=', $date);
        $this->db->where('color', '#FF0000');
        return $this->db->get('events_calender')->row_array();
    }
    public function data_pengunjung()
    {
        $data = [];
        for ($m = 1; $m <= 12; $m++) {
            $bulan = date('m-Y', mktime(0, 0, 0, $m, 1, date('Y')));
            $this->db->where('DATE_FORMAT(FROM_UNIXTIME(created_at), \'%m-%Y\') =', $bulan);
            $hasil = $this->db->count_all_results('pengunjung');
            if ($hasil) {
                $data[] = (string)$hasil;
            }
        }
        echo json_encode($data);
    }

    public function total($table, $where = null)
    {
        if ($where) {
            $this->db->where($where);
        }
        return $this->db->count_all_results($table);
    }
    public function total_absen($status)
    {
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->where('DATE_FORMAT(FROM_UNIXTIME(created_at), \'%d-%m-%Y\') =', date('d-m-Y'));
        $hasil = $this->db->count_all_results('absensi');
        return $hasil;
    }
}
