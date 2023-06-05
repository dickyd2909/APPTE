<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Konten
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Konten</a>
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th></th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
						<th>Kategori</th>
						<th>Url</th>
						<th>Status</th>
                        <th>Order</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody id="post_list">
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM content INNER JOIN contentcat ON content.contentcat_id = contentcat.contentcat_id ORDER BY content_order ASC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr data-post-id="<?php echo $dt["content_id"]; ?>">
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td width="1%">
								<?php if(!empty($dt['content_image'])){ ?>
									<img src="../../../assets/images/content/<?= $dt['content_image']; ?>" width="150">
								<?php }else{?>
									<img src="../../../assets/images/no-image.png" width="150">
								<?php } ?>
							</td>
                            <td><?= $dt['content_judul'] ?></td>
							<td><?= $dt['content_desc'] ?></td>
							<td><?= $dt['contentcat_judul'] ?></td>
							<td><?= $dt['contentcat_url'] ?></td>
                            <td><?= $dt['content_status'] ?></td>
                            <td><?= $dt['content_order'] ?></td>
                            <td><a href="#" id="myBtnEdit<?= $dt['content_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhps" data-nama="<?= $dt['content_judul']; ?>" data-url="index.php?m=contenthapus&id=<?= $dt['content_id']; ?>"><i class="fa fa-trash"></i></a></td>
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
      <h2>Tambah Data content</h2>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?m=contentsimpan" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="content_judul" type="text" class="form-control" required />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Kategori</div>
                <div class="forminput">
                    <select name="contentcat_id" class="form-control" required>
                        <option value="">-Pilih-</value>
						<?php 
							$cdb = $koneksi->query("SELECT * FROM contentcat");
							while($cdt = $cdb->fetch_array()){
						?>	
							<option value="<?= $cdt['contentcat_id']; ?>"><?= $cdt['contentcat_judul']; ?></value>
						<?php } ?>
                    </select>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Deskirpsi</div>
                <div class="forminput">
                    <textarea name="content_desc" class="form-control" id="content1"></textarea>
					<script type="text/javascript">
						CKEDITOR_BASEPATH = 'ckeditor';
						var editor = CKEDITOR.replace('content1', {
							filebrowserBrowseUrl: "apps/kcfinder/browse.php?type=files"
						});
					</script>
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
					<input type="file" name="content_image" class="dropzone">
				   </div>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Url</div>
                <div class="forminput">
                    <input name="content_url" type="text" class="form-control" />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Meta Deskripsi</div>
                <div class="forminput">
                    <textarea name="content_metadesc" class="form-control"></textarea>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Meta Keyword</div>
                <div class="forminput">
                    <textarea name="content_keyword" class="form-control"></textarea>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="content_status" class="form-control">
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
    $adb = $koneksi->query("SELECT * FROM content INNER JOIN contentcat ON content.contentcat_id = contentcat.contentcat_id ORDER BY content_order ASC");
    while($adt = $adb->fetch_array()){
?>
    <div id="myModalEdit<?= $adt['content_id']; ?>" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <span class="closeedit" id="close<?= $adt['content_id']; ?>">&times;</span>
            <h2>Edit content</h2>
        </div>
        <div class="modal-body">
            <form method="post" action="index.php?m=contentupdate" enctype="multipart/form-data">
            <div id="formbox" class="clearfix">
                <div class="formlabel">Nama</div>
                <div class="forminput">
                    <input name="content_judul" type="text" value="<?= $adt['content_judul']; ?>" class="form-control" required />
					<input name="content_id" type="hidden" value="<?= $adt['content_id']; ?>" class="form-control" required />
                </div>
            </div>
           <div id="formbox" class="clearfix">
                <div class="formlabel">Kategori</div>
                <div class="forminput">
                    <select name="contentcat_id" class="form-control" required>
                        <option value="<?= $adt['contentcat_id']; ?>"><?= $adt['contentcat_id']; ?></value>
						<?php 
							$cdb = $koneksi->query("SELECT * FROM contentcat");
							while($cdt = $cdb->fetch_array()){
						?>	
							<option value="<?= $cdt['contentcat_id']; ?>"><?= $cdt['contentcat_judul']; ?></value>
						<?php } ?>
                    </select>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Deskirpsi</div>
                <div class="forminput">
                    <textarea name="content_desc" class="form-control" id="content<?= $adt['content_id'] ?>" value="<?= $adt['content_desc']; ?>"><?= $adt['content_desc']; ?></textarea>
					<script type="text/javascript">
						CKEDITOR_BASEPATH = 'ckeditor';
						var editor = CKEDITOR.replace('content<?= $adt['content_id'] ?>', {
							filebrowserBrowseUrl: "apps/kcfinder/browse.php?type=files"
						});
					</script>
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
					<input type="file" name="content_image" class="dropzone">
				   </div>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Image</div>
                <div class="forminput">
					<?php if(!empty($adt['content_image'])){ ?>
						<img src="../../../assets/images/content/<?= $adt['content_image']; ?>" width="150">
					<?php }else{ ?>
						<img src="../../../assets/images/no-image.png" width="150">
					<?php } ?>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Url</div>
                <div class="forminput">
                    <input name="content_url" type="text" value="<?= $adt['content_url']; ?>" class="form-control" />
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Meta Deskripsi</div>
                <div class="forminput">
                    <textarea name="content_metadesc" class="form-control"><?= $adt['content_metadesc']; ?></textarea>
                </div>
            </div>
			<div id="formbox" class="clearfix">
                <div class="formlabel">Meta Keyword</div>
                <div class="forminput">
                    <textarea name="content_metakey" class="form-control"><?= $adt['content_keyword']; ?></textarea>
                </div>
            </div>
            <div id="formbox" class="clearfix">
                <div class="formlabel">Status</div>
                <div class="forminput">
                    <select name="content_status" class="form-control">
                        <option value="<?= $adt['content_status']; ?>"><?= $adt['content_status']; ?></value>
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
		$adb = $koneksi->query("SELECT * FROM content ORDER BY content_order ASC");
		while($adt = $adb->fetch_array()){
	?>
			var modaledit<?= $adt['content_id'];?> 	= document.getElementById("myModalEdit<?= $adt['content_id'];?>");
			var btnedit<?= $adt['content_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['content_id'];?>");
			var spanedit<?= $adt['content_id'];?> 	= document.getElementById("close<?= $adt['content_id'];?>");
			
			btnedit<?= $adt['content_id'];?>.onclick = function() {
			  modaledit<?= $adt['content_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['content_id'];?>.onclick = function() {
			  modaledit<?= $adt['content_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['content_id'];?>) {
				modaledit<?= $adt['content_id'];?>.style.display = "none";
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
				url:"../libs/postOrderContent.php",
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
