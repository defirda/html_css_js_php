<!DOCTYPE html>
<html lang="en">
<head>
	<?php $koneksi = new mysqli ("localhost","root","","ade_nutech");?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ADE - NUTECH</title>
	<link rel="icon" href="">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.all.min.js" integrity="sha512-/iBgV43zPirSC0tue+PT/1VHGs7En24twBmT+sVMgn9PTaOpKfbgIyL5YsGKlbAIxcwz9S8W/YEnYjpIYj2Axw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
</style>
</head>
<body>
<section class="content container-xl callout container">
	<div class="col-md-12" style="margin-top:10px;padding-right:0; padding-left:0;">
		<div class="content-container">
			<div class="box-header with-border mt-5" style="margin-bottom:10px;">
				<h3 class="box-title">CRUD <b>DATA BARANG</b></h3>
					<div class="box-tools pull-right mb-4">
						<a class="btn btn-primary" id="tambah_barang" aria-hidden="true" ><span class="fa fa-plus"></span> Tambah Barang </a>
					</div>
				</div>
				<div class="box-body">
					<div class="col-md-12">
							<table id="tableBarang" class="mb-10 table table-striped table-hover table-responsive display responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Foto Barang</th>
										<th>Nama Barang</th>
										<th>Harga Beli</th>
										<th>Harga Jual</th>
										<th>Stok</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;
											$sql = $koneksi->query("SELECT * FROM barang");
											while ($data= $sql->fetch_assoc()) {
									?>
									<tr>
										<td>
											<?= $no++; ?>
										</td>
										<td>
											<?= '<a href="#" id="detail"><img id="fotoBarang" src="'.'images/'.$data['foto_barang'].'" height="50"/></a>'?>
										</td>
										<td>
											<?= $data["nama_barang"]?>
										</td>
										<td>
											<?= $data["harga_beli"]?>
										</td>
										<td>
											<?= $data["harga_jual"]?>
										</td>
										<td>
											<?= $data["stok"]?>
										</td>
										<td align="center">
											<form id="Hapus" action="" method="post" enctype="multipart/form-data">
												<input type="submit" name="Hapus" value="Hapus" class="btn-xs btn-danger" id="hapus" onclick="event.preventDefault();
												Swal.fire({icon: 'warning',title: 'Yakin ingin hapus, data tidak bisa dikembalikan?', showCancelButton: true,confirmButtonText: 'Hapus'}).then((result) => {if (result.isConfirmed) {form.submit();}});">
												<input type="hidden" name="hapus_id" value="<?= $data["id"]?>">
											</form>

											<a class="btn" aria-hidden="true" onclick="openModal('<?= $data['id']; ?>', '<?= $data['foto_barang']?>', '<?= $data['nama_barang']?>', '<?= $data['harga_beli']?>', '<?= $data['harga_jual']?>', '<?= $data['stok']?>' )" ><span class="fa fa-edit"></span> Ubah Barang </a>
										</td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>
					</div>
				</div>
		</div>
	</div>

	<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Barang</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="foto-barang" class="col-form-label">Photo Barang:</label>
							<input type="file" name="foto_barang" class="form-control" id="foto-barang" required>
						</div>
						<div class="mb-3">
							<label for="nama-barang" class="col-form-label">Nama Barang:</label>
							<input type="text" name="nama_barang"class="form-control" id="nama-barang" required></input>
						</div>
						<div class="mb-3">
							<label for="harga-beli" class="col-form-label">Harga Beli:</label>
							<input type="number" name="harga_beli" class="form-control" id="harga-beli" required></input>
						</div>
						<div class="mb-3">
							<label for="harga-jual" class="col-form-label">Harga Jual:</label>
							<input type="number" name="harga_jual" class="form-control" id="harga-jual" required></input>
						</div>
						<div class="mb-3">
							<label for="stok" class="col-form-label">Stok:</label>
							<input type="number" name="stok" class="form-control" id="stok" required></input>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modalUbah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Barang</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="foto-barang" class="col-form-label">Photo Barang:</label>
							<span>Tidak perlu diisi jika tidak ingin diubah</span>
							<input type="file" name="foto_barang_u" class="form-control" id="foto-barang-u">
							<input type="hidden" id="id-u" name="id_u">
							<input type="hidden" id="foto-barang-uu" name ="foto_barang_uu">
						</div>
						<div class="mb-3">
							<label for="nama-barang" class="col-form-label">Nama Barang:</label>
							<input type="text" name="nama_barang_u"class="form-control" id="nama-barang-u" required></input>
						</div>
						<div class="mb-3">
							<label for="harga-beli" class="col-form-label">Harga Beli:</label>
							<input type="number" name="harga_beli_u" class="form-control" id="harga-beli-u" required></input>
						</div>
						<div class="mb-3">
							<label for="harga-jual" class="col-form-label">Harga Jual:</label>
							<input type="number" name="harga_jual_u" class="form-control" id="harga-jual-u" required></input>
						</div>
						<div class="mb-3">
							<label for="stok" class="col-form-label">Stok:</label>
							<input type="number" name="stok_u" class="form-control" id="stok-u" required></input>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					<input type="submit" name="Ubah" value="Ubah" class="btn btn-primary">
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Detail Foto</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<img src="" id="imagepreview" style="width: 400px; height: 264px;" >
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
</html>

<script>
	$(document).ready( function () {
		$('#tableBarang').DataTable( {
    	responsive: {
				details: true
			}
		});
	});

	$('#tambah_barang').on('click', function() {
		$('#modalTambah').modal('show')
		$('#foto-barang').val('')
		$('#nama-barang').val('')
		$('#harga-beli').val('')
		$('#harga-jual').val('')
		$('#stok').val('')
	})

	$("#detail").on("click", function() {
		$('#imagepreview').attr('src', $('#fotoBarang').attr('src'));
		$('#modalDetail').modal('show'); 
	});

	$('#foto-barang').change(function(){
    let inputFile = document.getElementById('foto-barang');
    let pathFile = inputFile.value;
    let type = /(\.jpg|\.png)$/i;
		let size = (this.files[0].size / 1024)
		size = (Math.round(size * 100) / 100)

    if(!type.exec(pathFile)){
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Silakan upload file yang dengan ekstensi .jpg/.png!',
					timer: 5000,
				})
        inputFile.value = '';
        return false;
    } else if (size > 100) {
			Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Ukuran file lebih besar dari 100 KB!',
					timer: 5000,
				})
        inputFile.value = '';
        return false;
		}	
  });

	$('#foto-barang-u').change(function(){
    let inputFile = document.getElementById('foto-barang-u');
    let pathFile = inputFile.value;
    let type = /(\.jpg|\.png)$/i;
		let size = (this.files[0].size / 1024)
		size = (Math.round(size * 100) / 100)

    if(!type.exec(pathFile)){
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Silakan upload file yang dengan ekstensi .jpg/.png!',
					timer: 5000,
				})
        inputFile.value = '';
        return false;
    } else if (size > 100) {
			Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Ukuran file lebih besar dari 100 KB!',
					timer: 5000,
				})
        inputFile.value = '';
        return false;
		}	
  });

	function openModal(id, foto_barang, nama_barang, harga_beli, harga_jual, stok){
		$('#modalUbah').modal('show')
		$('#id-u').val(id)
		$('#foto-barang-uu').val(foto_barang)
		$('#nama-barang-u').val(nama_barang)
		$('#harga-beli-u').val(parseInt(harga_beli))
		$('#harga-jual-u').val(parseInt(harga_jual))
		$('#stok-u').val(parseInt(stok))
	}
