<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'produksimpan') {
        $stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
        $barang_nama        = mysqli_real_escape_string($koneksi, $_POST['barang_nama']);
        $barang_jenis		= mysqli_real_escape_string($koneksi, $_POST['barang_jenis']);
		$barang_harga   	= mysqli_real_escape_string($koneksi, $_POST['barang_harga']);
		$barang_stok   	    = mysqli_real_escape_string($koneksi, $_POST['barang_stok']);
        $db                 = $koneksi->query("SELECT max(barang_id) as kodeTerbesar FROM barang");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "BR";
        $barang_id         = $huruf . sprintf("%04s", $urutan);

        $code		   		= md5(uniqid(rand()));
        $gencode			= substr($code, 0, 5);
        $replace			= strtolower(str_replace($stringreplace,'_',$barang_nama));
        $nama_file 			= $_FILES["barang_image"]["name"];
        $tipe_file 			= $_FILES["barang_image"]["type"];
        $alamat 			= $_FILES["barang_image"]["tmp_name"];
        $explode            = explode(".", $nama_file);
        $nama_baru 			= $replace."_".$gencode.".".end($explode);
        $tujuan 			= "../assets/images/produk/$nama_baru";
		$updated			= date('Y-m-d H:i:s');
		
        if (empty($nama_file)) {
            $sql = $koneksi->query("INSERT INTO barang (barang_id, barang_nama, barang_jenis, barang_harga, barang_stok) VALUES ('$barang_id', '$barang_nama', '$barang_jenis', '$barang_harga', '$barang_stok')")or die(mysqli_error($koneksi));
            if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Produk: $barang_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
                $_SESSION['success'] = 'Data Barang Berhasil Ditambahkan';
            }else{
                $_SESSION['error'] = 'Tambah Data Barang Gagal!';
            }	
            echo "<meta http-equiv='refresh' content='0; url=index.php?m=produk'>";
        }else{
            if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png" && $tipe_file != "image/webp") {
                $_SESSION['error'] = 'Format gambar tidak didukung!';
                echo "<meta http-equiv='refresh' content='0; url=index.php?m=produk'>";
            }else{
                $gambar_baru = move_uploaded_file($alamat, $tujuan);
                $sql = $koneksi->query("INSERT INTO barang (barang_id, barang_nama, barang_jenis, barang_harga, barang_stok, barang_image) VALUES ('$barang_id', '$barang_nama', '$barang_jenis', '$barang_harga', '$barang_stok', '$nama_baru')")or die(mysqli_error($koneksi));

                if($sql == true){
					$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Produk: $barang_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
                    $_SESSION['success'] = 'Data Barang Berhasil Ditambahkan';
                }else{
                    $_SESSION['error'] = 'Tambah Data Barang Gagal!';
                }	
                echo "<meta http-equiv='refresh' content='0; url=index.php?m=produk'>";
            }
        }
    }else if ($_GET['m'] == 'produkupdate') {
        $barang_id           = mysqli_real_escape_string($koneksi, $_POST['barang_id']);
        $stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
        $barang_nama        = mysqli_real_escape_string($koneksi, $_POST['barang_nama']);
        $barang_jenis		= mysqli_real_escape_string($koneksi, $_POST['barang_jenis']);
		$barang_harga   	= mysqli_real_escape_string($koneksi, $_POST['barang_harga']);
        $barang_stok        = mysqli_real_escape_string($koneksi, $_POST['barang_stok']);

        $code		   		= md5(uniqid(rand()));
        $gencode			= substr($code, 0, 5);
        $replace			= strtolower(str_replace($stringreplace,'_',$barang_nama));
        $nama_file 			= $_FILES["barang_image"]["name"];
        $tipe_file 			= $_FILES["barang_image"]["type"];
        $alamat 			= $_FILES["barang_image"]["tmp_name"];
        $explode            = explode(".", $nama_file);
        $nama_baru 			= $replace."_".$gencode.".".end($explode);
        $tujuan 			= "../assets/images/produk/$nama_baru";
        $updated			= date('Y-m-d H:i:s');
		
        if(empty($nama_file)){
            $sql = $koneksi->query("UPDATE barang SET
                barang_nama      = '$barang_nama',
                barang_jenis     = '$barang_jenis',
                barang_harga     = '$barang_harga',
                barang_stok      = '$barang_stok'
                WHERE barang_id  = '$barang_id'") or die(mysqli_error($koneksi));
            if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Produk: $barang_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
                $_SESSION['success'] = 'Data barang Berhasil Diubah';
            }else{
                $_SESSION['error'] = 'Ubah Data barang Gagal!';
            }	
            echo "<meta http-equiv='refresh' content='0; url=index.php?m=produk'>";
        }elseif (!empty($nama_file)){
            if ($tipe_file != "image/gif" && $tipe_file != "image/jpg" && $tipe_file != "image/jpeg" && $tipe_file != "image/png" && $tipe_file != "image/webp") {
                echo "<meta http-equiv='refresh' content='0; url=index.php?m=produk'>";
            }else{
                $db = "SELECT * FROM barang WHERE barang_id ='$barang_id'";
                $result = mysqli_query($koneksi, $db);
                if(mysqli_num_rows($result) > 0 ){
                    $data = mysqli_fetch_array($result);
                    @unlink('../assets/images/produk/'.$data['barang_image']);
                }
                $gambar_baru = move_uploaded_file($alamat, $tujuan);
                $sql = $koneksi->query("UPDATE barang SET
                barang_nama      = '$barang_nama',
                barang_jenis     = '$barang_jenis',
                barang_harga     = '$barang_harga',
                barang_stok      = '$barang_stok',
                barang_image     = '$nama_baru'
                WHERE barang_id  = '$barang_id'") or die(mysqli_error($koneksi));
                if($sql == true){
					$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Produk: $barang_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
                    $_SESSION['success'] = 'Data barang Berhasil Diubah';
                }else{
                    $_SESSION['error'] = 'Ubah Data barang Gagal!';
                }	
                echo "<meta http-equiv='refresh' content='0; url=index.php?m=produk'>";
            }
        }

     
    }else if($_GET['m'] == 'produkhapus'){
        $id     = $_GET['id'];
        $db     = $koneksi->query("SELECT * FROM barang WHERE barang_id ='$id'");
		$updated= date('Y-m-d H:i:s');
        if (mysqli_num_rows($db) > 0) {
            $dt     		= mysqli_fetch_array($db);
			$barang_nama	= $dt['barang_nama'];
            @unlink('../assets/images/produk/'.$dt['barang_image']);
            $sql    = $koneksi->query("DELETE FROM barang WHERE barang_id = '$id'");
            if($sql == true){
				$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Produk: $barang_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
                $_SESSION['success'] = 'Data barang Berhasil Dihapus!';
            }else{
                $_SESSION['error'] = 'Hapus Data barang Gagal!';
            }	
        }
		
		echo "<meta http-equiv='refresh' content='0; url=index.php?m=produk'>";
    }
?>