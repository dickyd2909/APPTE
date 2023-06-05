<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../config/database.php";
	
	$customer_email			= mysqli_real_escape_string($koneksi, $_POST['customer_email']);
	$customer_password		= md5(mysqli_real_escape_string($koneksi, $_POST['customer_password']));
	
	$action 			= $_GET['act'];
	$notification_ip	= $_SERVER['REMOTE_ADDR'];
	
	if ($action == "in") {
		
		$cdb = mysqli_query($koneksi, "SELECT * FROM customer WHERE customer_email='$customer_email' AND customer_password='$customer_password' AND customer_status='Aktif'");
		if (mysqli_num_rows($cdb) == 1) {
			$cdt = mysqli_fetch_array($cdb);
			$customer_id		= $cdt['customer_id'];
			$customer_email		= $cdt['customer_email'];
			$customer_nama		= $cdt['customer_nama'];
			$postdated		= date("Y-m-d H:i:s");
			$_SESSION['customer_id'] 		= $cdt['customer_id'];
			$_SESSION['customer_email'] 	= $cdt['customer_email'];
			$_SESSION['customer_nama'] 		= $cdt['customer_nama'];
				
			header("location:beranda");
			
		} else {
			header("location:errorlogin");
		}
		
	} elseif ($action == "out") {
		
		unset($_SESSION['customer_id']);
		unset($_SESSION['customer_email']);
		unset($_SESSION['customer_nama']);
		header("location:beranda");
		
	}
?>
