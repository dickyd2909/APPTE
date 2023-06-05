<?php
	date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'statuspenjualan') {
		$updated	= date('Y-m-d H:i:s');
		$id 		= $_GET['id'];
		$sql 		= $koneksi->query("UPDATE penjualan SET penjualan_status = 'Lunas' WHERE penjualan_id = '$id'")or die(mysqli_error($koneksi));
		$sql2 = $koneksi->query("UPDATE pembayaranjual SET pembayaran_status = 'Lunas' WHERE penjualan_id = '$id'")or die(mysqli_error($koneksi));
		
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Status Penjualan: Lunas', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Status mengubah status!';
        }else{
            $_SESSION['error'] = 'Ubah Status Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=penjualan'>";
    }
?>