<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Kategori Admin
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Kategori</a>
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM admincat ORDER BY admincat_id DESC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr>
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td><?= $dt['admincat_nama'] ?></td>
                            <td width="10%"><a href="#" id="myBtnEdit<?= $dt['admincat_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhps" data-nama="<?= $dt['admincat_nama']; ?>" data-url="index.php?m=admincathapus&id=<?= $dt['admincat_id']; ?>"><i class="fa fa-trash"></i></a></td>
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
      <h2>Kategori Admin Tambah</h2>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?m=admincatsimpan" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="admincat_nama" type="text" class="form-control" required />
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
    $adb = $koneksi->query("SELECT * FROM admincat ORDER BY admincat_id ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['admincat_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['admincat_id']; ?>">&times;</span>
            <h2>Edit Kategori Admin</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=admincatupdate" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="admincat_id" value="<?= $adt['admincat_id']; ?>" type="hidden" class="form-control"/>
                    <input name="admincat_nama" value="<?= $adt['admincat_nama']; ?>" type="text" class="form-control" required />
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
		$adb = $koneksi->query("SELECT * FROM admincat ORDER BY admincat_id ASC");
		while($adt = $adb->fetch_array()){
	?>
			var modaledit<?= $adt['admincat_id'];?> 	= document.getElementById("myModalEdit<?= $adt['admincat_id'];?>");
			var btnedit<?= $adt['admincat_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['admincat_id'];?>");
			var spanedit<?= $adt['admincat_id'];?> 	= document.getElementById("close<?= $adt['admincat_id'];?>");
			
			btnedit<?= $adt['admincat_id'];?>.onclick = function() {
			  modaledit<?= $adt['admincat_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['admincat_id'];?>.onclick = function() {
			  modaledit<?= $adt['admincat_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['admincat_id'];?>) {
				modaledit<?= $adt['admincat_id'];?>.style.display = "none";
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
