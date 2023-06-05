<?php
	$adb = $koneksi->query("SELECT * FROM content WHERE contentcat_id = 'CC002' AND content_status = 'Aktif' ORDER BY content_id ASC LIMIT 1");
	$adt = $adb->fetch_array();
?>
<div id="bgabout">
	<div id="boabout">
		<div class="aboutfirst">
			<?= $adt['content_url']; ?>
		</div>
		<div class="aboutit">
			<h1><?= $adt['content_judul']; ?></h1>
		</div>
		<div class="aboutdesc">
			<?= $adt['content_desc']; ?>
		</div>
	</div>
</div>