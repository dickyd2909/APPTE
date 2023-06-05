<?php
	session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/images/fav.png" rel="shortcut icon" type="image/x-icon" />
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-latest.min.js" ></script>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="../libs/sweetalert2.min.css">
	<script src="../libs/sweetalert2.min.js"></script>
	<?php
		include "../config/database.php";
		if(!isset($_SESSION['customer_email'])){
		   $_SESSION['error'] = "Silahkan Login terlebih dahulu!";
           die ("<meta http-equiv='refresh' content='0; url=login'>");
        }
	?>
	
    <title>Riwayat Belanja</title>
</head>
<body>
    <!-- section top -->
    <?php include "menu.php";?>
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
						<h1>SHOPPING HISTORY</h1>
					</div>
				</div>
				<div id="cartbox" class="clearfix">
						<div class="cartbox1">
							ID TRANSAKSI
						</div>
						<div class="cartbox2">
							ID CUSTOMER
						</div>
						<div class="cartbox3">
							NAMA CUSTOMER
						</div>
						<div class="cartbox4">
							TANGGAL PEMBELIAN
						</div>
						<div class="cartbox5">
							#
						</div>
					</div>
				<?php $nomor = 1;?>
				<?php  
					$ambil = $koneksi->query("SELECT * FROM penjualan JOIN customer ON penjualan.customer_id = customer.customer_id WHERE penjualan.customer_id ='$_SESSION[customer_id]'");
					while($dt = $ambil->fetch_assoc()){
				?>
					<div id="cartbox" class="clearfix">
						<div class="cartbox1">
							<h2><?= $dt['penjualan_id']; ?></h2>
						</div>
						<div class="cartbox2">
							<h3><?= $dt['customer_id']; ?></h3>
						</div>
						<div class="cartbox3">
							<h3><?= $dt['customer_nama']; ?></h3>
						</div>
						<div class="cartbox4">
							<h3><?= $dt['tanggal_penjualan']; ?></h3>
						</div>
						<div class="cartbox5">
							<a href="buktitransfer-<?= $dt['penjualan_id']; ?>" class="btnpay"><i class="fa fa-credit-card"></i></a>
						</div>
					</div>
					<?php $nomor++;?>
				<?php } ?>
			</div>	
			<div class="cartright">
				<div class="cartrightbox">
					<div class="cartrighttit">
						ORDER HISTORY :
					</div>
					<div class="cartrightitembox">
						<div class="item clearfix">
							<div class="itemleft">
								<?php $ambil = $koneksi->query("SELECT * FROM penjualan JOIN customer ON penjualan.customer_id = customer.customer_id WHERE penjualan.customer_id ='$_SESSION[customer_id]'");?>
								<h4><?= count($ambil); ?> ORDER</h4>
							</div>
							<div class="itemright">
							</div>
						</div>
						<div class="item clearfix">
							Thank you for shopping here!
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- section detail-->
    <?php include "hotproduct.php";?>
    <?php include "footer.php";?>
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