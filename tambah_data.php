<?php include "header.php"; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="container">
<div class="row">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Tambah Data Instansi Donor</h3>
			</div>
			<div class="panel-body">
				
				<form method="post" action="aksi_piagam.php?act=insert">
					<table class="table">
						<tr>
							<td width="160px">Nama Instansi</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="nama" required /></div></td>
						</tr>
						<tr>
							<td width="160px">Event</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="event" placeholder="Dalam Rangka Kegiatan Donor Darah Suka Rela" /></div></td>
						</tr>
						<tr>
							<td width="160px">Tanggal</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="tanggal" id="tanggal"/></div></td>
						</tr>
						<tr>
							<td>No. Piagam</td>
							<td>
								<div class="col-md-6">
									<?php
									// Ambil nilai MAX(id) dari tabel dpiagam
									$sql = mysqli_query($konek, "SELECT LEFT(no_piagam, 3) AS last_piagam, RIGHT(no_piagam, 4) AS tahun FROM dpiagam ORDER BY id DESC LIMIT 1");
									$row = mysqli_fetch_assoc($sql); // Ambil hasil sebagai array asosiatif
									$tahun = $row['tahun'] ?? '1'; 
									$last_piagam = $row['last_piagam'] ?? '1'; 

									if ($tahun == date('Y')) {
										// Tambahkan format tiga digit
										$formatted_piagam = sprintf('%03d', $last_piagam + 1);
									} else {
										// Reset menjadi 001
										$formatted_piagam = "001";
									}

									$bulanRomawi = '';

									// Menentukan bulan dalam Romawi
									switch (date('n')) {
										case 1:
											$bulanRomawi = 'I';
										break;
										case 2:
											$bulanRomawi = 'II';
										break;
										case 3:
											$bulanRomawi = 'III';
										break;
										case 4:
											$bulanRomawi = 'IV';
										break;
										case 5:
											$bulanRomawi = 'V';
										break;
										case 6:
											$bulanRomawi = 'VI';
										break;
										case 7:
											$bulanRomawi = 'VII';
										break;
										case 8:
											$bulanRomawi = 'VIII';
										break;
										case 9:
											$bulanRomawi = 'IX';
										break;
										case 10:
											$bulanRomawi = 'X';
										break;
										case 11:
											$bulanRomawi = 'XI';
										break;
										case 12:
											$bulanRomawi = 'XII';
										break;
									}
									?>
									<input class="form-control" type="text" name="nopiagam" 
									value="<?php echo htmlspecialchars($formatted_piagam); ?>/1.02.01/PK-PGM/DD/<?php echo $bulanRomawi ?>/<?php echo date('Y') ?>" required />
								</div>
							</td>
						</tr>
						<tr>
							<td width="160px">Logo</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="logo" id="embed_link" placeholder="Link embed logo instansi" /></div> <button type="button" class="btn btn-primary" id="check_button">Cek Link Embed</button></td>
						</tr>
						<tr>
							<td>
								<div class="preview_logo">
									<!-- Preview logo akan ditampilkan disini jika logo embedable -->
								</div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
							<div class="col-md-6">
								<input class="btn btn-primary" type="submit" value="Simpan" />
								<a class="btn btn-danger" href="data_piagam.php">Kembali</a>
								</div>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
	flatpickr("#tanggal", {
    	dateFormat: "Y-m-d",
		defaultDate: new Date(),
	});

	// Mendapatkan elemen HTML
    const embedInput = document.getElementById('embed_link');
    const checkButton = document.getElementById('check_button');
    const previewLogo = document.querySelector('.preview_logo');

    // Fungsi untuk mengecek tautan gambar
    checkButton.addEventListener('click', () => {
      const imageUrl = embedInput.value.trim();

      // Validasi jika input kosong
      if (!imageUrl) {
        alert('Harap masukkan tautan embed gambar.');
        return;
      }

      // Membuat elemen gambar
      const img = new Image();
      img.src = imageUrl;

      // Event ketika gambar berhasil dimuat
      img.onload = () => {
        // Kosongkan div preview_logo dan tambahkan gambar
        previewLogo.innerHTML = '';
        previewLogo.appendChild(img);
      };

      // Event ketika gambar gagal dimuat
      img.onerror = () => {
        alert('Gambar tidak dapat dimuat. Pastikan tautan valid dan dapat diakses.');
        previewLogo.innerHTML = ''; // Kosongkan preview jika tautan tidak valid
      };
    });
</script>

<?php include "footer.php"; ?>
