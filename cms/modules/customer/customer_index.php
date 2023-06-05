<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Customer
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Customer</a>
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No.Telp</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM customer ORDER BY customer_id DESC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr>
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td><?= $dt['customer_nama'] ?></td>
                            <td><?= $dt['customer_telp'] ?></td>
                            <td><?= $dt['customer_email'] ?></td>
                            <td>
                                <?php 
                                    if($dt['customer_gender'] == 'L'){
                                        $gender = "Laki - Laki";
                                    }else{
                                        $gender = "Perempuan";
                                    }
                                echo $gender;
                                ?>
                            </td>
                            <td>
                                <?= $dt['customer_status']; ?>
                            </td>
                            <td width="10%"><a href="#" id="myBtnEdit<?= $dt['customer_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhps" data-nama="<?= $dt['customer_nama']; ?>" data-url="index.php?m=customerhapus&id=<?= $dt['customer_id']; ?>"><i class="fa fa-trash"></i></a></td>
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
      <h2>Tambah Customer</h2>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?m=customersimpan" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="customer_nama" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">No.Telp</div>
                <div class="forminput">
                    <input name="customer_telp" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Email</div>
                <div class="forminput">
                    <input name="customer_email" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Password</div>
                <div class="forminput">
                    <input name="customer_password" type="password" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Gender</div>
                <div class="forminput">
                    <select name="customer_gender" class="form-control">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="customer_status" class="form-control">
                        <option value="Aktif">Aktif</option>
                        <option value="Non-Aktif">Non-Aktif</option>
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
    $adb = $koneksi->query("SELECT * FROM customer ORDER BY customer_id ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['customer_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['customer_id']; ?>">&times;</span>
            <h2>Cusstomer</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=customerupdate" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="customer_id" value="<?= $adt['customer_id']; ?>" type="hidden" class="form-control"/>
                    <input name="customer_nama" value="<?= $adt['customer_nama']; ?>" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">No.Telp</div>
                <div class="forminput">
                    <input name="customer_telp" value="<?= $adt['customer_telp']; ?>" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">No.email</div>
                <div class="forminput">
                    <input name="customer_email" value="<?= $adt['customer_email']; ?>" type="text" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Password <div style="font-size:12px;color:#c00">*Isi jika ingin mengganti password</div></div>
                <div class="forminput">
                    <input name="customer_password" type="password" class="form-control" />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Gender</div>
                <div class="forminput">
                    <select name="customer_gender" class="form-control">
                        <?php
                            if($adt['customer_gender']=='L'){
                                $gender = "Laki-laki";
                            }else{
                                $gender = "Perempuan";
                            }
                        ?>
                        <option value="<?= $adt['customer_gender'] ?>"><?= $gender;?></option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="customer_status" class="form-control">
                        <option value="<?= $adt['customer_status'] ?>"><?= $adt['customer_status'] ?></option>
                        <option value="Aktif">Aktif</option>
                        <option value="Non-Aktif">Non-Aktif</option>
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
		$adb = $koneksi->query("SELECT * FROM customer ORDER BY customer_id ASC");
		while($adt = $adb->fetch_array()){
	?>
			var modaledit<?= $adt['customer_id'];?> 	= document.getElementById("myModalEdit<?= $adt['customer_id'];?>");
			var btnedit<?= $adt['customer_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['customer_id'];?>");
			var spanedit<?= $adt['customer_id'];?> 	= document.getElementById("close<?= $adt['customer_id'];?>");
			
			btnedit<?= $adt['customer_id'];?>.onclick = function() {
			  modaledit<?= $adt['customer_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['customer_id'];?>.onclick = function() {
			  modaledit<?= $adt['customer_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['customer_id'];?>) {
				modaledit<?= $adt['customer_id'];?>.style.display = "none";
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
		  title: 'Sukses!',
		  text: '<?= $_SESSION['error']; ?>',
		  icon: 'error',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['error']);} ?>
