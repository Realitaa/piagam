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
		$logo	= $_POST['logo'];
		
		if($nama=='' || $nopiagam==''){
			header('location:data_piagam.php');
		}else{			
			//proses simpan data admin
			$simpan = mysqli_query($konek, "INSERT INTO dpiagam(nama_instansi, no_piagam, event, logo) 
							VALUES ('$nama', '$nopiagam','$event', '$logo')");

			if ($simpan) {
				header('location:data_piagam.php');
			}
		}
	} // akhir proses simpan data

	else{
		header('location:data_piagam.php');
	}

} // akhir get act

else{
	header('location:data_piagam.php');
}
?>