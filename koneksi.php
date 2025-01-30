<?php
//variabel koneksi
$konek = mysqli_connect("localhost","root","","qrpiagam");

if(!$konek){
	echo "Koneksi Database Gagal...!!!";
}

function formatTanggalIndo($tanggal_mysql) {
    $bulan_indo = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    $tanggal_format = date('d F Y', strtotime($tanggal_mysql));
    return strtr($tanggal_format, $bulan_indo);
}
?>