<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Penjualan
            </div>
            <div class="tabletopbtn">
                <!--<a href="#" id="myBtn">+ penjualan</a>-->
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM penjualan JOIN customer ON penjualan.customer_id = customer.customer_id ORDER BY penjualan_id DESC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr>
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td><?= $dt['penjualan_id'] ?></td>
                            <td><?= $dt['customer_nama'] ?></td>
                            <td><?= $dt['tanggal_penjualan'] ?></td>
                            <td><?= $dt['penjualan_status'] ?></td>
                            <td><a href="?m=detailpenjualan&id=<?= $dt['penjualan_id'] ?>" class="btnedit"><i class="fa fa-info"></i></a> <a href="#" id="myBtnEdit<?= $dt['penjualan_id']; ?>" class="btnhps"><i class="fa fa-credit-card"></i></a> <a href="?m=statuspenjualan&id=<?= $dt['penjualan_id'] ?>" class="btnedit"><i class="fa fa-check"></i></a></td>
                        </tr>
                    <?php } ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- modal edit -->
		<!--MODAL EDIT DATA-->
<?php
    $adb = $koneksi->query("SELECT * FROM penjualan ORDER BY penjualan_id ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['penjualan_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['penjualan_id']; ?>">&times;</span>
            <h2>Bukti Pembayaran</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=penjualanupdate" enctype="multipart/form-data">
			<?php
				$pdb = $koneksi->query("SELECT * FROM pembayaranjual WHERE penjualan_id = '$adt[penjualan_id]'");
				$pdt = $pdb->fetch_array();
			?>
            <div id="formbox" class="clearfix">
                <div class="formlabel">ID Transaksi</div>
                <div class="forminput">
                    <input name="penjualan_id" value="<?= $pdt['penjualan_id']; ?>" type="text" class="form-control" readonly />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Total Bayar</div>
                <div class="forminput">
                    <input name="total_bayar" value="<?= number_format($pdt['total_bayar']); ?>" type="text" class="form-control" readonly />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Bank</div>
                <div class="forminput">
                    <input name="bank" type="text" class="form-control"  value="<?= $pdt['bank']; ?>" readonly  />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">No Rekening</div>
                <div class="forminput">
                    <input name="no_rekening" type="text" class="form-control"  value="<?= $pdt['no_rekening']; ?>" readonly  />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Image</div>
                <div class="forminput">
                    <img src="../../../assets/images/buktipembayaran/<?= $pdt['bukti_transfer']; ?>" width="150">
                </div>
            </div>
			 <div id="formbox" class="clearfix">
                <div class="formlabel">Tanggal</div>
                <div class="forminput">
                    <input name="tanggal_pembayaran" type="text" class="form-control"  value="<?= $pdt['tanggal_pembayaran']; ?>" readonly  />
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
<?php } ?>	

<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0]; 
    btn.onclick = function() {
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script>
	<?php  
		$adb = $koneksi->query("SELECT * FROM penjualan ORDER BY penjualan_id ASC");
		while($adt = $adb->fetch_array()){
	?>
			var modaledit<?= $adt['penjualan_id'];?> 	= document.getElementById("myModalEdit<?= $adt['penjualan_id'];?>");
			var btnedit<?= $adt['penjualan_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['penjualan_id'];?>");
			var spanedit<?= $adt['penjualan_id'];?> 	= document.getElementById("close<?= $adt['penjualan_id'];?>");
			
			btnedit<?= $adt['penjualan_id'];?>.onclick = function() {
			  modaledit<?= $adt['penjualan_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['penjualan_id'];?>.onclick = function() {
			  modaledit<?= $adt['penjualan_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['penjualan_id'];?>) {
				modaledit<?= $adt['penjualan_id'];?>.style.display = "none";
			  }
			}
	<?php } ?>	
</script>
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
