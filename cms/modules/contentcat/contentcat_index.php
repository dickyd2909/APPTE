<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Kategori Konten
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
						<th>Status</th>
						<th>Order</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody id="post_list">
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM contentcat ORDER BY contentcat_order ASC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr data-post-id="<?php echo $dt["contentcat_id"]; ?>">
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td><?= $dt['contentcat_judul'] ?></td>
							<td><?= $dt['contentcat_status'] ?></td>
							<td><?= $dt['contentcat_order'] ?></td>
                            <td width="10%"><a href="#" id="myBtnEdit<?= $dt['contentcat_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhps" data-judul="<?= $dt['contentcat_judul']; ?>" data-url="index.php?m=contentcathapus&id=<?= $dt['contentcat_id']; ?>"><i class="fa fa-trash"></i></a></td>
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
      <h2>Tambah Kategori Konten</h2>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?m=contentcatsimpan" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="contentcat_judul" type="text" class="form-control" required />
                </div>
            </div>
			 <div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="contentcat_status" class="form-control">
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
    $adb = $koneksi->query("SELECT * FROM contentcat ORDER BY contentcat_id ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['contentcat_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['contentcat_id']; ?>">&times;</span>
            <h2>Ubah Kategori Konten</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=contentcatupdate" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="contentcat_id" value="<?= $adt['contentcat_id']; ?>" type="hidden" class="form-control"/>
                    <input name="contentcat_judul" value="<?= $adt['contentcat_judul']; ?>" type="text" class="form-control" required />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="contentcat_status" class="form-control">
                        <option value="<?= $adt['contentcat_status']; ?>"><?= $adt['contentcat_status']; ?></value>
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
		$adb = $koneksi->query("SELECT * FROM contentcat ORDER BY contentcat_id ASC");
		while($adt = $adb->fetch_array()){
	?>
			var modaledit<?= $adt['contentcat_id'];?> 	= document.getElementById("myModalEdit<?= $adt['contentcat_id'];?>");
			var btnedit<?= $adt['contentcat_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['contentcat_id'];?>");
			var spanedit<?= $adt['contentcat_id'];?> 	= document.getElementById("close<?= $adt['contentcat_id'];?>");
			
			btnedit<?= $adt['contentcat_id'];?>.onclick = function() {
			  modaledit<?= $adt['contentcat_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['contentcat_id'];?>.onclick = function() {
			  modaledit<?= $adt['contentcat_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['contentcat_id'];?>) {
				modaledit<?= $adt['contentcat_id'];?>.style.display = "none";
			  }
			}
	<?php } ?>	
</script>
<script type="text/javascript" lang="javascript">
    $('.btnhps').click(function(e) {
        let judul = $(this).data('judul'), url = $(this).data('url')
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Apakah anda yakin ingin menghapus ${judul}?`,
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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
	$( "#post_list" ).sortable({
		placeholder : "ui-state-highlight",
		update  : function(event, ui)
		{
			var post_order_ids = new Array();
			$('#post_list tr').each(function(){
				post_order_ids.push($(this).data("post-id"));
			});
			$.ajax({
				url:"../libs/postOrderContentcat.php",
				method:"POST",
				data:{post_order_ids:post_order_ids},
				success:function(data)
				{
				 if(data){
					$(".alert-danger").hide();
					$(".alert-success ").show();
				 }else{
					$(".alert-success").hide();
					$(".alert-danger").show();
				 }
				}
			});
		}
	});
</script>
