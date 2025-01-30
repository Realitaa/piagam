<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Piagam</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default">
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
    </div>
</nav>

<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <center><h3 class="panel-title"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> LOGIN PETUGAS</h3></center>
            </div>
            <div class="panel-body">
                <!-- Tampilkan error jika ada -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?= htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>

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
