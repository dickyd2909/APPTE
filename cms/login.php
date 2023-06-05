<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "libs/functiondb.php";
	
	$admin_username		= mysqli_real_escape_string($koneksi, $_POST['admin_username']);
	$admin_password		= md5(mysqli_real_escape_string($koneksi, $_POST['admin_password']));
	
	$action 			= $_GET['action'];
	$notification_ip	= $_SERVER['REMOTE_ADDR'];
	
	if ($action == "in") {
		
		$cdb = mysqli_query($koneksi, "SELECT * FROM admin WHERE admin_username='$admin_username' AND admin_password='$admin_password' AND admin_status='Aktif'");
		if (mysqli_num_rows($cdb) == 1) {
			$cdt = mysqli_fetch_array($cdb);
			$admin_id		= $cdt['admin_id'];
			$admin_username	= $cdt['admin_username'];
			$admin_nama		= $cdt['admin_nama'];
			$postdated		= date("Y-m-d H:i:s");
			$_SESSION['admin_id'] 		= $cdt['admin_id'];
			$_SESSION['admin_username'] = $cdt['admin_username'];
			$_SESSION['admin_nama'] 	= $cdt['admin_nama'];
			$_SESSION['admincat_id'] 	= $cdt['admincat_id'];
			if ($cdt['admin_username']=="$admin_username" AND $cdt['admincat_id']=="AC001") {
				
				header("location:templates/index.php?m=dashboard");
								
			} elseif ($cdt['admin_username']=="$admin_username" AND $cdt['admincat_id']=="AC002") {
				
				header("location:../bridge.php");
				
			} elseif ($cdt['admin_username']=="$admin_username" AND $cdt['admincat_id']=="3") {
				
				header("location:../bridge.php");
				
			} elseif ($cdt['admin_username']=="$admin_username" AND $cdt['admincat_id']=="4") {
				
				header("location:../bridge.php");
				
			}
			
		} else {
			header("location:errorlogin.php");
		}
		
	} elseif ($action == "out") {
		
		unset($_SESSION['admin_id']);
		unset($_SESSION['admin_username']);
		unset($_SESSION['admin_nama']);
		unset($_SESSION['admincat_id']);
		header("location:index.php");
		
	}
?>
