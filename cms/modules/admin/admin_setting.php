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
		<div id="profilformtitbo" class="clearfix">
			<div class="profilformtit">
				Profil Information
			</div>
			<div class="profilformbtn">
				<a href="?m=adminedit" class="btnprofil" id="myBtn">Edit</a>
			</div>
		</div>	
		<div class="profilform clearfix">
			<form action="#" method="post">
				<div class="formprofilkiri">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							NAMA
						</div>
						<input type="disable" name="admin_nama" value="<?= $dt['admin_nama']; ?>" class="form-profil" disabled />
						<input type="hidden" name="admin_id" value="<?= $dt['admin_id']; ?>" class="form-profil" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							USERNAME
						</div>
						<input type="disable" name="admin_username" value="<?= $dt['admin_username']; ?>" class="form-profil" disabled />
					</div>
				</div>
				<div class="formprofilkanan">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							LEVEL
						</div>
						<input type="disable" name="admincat_nama" value="<?= $dt['admincat_nama']; ?>" class="form-profil" disabled />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							STATUS
						</div>
						<input type="disable" name="admin_status" value="<?= $dt['admin_status']; ?>" class="form-profil" disabled />
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