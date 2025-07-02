<?php
$host = "localhost";     // biasanya localhost
$user = "root";          // username default XAMPP/MAMP/Laragon
$pass = "";              // kosong jika belum disetel
$db   = "db_user"; // ganti dengan nama database kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>