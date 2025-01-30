<?php
ob_start();
session_start();

// Cek jika file bukan scanner.php, lakukan pengecekan login
if (basename($_SERVER['PHP_SELF']) !== 'scanner.php') {
  if (!isset($_SESSION['login'])) {
      header('location:login.php');
      exit(); // Pastikan script berhenti setelah redirect
  }
}


include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/img/logo.png">

    <title>Aplikasi Piagam</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/style.css" rel="stylesheet">

</head>
<body>
<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">Aplikasi Piagam</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="tambah_data.php">Tambah Instansi</a></li>
            <li><a href="tambah_admin.php">Tambah Admin</a></li>
            <li><a href="data_piagam.php">Piagam</a></li>
            <li><a href="scanner.php">Validasi Piagam</a></li>
            <li><a href="logout.php">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
