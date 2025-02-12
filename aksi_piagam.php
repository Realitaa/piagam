<?php
session_start();
if(!isset($_SESSION['login'])){
	header('location:login.php');
}
include "koneksi.php";

// jika ada get act
if(isset($_GET['act'])){

	//proses simpan data
	if($_GET['act']=='insert'){
		//variabel dari elemen form
		$nama 	= $_POST['nama'];
		$nopiagam = $_POST['nopiagam'];
		$event	= $_POST['event'];
		$tanggal	= $_POST['tanggal'];
		$logo	= $_POST['logo'];
		
		if($nama=='' || $nopiagam==''){
			header('location:data_piagam.php');
		}else{			
			//proses simpan data admin
			$simpan = mysqli_query($konek, "INSERT INTO dpiagam(tanggal, nama_instansi, no_piagam, event, logo) 
							VALUES ('$tanggal', '$nama', '$nopiagam','$event', '$logo')");

			if ($simpan) {
				header('location:data_piagam.php');
			}
		}
	} else if ($_GET['act']=='delete'){
	    $id = $_GET['id'];
	        
	    if ($id) {
	        $hapus = mysqli_query($konek, "DELETE FROM dpiagam WHERE id = $id");
	        if ($hapus) {
	            // echo '<script>alert("Data berhasil di hapus")</script>';
	            header('location:data_piagam.php');
	        }
	    } else {
	        header('location:data_piagam.php');
	    }
	} else if ($_GET['act'] == 'afterprint') {
	    $id = $_POST['id'];

		if ($id) {
			$id = intval($id);

			$update = mysqli_query($konek, "UPDATE dpiagam SET banyak_copy = banyak_copy + 1 WHERE id = $id");
		} else {
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan jumlah cetak']);		
		}
	}

	else{
		header('location:data_piagam.php');
	}

} // akhir get act

else{
	header('location:data_piagam.php');
}
?>