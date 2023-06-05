<?php
    date_default_timezone_set('Asia/Jakarta');
	if($_GET['m'] == 'logoupdate'){
		$logo_id           	= mysqli_real_escape_string($koneksi, $_POST['logo_id']);
        $stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
		$logo_nama          = mysqli_real_escape_string($koneksi, $_POST['logo_nama']);
		$logo_lebar         = mysqli_real_escape_string($koneksi, $_POST['logo_lebar']);
		$logo_panjang       = mysqli_real_escape_string($koneksi, $_POST['logo_panjang']);
		$logo_alt          	= mysqli_real_escape_string($koneksi, $_POST['logo_alt']);
		$logo_title         = mysqli_real_escape_string($koneksi, $_POST['logo_title']);
		$code		   		= md5(uniqid(rand()));
        $gencode			= substr($code, 0, 5);
        $replace			= strtolower(str_replace($stringreplace,'_',$logo_nama));
        $nama_file 			= $_FILES["logo_gambar"]["name"];
        $tipe_file 			= $_FILES["logo_gambar"]["type"];
        $alamat 			= $_FILES["logo_gambar"]["tmp_name"];
        $explode            = explode(".", $nama_file);
        $nama_baru 			= $replace."_".$gencode.".".end($explode);
        $tujuan 			= "../assets/images/logo/$nama_baru";
		$updated			= date('Y-m-d H:i:s');
		
		if(empty($nama_file)){
            $sql = $koneksi->query("UPDATE logo SET
                logo_nama      	= '$logo_nama',
                logo_lebar     	= '$logo_lebar',
                logo_panjang   	= '$logo_panjang',
                logo_alt 	    = '$logo_alt',
				logo_title 	    = '$logo_title'
                WHERE logo_id 	= '$logo_id'") or die(mysqli_error($koneksi));
            if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Logo: $logo_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
                $_SESSION['success'] = 'Data logo Berhasil Diubah';
            }else{
                $_SESSION['error'] = 'Ubah Data logo Gagal!';
            }	
            echo "<meta http-equiv='refresh' content='0; url=index.php?m=logosetting'>";
        }elseif (!empty($nama_file)){
			if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png" && $tipe_file != "image/webp") {
				$_SESSION['error'] = 'Perubahan Data Logo Gagal!, ekstensi image tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=?m=logosetting'>";
			}else{
				$db = "SELECT * FROM logo";
				$result = mysqli_query($koneksi, $db);
				if(mysqli_num_rows($result) > 0 ){
					$data = mysqli_fetch_array($result);
					@unlink('../assets/images/logo/'.$data['logo_gambar']);
				}
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = $koneksi->query("UPDATE logo SET
				logo_nama      	= '$logo_nama',
                logo_lebar     	= '$logo_lebar',
                logo_panjang   	= '$logo_panjang',
                logo_alt 	    = '$logo_alt',
				logo_title 	    = '$logo_title',
				logo_gambar		= '$nama_baru'
				WHERE logo_id  = '$logo_id'") or die(mysqli_error($koneksi));
				if($sql == true){
					$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Logo: $logo_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
					$_SESSION['success'] = 'Data logo Berhasil Diubah';
				}else{
					$_SESSION['error'] = 'Ubah Data logo Gagal!';
				}	
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=logosetting'>";
			}
		}
	}else if($_GET['m'] == 'metadataupdate'){
		$metadata_id           	= mysqli_real_escape_string($koneksi, $_POST['metadata_id']);
        $stringreplace 			= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
		$metadata_judul         = mysqli_real_escape_string($koneksi, $_POST['metadata_judul']);
		$metadata_copyright		= mysqli_real_escape_string($koneksi, $_POST['metadata_copyright']);
		$metadata_description   = mysqli_real_escape_string($koneksi, $_POST['metadata_description']);
		$metadata_keyword       = mysqli_real_escape_string($koneksi, $_POST['metadata_keyword']);
		$metadata_url	        = mysqli_real_escape_string($koneksi, $_POST['metadata_url']);
		$code		   		= md5(uniqid(rand()));
        $gencode			= substr($code, 0, 5);
        $replace			= strtolower(str_replace($stringreplace,'_',$metadata_judul));
        $nama_file 			= $_FILES["metadata_gambar"]["name"];
        $tipe_file 			= $_FILES["metadata_gambar"]["type"];
        $alamat 			= $_FILES["metadata_gambar"]["tmp_name"];
        $explode            = explode(".", $nama_file);
        $nama_baru 			= $replace."_".$gencode.".".end($explode);
        $tujuan 			= "../assets/images/logo/$nama_baru";
		$updated			= date('Y-m-d H:i:s');
		 if(empty($nama_file)){
            $sql = $koneksi->query("UPDATE metadata SET
                metadata_judul      = '$metadata_judul',
                metadata_copyright  = '$metadata_copyright',
                metadata_description= '$metadata_description',
                metadata_keyword    = '$metadata_keyword',
				metadata_url 	    = '$metadata_url'
                WHERE metadata_id 	= '$metadata_id'") or die(mysqli_error($koneksi));
            if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Meta data: $metadata_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
                $_SESSION['success'] = 'Data metadata Berhasil Diubah';
            }else{
                $_SESSION['error'] = 'Ubah Data metadata Gagal!';
            }	
            echo "<meta http-equiv='refresh' content='0; url=index.php?m=metadatasetting'>";
        }elseif (!empty($nama_file)){
			if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png" && $tipe_file != "image/webp") {
				$_SESSION['error'] = 'Perubahan Data metadata Gagal!, ekstensi image tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=?m=metadatasetting'>";
			}else{
				$db = "SELECT * FROM metadata";
				$result = mysqli_query($koneksi, $db);
				if(mysqli_num_rows($result) > 0 ){
					$data = mysqli_fetch_array($result);
					@unlink('../assets/images/logo/'.$data['metadata_gambar']);
				}
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = $koneksi->query("UPDATE metadata SET
				metadata_judul      = '$metadata_judul',
                metadata_copyright  = '$metadata_copyright',
                metadata_description= '$metadata_description',
                metadata_keyword 	= '$metadata_keyword',
				metadata_url 	    = '$metadata_url',
				metadata_gambar		= '$nama_baru'
				WHERE metadata_id  = '$metadata_id'") or die(mysqli_error($koneksi));
				if($sql == true){
					$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Meta data: $metadata_judul', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
					$_SESSION['success'] = 'Data metadata Berhasil Diubah';
				}else{
					$_SESSION['error'] = 'Ubah Data metadata Gagal!';
				}	
				echo "<meta http-equiv='refresh' content='0; url=index.php?m=metadatasetting'>";
			}
		}
	}
?>