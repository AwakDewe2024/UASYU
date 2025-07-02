<?php
// Routing manual berdasarkan query string
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

switch ($page) {
    case 'login':
        include 'pages/login.php';
        break;
    case 'rekam_medis':
        include 'pages/rekam_medis.php';
        break;
    case 'tambah':
        include 'pages/tambah.php';
        break;
    case 'edit': // <--- Tambahkan ini
        include 'pages/edit.php';
        break;
    case 'hapus':
        include 'pages/hapus.php';
        break;
    case 'logout':
        include 'function/logout.php';
        break;
    default:
        echo "404 - Page not found";
        break;
}
?>