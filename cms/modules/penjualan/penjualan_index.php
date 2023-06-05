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
        <div class="filter">
            <div class="filtertit">Laporan Penjualan</div>
            <form action="\APPTE\PrintLaporanPenjualan" method="Post">
                <div id="fiterbox" class="clearfix">
                    <div class="filterleft">
                        <input name="filter1" type="date" class="form-control" required />
                    </div>
                    <div class="filtermidfirst">
                        -
                    </div>
                    <div class="filtermid">
                        <input name="filter2" type="date" class="form-control" required />
                    </div>
                    <div class="filterright">
                        <input type="submit" name="filter" value="Cetak Laporan" class="btnPrint"> 
                    </div>
                </div>
            </form>    
        </div>
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
                            <td><a href="?m=detailpenjualan&id=<?= $dt['penjualan_id'] ?>" class="btnedit"><i class="fa fa-info"></i></a></td>
                        </tr>
                    <?php } ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>
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
