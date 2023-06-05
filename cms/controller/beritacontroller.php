<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'beritasimpan') {
		$odb 				= $koneksi->query("SELECT MAX(berita_order) AS LastNo FROM berita");
		$odt 				= $odb->fetch_array();
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
        $berita_judul    	= mysqli_real_escape_string($koneksi, $_POST['berita_judul']);
		$berita_sdesc	  	= mysqli_real_escape_string($koneksi, $_POST['berita_sdesc']);
		$berita_desc	  	= mysqli_real_escape_string($koneksi, $_POST['berita_desc']);
		$berita_seo			= strtolower(str_replace($stringreplace,'-',$berita_judul));
		$berita_status   	= mysqli_real_escape_string($koneksi, $_POST['berita_status']);
		$berita_author   	= mysqli_real_escape_string($koneksi, $_POST['berita_author']);
		$berita_order 		= $odt['LastNo'] + 1;
		$berita_metadesc	= mysqli_real_escape_string($koneksi, $_POST['berita_metadesc']);
		$berita_metakey		= mysqli_real_escape_string($koneksi, $_POST['berita_metakey']);
		$berita_tanggal		= date('Y-m-d H:i:s');
		$code		   			= md5(uniqid(rand()));
		$gencode				= substr($code, 0, 3);
		$replace				= strtolower(str_replace($stringreplace,'_',$berita_judul));	
		$nama_file 				= $_FILES["berita_image"]["name"];
		$tipe_file 				= $_FILES["berita_image"]["type"];
		$alamat 				= $_FILES["berita_image"]["tmp_name"];
		$nama_baru 				= $replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 				= "../../assets/images/berita/$nama_baru";
		$updated				= date('Y-m-d H:i:s');

		if(empty($nama_file))
		{
			$sql = $koneksi->query("INSERT INTO berita(berita_id, berita_judul, berita_sdesc, berita_desc, berita_seo, berita_metadesc, berita_metakey, berita_author, berita_order, berita_tanggal, berita_status) VALUES (NULL, '$berita_judul', '$berita_sdesc', '$berita_desc', '$berita_seo', '$berita_metadesc', '$berita_metakey', '$berita_author', '$berita_order', '$berita_tanggal', '$berita_status') ")or die(mysqli_error($koneksi));
			if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data berita: $berita_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
				$_SESSION['success'] = 'Data berita Berhasil Ditambahkan';
			}else{
				$_SESSION['error'] = 'Tambah Data berita Gagal!';
			}	
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=berita'>";
		}else{
			if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png") {
				$_SESSION['error'] = 'Tambah Data berita Gagal!, tipe data tidak didukung!';
				echo "<meta http-equiv='refresh' berita='0; url=index.php?m=berita'>";
			}else{
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = $koneksi->query("INSERT INTO berita(berita_id, berita_judul, berita_sdesc, berita_desc, berita_image, berita_seo, berita_metadesc, berita_metakey, berita_author, berita_order, berita_tanggal, berita_status) VALUES (NULL, '$berita_judul', '$berita_sdesc', '$berita_desc', '$nama_baru', '$berita_seo', '$berita_metadesc', '$berita_metakey', '$berita_author', '$berita_order', '$berita_tanggal', '$berita_status') ")or die(mysqli_error($koneksi));
				if($sql == true){
					$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data berita: $berita_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
					$_SESSION['success'] = 'Data berita Berhasil Ditambahkan';
				}else{
					$_SESSION['error'] = 'Tambah Data berita Gagal!';
				}	
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=berita'>";
			}
		}	
    }else if ($_GET['m'] == 'beritaupdate') {
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
        $berita_id       	= mysqli_real_escape_string($koneksi, $_POST['berita_id']);
        $berita_judul    	= mysqli_real_escape_string($koneksi, $_POST['berita_judul']);
		$berita_sdesc	  	= mysqli_real_escape_string($koneksi, $_POST['berita_sdesc']);
		$berita_desc	  	= mysqli_real_escape_string($koneksi, $_POST['berita_desc']);
		$berita_seo			= strtolower(str_replace($stringreplace,'-',$berita_judul));
		$berita_status   	= mysqli_real_escape_string($koneksi, $_POST['berita_status']);
		$berita_author   	= mysqli_real_escape_string($koneksi, $_POST['berita_author']);
		$berita_order 		= $odt['LastNo'] + 1;
		$berita_metadesc	= mysqli_real_escape_string($koneksi, $_POST['berita_metadesc']);
		$berita_metakey		= mysqli_real_escape_string($koneksi, $_POST['berita_metakey']);
		$code		   			= md5(uniqid(rand()));
		$gencode				= substr($code, 0, 3);
		$replace				= strtolower(str_replace($stringreplace,'_',$berita_judul));	
		$nama_file 				= $_FILES["berita_image"]["name"];
		$tipe_file 				= $_FILES["berita_image"]["type"];
		$alamat 				= $_FILES["berita_image"]["tmp_name"];
		$nama_baru 				= $replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 				= "../../assets/images/berita/$nama_baru";
        $updated			= date('Y-m-d H:i:s'); 
		if(empty($nama_file))
		{	
			$sql = $koneksi->query("UPDATE berita SET
            berita_judul   	= '$berita_judul',
			berita_sdesc	= '$berita_sdesc',
			berita_desc		= '$berita_desc',
			berita_seo		= '$berita_seo',
			berita_metadesc	= '$berita_metadesc',
			berita_metakey 	= '$berita_metakey',
			berita_author 	= '$berita_author',
			berita_status	= '$berita_status'
            WHERE berita_id = '$berita_id'") or die(mysqli_error($koneksi));
			if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data berita: $berita_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
				$_SESSION['success'] = 'Data Berita Berhasil Diubah';
			}else{
				$_SESSION['error'] = 'Ubah Data Berita Gagal!';
			}	
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=berita'>";
		}else{
			if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png") {
				$_SESSION['error'] = 'Tambah Data berita Gagal!, tipe data tidak didukung!';
				echo "<meta http-equiv='refresh' berita='0; seo=index.php?m=berita'>";
			}else{
				$db = "SELECT * FROM berita WHERE berita_id='$berita_id'";
				$result = mysqli_query($koneksi, $db);
				if(mysqli_num_rows($result) > 0 ){
					$data = mysqli_fetch_array($result);
					@unlink('../../assets/images/berita/'.$data['berita_image']);
				}
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = $koneksi->query("UPDATE berita SET
				berita_judul   	= '$berita_judul',
				berita_sdesc	= '$berita_sdesc',
				berita_desc		= '$berita_desc',
				berita_seo		= '$berita_seo',
				berita_metadesc	= '$berita_metadesc',
				berita_metakey 	= '$berita_metakey',
				berita_author 	= '$berita_author',
				berita_status	= '$berita_status',
				berita_image	= '$nama_baru'
				WHERE berita_id= '$berita_id'") or die(mysqli_error($koneksi));
				if($sql == true){
					$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data berita: $berita_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
					$_SESSION['success'] = 'Data Berita Berhasil Diubah';
				}else{
					$_SESSION['error'] = 'Ubah Berita Gagal!';
				}	
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=berita'>";
			}
		}

    }else if($_GET['m'] == 'beritahapus'){
		$updated	= date('Y-m-d H:i:s');
		$id 		= $_GET['id'];
		$db 		= "SELECT * FROM berita WHERE berita_id='$id'";
		$result 	= mysqli_query($koneksi, $db);
		if(mysqli_num_rows($result) > 0 ) {
			$dt 				= mysqli_fetch_array($result);
			$berita_judul		= $dt['berita_judul'];
			@unlink('../../assets/images/berita/'.$dt['berita_image']);
			$sql = mysqli_query($koneksi, "DELETE FROM berita WHERE berita_id='$id'") or die (mysqli_error($koneksi));
			if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data berita: $berita_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
				$_SESSION['success'] = 'Data berita Berhasil Dihapus!';
			}else{
				$_SESSION['error'] = 'Hapus Data berita Gagal!';
			}
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=berita'>";
		}
    }
?>