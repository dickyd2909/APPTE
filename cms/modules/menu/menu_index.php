<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Menu
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Menu</a>
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
						<th>Title Page</th>
						<th>URL</th>
						<th>Target</th>
						<th>Order</th>
						<th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody id="post_list">
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM menu ORDER BY menu_order ASC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr data-post-id="<?php echo $dt["menu_id"]; ?>">
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td><?= $dt['menu_nama'] ?></td>
							<td><?= $dt['menu_titlepage'] ?></td>
							<td><?= $dt['menu_url'] ?></td>
							<td><?= $dt['menu_target'] ?></td>
							<td><?= $dt['menu_order'] ?></td>
							<td><?= $dt['menu_status'] ?></td>
                            <td width="10%"><a href="#" id="myBtnEdit<?= $dt['menu_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhps" data-nama="<?= $dt['menu_nama']; ?>" data-url="index.php?m=menuhapus&id=<?= $dt['menu_id']; ?>"><i class="fa fa-trash"></i></a></td>
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
      <h2>Tambah Menu</h2>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?m=menusimpan" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="menu_nama" type="text" class="form-control" required />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Title Page</div>
                <div class="forminput">
                    <input name="menu_titlepage" type="text" class="form-control" />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Url</div>
                <div class="forminput">
                    <input name="menu_url" type="text" class="form-control" required />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Target</div>
                <div class="forminput">
                    <select name="menu_target" class="form-control">
                        <option value="_self">_self</value>
                        <option value="_blank">_blank</value>
                    </select>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="menu_status" class="form-control">
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
    $adb = $koneksi->query("SELECT * FROM menu ORDER BY menu_order ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['menu_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['menu_id']; ?>">&times;</span>
            <h2>Edit Menu</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=menuupdate" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="menu_id" value="<?= $adt['menu_id']; ?>" type="hidden" class="form-control"/>
                    <input name="menu_nama" value="<?= $adt['menu_nama']; ?>" type="text" class="form-control" required />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Title Page</div>
                <div class="forminput">
                    <input name="menu_titlepage" value="<?= $adt['menu_titlepage']; ?>" type="text" class="form-control" required />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Url</div>
                <div class="forminput">
                    <input name="menu_url" value="<?= $adt['menu_url']; ?>" type="text" class="form-control" required />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Target</div>
                <div class="forminput">
                    <select name="menu_target" class="form-control">
						<option value="<?= $adt['menu_target']; ?>"><?= $adt['menu_target']; ?></value>
                        <option value="_self">_self</value>
                        <option value="_blank">_blank</value>
                    </select>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="menu_status" class="form-control">
						<option value="<?= $adt['menu_status']; ?>"><?= $adt['menu_status']; ?></value>
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
		$adb = $koneksi->query("SELECT * FROM menu ORDER BY menu_id ASC");
		while($adt = $adb->fetch_array()){
	?>
			var modaledit<?= $adt['menu_id'];?> 	= document.getElementById("myModalEdit<?= $adt['menu_id'];?>");
			var btnedit<?= $adt['menu_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['menu_id'];?>");
			var spanedit<?= $adt['menu_id'];?> 	= document.getElementById("close<?= $adt['menu_id'];?>");
			
			btnedit<?= $adt['menu_id'];?>.onclick = function() {
			  modaledit<?= $adt['menu_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['menu_id'];?>.onclick = function() {
			  modaledit<?= $adt['menu_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['menu_id'];?>) {
				modaledit<?= $adt['menu_id'];?>.style.display = "none";
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
		  title: 'Gagal!',
		  text: '<?= $_SESSION['error']; ?>',
		  icon: 'error',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['error']);} ?>
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
				url:"../libs/postOrderMenu.php",
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
