<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : 'Semua';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk memfilter data berdasarkan tahun, kategori, dan pencarian
$query = "SELECT * FROM dpiagam WHERE 1";

// Filter berdasarkan tahun
if ($tahun != 'Semua') {
    $query .= " AND YEAR(tanggal) = '$tahun'";
}

// Filter berdasarkan kategori
if (!empty($kategori)) {
    $query .= " AND kategori = '$kategori'";
}

// Filter berdasarkan pencarian
if (!empty($search)) {
    $query .= " AND (nama_instansi LIKE '%$search%' OR no_piagam LIKE '%$search%' )";
}

$query .= " ORDER BY id DESC"; // Urutkan berdasarkan ID secara DESC

$sql = mysqli_query($konek, $query);
$no = 1;
while ($d = mysqli_fetch_array($sql)) {
    $tanggal = formatTanggalIndo($d['tanggal']); // Format tanggal
    $logo = "";
    $isLogoAvailabe = false;
    if (!empty($d['logo'])) {
        $logo = "<a class='btn btn-info btn-sm' href='$d[logo]' 
            target='_blank'>Lihat Logo</a>";
    }
    echo "<tr>
        <td width='40px' align='center'>$no</td>
        <td>$tanggal</td>
        <td>$d[nama_instansi]</td>
        <td>$d[no_piagam]</td>
        <td>$d[banyak_copy]</td>
        <td align='center'>
            <a class='btn btn-success btn-sm' href='cetak_piagam.php?id=$d[id]' 
            target='_blank'>Cetak</a>
            $logo
            <a href='aksi_piagam.php?act=delete&id=$d[id]' class='btn btn-danger btn-sm'>Hapus</a>
        </td>
    </tr>";
    $no++;
}
?>
