<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Jakarta');

class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_akses();
        $this->rptra = new Rptra();
    }
    public function data_absensi()
    {
        $output = [];
        $data = '';
        $modal = '';
        $bulan = $this->input->post('bulan');
        $date = $this->input->post('hari') . '-' . date('F', mktime(0, 0, 0, (int)$bulan, 1, date('Y'))) . '-' . $this->input->post('tahun');
        $users = $this->CRUD->tb_user('pengurus');
        foreach ($users as $user) {
            $keterangan = '';
            $lokasi = '';
            $foto = '';
            $hapus = '';
            $file = base_url('assets/img/pengurus/' . $user['foto']);
            $nama = $user['nama_lengkap'];
            $email = $user['email'];
            $ID_user = $user['ID_user'];
            if ($this->M_rptra->cek_libur($date)) {
                $kehadiran = '<button class="btn btn-sm btn-danger">Libur</button>';
            } else {
                if ($date > date('d-F-Y') || $date == date('d-F-Y') && date('H:i') < '06:30') {
                    $kehadiran = '<button class="btn btn-sm btn-primary">Belum mulai</button>';
                } else {
                    $this->db->where('DATE_FORMAT(FROM_UNIXTIME(created_at), \'%d-%M-%Y\') =', $date);
                    $this->db->where('ID_user', $user['ID_user']);
                    $absensi = $this->db->get('absensi')->row();
                    if ($absensi) {
                        if ($absensi->status == 'hadir') {
                            $kehadiran = '<button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#bukti-' . $ID_user . '">Hadir</button>';
                            $keterangan = 'Absen pada jam <br>' . format_jam($absensi->created_at);
                            $foto = $absensi->foto;
                        } else {
                            $kehadiran = '<button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#bukti-' . $ID_user . '">Izin</button>';
                            $keterangan = $absensi->keterangan;
                            $foto = $absensi->foto;
                        }
                        $link_lokasi = base_url('admin/lihat/lokasi/' . $absensi->lat . '/' . $absensi->lng);
                        $lokasi = '<a href="' . $link_lokasi . '" target="_blank" class="btn btn-sm btn-info">Lacak</a>';
                        $hapus = '<button class="btn btn-sm btn-danger" type="button" id="hapus-absen-' . $ID_user . '"><i class="material-icons fs-6">delete</i> Hapus</button>';
                    } else {
                        if ($date == date('d-F-Y') && date('H:i') >= '06:30' && date('H:i') < '19:10') {
                            $kehadiran = '<button class="btn btn-sm btn-secondary">belum Absen</button>';
                        } else {
                            $kehadiran = '<button class="btn btn-sm btn-danger">Tidak Hadir</button>';
                        }
                    }
                }
            }
            $data .= '<tr>
                            <td class="w-15">
                                <input type="hidden" id="ID_user" value="' . $ID_user . '">
                                <input type="hidden" id="foto" value="' . base_url('assets') . '/img/bukti_absen/' . $foto  . '">
                                <p class="text-xs text-center font-weight-bold mb-0">' . $date . '</p>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="' . $file . '" class="avatar avatar-sm me-3" style="object-fit:cover;">
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
                            <p class="text-secondary text-xs font-weight-normal">' . $keterangan . '</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                ' . $lokasi . '
                            </td>
                            <td class="text-center">
                                ' . $hapus . '
                            </td>
                            </tr>
                            <script>
                            $("#hapus-absen-' . $ID_user . '").on("click", function() {
                                Swal.fire({
                                    title: "Apakah kamu yakin?",
                                    text: "Ingin menghapus ini!",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Yes, Hapus ini!"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.replace("' . base_url('admin/hapus/absensi') . "/$ID_user/" . $date . '")
                                    }
                                })
                            })
                            </script>
                            ';
            $modal .= '<div class="modal fade bukti" id="bukti-' . $ID_user . '" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bukti Foto Selfie</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="' . base_url('assets') . '/img/bukti_absen/' . $foto . '" alt="" width="200">
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
        $output += ['data' => $data];
        $output += ['modal' => $modal];
        echo json_encode($output);
    }
}
