<?php
ini_set('date.timezone', 'Asia/Jakarta');

function cek_active($posisi)
{
    if (stripos(current_url(), $posisi)) {
        return 'bg-gradient-primary';
    }
}
function set_url($arah)
{
    return str_replace('lihat', $arah, current_url());
}

function cek_akses()
{
    $ci = get_instance();
    $role = $ci->session->userdata('ID_role');
    $roleName = $ci->M_rptra->getByID('role', ['ID_role' => $role], 'role');
    if (!$role) {
        redirect('Authentication/login');
    } else {
        $controller = $ci->uri->segment(1);
        if ($controller == 'admin' && $roleName != 'admin' || $controller == 'pengurus' && $roleName != 'pengurus') {
            redirect($roleName . '/home');
        }
    }
}

function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
