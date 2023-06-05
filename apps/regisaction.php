<?php
	session_start();
	include "../config/database.php";
	 $customer_nama       = mysqli_real_escape_string($koneksi, $_POST['customer_nama']);
	$customer_telp       = mysqli_real_escape_string($koneksi, $_POST['customer_telp']);
	$customer_email      = mysqli_real_escape_string($koneksi, $_POST['customer_email']);
	$customer_password   = mysqli_real_escape_string($koneksi, md5($_POST['customer_password']));
	$customer_gender     = mysqli_real_escape_string($koneksi, $_POST['customer_gender']);
	$customer_status     = 'Aktif';
	$db                 = $koneksi->query("SELECT max(customer_id) as kodeTerbesar FROM customer");
	$dt                 = $db->fetch_array();
	$kode               = $dt['kodeTerbesar'];    
	$urutan             = (int) substr($kode, 3, 3); 
	$urutan++;
	$huruf              = "CS";
	$customer_id         = $huruf . sprintf("%03s", $urutan);


	$sql = $koneksi->query("INSERT INTO customer (customer_id, customer_nama, customer_telp, customer_email, customer_password, customer_gender, customer_status) VALUES ('$customer_id', '$customer_nama', '$customer_telp', '$customer_email', '$customer_password', '$customer_gender', '$customer_status')")or die(mysqli_error($koneksi));
	if($sql == true){
		$_SESSION['success'] = 'Registrasi Berhasil! Silahkan lakukan login akun!';
	}else{
		$_SESSION['error'] = 'Registrasi Gagal Silahkan Coba lagi!';
	}	
	echo "<meta http-equiv='refresh' content='0; url=registrasi'>";
?>
