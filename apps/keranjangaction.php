<?php  
session_start();
$barang_id = $_POST['barang_id'];
if (isset($_SESSION['keranjang'][$barang_id]))
{
	$_SESSION['keranjang'][$barang_id]+=$_POST['jumlah'];
}
else
{
	$_SESSION['keranjang'][$barang_id] = $_POST['jumlah'];
}
echo "<script>location='keranjang';</script>";
?>