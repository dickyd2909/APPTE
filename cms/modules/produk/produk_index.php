<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Barang
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Barang</a>
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th></th>
                        <th>Nama</th>
                        <th>Jenis</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Supplier</th>
                        <th>Bahan</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody id="post_list">
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM barang INNER JOIN supplier ON barang.supplier_id = supplier.supplier_id INNER JOIN bahan ON barang.bahan_id = bahan.bahan_id ORDER BY barang_order ASC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr data-post-id="<?php echo $dt["barang_id"]; ?>">
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td width="1%">
								<?php if(!empty($dt['barang_image'])){ ?>
									<img src="../assets/images/produk/<?= $dt['barang_image']; ?>" width="150">
								<?php }else{?>
									<img src="../assets/images/no-image.png" width="150">
								<?php } ?>
							</td>
                            <td><?= $dt['barang_nama'] ?></td>
							<td><?= $dt['barang_jenis'] ?></td>
							<td><?= $dt['barang_harga'] ?></td>
							<td><?= $dt['barang_stok'] ?></td>
                            <td><?= $dt['supplier_nama'] ?></td>
                            <td><?= $dt['bahan_nama'] ?></td>
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
      <h2>Tambah Data Barang</h2>
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
                <div class="formlabel">Jenis</div>
                <div class="forminput">
                    <input name="barang_jenis" type="text" class="form-control" required />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Harga</div>
                <div class="forminput">
                    <input name="barang_harga" type="number" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Stok</div>
                <div class="forminput">
                    <input name="barang_stok" type="number" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Supplier</div>
                <div class="forminput">
                    <select name="supplier_id" class="form-control">
                        <option value="">- Pilih - </option>
                        <?php 
                            $sdb = $koneksi->query("SELECT * FROM supplier ORDER BY supplier_id ASC");
                            while($sdt = $sdb->fetch_array()){
                        ?>
                            <option value="<?= $sdt['supplier_id'] ?>"><?= $sdt['supplier_nama']; ?></option>
                        <?php } ?>    
                    </select>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Bahan</div>
                <div class="forminput">
                    <select name="bahan_id" class="form-control">
                        <option value="">- Pilih - </option>
                        <?php 
                            $sdb = $koneksi->query("SELECT * FROM bahan ORDER BY bahan_id ASC");
                            while($sdt = $sdb->fetch_array()){
                        ?>
                            <option value="<?= $sdt['bahan_id'] ?>"><?= $sdt['bahan_nama']; ?></option>
                        <?php } ?>    
                    </select>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Image</div>
                <div class="forminput">
                    <div class="preview-zone hidden">
					<div class="box box-solid">
					 <div class="box-header">
					  <div class="box-tools pull-right">
					   <button type="button" class="btnremove remove-preview">
						<i class="fa fa-times"></i> Reset This Form
					   </button>
					  </div>
					 </div>
					 <div class="box-body"></div>
					</div>
				   </div>
				   <div class="dropzone-wrapper">
					<div class="dropzone-desc">
					 <i class="glyphicon glyphicon-download-alt"></i>
					 <p>Choose an image file or drag it here.</p>
					</div>
					<input type="file" name="barang_image" class="dropzone">
				   </div>
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
    $adb = $koneksi->query("SELECT * FROM barang INNER JOIN supplier ON barang.supplier_id = supplier.supplier_id INNER JOIN bahan ON barang.bahan_id = bahan.bahan_id ORDER BY barang_order ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['barang_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['barang_id']; ?>">&times;</span>
            <h2>Edit Barang</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=produkupdate" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="barang_nama" type="text" value="<?= $adt['barang_nama']; ?>" class="form-control" required />
					<input name="barang_id" type="hidden" value="<?= $adt['barang_id']; ?>" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Jenis</div>
                <div class="forminput">
                    <input name="barang_jenis" type="text" value="<?= $adt['barang_jenis']; ?>" class="form-control" required />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Harga</div>
                <div class="forminput">
                    <input name="barang_harga" type="number" value="<?= $adt['barang_harga']; ?>" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Stok</div>
                <div class="forminput">
                    <input name="barang_stok" type="number" value="<?= $adt['barang_stok']; ?>" class="form-control" required />
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Supplier</div>
                <div class="forminput">
                    <select name="supplier_id" class="form-control">
                        <option value="<?= $adt['supplier_id']; ?>"><?= $adt['supplier_nama']; ?></option>
                        <?php
                            $sdb = $koneksi->query("SELECT * FROM supplier ORDER BY supplier_id ASC");
                            while($sdt = $sdb->fetch_array()){
                        ?>
                            <option value="<?= $sdt['supplier_id']; ?>"><?= $sdt['supplier_nama']; ?></option>
                        <?php } ?>    
                    </select>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Bahan</div>
                <div class="forminput">
                    <select name="bahan_id" class="form-control">
                        <option value="<?= $adt['bahan_id']; ?>"><?= $adt['bahan_nama']; ?></option>
                        <?php
                            $sdb = $koneksi->query("SELECT * FROM bahan ORDER BY bahan_id ASC");
                            while($sdt = $sdb->fetch_array()){
                        ?>
                            <option value="<?= $sdt['bahan_id']; ?>"><?= $sdt['bahan_nama']; ?></option>
                        <?php } ?>    
                    </select>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Image</div>
                <div class="forminput">
                    <div class="preview-zone hidden">
					<div class="box box-solid">
					 <div class="box-header">
					  <div class="box-tools pull-right">
					   <button type="button" class="btnremove remove-preview">
						<i class="fa fa-times"></i> Reset This Form
					   </button>
					  </div>
					 </div>
					 <div class="box-body"></div>
					</div>
				   </div>
				   <div class="dropzone-wrapper">
					<div class="dropzone-desc">
					 <i class="glyphicon glyphicon-download-alt"></i>
					 <p>Choose an image file or drag it here.</p>
					</div>
					<input type="file" name="barang_image" class="dropzone">
				   </div>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Image</div>
                <div class="forminput">
					<?php if(!empty($adt['barang_image'])){ ?>
						<img src="../assets/images/produk/<?= $adt['barang_image']; ?>" width="150">
					<?php }else{ ?>
						<img src="../assets/images/no-image.png" width="150">
					<?php } ?>
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
		$adb = $koneksi->query("SELECT * FROM barang ORDER BY barang_order ASC");
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
		  title: 'Gagal!',
		  text: '<?= $_SESSION['error']; ?>',
		  icon: 'error',
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
				url:"../libs/postOrderBarang.php",
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
<script>
	function readFile(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
			var htmlPreview = 
			'<img width="200" src="' + e.target.result + '" />'+
			'<p>' + input.files[0].name + '</p>';
			var wrapperZone = $(input).parent();
			var previewZone = $(input).parent().parent().find('.preview-zone');
			var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

			wrapperZone.removeClass('dragover');
			previewZone.removeClass('hidden');
			boxZone.empty();
			boxZone.append(htmlPreview);
			};

			reader.readAsDataURL(input.files[0]);	
		}
	}
	function reset(e) {
		e.wrap('<form>').closest('form').get(0).reset();
		e.unwrap();
	}
	$(".dropzone").change(function(){
		readFile(this);
	});
	$('.dropzone-wrapper').on('dragover', function(e) {
		 e.preventDefault();
		 e.stopPropagation();
		 $(this).addClass('dragover');
	});
	$('.dropzone-wrapper').on('dragleave', function(e) {
		 e.preventDefault();
		 e.stopPropagation();
		 $(this).removeClass('dragover');
	});
	$('.remove-preview').on('click', function() {
		 var boxZone = $(this).parents('.preview-zone').find('.box-body');
		 var previewZone = $(this).parents('.preview-zone');
		 var dropzone = $(this).parents('.form-group').find('.dropzone');
		 boxZone.empty();
		 previewZone.addClass('hidden');
		 reset(dropzone);
	});
</script>

