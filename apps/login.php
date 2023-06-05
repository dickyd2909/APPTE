<?php session_start();?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
		include "../config/database.php";
		include "../libs/core.php";
	?>
    <?php
		$mtdb = $koneksi->query("SELECT * FROM metadata");
		$mtdt = $mtdb->fetch_array();
	?>
	<?php site('logsvisitor');?>
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
    <title>Ipsum Official Website Online Store</title>
</head>
<body>
    <!-- section top -->
    <?php site('menu');?>
    <!-- section top -->
	<div id="bgjumbo">
		<div class="jumboimg">
			<img src="../assets/images/jumbo.jpg" />
		</div>
	</div>
    <!-- section login -->
    <div id="bglogin">
		<div id="bologin">
			<div class="login">
				<div class="loginwel">
					<h1>Welcome To Website Onlineshop Ipsum </h1>
				</div>
				<div class="logintit">
					Login
				</div>
				<div class="logindesc">
					Please Enter Your Email And Password 
				</div>
			</div>	
			<form action="loginaction" method="post">
				<div class="loginform">
					<div class="loginformtit">
						Email
					</div>
					<div class="loginformbox">
						<input name="customer_email" type="text" class="formboxlogin" required>
					</div>
				</div>
				<div class="loginform">
					<div class="loginformtit">
						Password
					</div>
					<div class="loginformbox">
						<input name="customer_password" type="password" class="formboxlogin" required>
					</div>
				</div>
				<div class="loginbtn">
					<input type="submit" name="submit" value="SUBMIT" class="btncheck">
				</div>
				<div class="loginbottom clearfix">
					<div class="loginbotleft">
						Sudah punya akun?
					</div>
					<div class="loginbotright">
						<a href="registrasi">Registrasi</a>
					</div>
				</div>
			</form>	
		</div>
	</div>
    <!-- section all product -->

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