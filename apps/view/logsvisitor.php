<?php
	date_default_timezone_set("Asia/Jakarta");
	include "../../config/database.php";
	$visitor_ip		= $_SERVER['REMOTE_ADDR'];
	$visitor_agent	= $_SERVER['HTTP_USER_AGENT'];
	$visitor_date	= date("Y-m-d H:i:s");
	$visitor_online	= time();
	
	$stdb = mysqli_query($koneksi, "SELECT * FROM logsvisitor WHERE visitor_ip='$visitor_ip' AND visitor_agent='$visitor_agent'");
	$find = mysqli_num_rows($stdb);
	if ($find == 0) {
		mysqli_query($koneksi, "INSERT INTO logsvisitor (visitor_id, visitor_ip, visitor_date, visitor_hits, visitor_online, visitor_agent) VALUES('visitor_id', '$visitor_ip', '$visitor_date', '1', '$visitor_online', '$visitor_agent')");
	} else {
		mysqli_query($koneksi, "UPDATE logsvisitor SET visitor_date = '$visitor_date', visitor_hits = visitor_hits+1, visitor_online='$visitor_online' WHERE visitor_ip='$visitor_ip'");
	}
?>