<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Supplier
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Supplier</a>
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No.Telp</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM supplier ORDER BY supplier_id DESC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr>
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td><?= $dt['supplier_nama'] ?></td>
                            <td><?= $dt['supplier_telp'] ?></td>
                            <td><?= $dt['supplier_alamat'] ?></td>
                            <td><?= $dt['supplier_status'] ?></td>
                            <td><a href="#" id="myBtnEdit<?= $dt['supplier_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhps" data-nama="<?= $dt['supplier_nama']; ?>" data-url="index.php?m=supplierhapus&id=<?= $dt['supplier_id']; ?>"><i class="fa fa-trash"></i></a></td>
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
      <h2>Tambah Data Supplier</h2>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?m=suppliersimpan" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="supplier_nama" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">No.Telp</div>
                <div class="forminput">
                    <input name="supplier_telp" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Alamat</div>
                <div class="forminput">
                    <textarea name="supplier_alamat" class="form-control" required></textarea>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="supplier_status" class="form-control">
                        <option value="Aktif">Aktif</value>
                        <option value="Non-aktif">Non-aktif</value>
                    </select>
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
    $adb = $koneksi->query("SELECT * FROM supplier ORDER BY supplier_id ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['supplier_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['supplier_id']; ?>">&times;</span>
            <h2>Edit supplier</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=supplierupdate" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="supplier_id" value="<?= $adt['supplier_id']; ?>" type="hidden" class="form-control"/>
                    <input name="supplier_nama" value="<?= $adt['supplier_nama']; ?>" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">No.Telp</div>
                <div class="forminput">
                    <input name="supplier_telp" value="<?= $adt['supplier_telp']; ?>" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Alamat</div>
                <div class="forminput">
                    <textarea name="supplier_alamat" class="form-control" required><?= $adt['supplier_alamat']; ?></textarea>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="supplier_status" class="form-control">
                        <option value="<?= $adt['supplier_status']; ?>"><?= $adt['supplier_status']; ?></value>
                        <option value="Aktif">Aktif</value>
                        <option value="Non-aktif">Non-aktif</value>
                    </select>
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
		$adb = $koneksi->query("SELECT * FROM supplier ORDER BY supplier_id ASC");
		while($adt = $adb->fetch_array()){
	?>
			var modaledit<?= $adt['supplier_id'];?> 	= document.getElementById("myModalEdit<?= $adt['supplier_id'];?>");
			var btnedit<?= $adt['supplier_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['supplier_id'];?>");
			var spanedit<?= $adt['supplier_id'];?> 	= document.getElementById("close<?= $adt['supplier_id'];?>");
			
			btnedit<?= $adt['supplier_id'];?>.onclick = function() {
			  modaledit<?= $adt['supplier_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['supplier_id'];?>.onclick = function() {
			  modaledit<?= $adt['supplier_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['supplier_id'];?>) {
				modaledit<?= $adt['supplier_id'];?>.style.display = "none";
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