</script>

<?php
	if (isset ($_POST['Ubah'])){
		$sql = $koneksi->query("SELECT nama_barang FROM barang where nama_barang='".trim($_POST['nama_barang_u'])."' and id <> '".$_POST['id_u']."'");
		$data = $sql->fetch_assoc();

		if ($data === NULL) {
			if (isset ($_FILES['foto_barang_u']) && $_FILES['foto_barang_u']['name'] != '') {
				try {
					$file_name = rand(0,999999) . substr($_FILES["foto_barang_u"]["name"],-4);
					move_uploaded_file($_FILES["foto_barang_u"]["tmp_name"], "images/" . $file_name);
					$url = 'images/' . $_POST["foto_barang_uu"];
					unlink($url); 
	
					$sql_ubah = "UPDATE barang SET
					foto_barang='".$file_name."',
					nama_barang='".$_POST['nama_barang_u']."',
					harga_beli='".$_POST['harga_beli_u']."',
					harga_jual='".$_POST['harga_jual_u']."',
					stok='".$_POST['stok_u']."'
					WHERE id='".$_POST['id_u']."'";
					$query_ubah = mysqli_query($koneksi, $sql_ubah);
					mysqli_close($koneksi);

					echo "<script>
						Swal.fire({
								title: 'Data Berhasil Disimpan',
								text: '',
								icon: 'success',
								confirmButtonText: 'OK',
								timer:5000
						}).then((result) => {
							window.location = 'index.php';
						})</script>";
				} catch (Exception $e) {
					echo "<script>
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Data gagal disimpan, terjadi error di server!',
						timer: 5000,
					}).then((result) => {
						window.location = 'index.php';
					})
					";
				}
			} else {
				try {
					$sql_ubah = "UPDATE barang SET
					nama_barang='".$_POST['nama_barang_u']."',
					harga_beli='".$_POST['harga_beli_u']."',
					harga_jual='".$_POST['harga_jual_u']."',
					stok='".$_POST['stok_u']."'
					WHERE id ='".$_POST['id_u']."'";
					$query_ubah = mysqli_query($koneksi, $sql_ubah);
					mysqli_close($koneksi);

					echo "<script>
					Swal.fire({
							title: 'Data Berhasil Disimpan',
							text: '',
							icon: 'success',
							confirmButtonText: 'OK',
							timer:5000
					}).then((result) => {
						window.location = 'index.php';
					})</script>";
				} catch (Exception $e) {
					echo "<script>
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Data gagal disimpan, terjadi error di server!',
						timer: 5000,
					}).then((result) => {
						window.location = 'index.php';
					})
					";
				}
			}
		} else {
			echo "<script>
				Swal.fire({
						title: 'Data Gagal Disimpan',
						text: 'Nama Barang sudah dipakai!',
						icon: 'error',
						confirmButtonText: 'OK',
						timer:5000
				}).then((result) => {
					window.location = 'index.php';
				})</script>";

		}
	}

	if (isset ($_POST['Simpan'])){
			$sql = $koneksi->query("SELECT nama_barang FROM barang where nama_barang='".trim($_POST['nama_barang'])."'");
			$data = $sql->fetch_assoc();

			if ($data === NULL) {
				try {
					$file_name = rand(0,999999) . substr($_FILES["foto_barang"]["name"],-4);
					move_uploaded_file($_FILES["foto_barang"]["tmp_name"], "images/" . $file_name);
					$sql_simpan = "INSERT INTO barang (foto_barang,nama_barang,harga_beli,harga_jual,stok) VALUES (
						'".$file_name."',
						'".trim($_POST['nama_barang'])."',
						'".$_POST['harga_beli']."',
						'".$_POST['harga_jual']."',
						'".$_POST['stok']."')";
					$query_simpan = mysqli_query($koneksi, $sql_simpan);
					mysqli_close($koneksi);

					echo "<script>
						Swal.fire({
								title: 'Data Berhasil Disimpan',
								text: '',
								icon: 'success',
								confirmButtonText: 'OK',
								timer:5000
						}).then((result) => {
							window.location = 'index.php';
						})</script>";
				} catch (Exception $e) {
					echo "<script>
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Data gagal disimpan, terjadi error di server!',
						timer: 5000,
					}).then((result) => {
						window.location = 'index.php';
					})
					";
				}
			} else {
				echo "<script>
				Swal.fire({
						title: 'Data Gagal Disimpan',
						text: 'Nama Barang sudah dipakai!',
						icon: 'error',
						confirmButtonText: 'OK',
						timer:5000
				}).then((result) => {
					window.location = 'index.php';
				})</script>";
			}
  }

	if (isset ($_POST["hapus_id"])) {
		try {
			$sql = $koneksi->query("SELECT foto_barang FROM barang where id='".$_POST['hapus_id']."'");
			$data = $sql->fetch_assoc();
			$url = 'images/' . $data["foto_barang"];
			unlink($url); 
			$sql_hapus = "DELETE FROM barang WHERE id='".$_POST['hapus_id']."'";
			$query_hapus = mysqli_query($koneksi, $sql_hapus);
	
				if ($query_hapus) {
						echo "<script>
						Swal.fire({
								title: 'Data Berhasil Dihapus',
								text: '',
								icon: 'success',
								confirmButtonText: 'OK',
								timer:5000
						}).then((result) => {
							window.location = 'index.php';
						})</script>";
				} else {
						echo "<script>
						Swal.fire({
								title: 'Hapus Data Gagal',
								text: '',
								icon: 'error',
								confirmButtonText: 'OK'
						}).then((result) => {
							window.location = 'index.php';
						})</script>";
				}
	
		} catch (Exception $e) {
			echo "<script>
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Data gagal dihapus, terjadi error di server!',
				timer: 5000,
			}).then((result) => {
				window.location = 'index.php';
			})
			";
		}

	}
?>
