<?php
session_start();
include "koneksi.php"; // Pastikan koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $pass = trim($_POST['password']); // Password tidak boleh difilter secara ketat sebelum hash

    if (empty($user) || empty($pass)) {
        header("Location: login.php?error=Form Belum Lengkap!!");
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
        header("Location: login.php?error=Username dan Password anda Salah!!!");
        exit();
    }

    $stmt->close();
} else {
    // Jika bukan POST request, redirect ke login page
    header("Location: login.php");
    exit();
}
?>
