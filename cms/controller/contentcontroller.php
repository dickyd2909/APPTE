<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'contentsimpan') {
		$odb 				= $koneksi->query("SELECT MAX(content_order) AS LastNo FROM content");
		$odt 				= $odb->fetch_array();
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
        $db                 = $koneksi->query("SELECT max(content_id) as kodeTerbesar FROM content");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "CO";
        $content_id       	= $huruf . sprintf("%03s", $urutan);
        $content_judul    	= mysqli_real_escape_string($koneksi, $_POST['content_judul']);
		$content_desc	  	= mysqli_real_escape_string($koneksi, $_POST['content_desc']);
		$content_url	  	= mysqli_real_escape_string($koneksi, $_POST['content_url']);
		$content_status   	= mysqli_real_escape_string($koneksi, $_POST['content_status']);
		$contentcat_id   	= mysqli_real_escape_string($koneksi, $_POST['contentcat_id']);
		$content_order 		= $odt['LastNo'] + 1;
		$content_metadesc	= mysqli_real_escape_string($koneksi, $_POST['content_metadesc']);
		$content_metakey	= mysqli_real_escape_string($koneksi, $_POST['content_metakey']);
		$code		   			= md5(uniqid(rand()));
		$gencode				= substr($code, 0, 3);
		$replace				= strtolower(str_replace($stringreplace,'_',$content_judul));	
		$nama_file 				= $_FILES["content_image"]["name"];
		$tipe_file 				= $_FILES["content_image"]["type"];
		$alamat 				= $_FILES["content_image"]["tmp_name"];
		$nama_baru 				= $replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 				= "../../assets/images/content/$nama_baru";
		$updated				= date('Y-m-d H:i:s');
		if(empty($nama_file))
		{
			$sql = $koneksi->query("INSERT INTO content(content_id, content_judul, content_desc, content_url, content_status, content_order, content_metadesc, content_metakey, contentcat_id) VALUES ('$content_id', '$content_judul', '$content_desc', '$content_url', '$content_status', '$content_order', '$content_metadesc', '$content_metakey', '$contentcat_id') ")or die(mysqli_error($koneksi));
			if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Content: $content_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
				$_SESSION['success'] = 'Data Content Berhasil Ditambahkan';
			}else{
				$_SESSION['error'] = 'Tambah Data Content Gagal!';
			}	
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=content'>";
		}else{
			if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png") {
				$_SESSION['error'] = 'Tambah Data content Gagal!, tipe data tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=content'>";
			}else{
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = $koneksi->query("INSERT INTO content(content_id, content_judul, content_desc, content_url, content_image, content_status, content_order, content_metadesc, content_metakey, contentcat_id) VALUES ('$content_id', '$content_judul', '$content_desc', '$content_url', '$nama_baru', '$content_status', '$content_order', '$content_metadesc', '$content_metakey', '$contentcat_id') ")or die(mysqli_error($koneksi));
				if($sql == true){
					$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Content: $content_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
					$_SESSION['success'] = 'Data Content Berhasil Ditambahkan';
				}else{
					$_SESSION['error'] = 'Tambah Data Content Gagal!';
				}	
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=content'>";
			}
		}	
    }else if ($_GET['m'] == 'contentupdate') {
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
        $content_id       		= mysqli_real_escape_string($koneksi, $_POST['content_id']);
        $content_judul    		= mysqli_real_escape_string($koneksi, $_POST['content_judul']);
		$content_desc	  		= mysqli_real_escape_string($koneksi, $_POST['content_desc']);
		$content_url	  		= mysqli_real_escape_string($koneksi, $_POST['content_url']);
		$content_status   		= mysqli_real_escape_string($koneksi, $_POST['content_status']);
		$contentcat_id   		= mysqli_real_escape_string($koneksi, $_POST['contentcat_id']);
		$content_metadesc 		= mysqli_real_escape_string($koneksi, $_POST['content_metadesc']);
		$content_metakey  		= mysqli_real_escape_string($koneksi, $_POST['content_metakey']);
		$code		   			= md5(uniqid(rand()));
		$gencode				= substr($code, 0, 3);
		$replace				= strtolower(str_replace($stringreplace,'_',$content_judul));	
		$nama_file 				= $_FILES["content_image"]["name"];
		$tipe_file 				= $_FILES["content_image"]["type"];
		$alamat 				= $_FILES["content_image"]["tmp_name"];
		$nama_baru 				= $replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 				= "../../assets/images/content/$nama_baru";
        $updated			= date('Y-m-d H:i:s'); 
		if(empty($nama_file))
		{	
			$sql = $koneksi->query("UPDATE content SET
            content_judul   = '$content_judul',
			content_desc	= '$content_desc',
			content_url		= '$content_url',
			content_metadesc= '$content_metadesc',
			content_metakey = '$content_metakey',
			content_status	= '$content_status'
            WHERE content_id= '$content_id'") or die(mysqli_error($koneksi));
			if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Content: $content_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
				$_SESSION['success'] = 'Data Content Berhasil Diubah';
			}else{
				$_SESSION['error'] = 'Ubah Data Content Gagal!';
			}	
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=content'>";
		}else{
			if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png") {
				$_SESSION['error'] = 'Tambah Data content Gagal!, tipe data tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=content'>";
			}else{
				$db = "SELECT * FROM content WHERE content_id='$content_id'";
				$result = mysqli_query($koneksi, $db);
				if(mysqli_num_rows($result) > 0 ){
					$data = mysqli_fetch_array($result);
					@unlink('../../assets/images/content/'.$data['content_image']);
				}
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = $koneksi->query("UPDATE content SET
				content_judul   = '$content_judul',
				content_desc	= '$content_desc',
				content_url		= '$content_url',
				content_metadesc= '$content_metadesc',
				content_metakey = '$content_metakey',
				content_status	= '$content_status',
				content_image	= '$nama_baru'
				WHERE content_id= '$content_id'") or die(mysqli_error($koneksi));
				if($sql == true){
					$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Content: $content_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
					$_SESSION['success'] = 'Data Content Berhasil Diubah';
				}else{
					$_SESSION['error'] = 'Ubah Content Gagal!';
				}	
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=content'>";
			}
		}

    }else if($_GET['m'] == 'contenthapus'){
		$updated	= date('Y-m-d H:i:s');
		$id 		= $_GET['id'];
		$db 		= "SELECT * FROM content WHERE content_id='$id'";
		$result 	= mysqli_query($koneksi, $db);
		if(mysqli_num_rows($result) > 0 ) {
			$dt 				= mysqli_fetch_array($result);
			$content_judul	= $dt['content_judul'];
			@unlink('../../assets/images/content/'.$dt['content_image']);
			$sql = mysqli_query($koneksi, "DELETE FROM content WHERE content_id='$id'") or die (mysqli_error($koneksi));
			if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Content: $content_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
				$_SESSION['success'] = 'Data Content Berhasil Dihapus!';
			}else{
				$_SESSION['error'] = 'Hapus Data Content Gagal!';
			}
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=content'>";
		}
    }
?>