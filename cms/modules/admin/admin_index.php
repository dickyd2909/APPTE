<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Admin
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Admin</a>
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM admin JOIN admincat ON admin.admincat_id = admincat.admincat_id ORDER BY admin_id DESC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr>
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td><?= $dt['admin_nama'] ?></td>
                            <td><?= $dt['admin_username'] ?></td>
                            <td><?= $dt['admincat_nama'] ?></td>
                            <td><?= $dt['admin_status'] ?></td>
                            <td><a href="#" id="myBtnEdit<?= $dt['admin_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhps" data-nama="<?= $dt['admin_nama']; ?>" data-url="index.php?m=adminhapus&id=<?= $dt['admin_id']; ?>"><i class="fa fa-trash"></i></a></td>
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
      <h2>Admin Tambah</h2>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?m=adminsimpan" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="admin_nama" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Username</div>
                <div class="forminput">
                    <input name="admin_username" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Password</div>
                <div class="forminput">
                    <input name="admin_password" type="password" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Kategori</div>
                <div class="forminput">
                    <select name="admincat_id" class="form-control">
                        <option value="">- Pilih -</value>
                        <?php
                            $ldb = $koneksi->query("SELECT * FROM admincat ORDER BY admincat_id ASC");
                            while($ldt = $ldb->fetch_array()){
                        ?>
                            <option value="<?= $ldt['admincat_id']; ?>"><?= $ldt['admincat_nama']; ?></value>
                        <?php } ?>	
                    </select>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="admin_status" class="form-control">
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
    $adb = $koneksi->query("SELECT * FROM admin ORDER BY admin_id ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['admin_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['admin_id']; ?>">&times;</span>
            <h2>Edit Admin</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=adminupdate" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="admin_id" value="<?= $adt['admin_id']; ?>" type="hidden" class="form-control"/>
                    <input name="admin_nama" value="<?= $adt['admin_nama']; ?>" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Username</div>
                <div class="forminput">
                    <input name="admin_username" value="<?= $adt['admin_username']; ?>" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Level</div>
                <div class="forminput">
                    <select name="admincat_id" class="form-control">
                        <?php
                            $sldb = $koneksi->query("SELECT * FROM admincat WHERE admincat_id = '$adt[admincat_id]'");
                            $sldt = $sldb->fetch_array();
                        ?>
                        <option value="<?= $sldt['admincat_id']; ?>"><?= $sldt['admincat_nama']; ?></value>
                        <?php
                            $ldb = $koneksi->query("SELECT * FROM admincat ORDER BY admincat_id ASC");
                            while($ldt = $ldb->fetch_array()){
                        ?>
                            <option value="<?= $ldt['admincat_id']; ?>"><?= $ldt['admincat_nama']; ?></value>
                        <?php } ?>	
                    </select>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Password <div style="font-size:12px;color:#c00">*Isi jika ingin mengganti password</div> </div>
                <div class="forminput">
                    <input name="admin_password" type="password" class="form-control" />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="admin_status" class="form-control">
                        <option value="<?= $adt['admin_status']; ?>"><?= $adt['admin_status']; ?></value>
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
		$adb = $koneksi->query("SELECT * FROM admin ORDER BY admin_id ASC");
		while($adt = $adb->fetch_array()){
	?>
			var modaledit<?= $adt['admin_id'];?> 	= document.getElementById("myModalEdit<?= $adt['admin_id'];?>");
			var btnedit<?= $adt['admin_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['admin_id'];?>");
			var spanedit<?= $adt['admin_id'];?> 	= document.getElementById("close<?= $adt['admin_id'];?>");
			
			btnedit<?= $adt['admin_id'];?>.onclick = function() {
			  modaledit<?= $adt['admin_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['admin_id'];?>.onclick = function() {
			  modaledit<?= $adt['admin_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['admin_id'];?>) {
				modaledit<?= $adt['admin_id'];?>.style.display = "none";
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
