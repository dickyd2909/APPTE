<title>Profil | MALINIART OLSHOP</title>

<div id="profiltit" class="clearfix">
	<h3>Metadata Information</h3>
	<span><a href="?m=dashboard">Home</a> > Metadata Information </span>
</div>
<div id="bgbodyrightcontent">
	<?php
			$db = $koneksi->query("SELECT * FROM metadata");
			$dt = $db->fetch_array();
	?>
	<div class="bgprofil">
		<div id="profilformtitbo" class="clearfix">
			<div class="profilformtit">
				Metadata Information
			</div>
			<div class="profilformbtn">
				<a href="?m=metadataedit" class="btnprofil" id="myBtn">Edit</a>
			</div>
		</div>	
		<div class="profilimg">
			<img src="../assets/images/logo/<?= $dt['metadata_gambar']; ?>" title="Olshop maliniart" alt="Olshop maliniart">
		</div>
		<div class="profilform clearfix">
			<form action="#" method="post">
				<div class="formprofilkiri">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Judul
						</div>
						<input type="disable" name="metadata_judul" value="<?= $dt['metadata_judul']; ?>" class="form-profil" disabled />
						<input type="hidden" name="metadata_id" value="<?= $dt['metadata_id']; ?>" class="form-profil" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Copyright
						</div>
						<input type="disable" name="metadata_copyright" value="<?= $dt['metadata_copyright']; ?>" class="form-profil" disabled />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Keyword
						</div>
						<input type="disable" name="metadata_keyword" value="<?= $dt['metadata_keyword']; ?>" class="form-profil" disabled />
					</div>
				</div>
				<div class="formprofilkanan">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Description
						</div>
						<textarea class="form-profil" name="metadata_description" disabled><?= $dt['metadata_description']; ?></textarea>
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Url
						</div>
						<input type="disable" name="metadata_url" value="<?= $dt['metadata_url']; ?>" class="form-profil" disabled />
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