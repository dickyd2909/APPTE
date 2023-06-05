<div id="bgall">
	<div id="boall">
		<div class="alltit">
			<h3>ALL PRODUCT</h3>
			<hr>
		</div>
		<div id="all" class="clearfix">
			<?php
				$adb = $koneksi->query("SELECT * FROM barang");
				while($adt = $adb->fetch_array()){
			?>
			<a href="detailOf-<?= $adt['barang_id']; ?>">
				<div class="allbox">
					<div class="allimg">
						<?php if(!empty($adt['barang_image'])) { ?>
							<img src="../cms/assets/images/produk/<?= $adt['barang_image']; ?>" alt="website jakarta">
						<?php }else{ ?>
							<img src="../cms/assets/image/no-image.png" alt="">
						<?php } ?>
					</div>
					<div class="hottit clearfix">
						<div class="hottitkiri">
							<h2><?= $adt['barang_nama']; ?></h2>
						</div>
						<div class="hotkanan">
							Rp.<?= number_format($adt['barang_harga']); ?>
						</div>
					</div>
					<div class="hotdesc">
						<?= $adt['barang_jenis']; ?>
					</div>
				</div>
			</a>	
			<?php } ?>	
		</div>
	</div>
</div>