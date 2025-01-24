<?php
    include "koneksi.php";
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Cetak Piagam</title>
        <link rel="icon" href="./assets/img/logo.png">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f9f9f9;
            }

            .container {
                width: 297mm;
                height: 210mm;
                margin: 0 auto;
                background: white;
                padding: 20mm;
                box-sizing: border-box;
                border: 1px solid #ddd;
                position: relative;
                overflow: hidden;
            }

            .container > * {
                position: relative;
                z-index: 1; /* Pastikan konten tetap di atas watermark */
            }

            .top-border {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: auto;
                max-height: 50px;
            }

            .header {
                text-align: center;
                margin-top: 50px;
                margin-bottom: 20px;
            }

            .header h1 {
                font-size: 24px;
                font-weight: bold;
                margin: 50px;
            }

            .content {
                text-align: center;
                margin-top: 20px;
            }

            .content p {
                font-size: 18px;
                margin: 10px 0;
            }

            .footer {
                text-align: center;
                margin-top: 20px;
            }

            .footer p {
                margin: 5px 0;
            }

            .signature {
                text-align: center;
                position: relative;
            }

            .signature img {
                max-height: 60px;
            }

            .barcode {
                text-align: center; 
                position: absolute; 
                right: 80px;
                bottom: 40px; 
                padding: 0;
            }

            .print-btn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            @media print {
                .print-btn {
                    display: none;
                }

                body {
                    margin: 0;
                }
                    
    }
        </style>
    </head>

    <?php ob_start();
session_start();
 if (!isset($_SESSION['login'])) : ?>
    <style>
        .container::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg); /* Tambahkan rotasi */
            background: url('/assets/img/valid-stemp.png') no-repeat center center;
            background-size: 678px 255px; /* Ukuran watermark */
            opacity: 0.5; /* Transparansi watermark */
            width: 678px; /* Sama seperti background-size */
            height: 255px; /* Sama seperti background-size */
            z-index: 0; /* Letakkan di belakang konten */
        }
    </style>
<?php endif; ?>


    <body>
        <div class="container">
            <?php
            $sql = mysqli_query($konek, "SELECT * FROM dpiagam WHERE id='$_GET[id]'");
            $d = mysqli_fetch_array($sql);
            ?>
            <b>No: <?php echo $d['no_piagam']; ?></b>    
            <img src="assets/img/top-border.jpg" alt="Top Border" class="top-border">
            <div class="header">
                <img src="assets/img/logo.png" style="max-width: 250px;" alt="Logo PMI">
            </div>
            <div class="header">
                <img src="assets/img/custom_font.jpg" style="max-width: 600px;" alt="Terima Kasih & Penghargaan">
            </div>

            <div class="content">
                <h2>Kepada:</h2>
                <?php if ($d['logo']): ?>
                    <img src="<?php echo $d['logo']; ?>" style="max-height: 70px;" alt="Logo Instansi">
                <?php else : ?>
                    <h2 style="margin: 20px 0; font-size: 30px ;"><?php echo $d['nama_instansi']; ?></h2>
                <?php endif; ?>
                <p style="margin-top: 20px;">Atas Partisipasi & Kerjasamanya</p>
                <p style="font-size: 25px;"><?php echo $d['event'] ?? "Dalam Rangka Kegiatan Donor Darah Suka Rela"; ?></p>
            </div>

            <div class="footer">
                <div class="signature">
                    <p>Medan, <?php echo formatTanggalIndo($d['tanggal']); ?></p>
                    <p>PALANG MERAH INDONESIA</p> 
                    <img src="assets/img/signature.png" alt="Signature" />
                    <p><u>Dr. Harry Butarbutar, Sp.B.</u></p>
                    <p>Kepala</p>
                </div>
            </div>
            
            <div class="barcode">
                <p>CEK KEASLIAN</p>
                <?php  
                    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                        $url = "https://";   
                    else  
                        $url = "http://";   
                    // Append the host(domain name, ip) to the URL.   
                    $url.= $_SERVER['HTTP_HOST'];   
                    
                    // Append the requested resource location to the URL   
                    $url.= $_SERVER['REQUEST_URI'];    
                    echo "<img src='https://api.qrserver.com/v1/create-qr-code/?size=70x70&data=$url' alt='Barcode Keaslian Piagam'>";
                ?>   
            </div>
        </div>

        <button class="print-btn" onclick="window.print()">Print</button>
    </body>

    </html>

<?php
?>