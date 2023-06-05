<?php
    date_default_timezone_set('Asia/Jakarta');
    if ($_GET['m'] == 'customersimpan') {
        $customer_nama      = mysqli_real_escape_string($koneksi, $_POST['customer_nama']);
        $customer_telp      = mysqli_real_escape_string($koneksi, $_POST['customer_telp']);
        $customer_email     = mysqli_real_escape_string($koneksi, $_POST['customer_email']);
        $customer_password  = mysqli_real_escape_string($koneksi, md5($_POST['customer_password']));
        $customer_gender    = mysqli_real_escape_string($koneksi, $_POST['customer_gender']);
        $customer_status    = mysqli_real_escape_string($koneksi, $_POST['customer_status']);
        $db                 = $koneksi->query("SELECT max(customer_id) as kodeTerbesar FROM customer");
        $dt                 = $db->fetch_array();
        $kode               = $dt['kodeTerbesar'];    
        $urutan             = (int) substr($kode, 3, 3); 
        $urutan++;
        $huruf              = "CS";
        $customer_id        = $huruf . sprintf("%03s", $urutan);
		$updated			= date('Y-m-d H:i:s');

		$sql = $koneksi->query("INSERT INTO customer (customer_id, customer_nama, customer_telp, customer_email, customer_password, customer_gender, customer_status) VALUES ('$customer_id', '$customer_nama', '$customer_telp', '$customer_email', '$customer_password', '$customer_gender', '$customer_status')")or die(mysqli_error($koneksi));
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Customer: $customer_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Customer Berhasil Ditambahkan';
        }else{
            $_SESSION['error'] = 'Tambah Data Customer Admin Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=customer'>";
    }else if ($_GET['m'] == 'customerupdate') {
        $customer_id        = mysqli_real_escape_string($koneksi, $_POST['customer_id']);
        $customer_nama      = mysqli_real_escape_string($koneksi, $_POST['customer_nama']);
        $customer_telp      = mysqli_real_escape_string($koneksi, $_POST['customer_telp']);
        $customer_email     = mysqli_real_escape_string($koneksi, $_POST['customer_email']);
        $customer_password  = mysqli_real_escape_string($koneksi, md5($_POST['customer_password']));
        $customer_gender    = mysqli_real_escape_string($koneksi, $_POST['customer_gender']);
        $customer_status    = mysqli_real_escape_string($koneksi, $_POST['customer_status']);
		$updated			= date('Y-m-d H:i:s');
		
        if(empty($_POST['customer_password'])){
            $sql = $koneksi->query("UPDATE customer SET
            customer_nama      = '$customer_nama',
            customer_telp      = '$customer_telp',
            customer_email     = '$customer_email',
            customer_gender    = '$customer_gender',
            customer_status    = '$customer_status'
            WHERE customer_id  = '$customer_id'") or die(mysqli_error($koneksi));
        }else{
            $sql = $koneksi->query("UPDATE customer SET
            customer_nama      = '$customer_nama',
            customer_telp      = '$customer_telp',
            customer_email     = '$customer_email',
            customer_password  = '$customer_password',
            customer_gender    = '$customer_gender',
            customer_status    = '$customer_status',
            WHERE customer_id  = '$customer_id'") or die(mysqli_error($koneksi));    
        }
                
        if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Update', 'Data Customer: $customer_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Data Customer Berhasil Diubah';
        }else{
            $_SESSION['error'] = 'Ubah Data Customer Gagal!';
        }	
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=customer'>";
    }else if($_GET['m'] == 'customerhapus'){
		$updated	= date('Y-m-d H:i:s');
        $id 		= trim($_GET['id']);
		$sdb			= $koneksi->query("SELECT * FROM customer WHERE customer_id = '$id'");
		$sdt			= $sdb->fetch_array();
		$customer_nama	= $sdt['customer_nama'];
		$sql 		= $koneksi->query("DELETE FROM customer WHERE customer_id = '$id'");
		if($sql == true){
			$koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Hapus', 'Data Customer: $customer_nama', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
			$_SESSION['success'] = 'Data Customer Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Customer Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=index.php?m=customer'>";
    }
?>