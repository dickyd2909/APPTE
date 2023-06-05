<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'bahansimpan') {
        $bahan_nama     = mysqli_real_escape_string($koneksi, $_POST['bahan_nama']);
        $bahan_satuan	= mysqli_real_escape_string($koneksi, $_POST['bahan_satuan']);
        $bahan_harga	= mysqli_real_escape_string($koneksi, $_POST['bahan_harga']);
		$bahan_stok	    = mysqli_real_escape_string($koneksi, $_POST['bahan_stok']);
        $db                 = $koneksi->query("SELECT max(bahan_id) as kodeTerbesar FROM bahan");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "BH";
        $bahan_id           = $huruf . sprintf("%03s", $urutan);
		$updated			= date('Y-m-d H:i:s');

		$sql = $koneksi->query("INSERT INTO bahan (bahan_id, bahan_nama, bahan_satuan, bahan_harga, bahan_stok) VALUES ('$bahan_id', '$bahan_nama', '$bahan_satuan', '$bahan_harga', '$bahan_stok')")or die(mysqli_error($koneksi));
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data bahan: $bahan_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data bahan Berhasil Ditambahkan';
        }else{
            $_SESSION['error'] = 'Tambah Data bahan Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=bahan'>";
    }else if ($_GET['m'] == 'bahanupdate') {
        $bahan_id        = mysqli_real_escape_string($koneksi, $_POST['bahan_id']);
        $bahan_nama      = mysqli_real_escape_string($koneksi, $_POST['bahan_nama']);
        $bahan_satuan		= mysqli_real_escape_string($koneksi, $_POST['bahan_satuan']);
        $bahan_harga	= mysqli_real_escape_string($koneksi, $_POST['bahan_harga']);
		$bahan_stok	= mysqli_real_escape_string($koneksi, $_POST['bahan_stok']);
        $updated			= date('Y-m-d H:i:s');
       
        $sql = $koneksi->query("UPDATE bahan SET
            bahan_nama      = '$bahan_nama',
            bahan_satuan      = '$bahan_satuan',
            bahan_stok    = '$bahan_stok',
            bahan_harga    = '$bahan_harga'
            WHERE bahan_id  = '$bahan_id'") or die(mysqli_error($koneksi));

		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Bahan: $bahan_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Bahan Berhasil Diubah';
        }else{
            $_SESSION['error'] = 'Ubah Data bahan Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=bahan'>";
    }else if($_GET['m'] == 'bahanhapus'){
		$updated		= date('Y-m-d H:i:s');
        $id 			= trim($_GET['id']);
		$sdb			= $koneksi->query("SELECT * FROM bahan WHERE bahan_id = '$id'");
		$sdt			= $sdb->fetch_array();
		$bahan_nama	= $sdt['bahan_nama'];
		$sql 			= $koneksi->query("DELETE FROM bahan WHERE bahan_id = '$id'");
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Bahan: $bahan_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
			$_SESSION['success'] = 'Data Bahan Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Bahan Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=index.php?m=bahan'>";
    }
?>