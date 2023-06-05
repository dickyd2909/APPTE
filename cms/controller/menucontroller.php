<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'menusimpan') {
        $menu_nama       	= mysqli_real_escape_string($koneksi, $_POST['menu_nama']);
		$menu_titlepage     = mysqli_real_escape_string($koneksi, $_POST['menu_titlepage']);
		$menu_url     		= mysqli_real_escape_string($koneksi, $_POST['menu_url']);
        $menu_status   		= mysqli_real_escape_string($koneksi, $_POST['menu_status']);
		$menu_target   		= mysqli_real_escape_string($koneksi, $_POST['menu_target']);
		$odb 				= $koneksi->query("SELECT MAX(menu_order) AS LastNo FROM menu");
		$odt 				= $odb->fetch_array();
		$menu_order 		= $odt['LastNo'] + 1;
		$db                 = $koneksi->query("SELECT max(menu_id) as kodeTerbesar FROM menu");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "MN";
        $menu_id         	= $huruf . sprintf("%03s", $urutan);
		$updated			= date('Y-m-d H:i:s');

		$sql = $koneksi->query("INSERT INTO menu (menu_id, menu_nama, menu_url, menu_titlepage, menu_status, menu_target, menu_order) VALUES ('$menu_id', '$menu_nama', '$menu_url', '$menu_titlepage', '$menu_status', '$menu_target', '$menu_order')")or die(mysqli_error($koneksi));
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Menu: $menu_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Menu Berhasil Ditambahkan';
        }else{
            $_SESSION['error'] = 'Tambah Data Menu Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=menu'>";
    }else if ($_GET['m'] == 'menuupdate') {
        $menu_id           	= mysqli_real_escape_string($koneksi, $_POST['menu_id']);
        $menu_nama       	= mysqli_real_escape_string($koneksi, $_POST['menu_nama']);
		$menu_titlepage     = mysqli_real_escape_string($koneksi, $_POST['menu_titlepage']);
		$menu_url     		= mysqli_real_escape_string($koneksi, $_POST['menu_url']);
        $menu_status   		= mysqli_real_escape_string($koneksi, $_POST['menu_status']);
		$menu_target   		= mysqli_real_escape_string($koneksi, $_POST['menu_target']);
        $updated			= date('Y-m-d H:i:s');
        
        $sql = $koneksi->query("UPDATE menu SET
		menu_nama      	= '$menu_nama',
		menu_titlepage 	= '$menu_titlepage',
		menu_url	 	= '$menu_url',
		menu_status		= '$menu_status',
		menu_target		= '$menu_target'
		WHERE menu_id  	= '$menu_id'") or die(mysqli_error($koneksi));
    

		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Menu: $menu_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Menu Berhasil Diubah';
        }else{
            $_SESSION['error'] = 'Ubah Menu Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=menu'>";
    }else if($_GET['m'] == 'menuhapus'){
		$updated	= date('Y-m-d H:i:s');
        $id 		= trim($_GET['id']);
		$sdb			= $koneksi->query("SELECT * FROM menu WHERE menu_id = '$id'");
		$sdt			= $sdb->fetch_array();
		$menu_nama		= $sdt['menu_nama'];
		$sql 		= $koneksi->query("DELETE FROM menu WHERE menu_id = '$id'");
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Menu: $menu_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
			$_SESSION['success'] = 'Data Menu Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Menu Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=index.php?m=menu'>";
    }
?>