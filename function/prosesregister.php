<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if ($username && $email && $password && $confirm) {
    if ($password !== $confirm) {
        header("Location: ../index.php?page=register&error=Konfirmasi%20password%20tidak%20cocok.");
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $check = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        header("Location: ../index.php?page=register&error=Email%20sudah%20digunakan.");
        exit;
    }

    $query = "INSERT INTO pengguna (username, email, password) VALUES ('$username', '$email', '$hashed')";
    if (mysqli_query($koneksi, $query)) {
        // Ambil data user yang baru didaftarkan
        $user_id = mysqli_insert_id($koneksi);
        $_SESSION['id_pengguna'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'asisten'; // default role
        header("Location: ../index.php?page=rekam_medis");
        exit;
    } else {
        header("Location: ../index.php?page=register&error=Registrasi%20gagal.");
        exit;
    }
} else {
    header("Location: ../index.php?page=register&error=Mohon%20isi%20semua%20field.");
    exit;
}
?>