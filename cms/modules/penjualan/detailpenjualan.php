<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Detail Penjualan
            </div>
            <div class="tabletopbtn">
                <a href="?m=penjualan" id="myBtn"> Kembali</a>
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
						<th>Harga</th>
						<th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
						$id = $_GET['id'];
                        $db = $koneksi->query("SELECT * FROM detailpenjualan JOIN barang ON detailpenjualan.barang_id = barang.barang_id WHERE penjualan_id = '$id' ORDER BY detailpenjualan_id DESC") or die (mysqli_error($koneksi));
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr>
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td><img src="../assets/images/produk/<?= $dt['barang_image']; ?>" width="100"></td>
                            <td><?= $dt['penjualan_id']; ?></td>
                            <td><?= $dt['barang_nama']; ?></td>
                            <td><?= $dt['qty']; ?></td>
							<td>Rp.<?= number_format($dt['harga']); ?></td>
							<td>Rp.<?= number_format($dt['total_harga']); ?></td>
                        </tr>
                    <?php } ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>