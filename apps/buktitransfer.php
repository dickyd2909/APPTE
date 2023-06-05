<?php
	session_start();
?>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php
		include "../config/database.php";
		include "../libs/core.php";
	?>
	<?php site('logsvisitor');?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
		$mtdb = $koneksi->query("SELECT * FROM metadata");
		$mtdt = $mtdb->fetch_array();
	?>
	<meta name="description" content="<?= $mtdt['metadata_description']; ?>"> 
	<meta name="keywords" content="<?= $mtdt['metadata_keyword']; ?>">
	<meta charset="UTF-8">
	<meta name="generator" content="cms-phpnative">
	<meta name="robots" content="index, follow">
	<meta name="developer" content="dickydarmawan">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="author" content="Maliniart Olshop">
	<meta name="copyright" content="<?= $mtdt['metadata_copyright']; ?>">
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Maliniart Olshop" />
	<meta property="og:description" content="<?= $mtdt['metadata_description']; ?>" />
	<meta property="og:url" content="<?= $mtdt['metadata_url']; ?>" />
	<meta property="og:site_name" content="olshop maliniart" />
	<meta property="article:tag" content="online shop jakarta">
	<meta property="article:tag" content="market place jakarta">
	<meta property="article:tag" content="website jakarta">
    <link href="../cms/assets/images/logo/<?= $mtdt['metadata_gambar']; ?>" rel="shortcut icon" type="image/x-icon" />
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-latest.min.js" ></script>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="../libs/sweetalert2.min.css">
	<script src="../libs/sweetalert2.min.js"></script>
	<?php
		if(!isset($_SESSION['customer_email'])){
		   $_SESSION['error'] = "Silahkan Login terlebih dahulu!";
           die ("<meta http-equiv='refresh' content='0; url=login'>");
        }
	?>
	
    <title>Konfirmasi Pembayaran</title>
