<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Transaksi Penjualan
            </div>
            <div class="tabletopbtn">
                <!--<a href="#" id="myBtn">+ penjualan</a>-->
            </div>
        </div>
        <div id="boxprod" class="clearfix">
            <div class="prodleft">
                <div class="prodlefttit"><h3>List Data Produk</h3></div>
                <section class="consearch">
                    <form action="#">
                        <i class="fas fa-search"></i>
                        <input type="text" name="" id="search-item" placeholder="Search Products" onkeyup="search()">
                    </form>
                    <div class="product-box">
                        <div class="product-list" id="product-list">
                            <?php 
                                $pdb = $koneksi->query("SELECT * FROM barang ORDER BY barang_order ASC");
                                while($pdt = $pdb->fetch_array()){
                            ?>
                                <a href="index.php?m=keranjang&id=<?= $pdt['barang_id']; ?>">
                                    <div class="product">
                                        <img src="../assets/images/produk/<?= $pdt['barang_image'] ?>" alt="">
                                        <div class="p-details">
                                            <h2><?= $pdt['barang_nama'] ?></h2>
                                            <h3>Rp <?= number_format($pdt['barang_harga']); ?></h3>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>    
                        </div>
                    </div>    
                </section>
            </div>
            <div class="prodright">
                <div class="prodrighttit"><h3>List Data Pembelian</h3></div>
                <div class="prodrighttable">
                    <table class="tablestruk" width="100%" cellspaccing="0" cellpadding="0" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $total = 0;
                            ?>
                            <?php if(empty($_SESSION['keranjang'])){?>
                                <tr>
                                    <td colspan="6" align="center"> Keranjang kosong! Silahkan Pilih Produk Terlebih Dahulu!</td>
                                </tr>
                            <?php }else{?>
                                <?php foreach ($_SESSION['keranjang'] as $barang_id => $jumlah):?>
                                    <?php  
                                        $ambil = $koneksi->query("SELECT * FROM barang WHERE barang_id ='$barang_id'");
                                        $pecah = $ambil->fetch_assoc();
                                        $subharga = $pecah['barang_harga']*$jumlah;
                                    ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td align="center"><?= $pecah['barang_nama']; ?></td>
                                        <td align="center" width="1%"><?= $jumlah; ?></td>
                                        <td align="center">Rp <?= number_format($pecah['barang_harga']); ?></td>
                                        <td align="center">Rp <?= number_format($subharga); ?></td>
                                        <td align="center" width="1%">
                                            <a href="index.php?m=keranjanghapus&id=<?= $pecah['barang_id']; ?>" class="closetrans"><i class="fa-regular fa-circle-xmark"></i></a>
                                        </td>
                                    </tr>
                                    <?php $total += $subharga; ?>
                                    <?php endforeach?>
                            <?php } ?>       
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" align="left">Total</th>
                                <th align="center" colspan="2">Rp. <?= number_format($total); ?></th>
                            </tr>
                        </tfoot>
                    </table>    
                </div>
                <div class="btntrans">
                    <form action="index.php?m=transaksiaction" method="post" enctype="multipart/form-data">
                        <div class="btntransbox clearfix">
                            <div class="btntransleft">
                                <?php
                                $tanggal_penjualan	= date('Y-m-d');
                                $db                 = $koneksi->query("SELECT max(penjualan_id) as kodeTerbesar FROM penjualan WHERE tanggal_penjualan = '$tanggal_penjualan'");
                                $dt                 = $db->fetch_array();
                                $kode               = $dt['kodeTerbesar'];    
                                $urutan             = (int) substr($kode, 3, 3); 
                                $urutan++;
                                $huruf              = "TR";
                                $date				= date('Ymd');
                                $penjualan_id       = $huruf . $date . sprintf("%03s", $urutan);
                                
                                ?>
                                <div id="formbox">
                                    <input type="text" name="transaksi_id" value="<?= $penjualan_id ?>" class="form-control" readonly>
                                    <input type="hidden" name="admin_id" value="<?= $_SESSION['admin_id'];?>" class="form-control" readonly>
                                    <input type="hidden" name="total_beli" value="<?= $total;?>" class="form-control" id="beli" readonly>
                                </div>
                                <div class="formbox">
                                    <select name="customer_id" class="theSelect form-control" required>
                                        <option value="">- Pilih Customer - </option>
                                        <?php
                                            $mdb = $koneksi->query("SELECT * FROM customer");
                                            while($mdt = $mdb->fetch_array()){
                                        ?>
                                                <option value="<?= $mdt['customer_id']; ?>"><?= $mdt['customer_nama']; ?></option>
                                        <?php } ?>	
                                    </select>
                                </div>
                            </div>
                            <div class="btntransleft">
                                <div id="formbox">
                                    <input type="text" name="tanggal_penjualan"  value="<?= $date ?>"  class="form-control" readonly>
                                </div>
                                <div class="formbox">
                                    <input type="text" name="jumlah_bayar" onkeyup="disableBtn()" id="jumlahbeli" class="form-control" placeholder="Masukan Jumlah Bayar" required>
                                </div>
                            </div>
                        </div>
                        <div class="btnsubmittrans">
                            <input type="submit" class="submittrans" id="checkout" value="Checkout" disabled="disabled">
                        </div>    
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
<script type="text/javascript" src="../assets/js/select.js"></script>
<link rel="stylesheet" href="../assets/css/select.css">
<script>
	$(".theSelect").select2();
    function disableBtn(){
        var beli = document.getElementById('beli').value;
        var jumlah  = document.getElementById('jumlahbeli').value;
        var a = Number(beli);
        var b = Number(jumlah);
        if(b < a){
            $('#checkout').attr('disabled', 'disabled');
        }else{
            $('#checkout').removeAttr('disabled');
        }
    }
    
</script>
<script type="text/javascript">
    const search = () => {
        const searchbox = document.getElementById("search-item").value.toUpperCase();
        const storeitems = document.getElementById("product-list");
        const product = document.querySelectorAll(".product");
        const pname = storeitems.getElementsByTagName("h2");

        for(var i = 0; i < pname.length; i++){
            let match  = product[i].getElementsByTagName("h2")[0];
            if(match){
                let textValue = match.textContent ||match.innerHTML

                if(textValue.toUpperCase().indexOf(searchbox) > -1){
                    product[i].style.display = "";
                }else{
                    product[i].style.display = "none";
                }
            }
        }
    }
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
<?php if(isset($_SESSION['error'])){ ?>
	<script>
		Swal.fire({
		  title: 'Oops!',
		  text: '<?= $_SESSION['error']; ?>',
		  icon: 'error',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['error']);} ?>
