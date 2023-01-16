<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['berita'] = 'lihat/semua_postingan/berita';
$route['berita/(:any)'] = 'lihat/postingan/berita/$1';
$route['blog'] = 'lihat/semua_postingan/blog';
$route['blog/(:any)'] = 'lihat/postingan/blog/$1';
$route['login'] = 'Authentication/login';
$route['translate_uri_dashes'] = FALSE;
