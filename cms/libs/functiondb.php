<?php
	# ================================================= #
	# Database CMAS
	# ================================================= #
	$dbtype		= '';
	# ================================================= #
	#
	$ereport	= 0;
	# ================================================= #
	#
	$mailer 	= 'smtp';
	# ================================================= #
	#
	$host	 	= '127.0.0.1';
	# ================================================= #
	#
	$author		= '';
	# ================================================= #
	#
	$port		= '22';
	# ================================================= #
	#
	$smtpauth   = '1';
	# ================================================= #
	#
	$smtpsecure = 'none';
	# ================================================= #
	#
	$smtpport   = '25';
	# ================================================= #
	#
	$server 	= 'localhost';
	# ================================================= #
	#
	$username 	= 'ma956624_usolsop';
	# ================================================= #
	#
	$password 	= '*m2_OFG(#$z_';
	# ================================================= #
	#
	$database 	= 'ma956624_dbolsop';
	# ================================================= #
	#
	$koneksi	= @mysqli_connect($server, $username, $password, $database)or die ("<div style='text-align:center;padding:2% 0;background:#f9f9f9;color:#666;margin:20% auto;width:40%;font-family:Arial'>DATABASE COULD NOT CONNECT!</div>");
	# ================================================= #
	#
	if (mysqli_connect_errno()) { echo "DATABASE CONNECTION FAILED : " . mysqli_connect_error(); }
	# ================================================= #
?>