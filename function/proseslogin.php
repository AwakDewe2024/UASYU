<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    $query = "SELECT * FROM pengguna WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user2['role']; // role dari database
            header("Location: ../index.php?page=rekam_medis"); // ganti sesuai halaman setelah login
            exit;
        } else {
            header("Location: ../index.php?page=login&error=Password%20salah");
        exit;
    }
} else {
    header("Location: ../index.php?page=login&error=Username%20tidak%20ditemukan");
    exit;
    }
} else {
    echo "Mohon isi semua field.";
}
?>