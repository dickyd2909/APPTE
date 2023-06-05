<!-- section hotproduct -->
<div id="bghot">
	<div id="bohot">
		<div class="hotpen">
			HOT PRODUCT
			<hr>
		</div>
		<div id="hot" class="clearfix">
			<?php
				$hdb = $koneksi->query("SELECT * FROM barang ORDER BY barang_id DESC LIMIT 5");
				while($hdt = $hdb->fetch_array()){
			?>	
				<a href="detailOf-<?= $hdt['barang_id']; ?>">
					<div class="hotbox">
						<div class="hotimg">
							<?php if(!empty($hdt['barang_image'])) { ?>
								<img src="../cms/assets/images/produk/<?= $hdt['barang_image']; ?>" alt="">
							<?php }else{ ?>
								<img src="../cms/assets/image/no-image.png" alt="">
							<?php } ?>
						</div>
						<div class="hottit clearfix">
							<div class="hottitkiri">
								<h2><?= $hdt['barang_nama']; ?></h2>
							</div>
							<div class="hotkanan">
								Rp.<?= number_format($hdt['barang_harga']); ?>
							</div>
						</div>
						<div class="hotdesc">
							<?= $hdt['barang_jenis']; ?>
						</div>
					</div>
				</a>	
			<?php } ?>
		</div>    
	</div>
</div>