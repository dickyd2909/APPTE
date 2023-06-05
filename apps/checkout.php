<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../config/database.php";
	
	$customer_id		= mysqli_real_escape_string($koneksi, $_POST['customer_id']);
	$tanggal_penjualan	= date('Y-m-d');
	$admin_id			= "AD001";
	$db                 = $koneksi->query("SELECT max(penjualan_id) as kodeTerbesar FROM penjualan WHERE tanggal_penjualan = '$tanggal_penjualan'");
	$dt                 = $db->fetch_array();
	$kode               = $dt['kodeTerbesar'];    
	$urutan             = (int) substr($kode, 3, 3); 
	$urutan++;
	$huruf              = "TR";
	$date				= date('Ymd');
	$penjualan_id       = $huruf . $date . sprintf("%03s", $urutan);
	
	$koneksi->query("INSERT INTO penjualan (penjualan_id, customer_id, admin_id, tanggal_penjualan) VALUES ('$penjualan_id', '$customer_id', '$admin_id', '$tanggal_penjualan')") or die (mysqli_error($koneksi)) or die (mysqli_error($koneksi));
	
	
	foreach ($_SESSION["keranjang"] as $barang_id => $jumlah) 
	{
	//	mendapatkan data barang berdasarkan id prosduk
		$db2                = $koneksi->query("SELECT max(detailpenjualan_id) as kodeTerbesar FROM detailpenjualan");
		$dt2                = $db2->fetch_array();
		$kode               = $dt2['kodeTerbesar'];    
		$urutan             = (int) substr($kode, 3, 3); 
		$urutan++;
		$huruf              = "DT";
		$detailpenjualan_id	= $huruf . sprintf("%03s", $urutan);
		
		$ambil=$koneksi->query("SELECT * FROM barang WHERE barang_id='$barang_id'");
		$perbarang = $ambil->fetch_assoc();

		$barang_nama = $perbarang['barang_nama'];
		$barang_harga = $perbarang['barang_harga'];
		echo $subharga = $perbarang['barang_harga']*$jumlah;
		
		$koneksi->query("INSERT INTO detailpenjualan (detailpenjualan_id, penjualan_id, barang_id, qty, harga, total_harga, penjualan_status) VALUES ('$detailpenjualan_id', '$penjualan_id', '$barang_id', '$jumlah', '$barang_harga', '$subharga', 'Proses') ") or die (mysqli_error($koneksi));

		//skrip update stok
		$koneksi->query("UPDATE barang SET barang_stok=barang_stok-$jumlah WHERE barang_id='$barang_id'");
	}

	// mengkosongkan keranjang belanja

	unset($_SESSION["keranjang"]);
	$_SESSION['success'] = 'Pembelian berhasil! silahkan lakukan konfirmasi pembayaran!';
	echo "<meta http-equiv='refresh' content='0; url=riwayat'>";
?>