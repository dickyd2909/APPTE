<title>Profil | Maliniart Olshop</title>

<div id="profiltit" class="clearfix">
	<h3>User Profile</h3>
	<span><a href="?m=dashboard">Home</a> > Profile </span>
</div>
<div id="bgbodyrightcontent">
	<?php
			$db = $koneksi->query("SELECT * FROM admin INNER JOIN admincat ON admin.admincat_id = admincat.admincat_id WHERE admin_id = '$_SESSION[admin_id]'");
			$dt = $db->fetch_array();
	?>
	<div class="bgprofil">
		<form action="?m=adminprofilupdate" method="post" enctype="multipart/form-data">
			<div id="profilformtitbo" class="clearfix">
				<div class="profilformtit">
					Profil Information
				</div>
				<div class="profilformbtn">
					<input type="submit" name="simpan" value="Simpan" class="btnprofil" />
				</div>
			</div>	
			<div class="profilform clearfix">
				<div class="formprofilkiri">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							NAMA
						</div>
						<input type="text" name="admin_nama" value="<?= $dt['admin_nama']; ?>" class="form-control" />
						<input type="hidden" name="admin_id" value="<?= $dt['admin_id']; ?>" class="form-profil" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							USERNAME
						</div>
						<input type="text" name="admin_username" value="<?= $dt['admin_username']; ?>" class="form-control" />
					</div>
				</div>
				<div class="formprofilkanan">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							LEVEL
						</div>
						<select name="admincat_id" class="form-control">
							<option value="<?= $dt['admincat_id']; ?>"><?= $dt['admincat_nama']; ?></option>
							<?php
								$ldb = $koneksi->query("SELECT * FROM admincat");
								while($ldt = $ldb->fetch_array()){
							?>
								<option value="<?= $ldt['admincat_id_id']; ?>"><?= $ldt['admincat_id_nama']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							STATUS
						</div>
						<select name="admin_status" class="form-control">
							<option value="<?= $dt['admin_status']; ?>"><?= $dt['admin_status']; ?></option>
							<option value="Aktif">Aktif</option>
							<option value="Non-Aktif">Non-Aktif</option>
						</select>
					</div>
				</div>
			</div>
			<div class="formbgprofil">
				<span class="adminpass">*Optional</span>
				<div class="formbgprofiltit">
					PASSWORD
				</div>
				<input type="password" name="admin_password" class="form-control" />
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