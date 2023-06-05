<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'contentcatsimpan') {
		$odb 				= $koneksi->query("SELECT MAX(contentcat_order) AS LastNo FROM contentcat");
		$odt 				= $odb->fetch_array();
        $contentcat_judul   = mysqli_real_escape_string($koneksi, $_POST['contentcat_judul']);
		$contentcat_status   = mysqli_real_escape_string($koneksi, $_POST['contentcat_status']);
        $db                 = $koneksi->query("SELECT max(contentcat_id) as kodeTerbesar FROM contentcat");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "CC";
        $contentcat_id      = $huruf . sprintf("%03s", $urutan);
		$updated			= date('Y-m-d H:i:s');
		$contentcat_order 	= $odt['LastNo'] + 1;
		
		$sql = $koneksi->query("INSERT INTO contentcat (contentcat_id, contentcat_judul, contentcat_status, contentcat_order) VALUES ('$contentcat_id', '$contentcat_judul', '$contentcat_status', '$contentcat_order')")or die(mysqli_error($koneksi));
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Kategori Konten: $contentcat_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Kategori Konten Berhasil Ditambahkan';
        }else{
            $_SESSION['error'] = 'Tambah Data Kategori Konten Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=contentcat'>";
    }else if ($_GET['m'] == 'contentcatupdate') {
        $contentcat_id      = mysqli_real_escape_string($koneksi, $_POST['contentcat_id']);
        $contentcat_judul   = mysqli_real_escape_string($koneksi, $_POST['contentcat_judul']);
		$contentcat_status	= mysqli_real_escape_string($koneksi, $_POST['contentcat_status']);
        $updated			= date('Y-m-d H:i:s');        
        $sql = $koneksi->query("UPDATE contentcat SET
		contentcat_judul    = '$contentcat_judul',
		contentcat_status	= '$contentcat_status'
		WHERE contentcat_id = '$contentcat_id'") or die(mysqli_error($koneksi));
    
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Kategori Konten: $contentcat_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Kategori Konten Berhasil Diubah';
        }else{
            $_SESSION['error'] = 'Ubah Data Kategori Konten Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=contentcat'>";
    }else if($_GET['m'] == 'contentcathapus'){
		$updated	= date('Y-m-d H:i:s');
        $id 		= trim($_GET['id']);
		$sdb			= $koneksi->query("SELECT * FROM contentcat WHERE contentcat_id = '$id'");
		$sdt			= $sdb->fetch_array();
		$contentcat_judul	= $sdt['contentcat_judul'];
		$sql 		= $koneksi->query("DELETE FROM contentcat WHERE contentcat_id = '$id'");
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Kategori Konten: $contentcat_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
			$_SESSION['success'] = 'Data Kategori Konten Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Kategori Konten Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=index.php?m=contentcat'>";
    }
?>