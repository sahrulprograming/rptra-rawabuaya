<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Rubah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->rptra = new Rptra();
        $this->ID_user = $this->session->userdata('ID_user');
        $this->ID_role = $this->session->userdata('ID_role');
        $this->ID_jbtn = $this->session->userdata('ID_jbtn');
    }
    public function profile()
    {
        $this->db->update('users', $_POST, ['ID_user' => $this->ID_user]);
        if ($this->db->affected_rows() > 0) {
            $this->rptra->notif_berhasil('Profile dirubah');
        } else {
            $this->rptra->notif_gagal('Profile tidak berubah');
        }
        redirect('lihat/profile');
    }
    public function password()
    {
        $output = [];
        $password_lama = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru');
        $konfirmasi = $this->input->post('konfirmasi');
        if ($password_lama && $password_baru && $konfirmasi) {
            $user = $this->db->get_where('users', ['ID_user' => $this->ID_user])->row();
            if (password_verify($password_lama, $user->password)) {
                if (strlen($password_baru) >= 8) {
                    if ($password_baru === $konfirmasi) {
                        $this->db->update('users', ['password' => password_hash($password_baru, PASSWORD_DEFAULT)], ['ID_user' => $this->ID_user]);
                        if ($this->db->affected_rows() > 0) {
                            $output += [
                                'success' => true,
                                'icon' => 'success',
                                'title' => 'Selamat',
                                'text' => 'Password dirubah!'
                            ];
                        } else {
                            $output += [
                                'success' => false,
                                'icon' => 'error',
                                'title' => 'Gagal',
                                'text' => 'Ada yang salah di system!'
                            ];
                        }
                    } else {
                        $output += [
                            'success' => false,
                            'icon' => 'error',
                            'title' => 'Gagal',
                            'text' => 'Password konfirmasi salah!'
                        ];
                    }
                } else {
                    $output += [
                        'success' => false,
                        'icon' => 'error',
                        'title' => 'Gagal',
                        'text' => 'Password minimal 8 characters!'
                    ];
                }
            } else {
                $output += [
                    'success' => false,
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'text' => 'Password lama salah!'
                ];
            }
        } else {
            $output += [
                'success' => false,
                'icon' => 'error',
                'title' => 'Opss..',
                'text' => 'Password wajib di isi!'
            ];
        }

        echo json_encode($output);
    }
}
