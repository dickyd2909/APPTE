<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'suppliersimpan') {
        $supplier_nama      = mysqli_real_escape_string($koneksi, $_POST['supplier_nama']);
        $supplier_telp		= mysqli_real_escape_string($koneksi, $_POST['supplier_telp']);
        $supplier_alamat	= mysqli_real_escape_string($koneksi, $_POST['supplier_alamat']);
		$supplier_status	= mysqli_real_escape_string($koneksi, $_POST['supplier_status']);
        $db                 = $koneksi->query("SELECT max(supplier_id) as kodeTerbesar FROM supplier");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "SP";
        $supplier_id         = $huruf . sprintf("%03s", $urutan);
		$updated			= date('Y-m-d H:i:s');

		$sql = $koneksi->query("INSERT INTO supplier (supplier_id, supplier_nama, supplier_telp, supplier_alamat, supplier_status) VALUES ('$supplier_id', '$supplier_nama', '$supplier_telp', '$supplier_alamat', '$supplier_status')")or die(mysqli_error($koneksi));
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Supplier: $supplier_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Supplier Berhasil Ditambahkan';
        }else{
            $_SESSION['error'] = 'Tambah Data Supplier Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=supplier'>";
    }else if ($_GET['m'] == 'supplierupdate') {
        $supplier_id        = mysqli_real_escape_string($koneksi, $_POST['supplier_id']);
        $supplier_nama      = mysqli_real_escape_string($koneksi, $_POST['supplier_nama']);
        $supplier_telp		= mysqli_real_escape_string($koneksi, $_POST['supplier_telp']);
        $supplier_alamat	= mysqli_real_escape_string($koneksi, $_POST['supplier_alamat']);
		$supplier_status	= mysqli_real_escape_string($koneksi, $_POST['supplier_status']);
        $updated			= date('Y-m-d H:i:s');
       
        $sql = $koneksi->query("UPDATE supplier SET
            supplier_nama      = '$supplier_nama',
            supplier_telp      = '$supplier_telp',
            supplier_status    = '$supplier_status',
            supplier_alamat    = '$supplier_alamat'
            WHERE supplier_id  = '$supplier_id'") or die(mysqli_error($koneksi));

		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Supplier: $supplier_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Supplier Berhasil Diubah';
        }else{
            $_SESSION['error'] = 'Ubah Data Supplier Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=supplier'>";
    }else if($_GET['m'] == 'supplierhapus'){
		$updated		= date('Y-m-d H:i:s');
        $id 			= trim($_GET['id']);
		$sdb			= $koneksi->query("SELECT * FROM supplier WHERE supplier_id = '$id'");
		$sdt			= $sdb->fetch_array();
		$supplier_nama	= $sdt['supplier_nama'];
		$sql 			= $koneksi->query("DELETE FROM supplier WHERE supplier_id = '$id'");
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Supplier: $supplier_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
			$_SESSION['success'] = 'Data Supplier Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Supplier Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=index.php?m=supplier'>";
    }
?>