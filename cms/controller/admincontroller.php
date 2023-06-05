<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'adminsimpan') {
        $admin_nama         = mysqli_real_escape_string($koneksi, $_POST['admin_nama']);
        $admin_username		= mysqli_real_escape_string($koneksi, $_POST['admin_username']);
		$admin_password		= mysqli_real_escape_string($koneksi, md5($_POST['admin_password']));
		$admin_status		= mysqli_real_escape_string($koneksi, $_POST['admin_status']);
		$admincat_id		= mysqli_real_escape_string($koneksi, $_POST['admincat_id']);
        $db                 = $koneksi->query("SELECT max(admin_id) as kodeTerbesar FROM admin");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "AD";
        $admin_id         = $huruf . sprintf("%03s", $urutan);
		$updated			= date('Y-m-d H:i:s');

		$sql = $koneksi->query("INSERT INTO admin (admin_id, admin_nama, admin_username, admin_password, admin_status, admincat_id) VALUES ('$admin_id', '$admin_nama', '$admin_username', '$admin_password', '$admin_status', '$admincat_id')")or die(mysqli_error($koneksi));
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Akun Admin: $admin_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Admin Berhasil Ditambahkan';
        }else{
            $_SESSION['error'] = 'Tambah Data Admin Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=admin'>";
    }else if ($_GET['m'] == 'adminupdate') {
        $admin_id           = mysqli_real_escape_string($koneksi, $_POST['admin_id']);
        $admin_nama         = mysqli_real_escape_string($koneksi, $_POST['admin_nama']);
        $admin_username		= mysqli_real_escape_string($koneksi, $_POST['admin_username']);
		$admin_password		= mysqli_real_escape_string($koneksi, md5($_POST['admin_password']));
		$admin_status		= mysqli_real_escape_string($koneksi, $_POST['admin_status']);
		$admincat_id		= mysqli_real_escape_string($koneksi, $_POST['admincat_id']);
        $updated			= date('Y-m-d H:i:s');
        if(empty($_POST['admin_password'])){
            $sql = $koneksi->query("UPDATE admin SET
                admin_nama      = '$admin_nama',
                admin_username  = '$admin_username',
                admin_status    = '$admin_status',
                admincat_id     = '$admincat_id'
                WHERE admin_id  = '$admin_id'") or die(mysqli_error($koneksi));
        }else{
            $sql = $koneksi->query("UPDATE admin SET
                admin_nama      = '$admin_nama',
                admin_username  = '$admin_username',
                admin_status    = '$admin_status',
                admin_password  = '$admin_password',
                admincat_id     = '$admincat_id'
                WHERE admin_id  = '$admin_id'") or die(mysqli_error($koneksi));
        }
		
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Akun Admin: $admin_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Admin Berhasil Diubah';
        }else{
            $_SESSION['error'] = 'Ubah Data Admin Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=admin'>";
    }else if($_GET['m'] == 'adminhapus'){
		$updated			= date('Y-m-d H:i:s');
        $id 				= trim($_GET['id']);
		$sdb			= $koneksi->query("SELECT * FROM admin WHERE admin_id = '$id'");
		$sdt			= $sdb->fetch_array();
		$admin_nama		= $sdt['admin_nama'];
		$sql 				= $koneksi->query("DELETE FROM admin WHERE admin_id = '$id'");
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Akun Admin: $admin_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
			$_SESSION['success'] = 'Data Admin Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Admin Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=index.php?m=admin'>";
    }else if($_GET['m'] == 'adminprofilupdate'){
		$admin_id           = mysqli_real_escape_string($koneksi, $_POST['admin_id']);
        $admin_nama         = mysqli_real_escape_string($koneksi, $_POST['admin_nama']);
        $admin_username		= mysqli_real_escape_string($koneksi, $_POST['admin_username']);
		$admin_password		= mysqli_real_escape_string($koneksi, md5($_POST['admin_password']));
		$admin_status		= mysqli_real_escape_string($koneksi, $_POST['admin_status']);
		$admincat_id		= mysqli_real_escape_string($koneksi, $_POST['admincat_id']);
		$updated			= date('Y-m-d H:i:s');
		if(empty($_POST['admin_password'])){
			$sql = $koneksi->query("UPDATE admin SET
			admin_nama			= '$admin_nama',
			admin_username		= '$admin_username',
			admin_status		= '$admin_status',
			admincat_id			= '$admincat_id'
			WHERE admin_id		= '$admin_id'")or die(mysqli_error($koneksi));
		}else{
			$sql = $koneksi->query("UPDATE admin SET
			admin_nama			= '$admin_nama',
			admin_username		= '$admin_username',
			admin_status		= '$admin_status',
			admin_password		= '$admin_password',
			admincat_id			= '$admincat_id'
			WHERE admin_id		= '$admin_id'")or die(mysqli_error($koneksi));
		}				
		
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Profile Admin: $admin_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
			$_SESSION['success'] = 'Data Profile Berhasil Diubah!';
		}else{
			$_SESSION['error'] = 'Perubahan Data Profile Gagal!';
		}	
		
		echo "<meta http-equiv='refresh' content='0; url=?m=adminsetting'>";	
			
	}
?>