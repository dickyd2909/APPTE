<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'admincatsimpan') {
        $admincat_nama       = mysqli_real_escape_string($koneksi, $_POST['admincat_nama']);
        $db                 = $koneksi->query("SELECT max(admincat_id) as kodeTerbesar FROM admincat");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "AC";
        $admincat_id         = $huruf . sprintf("%03s", $urutan);
		$updated			= date('Y-m-d H:i:s');

		$sql = $koneksi->query("INSERT INTO admincat (admincat_id, admincat_nama) VALUES ('$admincat_id', '$admincat_nama')")or die(mysqli_error($koneksi));
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Kategori Admin: $admincat_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Kategori Admin Berhasil Ditambahkan';
        }else{
            $_SESSION['error'] = 'Tambah Data Kategori Admin Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=admincat'>";
    }else if ($_GET['m'] == 'admincatupdate') {
        $admincat_id        = mysqli_real_escape_string($koneksi, $_POST['admincat_id']);
        $admincat_nama      = mysqli_real_escape_string($koneksi, $_POST['admincat_nama']);
        $updated			= date('Y-m-d H:i:s');        
        $sql = $koneksi->query("UPDATE admincat SET
		admincat_nama      = '$admincat_nama'
		WHERE admincat_id  = '$admincat_id'") or die(mysqli_error($koneksi));
    
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Kategori Admin: $admincat_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Kategori Admin Berhasil Diubah';
        }else{
            $_SESSION['error'] = 'Ubah Data Kategori Admin Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=admincat'>";
    }else if($_GET['m'] == 'admincathapus'){
		$updated	= date('Y-m-d H:i:s');
        $id 		= trim($_GET['id']);
		$sdb			= $koneksi->query("SELECT * FROM admincat WHERE admincat_id = '$id'");
		$sdt			= $sdb->fetch_array();
		$admincat_nama	= $sdt['admincat_nama'];
		$sql 		= $koneksi->query("DELETE FROM admincat WHERE admincat_id = '$id'");
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Kategori Admin: $admincat_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
			$_SESSION['success'] = 'Data Kategori Admin Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Kategori Admin Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=index.php?m=admincat'>";
    }
?>