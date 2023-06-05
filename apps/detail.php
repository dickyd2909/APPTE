<?php
	session_start();
?>
<html lang="en">
<head>
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
	<?php
		$id = mysqli_real_escape_string($koneksi, $_GET['id']);
		$db = $koneksi->query("SELECT * FROM barang WHERE barang_id = '$id'");
		$dt = $db->fetch_array();
	?>
    <title>Detail <?= $dt['barang_nama']; ?></title>
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
	<div id="bgdetail">
		<div id="bodetail" class="clearfix">
			<div class="detailleft">
				<div class="detailimg">
					<?php if(empty($dt['barang_image'])){ ?>
						<img src="../cms/assets/images/no-image.png">
					<?php }else{ ?>
						<img src="../cms/assets/images/produk/<?= $dt['barang_image']; ?>">
					<?php } ?>
				</div>
			</div>
			<div class="detailright">
				<div class="detailrighttit">
					<i><h1><?= $dt['barang_nama']; ?></h1></i>
				</div>
				<div class="detailrightdesc">
					<?= $dt['barang_jenis']; ?>
				</div>
				<div class="detailrightprice">
					Rp.<?= number_format($dt['barang_harga']); ?>
				</div>
				<div class="detailrightstok">
					Stok Tersedia : <span><?= $dt['barang_stok']; ?></span>
				</div>
				<form action="keranjangaction" method="post">
					<div class="detailrightform clearfix">
						<div class="detailformleft">
							<input name="jumlah" value="1" min="1" type="number" class="formjml">
							<input name="barang_id" type="hidden" value="<?= $dt['barang_id']; ?>" class="formjml">
						</div>
						<div class="detailformright">
							<?php if(isset($_SESSION['customer_email'])){ ?>
								<input type="submit" name="submit" value="Add To Cart" class="btncheck">
							<?php }else{ ?>
								<a href="registrasi" class="btnregis">Registration </a>
							<?php } ?>							
						</div>
					</div>
				</form>
				<div class="detailterm">
					<div class="term">
						<i class="fa fa-truck"></i> Free Delivery
					</div>
					<div class="term">
						<i class="fa fa-info-circle"></i> All Size Available
					</div>
					<div class="term">
						<i class="fa fa-check-circle"></i> Read The Term And Conditions We Have
					</div>
					
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