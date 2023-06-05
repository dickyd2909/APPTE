<div id="bgtop">
	<div id="botop" class="clearfix">
		<?php
			$ldb = $koneksi->query("SELECT * FROM logo");
			$ldt = $ldb->fetch_array();
		?>
		<div class="topleft">
			<div class="topleftimg">
				<a href="beranda"><img src="../cms/assets/images/logo/<?= $ldt['logo_gambar']; ?>" alt="<?= $ldt['logo_alt']; ?>" title="<?= $ldt['logo_title']; ?>" width="<?= $ldt['logo_lebar']; ?>" height="<?= $ldt['logo_panjang']; ?>"></a>
			</div>
		</div>
		<div class="topright">
			<div class="topnav">
				<ul>
					<?php
						$mdb = $koneksi->query("SELECT * FROM menu WHERE menu_status = 'Aktif' ORDER BY menu_order ASC");
						while($mdt = $mdb->fetch_array()){
					?>
						<li><a href="<?= $mdt['menu_url'] ?>"><?= $mdt['menu_nama'] ?></a></li>
					<?php } ?>
					<?php if(isset($_SESSION['customer_email'])){ ?>
						<li><a href="logout">LOGOUT</a></li>
					<?php }else{ ?>
						<li><a href="login">LOGIN</a></li>
					<?php } ?>
				</ul>
				<div class="keranjang clearfix">
				<a href="keranjang" class="cart"><i class="fa fa-shopping-bag"></i>
				<?php if(isset($_SESSION['keranjang'])) { ?>
					<span class="cartnum"><?= count($_SESSION['keranjang']); ?></span>
				<?php } ?></a>
				<div class="dropdown">
					<span class="nameacc"><?php if(isset($_SESSION['customer_email'])){ echo $_SESSION['customer_nama'];}?></span>
					<div class="dropdown-content">
						<a href="riwayat">Riwayat Belanja</a>
					</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>