<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class CRUD extends CI_Model
{
    public function ambilSatuData($table, $where)
    {
        return $this->db->get_where($table, $where)->row_array();
    }
    public function tb_kategori($jenis)
    {
        return $this->db->get_where('kategori', ['jenis' => $jenis])->result_array();
    }
    public function tb_user($bagian, $where = null)
    {
        $this->db->select('u.ID_user, u.foto, u.nama_lengkap, r.role, j.ID_jbtn, j.posisi, u.instagram, u.email');
        $this->db->from('users u');
        $this->db->join('role r', 'u.ID_role = r.ID_role');
        $this->db->join('jabatan j', 'u.ID_jbtn = j.ID_jbtn');
        $this->db->where('r.role', $bagian);
        if ($where) {
            $this->db->where($where);
            return $this->db->get()->row_array();
        }
        return $this->db->get()->result_array();
    }
    public function tb_postingan($jenis, $where = null)
    {
        $this->db->select('p.created_at, p.gambar, p.judul, p.ID_kategori, k.jenis, k.nama_kategori, p.content, u.nama_lengkap AS nama_pembuat');
        $this->db->from('postingan p');
        $this->db->join('kategori k', 'p.ID_kategori = k.ID');
        $this->db->join('users u', 'p.created_by = u.ID_user');
        $this->db->where('k.jenis', $jenis);
        if ($where) {
            $this->db->where($where);
            return $this->db->get()->row_array();
        }
        return $this->db->get()->result_array();
    }
    public function getTableByID($table, $where, $output)
    {
        $data = $this->db->get_where($table, $where)->row_array();
        if ($data) {
            return $data[$output];
        }
    }
    public function events($events)
    {
        $output = [];
        foreach ($events as $event) {
            $output[] = [
                'id' => $event['id'],
                'title' => $event['title'],
                'start' => $event['start'],
                'end' => $event['end'],
                'color' => $event['color']
            ];
        }
        echo json_encode($output);
    }
}
