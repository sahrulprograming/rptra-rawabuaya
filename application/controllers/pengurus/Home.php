<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Home extends CI_Controller
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
    public function index()
    {
        $data['title'] = 'Absen | Pengurus';
        $data['page'] = 'Absen';
        $this->db->where('DATE_FORMAT(start, "%Y-%m-%d %T") <=', date('Y-m-d H:i:s'));
        $this->db->where('DATE_FORMAT(end, "%Y-%m-%d %T") >', date('Y-m-d H:i:s'));
        $this->db->where('color', '#FF0000');
        $data['libur'] = $this->db->get('events_calender')->row_array();
        $this->db->where('ID_user', $this->ID_user);
        $this->db->where('DATE_FORMAT(FROM_UNIXTIME(created_at), \'%Y-%m-%d\') =', date('Y-m-d'));
        $data['sudah_absen'] = $this->db->get('absensi')->row_array();
        $this->load->view('layouts/dashboard/head', $data);
        $this->load->view('layouts/dashboard/sidebar/pengurus');
        $this->load->view('layouts/dashboard/navbar');
        $this->load->view('pengurus/absen');
        $this->load->view('layouts/dashboard/footer');
    }
    public function absen($status, $tanggal_absen = null)
    {
        $foto = $this->M_rptra->upload_foto('foto', 'bukti_absen');
        if (!$foto) {
            $this->rptra->notif_gagal('Wajib upload foto selfie');
            redirect('pengurus/home');
        }
        if ($status == 'masuk') {
            $this->db->where('ID_user', $this->ID_user);
            $this->db->where('DATE_FORMAT(FROM_UNIXTIME(created_at), \'%Y-%m-%d\') =', date('Y-m-d'));
            $sudah_absen = $this->db->get('absensi')->row_array();
            if ($sudah_absen) {
                $this->rptra->notif_gagal('Anda Sudah Melakukan Absen');
                redirect('pengurus/home');
            }
            $data = [
                'ID_user' => $this->ID_user,
                'foto' => $foto,
                'status' => 'hadir',
                'created_at' => time()
            ];
            $_POST += $data;
            $this->db->insert('absensi', $_POST);
            if ($this->db->affected_rows() > 0) {
                $this->rptra->notif_berhasil('Anda sudah absen');
            }
        } elseif ($tanggal_absen && $status == 'pulang') {
            $data = [
                'jam_pulang' => time(),
                'foto' => $foto
            ];
            $this->db->update('absensi', $data, ['created_at' => $tanggal_absen]);
            if ($this->db->affected_rows() > 0) {
                $this->rptra->notif_berhasil('Anda sudah pulang');
            }
        } else {
            $this->rptra->notif_gagal('Ada yang salah!');
        }
        redirect('pengurus/home');
    }
    public function izin()
    {
        $foto = $this->M_rptra->upload_foto('foto', 'bukti_absen');
        if (!$foto) {
            $this->rptra->notif_gagal('Wajib upload foto selfie');
            redirect('pengurus/home');
        }
        $data = [
            'ID_user' => $this->ID_user,
            'foto' => $foto,
            'status' => 'izin',
            'created_at' => time()
        ];
        $_POST += $data;
        sleep(1);
        $this->db->insert('absensi', $_POST);
        if ($this->db->affected_rows() > 0) {
            $this->rptra->notif_berhasil('Anda sudah absen');
        }
        redirect('pengurus/home');
    }

    // AJAX
    public function data_absensi()
    {
        $output = '';
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $foto = $this->M_rptra->getByID('users', ['ID_user' => $this->ID_user], 'foto');
        $nama = $this->M_rptra->getByID('users', ['ID_user' => $this->ID_user], 'nama_lengkap');
        $email = $this->M_rptra->getByID('users', ['ID_user' => $this->ID_user], 'email');
        $this->db->where('ID_user', $this->ID_user);
        $this->db->where('DATE_FORMAT(FROM_UNIXTIME(created_at), \'%M-%Y\') =', "$bulan-$tahun");
        $absensi = $this->db->get('absensi')->result();
        foreach ($absensi as $a) {
            $tanggal = format_tanggal($a->created_at);
            $kehadiran = '<button class="btn btn-sm btn-success">' . $a->status . '</button>';
            if ($a->status == 'izin') {
                $kehadiran = '<button class="btn btn-sm btn-primary">' . $a->status . '</button>';
            }
            $file = base_url("assets/img/pengurus/$foto");
            $output .= '<div class="table-responsive">
                    <table class="table align-items-center mb-3 border border-top border-2 shadow">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-center text-dark text-xxs font-weight-bolder opacity-7 ps-2">tanggal</th>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Pengurus</th>
                                <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="w-15">
                                    <p class="text-xs text-center font-weight-bold mb-0">' . $tanggal . '</p>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="' . $file . '" class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">' . $nama . '</h6>
                                            <p class="text-xs text-secondary mb-0">' . $email . '</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    ' . $kehadiran . '
                                </td>
                                <td class="align-middle text-center w-25" style="white-space: pre-wrap;">
                                    <p class="text-secondary text-xs font-weight-normal">' . $a->keterangan . '</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>';
        }
        echo $output;
    }
}
