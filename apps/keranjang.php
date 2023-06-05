<?php
	session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
		include "../config/database.php";
		if(!isset($_SESSION['keranjang'])){
		   $_SESSION['error'] = "Silahkan Belanja terlebih dahulu!";
           die ("<meta http-equiv='refresh' content='0; url=beranda'>");
        }
		include "../libs/core.php";
	?>
	<?php site('logsvisitor');?>
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
	
    <title>Keranjang</title>
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
						<h1>YOUR CART  <span><?= count($_SESSION['keranjang']); ?> Item <span></h1>
					</div>
					<div class="carttitright">
						<a href="beranda">Continue Shopping</a>
					</div>
				</div>
				<?php $nomor = 1;?>
				<?php $total = 0;?>
				<?php foreach ($_SESSION['keranjang'] as $barang_id => $jumlah):?>
					<?php  
						$ambil = $koneksi->query("SELECT * FROM barang WHERE barang_id ='$barang_id'");
						$pecah = $ambil->fetch_assoc();
						$subharga = $pecah['barang_harga']*$jumlah;
					?>
					<div id="cartbox" class="clearfix">
						<div class="cartbox1">
							<div class="cartbox1img">
								<img src="../cms/assets/images/produk/<?= $pecah['barang_image']; ?>">
							</div>
						</div>
						<div class="cartbox2">
							<h2><?= $pecah['barang_nama']; ?></h2>
							<h3>In Stok <i class="fa fa-check"></i></h3>
						</div>
						<div class="cartbox3">
							<h3><?= $jumlah; ?>x</h3>
						</div>
						<div class="cartbox4">
							<h3>Rp. <?= number_format($subharga); ?></h3>
						</div>
						<div class="cartbox5">
							<a href="#"><i class="fa fa-close"></i></a>
						</div>
					</div>
					<?php $nomor++;?>
					<?php $total+=$subharga;?>
				<?php endforeach?>
			</div>	
			<div class="cartright">
				<div class="cartrightbox">
					<div class="cartrighttit">
						ORDER SUMMARY :
					</div>
					<div class="cartrightitembox">
						<div class="item clearfix">
							<div class="itemleft">
								<h4><?= count($_SESSION['keranjang']); ?> Product</h4>
							</div>
							<div class="itemright">
							</div>
						</div>
						<div class="item clearfix">
							<div class="itemleft">
								<h4>Product Total </h4>
							</div>
							<div class="itemright">
								<h5>Rp.<?= number_format($total); ?></h5>
							</div>
						</div>	
						<div class="item clearfix">
							<div class="itemleft">
								<h4>Delivery</h4>
							</div>
							<div class="itemright">
								<h5>FREE</h5>
							</div>
						</div>
						<div class="item clearfix">
							<div class="itemleft">
								<h3>Total</h3>
							</div>
							<div class="itemright">
								<h5><?= number_format($total); ?></h5>
							</div>
						</div>
					</div>
					<div class="itembtn">
						<form action="checkout" method="post">
							<input name="customer_id" value="<?= $_SESSION['customer_id']; ?>" type="hidden">
							<input name="submit" type="submit" value="CHECKOUT" class="btnitem">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- section detail-->
    <!-- section hotproduct -->
    <?php site('hotproduct'); ?>
    
    <?php site('footer');?>
</body>
</html>