<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'slideshowsimpan') {
		$odb 				= $koneksi->query("SELECT MAX(slideshow_order) AS LastNo FROM slideshow");
		$odt 				= $odb->fetch_array();
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
        $db                 = $koneksi->query("SELECT max(slideshow_id) as kodeTerbesar FROM slideshow");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "SL";
        $slideshow_id       = $huruf . sprintf("%03s", $urutan);
        $slideshow_judul    = mysqli_real_escape_string($koneksi, $_POST['slideshow_judul']);
		$slideshow_status   = mysqli_real_escape_string($koneksi, $_POST['slideshow_status']);
		$slideshow_order 	= $odt['LastNo'] + 1;
		
		$code		   			= md5(uniqid(rand()));
		$gencode				= substr($code, 0, 3);
		$replace				= strtolower(str_replace($stringreplace,'_',$slideshow_judul));	
		$nama_file 				= $_FILES["slideshow_image"]["name"];
		$tipe_file 				= $_FILES["slideshow_image"]["type"];
		$alamat 				= $_FILES["slideshow_image"]["tmp_name"];
		$nama_baru 				= $replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 				= "../../assets/images/slideshow/$nama_baru";
		$updated				= date('Y-m-d H:i:s');
		
		if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png") {
			$_SESSION['error'] = 'Tambah Data Slideshow Gagal!, tipe data tidak didukung!';
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=slideshow'>";
		}else{
			$gambar_baru = move_uploaded_file($alamat, $tujuan);
			$sql = $koneksi->query("INSERT INTO slideshow(slideshow_id, slideshow_judul, slideshow_image, slideshow_status, slideshow_order) VALUES ('$slideshow_id', '$slideshow_judul', '$nama_baru', '$slideshow_status', '$slideshow_order') ")or die(mysqli_error($koneksi));
			if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Slideshow: $slideshow_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
				$_SESSION['success'] = 'Data Slideshow Berhasil Ditambahkan';
			}else{
				$_SESSION['error'] = 'Tambah Data Slideshow Gagal!';
			}	
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=slideshow'>";
		}
    }else if ($_GET['m'] == 'slideshowupdate') {
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
        $slideshow_id       = mysqli_real_escape_string($koneksi, $_POST['slideshow_id']);
        $slideshow_judul    = mysqli_real_escape_string($koneksi, $_POST['slideshow_judul']);
		$slideshow_status   = mysqli_real_escape_string($koneksi, $_POST['slideshow_status']);
		
		$code		   			= md5(uniqid(rand()));
		$gencode				= substr($code, 0, 3);
		$replace				= strtolower(str_replace($stringreplace,'_',$slideshow_judul));	
		$nama_file 				= $_FILES["slideshow_image"]["name"];
		$tipe_file 				= $_FILES["slideshow_image"]["type"];
		$alamat 				= $_FILES["slideshow_image"]["tmp_name"];
		$nama_baru 				= $replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 				= "../../assets/images/slideshow/$nama_baru";
        $updated			= date('Y-m-d H:i:s'); 
		if(empty($nama_file))
		{	
			$sql = $koneksi->query("UPDATE slideshow SET
            slideshow_judul     = '$slideshow_judul',
			slideshow_status	= '$slideshow_status'
            WHERE slideshow_id  = '$slideshow_id'") or die(mysqli_error($koneksi));
			if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Slideshow: $slideshow_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
				$_SESSION['success'] = 'Data Slideshow Berhasil Diubah';
			}else{
				$_SESSION['error'] = 'Ubah Data Slideshow Gagal!';
			}	
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=slideshow'>";
		}else{
			if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png") {
				$_SESSION['error'] = 'Tambah Data Slideshow Gagal!, tipe data tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=slideshow'>";
			}else{
				$db = "SELECT * FROM slideshow WHERE slideshow_id='$slideshow_id'";
				$result = mysqli_query($koneksi, $db);
				if(mysqli_num_rows($result) > 0 ){
					$data = mysqli_fetch_array($result);
					@unlink('../../assets/images/slideshow/'.$data['slideshow_image']);
				}
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = $koneksi->query("UPDATE slideshow SET
				slideshow_judul     = '$slideshow_judul',
				slideshow_status	= '$slideshow_status',
				slideshow_image		= '$nama_baru'
				WHERE slideshow_id  = '$slideshow_id'") or die(mysqli_error($koneksi));
				if($sql == true){
					$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Slideshow: $slideshow_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
					$_SESSION['success'] = 'Data Slideshow Berhasil Diubah';
				}else{
					$_SESSION['error'] = 'Ubah Slideshow Gagal!';
				}	
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=slideshow'>";
			}
		}

    }else if($_GET['m'] == 'slideshowhapus'){
		$updated	= date('Y-m-d H:i:s');
		$id 		= $_GET['id'];
		$db 		= "SELECT * FROM slideshow WHERE slideshow_id='$id'";
		$result 	= mysqli_query($koneksi, $db);
		if(mysqli_num_rows($result) > 0 ) {
			$dt 				= mysqli_fetch_array($result);
			$slideshow_judul	= $dt['slideshow_judul'];
			@unlink('../../assets/images/slideshow/'.$dt['slideshow_image']);
			$sql = mysqli_query($koneksi, "DELETE FROM slideshow WHERE slideshow_id='$id'") or die (mysqli_error($koneksi));
			if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Slideshow: $slideshow_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
				$_SESSION['success'] = 'Data Slideshow Berhasil Dihapus!';
			}else{
				$_SESSION['error'] = 'Hapus Data Slideshow Gagal!';
			}
			echo "<meta http-equiv='refresh' content='0; url=index.php?m=slideshow'>";
		}
    }
?>