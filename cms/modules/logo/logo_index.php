<title>Logo | MALINIART OLSHOP</title>

<div id="profiltit" class="clearfix">
	<h3>Logo Information</h3>
	<span><a href="?m=dashboard">Home</a> > Logo Information </span>
</div>
<div id="bgbodyrightcontent">
	<?php
			$db = $koneksi->query("SELECT * FROM logo");
			$dt = $db->fetch_array();
	?>
	<div class="bgprofil">
		<div id="profilformtitbo" class="clearfix">
			<div class="profilformtit">
				Logo Information
			</div>
			<div class="profilformbtn">
				<a href="?m=logoedit" class="btnprofil" id="myBtn">Edit</a>
			</div>
		</div>	
		<div class="profilimg">
			<img src="../assets/images/logo/<?= $dt['logo_gambar']; ?>" title="Olshop maliniart" alt="Olshop maliniart" width="<?= $dt['logo_lebar'];?>" height="<?= $dt['logo_panjang'];?>" >
		</div>
		<div class="profilform clearfix">
			<form action="#" method="post">
				<div class="formprofilkiri">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							NAMA
						</div>
						<input type="disable" name="logo_nama" value="<?= $dt['logo_nama']; ?>" class="form-profil" disabled />
						<input type="hidden" name="logo_id" value="<?= $dt['logo_id']; ?>" class="form-profil" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Lebar
						</div>
						<input type="disable" name="logo_lebar" value="<?= $dt['logo_lebar']; ?>" class="form-profil" disabled />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Panjang
						</div>
						<input type="disable" name="logo_panjang" value="<?= $dt['logo_panjang']; ?>" class="form-profil" disabled />
					</div>
				</div>
				<div class="formprofilkanan">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Alt Text
						</div>
						<input type="disable" name="logo_alt" value="<?= $dt['logo_alt']; ?>" class="form-profil" disabled />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Title
						</div>
						<input type="disable" name="logo_title" value="<?= $dt['logo_title']; ?>" class="form-profil" disabled />
					</div>
				</div>
			</form>
		</div>
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