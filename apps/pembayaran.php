<?php
	session_start();
	include "../config/database.php";
	$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
	$penjualan_id       = mysqli_real_escape_string($koneksi, $_POST['penjualan_id']);
	$admin_id	       	= "AD001";
	$total_bayar      	= mysqli_real_escape_string($koneksi, $_POST['total_bayar']);
	$bank			    = mysqli_real_escape_string($koneksi, $_POST['bank']);
	$no_rekening	    = mysqli_real_escape_string($koneksi, $_POST['no_rekening']);
	$tanggal_pembayaran = mysqli_real_escape_string($koneksi, $_POST['tanggal_pembayaran']);
	$pembayaran_status  = 'Proses';
	$db                 = $koneksi->query("SELECT max(pembayaranjual_id) as kodeTerbesar FROM pembayaranjual");
	$dt                 = $db->fetch_array();
	$kode               = $dt['kodeTerbesar'];    
	$urutan             = (int) substr($kode, 3, 3); 
	$urutan++;
	$huruf              = "PJ";
	$pembayaran_id		= $huruf . sprintf("%03s", $urutan);
	$code		   		= md5(uniqid(rand()));
	$gencode			= substr($code, 0, 5);
	$replace			= strtolower(str_replace($stringreplace,'_',$penjualan_id));
	$nama_file 			= $_FILES["bukti_transfer"]["name"];
	$tipe_file 			= $_FILES["bukti_transfer"]["type"];
	$alamat 			= $_FILES["bukti_transfer"]["tmp_name"];
	$explode            = explode(".", $nama_file);
	$nama_baru 			= $replace."_".$gencode.".".end($explode);
	$tujuan 			= "../assets/images/buktipembayaran/$nama_baru";

	$gambar_baru = move_uploaded_file($alamat, $tujuan);
	$sql = $koneksi->query("INSERT INTO pembayaranjual (pembayaranjual_id, penjualan_id, admin_id, total_bayar, bank, bukti_transfer, no_rekening, tanggal_pembayaran, pembayaran_status) VALUES ('$pembayaranjual_id', '$penjualan_id', '$admin_id', '$total_bayar', '$bank', '$nama_baru', '$no_rekening', '$tanggal_pembayaran', '$pembayaran_status')")or die(mysqli_error($koneksi));
	if($sql == true){
		$_SESSION['success'] = 'Pembayaran Berhasil! Tunggu Konfirmasi Admin!';
	}else{
		$_SESSION['error'] = 'Pembayaran Gagal Silahkan Coba lagi!';
	}	
	echo "<meta http-equiv='refresh' content='0; url=buktitransfer-$penjualan_id'>";
?>
