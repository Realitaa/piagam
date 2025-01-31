<!DOCTIPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/icon.png">

    <title>Aplikasi Piagam</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/style.css" rel="stylesheet">
	<style>
		body {
    background-color: #f4f4f4;
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
}

.navbar {
    background-color: #3498db;
    border: none;
    margin-bottom: 150px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.navbar-brand {
    color: #ffffff !important;
    font-weight: bold;
}

.container {
    max-width: 2000px;
}

.panel {
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.panel-primary .panel-heading {
    background-color: #3498db;
    color: #ffffff;
    text-align: center;
    padding: 15px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.panel-danger .panel-heading {
    background-color: #e74c3c;
    color: #ffffff;
    text-align: center;
    padding: 15px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.form-control {
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 15px;
}

.btn-primary, .btn-danger {
    border-radius: 4px;
    padding: 10px 20px;
    text-transform: uppercase;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-primary:hover, .btn-danger:hover {
    opacity: 0.9;
}

.footer {
    background-color: #f8f9fa;
    padding: 0px;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
}

.alert {
    border-radius: 4px;
}

@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }
}
	</style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="col-md-5 col-md-offset-5">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Aplikasi Piagam</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <center><h3 class="panel-title"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> LOGIN PETUGAS</h3></center>
            </div>
            <div class="panel-body">
				<?php 
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$user	= $_POST['username'];
					$pass	= $_POST['password'];
					$p		= md5($pass);
					if($user=='' || $pass==''){
						?>
						<div class="alert alert-warning alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <?php
						  echo "<strong>Error!</strong> Form Belum Lengkap!!";
						  ?>
						</div>
						<?php
					}else{
						include "koneksi.php";
						$sqlLogin = mysqli_query($konek, "SELECT * FROM admin WHERE username='$user' AND password='$p'");
						$jml=mysqli_num_rows($sqlLogin);
						$d=mysqli_fetch_array($sqlLogin);
						if($jml > 0){
							session_start();
							$_SESSION['login']		= TRUE;
							$_SESSION['id']			= $d['idadmin'];
							$_SESSION['username']	= $d['username'];
							$_SESSION['namalengkap']= $d['namalengkap'];
							
							header('Location:./index.php');
						}else{
						?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <?php
							  echo "<strong>Error!</strong> Username dan Password anda Salah!!!";
							  ?>
                    </div>
						<?php
						}
						
					}
				}
				?>


                <form method="post" action="validation.php" role="form">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Masuk" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <center><h3 class="panel-title">Cek Validasi Piagam</h3></center>
            </div>
            <div class="panel-body">
                <center><p>Untuk melakukan pengecekan Piagam, pastikan anda menggunakan perangkat yang memiliki kamera seperti laptop/smartphone.</p></center>
                <center><a href="./scanner.php" class="btn btn-danger">Cek Validasi QR Code</a></center>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted"><a href="https://bikinbagoes.my.id" target="_blank">bikinbagoes.my.id</a> Tahun 2024</p>
    </div>
</footer>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
