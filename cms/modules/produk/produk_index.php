<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Produk
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Produk</a>
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM barang  ORDER BY barang_id DESC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr>
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td width="1%" align="center">
                                <?php if(!empty($dt['barang_image'])){ ?>
                                    <img src="../assets/images/produk/<?= $dt['barang_image']; ?>" width="100">
                                <?php } else { ?>
                                    <img src="../assets/images/no-image.png" width="100">
                                <?php } ?>
                            </td>
                            <td><?= $dt['barang_nama'] ?></td>
                            <td><?= $dt['barang_jenis'] ?></td>
                            <td>Rp.<?= number_format($dt['barang_harga']); ?></td>
                            <td><?= $dt['barang_stok'] ?></td>
                            <td><a href="#" id="myBtnEdit<?= $dt['barang_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhps" data-nama="<?= $dt['barang_nama']; ?>" data-url="index.php?m=produkhapus&id=<?= $dt['barang_id']; ?>"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    <?php } ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal tambah -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Barang Tambah</h2>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?m=produksimpan" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="barang_nama" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Jenis Barang</div>
                <div class="forminput">
                    <input name="barang_jenis" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Harga</div>
                <div class="forminput">
                    <input type="text" name="barang_harga" class="form-control" onkeypress="return hanyaAngka(event)"/>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Stok</div>
                <div class="forminput">
                     <input name="barang_stok" onkeypress="return hanyaAngka(event)" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Image</div>
                <div class="forminput">
                     <input name="barang_image" type="file"  class="form-control"  />
                </div>
            </div>
            <div class="formsubmit">
                <input name="submit" type="submit" value="Simpan" class="btnsubmit"></input>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- modal edit -->
		<!--MODAL EDIT DATA-->
<?php
    $adb = $koneksi->query("SELECT * FROM barang ORDER BY barang_id ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['barang_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['barang_id']; ?>">&times;</span>
            <h2>Edit barang</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=produkupdate" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="barang_id" value="<?= $adt['barang_id']; ?>" type="hidden" class="form-control"/>
                    <input name="barang_nama" value="<?= $adt['barang_nama']; ?>" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Jenis</div>
                <div class="forminput">
                    <input name="barang_jenis" value="<?= $adt['barang_jenis']; ?>" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Harga</div>
                <div class="forminput">
                     <input name="barang_harga" value="<?= $adt['barang_harga']; ?>" type="text" onkeypress=”return hanyaAngka(event)” class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Stok</div>
                <div class="forminput">
                     <input name="barang_stok" value="<?= $adt['barang_stok']; ?>" type="text" onkeypress=”return hanyaAngka(event)” class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Upload</div>
                <div class="forminput">
                     <input name="barang_image" type="file"  class="form-control"  />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Image</div>
                <div class="forminput">
                     <div class="framimg">
                        <?php if(!empty($adt['barang_image'])){ ?>
                            <img src="../assets/images/produk/<?= $adt['barang_image']; ?>">
                        <?php } else { ?>
                            <img src="../assets/images/no-image.png">
                        <?php } ?>
                     </div>
                </div>
            </div>
            <div class="formsubmit">
                <input name="edit" type="submit" value="Update" class="btnsubmit"></input>
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
		$adb = $koneksi->query("SELECT * FROM barang ORDER BY barang_id ASC");
		while($adt = $adb->fetch_array()){
	?>
			var modaledit<?= $adt['barang_id'];?> 	= document.getElementById("myModalEdit<?= $adt['barang_id'];?>");
			var btnedit<?= $adt['barang_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['barang_id'];?>");
			var spanedit<?= $adt['barang_id'];?> 	= document.getElementById("close<?= $adt['barang_id'];?>");
			
			btnedit<?= $adt['barang_id'];?>.onclick = function() {
			  modaledit<?= $adt['barang_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['barang_id'];?>.onclick = function() {
			  modaledit<?= $adt['barang_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['barang_id'];?>) {
				modaledit<?= $adt['barang_id'];?>.style.display = "none";
			  }
			}
	<?php } ?>	
</script>
<script type="text/javascript" lang="javascript">
    $('.btnhps').click(function(e) {
        let nama = $(this).data('nama'), url = $(this).data('url')
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Apakah anda yakin ingin menghapus ${nama}?`,
            icon: 'question',
            showCancelButton: true,
        }).then(result => {
            if (result.value) {
                window.location = url
            }
        })
    })
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
		  title: 'Error!',
		  text: '<?= $_SESSION['error']; ?>',
		  icon: 'error',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['error']);} ?>
<script>
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
    }
</script>
