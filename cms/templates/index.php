<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        
        if(isset($_GET['admin_username'])){
            $admin_username=$_GET['admin_username'];
        }
        if(empty($_GET['admin_username'])){
            $admin_username=$_SESSION['admin_username'];
        }
        if(!isset($_SESSION['admin_username'])){
            die ("<meta http-equiv='refresh' content='0; url=../session.php'>");
        }
        include "../libs/functiondb.php";
    ?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="../assets/images/fav.png" rel="shortcut icon" type="image/x-icon" />
    <link href="../assets/css/admin.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/table.css" rel="stylesheet" type="text/css" />
	<script src="../libs/ckeditor/ckeditor.js"></script>
	<script src="../libs/ckeditor/samples/sample.js"></script>
	<link href="../libs/ckeditor/samples/sample.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php include "../libs/function.php";?> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../assets/libs/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-latest.min.js" ></script>
    <script  charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script src="../assets/libs/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "iDisplayLength": 10
            } );
        } );
    </script>
    <title>Dashboard</title>
</head>
<body>
    <div id="bgfirst">
        <div id="bofirst" class="clearfix">
			<div class="firstbackground">
				<div class="sidebar" id="sidebar">
					<div class="closebar" onclick="btntoogle();">
						<i class="fa fa-times"></i>
					</div>
					<div class="sidebarimg">
						<img src="../assets/images/logo.png" alt="">
					</div>
					<div class="sidebartit">
						<i class="fas fa-chart-line"></i> Dashboard
					</div>
					<div class="sidebarlink" id="nav">
						<ul>
							<?php
								if(isset($_GET['m'])){
									if($_GET['m'] == 'dashboard'){
										$db = "active";
									}else{
										$db = "";
									}

									if($_GET['m'] == 'admin'){
										$ad = "active";
									}else{
										$ad = "";
									}
									
									if($_GET['m'] == 'admincat'){
										$ac = "active";
									}else{
										$ac = "";
									}

									if($_GET['m'] == 'customer'){
										$cs = "active";
									}else{
										$cs = "";
									}

									if($_GET['m'] == 'produk'){
										$pd = "active";
									}else{
										$pd = "";
									}

									if($_GET['m'] == 'penjualan'){
										$pj = "active";
									}else{
										$pj = "";
									}

									if($_GET['m'] == 'supplier'){
										$sp = "active";
									}else{
										$sp= "";
									}

									if($_GET['m'] == 'pembelian'){
										$pb = "active";
									}else{
										$pb = "";
									}
									if($_GET['m'] == 'slideshow'){
										$sd = "active";
									}else{
										$sd = "";
									}
									if($_GET['m'] == 'menu'){
										$mn = "active";
									}else{
										$mn = "";
									}
									if($_GET['m'] == 'contentcat'){
										$cc = "active";
									}else{
										$cc = "";
									}
									if($_GET['m'] == 'content'){
										$co = "active";
									}else{
										$co = "";
									}
									if($_GET['m'] == 'berita'){
										$br = "active";
									}else{
										$br = "";
									}
								}
							?>
							<li><a href="index.php?m=dashboard" class="navlink <?= $db; ?>">Dashboard</a></li>
							<li><a href="index.php?m=admincat" class="navlink <?= $ac; ?>">Admin Category</a></li>
							<li><a href="index.php?m=admin" class="navlink <?= $ad; ?>">Admin</a></li>
							<li><a href="index.php?m=customer" class="navlink <?= $cs; ?>">Customer</a></li>
							<li><a href="index.php?m=produk" class="navlink <?= $pd; ?>">Product</a></li>
							<li><a href="index.php?m=penjualan" class="navlink <?= $pj; ?>">Selling</a></li>
							<li><a href="index.php?m=slideshow" class="navlink <?= $sd; ?>">Slideshow</a></li>
							<li><a href="index.php?m=menu" class="navlink <?= $mn; ?>">Menu</a></li>
							<li><a href="index.php?m=contentcat" class="navlink <?= $cc; ?>">Content Category</a></li>
							<li><a href="index.php?m=content" class="navlink <?= $co; ?>">Content</a></li>
							<li><a href="index.php?m=berita" class="navlink <?= $br; ?>">Berita</a></li>
						</ul>
					</div>
					<div class="sidebarview">
						<a href="../../beranda" class="btnview" target="_blank">View Website</a>
					</div>	
					<div class="sidebarlogout">
						<a href="../login.php?action=out" class="btnlogout">Logout</a>
					</div>
				</div>
				<div class="content">
					<div id="bgtop">
						<div id="botop" class="clearfix">
							<div class="tooglebar">
								<a><i class="fa fa-bars" onclick="btntoogle();"></i></a> <span>Dashboard</span>
							</div>
							<div class="avatar">
								<div class="avatarsetting">
									<i class="fa fa-cog"></i>
									<div class="dropdown-content">
									  <div class="dropdown-title">Setting Dashboard</div>
									  <a href="?m=adminsetting">Profile</a>
									  <a href="?m=logosetting">Logo</a>
									  <a href="?m=metadatasetting">Metadata</a>
									  <a href="?m=logsvisitor">Logs Visitor</a>
									</div>
								</div>
								<div class="avatarsetting">
									<div class="avatarnotif">
										<?php
											$ndb = $koneksi->query("SELECT * FROM logscontent WHERE logscontent_read = '1'");
											$nrow = mysqli_num_rows($ndb);
											
										?>
											<i class="fa fa-bell"></i>
										<?php if($nrow > 0){ ?>	
											<span><?= $nrow; ?></span>
										<?php } ?>
									</div>	
									<div class="dropdown-content2">
									  <div class="dropdown-title2">Notification</div>
										<?php
											$ndb = $koneksi->query("SELECT * FROM logscontent INNER JOIN admin ON logscontent.admin_id = admin.admin_id ORDER BY logscontent_id DESC LIMIT 5");
											while($ndt = $ndb->fetch_array()){ 
										?>
										<div class="dropdown-list"><span><?= $ndt['postdated']; ?></span><br><?= $ndt['admin_username']; ?> <?= $ndt['logscontent_status']; ?> <?= $ndt['logscontent_desc']; ?></div>
									  <?php } ?>
									  <a href="?m=logscontent">See All</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- section content yang bisa diubah -->
					<div id="bgcont">
						<div id="bocont">
							<?php include "../routes/web.php";?>
						</div>
					</div>
				</div>
			</div>	
        </div>
    </div>
</body>
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("nav");
var btns = header.getElementsByClassName("navlink");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}

function btntoogle(){
	var nav = document.getElementById("sidebar");
	nav.classList.toggle("active");
}
</script>
</html>