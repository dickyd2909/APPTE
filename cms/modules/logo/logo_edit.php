<title>Logo | Maliniart Olshop</title>

<div id="profiltit" class="clearfix">
	<h3>Logo Information</h3>
	<span><a href="/dashboard">Home</a> > Logo Information </span>
</div>
<div id="bgbodyrightcontent">
	<?php
			$db = $koneksi->query("SELECT * FROM logo");
			$dt = $db->fetch_array();
	?>
	<div class="bgprofil">
		<form action="?m=logoupdate" method="post" enctype="multipart/form-data">
			<div id="profilformtitbo" class="clearfix">
				<div class="profilformtit">
					Logo Information
				</div>
				<div class="profilformbtn">
					<input type="submit" name="simpan" value="Simpan" class="btnprofil" />
				</div>
			</div>	
			<div class="profilimg">
				<img src="../assets/images/logo/<?= $dt['logo_gambar']; ?>" title="Olshop Maliniart" alt="Maliniart Olshop">
			</div>
			<div class="formbgprofil">
				<input type="file" name="logo_gambar" class="form-control" />
			</div>
			<div class="profilform clearfix">
				<div class="formprofilkiri">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							NAMA
						</div>
						<input type="text" name="logo_nama" value="<?= $dt['logo_nama']; ?>" class="form-control" />
						<input type="hidden" name="logo_id" value="<?= $dt['logo_id']; ?>" class="form-profil" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							LEBAR
						</div>
						<input type="text" name="logo_lebar" value="<?= $dt['logo_lebar']; ?>" class="form-control" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							PANJANG
						</div>
						<input type="text" name="logo_panjang" value="<?= $dt['logo_panjang']; ?>" class="form-control" />
					</div>
				</div>
				<div class="formprofilkanan">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							ALT TEXT
						</div>
						<input type="text" name="logo_alt" value="<?= $dt['logo_alt']; ?>" class="form-control" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							TITLE
						</div>
						<input type="text" name="logo_title" value="<?= $dt['logo_title']; ?>" class="form-control" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php if(isset($_SESSION['success'])){ ?>
	<script>
		Swal.fire({
		  title: 'Sukses!',
		  text: '<?= $_SESSION['success']; ?>',
		  icon: 'success',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['success']);} ?>
<?php if(isset($_SESSION['error'])){ ?>
	<script>
		Swal.fire({
		  title: 'Gagal!',
		  text: '<?= $_SESSION['error']; ?>',
		  icon: 'error',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['error']);} ?>