</head>
<body>
    <!-- section top -->
    <?php site('menu');?>
    <!-- section top -->
	<!-- section jumbotron -->
	<div id="bgjumbo">
		<div class="jumboimg">
			<img src="../assets/images/jumbo.jpg" />
		</div>
	</div>
	<!-- section jumbotron -->
	<!-- section detail-->
	<div id="bgcart">
		<div id="bocart" class="clearfix">
			<div class="cartleft">
				<div id="cart" class="clearfix">
					<div class="carttitleft">
						<h1>Shopping Detail</h1>
					</div>
				</div>
				<?php $nomor = 1;?>
				<?php  
					$id		= $_GET['id'];
					$ambil 	= $koneksi->query("SELECT * FROM `detailpenjualan` INNER JOIN barang ON detailpenjualan.barang_id = barang.barang_id WHERE penjualan_id = '$id'");
					while($dt 	= $ambil->fetch_array()){
				?>
					<div id="cartbox" class="clearfix">
						<div class="cartbox1">
							<div class="cartbox1img">
								<img src="../cms/assets/images/produk/<?= $dt['barang_image']; ?>">
							</div>
						</div>
						<div class="cartbox2">
							<h2><?= $dt['barang_nama']; ?></h2>
							<h3>In Stok <i class="fa fa-check"></i></h3>
						</div>
						<div class="cartbox3">
							<h3><?= $dt['qty']; ?>x</h3>
						</div>
						<div class="cartbox4">
							<h3>Rp. <?= number_format($dt['total_harga']); ?></h3>
						</div>
						<div class="cartbox5">
							<?= $dt['penjualan_status']; ?>
						</div>
					</div>
					<?php $nomor++;?>
				<?php } ?>
			</div>	
			<div class="cartright">
				<div class="cartrightbox">
					<div class="cartrighttit">
						PROOF OF PAYMENT
					</div>
					<?php
						$pdb = $koneksi->query("SELECT * FROM pembayaranjual WHERE penjualan_id = '$id'");
						$row = mysqli_num_rows($pdb);
						if($row == 0){
					?>
						<form action="pembayaran" method="post"  enctype="multipart/form-data">
							<div class="cartrightitembox">
								<div class="item clearfix">
									<div class="itemleft">
										<h4>TOTAL</h4>
									</div>
									<div class="itemright">
										<?php 
											$id		= $_GET['id'];
											$tdb = $koneksi->query("SELECT SUM(total_harga) as total FROM detailpenjualan WHERE penjualan_id = '$id' ");
											$total = $tdb->fetch_assoc();
										?>
										<h2>Rp. <?= number_format($total['total']); ?></h2>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										ID Transaksi
									</div>
									<div class="loginformbox">
										<input name="penjualan_id" type="text" class="formboxlogin" value="<?= $id; ?>" readonly>
										<input name="admin_id" type="hidden" class="formboxlogin" value="AD001" readonly>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										Total
									</div>
									<div class="loginformbox">
										<input name="total_bayar" type="text" class="formboxlogin" value="<?= $total['total']; ?>" readonly>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										Bank
									</div>
									<div class="loginformbox">
										<input name="bank" type="text" class="formboxlogin" required>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										No Rekening
									</div>
									<div class="loginformbox">
										<input name="no_rekening" type="text" class="formboxlogin" required>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										Upload
									</div>
									<div class="loginformbox">
										<input name="bukti_transfer" type="file" class="formboxlogin" required>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										Date
									</div>
									<div class="loginformbox">
										<input name="tanggal_pembayaran" type="date" class="formboxlogin" required>
									</div>
								</div>
							</div>
							<div class="itembtn">
								<input name="submit" type="submit" value="UPLOAD" class="btnitem">
							</div>
						</form>
					  <?php }else{ ?>
						<?php $pdt = $pdb->fetch_assoc(); ?>
						<form action="pembayaran" method="post"  enctype="multipart/form-data">
							<div class="cartrightitembox">
								<div class="item clearfix">
									<div class="itemleft">
										<h4>TOTAL</h4>
									</div>
									<div class="itemright">
										<?php 
											$id		= $_GET['id'];
											$tdb = $koneksi->query("SELECT SUM(total_harga) as total FROM detailpenjualan WHERE penjualan_id = '$id' ");
											$total = $tdb->fetch_assoc();
										?>
										<h2>Rp. <?= number_format($total['total']); ?></h2>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										ID Transaksi
									</div>
									<div class="loginformbox">
										<input name="penjualan_id" type="text" class="formboxlogin" value="<?= $id; ?>" readonly>
										<input name="admin_id" type="hidden" class="formboxlogin" value="AD001" readonly>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										Total
									</div>
									<div class="loginformbox">
										<input name="total_bayar" type="text" class="formboxlogin" value="<?= $total['total']; ?>" readonly>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										Bank
									</div>
									<div class="loginformbox">
										<input name="bank" type="text" class="formboxlogin" value="<?= $pdt['bank'] ?>" readonly>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										No Rekening
									</div>
									<div class="loginformbox">
										<input name="no_rekening" type="text" class="formboxlogin" value="<?= $pdt['no_rekening'] ?>" readonly>
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										Image
									</div>
									<div class="loginformbox">
										<img src="../assets/images/buktipembayaran/<?= $pdt['bukti_transfer']; ?>" width="150">
									</div>
								</div>
								<div class="loginform">
									<div class="loginformtit">
										Date
									</div>
									<div class="loginformbox">
										<input name="tanggal_pembayaran" type="date" class="formboxlogin" value="<?= $pdt['tanggal_pembayaran'] ?>" readonly>
									</div>
								</div>
							</div>
						</form>
					  <?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- section detail-->
    <!-- section hotproduct -->
    <?php site('hotproduct');?>
	<?php site('footer');?>
</body>
</html>
<?php if(isset($_SESSION['success'])){ ?>
	<script>
		Swal.fire({
		  title: 'Sukses!',
		  text: '<?= $_SESSION['success']; ?>',
		  icon: 'success',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['success']);} ?>
<?php if(isset($_SESSION['error'])){ ?>
	<script>
		Swal.fire({
		  title: 'Error!',
		  text: '<?= $_SESSION['error']; ?>',
		  icon: 'error',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['error']);} ?>