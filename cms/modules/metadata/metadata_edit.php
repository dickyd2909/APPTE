<title>Metadata | Maliniart Olshop</title>

<div id="profiltit" class="clearfix">
	<h3>Metadata Information</h3>
	<span><a href="/dashboard">Home</a> > Metadata Information </span>
</div>
<div id="bgbodyrightcontent">
	<?php
			$db = $koneksi->query("SELECT * FROM metadata");
			$dt = $db->fetch_array();
	?>
	<div class="bgprofil">
		<form action="?m=metadataupdate" method="post" enctype="multipart/form-data">
			<div id="profilformtitbo" class="clearfix">
				<div class="profilformtit">
					Metadata Information
				</div>
				<div class="profilformbtn">
					<input type="submit" name="simpan" value="Simpan" class="btnprofil" />
				</div>
			</div>	
			<div class="profilimg">
				<img src="../assets/images/logo/<?= $dt['metadata_gambar']; ?>" title="Olshop Maliniart" alt="Maliniart Olshop">
			</div>
			<div class="formbgprofil">
				<input type="file" name="metadata_gambar" class="form-control" />
			</div>
			<div class="profilform clearfix">
				<div class="formprofilkiri">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Judul
						</div>
						<input type="text" name="metadata_judul" value="<?= $dt['metadata_judul']; ?>" class="form-control" />
						<input type="hidden" name="metadata_id" value="<?= $dt['metadata_id']; ?>" class="form-profil" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Copyright
						</div>
						<input type="text" name="metadata_copyright" value="<?= $dt['metadata_copyright']; ?>" class="form-control" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Keyword
						</div>
						<input type="text" name="metadata_keyword" value="<?= $dt['metadata_keyword']; ?>" class="form-control" />
					</div>
				</div>
				<div class="formprofilkanan">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Description
						</div>
						<textarea class="form-control" name="metadata_description"><?= $dt['metadata_description']; ?></textarea>
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							Url
						</div>
						<input type="text" name="metadata_url" value="<?= $dt['metadata_url']; ?>" class="form-control" />
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