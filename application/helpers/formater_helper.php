<?php
ini_set('date.timezone', 'Asia/Jakarta');
function ambil_hari($timestamp)
{
    $hari = date('D', $timestamp);
    if ($hari === 'Mon') {
        return 'Senin';
    } elseif ($hari === 'Tue') {
        return 'Selasa';
    } elseif ($hari === 'Wed') {
        return 'Rabu';
    } elseif ($hari === 'Thu') {
        return 'Kamis';
    } elseif ($hari === 'Fri') {
        return 'Jum\'at';
    } elseif ($hari === 'Sat') {
        return 'Sabtu';
    } elseif ($hari === 'Sun') {
        return 'Minggu';
    }
}
function format_tanggal($timestamp)
{
    return date('d F Y', $timestamp);
}
function jam_komentar($timestamp)
{
    return date('H:i', $timestamp);
}

function format_jam($timestamp)
{
    return date('H:i', $timestamp);
}

function format_tanggal_database($timestamp)
{
    return date('Y-m-d', $timestamp);
}

function getMonth($timestamp)
{
    return date('F', $timestamp);
}

function format_embed($url)
{
    $embed = explode(' ', $url);
    $embed = $embed[1];
    return $embed;
}

function format_link_youtube($link)
{
    $youtube = explode('/', $link);
    if (array_search('youtu.be', $youtube)) {
        $url = $youtube[3];
    } elseif (array_search('www.youtube.com', $youtube)) {
        $url = explode('=', $youtube[3]);
        $url = $url[1];
    }
    return $url;
}

function format_rupiah($uang)
{
    return 'Rp. ' . number_format($uang, 0, ',', '.');
}

function format_jenis_kelamin($jenis_kelamin)
{
    if (strtolower($jenis_kelamin) == 'l') {
        return 'Laki - Laki';
    } else {
        return 'Perempuan';
    }
}
