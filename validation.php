<?php
session_start();
include "koneksi.php"; // Pastikan koneksi database sudah benar

// Pastikan tidak ada output sebelum header (misalnya, spasi kosong atau echo sebelumnya)
ob_start(); // Mulai output buffering untuk menangani header yang lebih baik

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']); // Password tidak perlu difilter, tetap aman

    if (empty($user) || empty($pass)) {
        header("Location: login.php?error=Form Belum Lengkap");
        exit();
    }

    // Gunakan prepared statement untuk keamanan
    $stmt = $konek->prepare("SELECT idadmin, username, namalengkap, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $d = $result->fetch_assoc();

    if ($d && password_verify($pass, $d['password'])) {
        $_SESSION['login'] = TRUE;
        $_SESSION['id'] = $d['idadmin'];
        $_SESSION['username'] = $d['username'];
        $_SESSION['namalengkap'] = $d['namalengkap'];

        header('Location: ./index.php');
        exit();
    } else {
        header("Location: login.php?error=Username dan Password anda Salah");
        exit();
    }

    $stmt->close();
} else {
    // Jika bukan POST request, redirect ke login page
    header("Location: login.php");
    exit();
}

ob_end_flush(); // Pastikan output buffering berakhir dan output dikirim
?>
