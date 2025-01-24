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

    <title>APPASER</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/style.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="./">Validasi Piagam dengan QR Code</a>
    </div>
  </div>
</nav>


<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<div class="container">
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">Arahkan Kode QR Ke Kamera!</h3>
      </div>
      <div class="panel-body text-center" >
        <div id="cameraSelection">
          <label for="cameraSelect">Pilih Kamera: </label>
          <select id="cameraSelect" class="form-control"></select>
        </div>
        <div id="reader" style="margin-top: 10px;"></div>
      </div>
      <div class="panel-footer">
          <center><a class="btn btn-danger" href="../">Kembali</a></center>
      </div>
    </div>
  </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const html5QrCode = new Html5Qrcode("reader");
    const cameraSelect = document.getElementById("cameraSelect");
    let isScanning = false; // Menandai apakah pemindai sedang berjalan

    // Fetch available cameras
    Html5Qrcode.getCameras().then(cameras => {
        if (cameras && cameras.length) {
            cameras.forEach((camera, index) => {
                const option = document.createElement("option");
                option.value = camera.id;
                option.text = camera.label || `Camera ${index + 1}`;
                cameraSelect.appendChild(option);
            });

            // Start with the first camera
            startScanning(cameras[0].id);

            // Change camera on selection
            cameraSelect.addEventListener("change", () => {
                startScanning(cameraSelect.value);
            });
        } else {
            alert("No cameras found!");
        }
    }).catch(err => {
        console.error("Error fetching cameras: ", err);
    });

    function startScanning(cameraId) {
        if (isScanning) {
            html5QrCode.stop().then(() => {
                isScanning = false;
                initiateScan(cameraId);
            }).catch(err => {
                console.warn("Error stopping camera: ", err);
                initiateScan(cameraId);
            });
        } else {
            initiateScan(cameraId);
        }
    }

    function initiateScan(cameraId) {
        html5QrCode.start(
            cameraId,
            {
                fps: 10,
                qrbox: { width: 250, height: 250 }
            },
            qrCodeMessage => {
                const baseUrl = window.location.origin;

                // Mem-parse kedua URL untuk mengabaikan protokol
                const qrCodeUrl = new URL(qrCodeMessage);
                const currentBaseUrl = new URL(baseUrl);

                // Membandingkan hanya domain dan path tanpa protokol
                if (qrCodeUrl.host === currentBaseUrl.host) {
                    window.open(qrCodeMessage, '_blank');
                } else {
                    alert("Barcode tidak valid: " + qrCodeMessage + " vs " + currentBaseUrl);
                }
            },
            errorMessage => {
                console.warn(`QR Code Scan Error: ${errorMessage}`);
            }
        ).then(() => {
            isScanning = true;
        }).catch(err => {
            console.error("Error starting camera: ", err);
        });
    }

    window.addEventListener("beforeunload", () => {
        if (isScanning) {
            html5QrCode.stop().catch(err => console.error("Error stopping the camera: ", err));
        }
    });
</script>
</body>
</html>
