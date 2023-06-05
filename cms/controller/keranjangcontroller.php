<?php 
    if($_GET['m'] == "keranjang"){
        $barang_id = $_GET['id'];
        if (isset($_SESSION['keranjang'][$barang_id]))
        {
            $_SESSION['keranjang'][$barang_id]+=1;
        }
        else
        {
            $_SESSION['keranjang'][$barang_id] = 1;
        }
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=transaksi'>";
    }else if($_GET['m'] == "keranjanghapus"){
        $barang_id = $_GET['id'];
        unset($_SESSION['keranjang'][$barang_id]);
        echo "<meta http-equiv='refresh' content='0; url=index.php?m=transaksi'>";
    }else if($_GET['m'] == "transaksiaction"){
        $penjualan_id       = mysqli_real_escape_string($koneksi, $_POST['transaksi_id']);
        $customer_id        = mysqli_real_escape_string($koneksi, $_POST['customer_id']);
        $admin_id           = mysqli_real_escape_string($koneksi, $_POST['admin_id']);
        $tanggal_penjualan  = mysqli_real_escape_string($koneksi, $_POST['tanggal_penjualan']);
        $penjualan_status   = 'Berhasil';
        $total_bayar        = mysqli_real_escape_string($koneksi, $_POST['jumlah_bayar']);
        $total_beli         = mysqli_real_escape_string($koneksi, $_POST['total_beli']);
        $updated			= date('Y-m-d H:i:s');
        $sql = $koneksi->query("INSERT INTO penjualan (penjualan_id, customer_id, admin_id, tanggal_penjualan, penjualan_status) VALUES ('$penjualan_id', '$customer_id', '$admin_id', '$tanggal_penjualan', '$penjualan_status')") or die (mysqli_error($koneksi));

        $db2                = $koneksi->query("SELECT max(detailpenjualan_id) as kodeTerbesar FROM detailpenjualan");
		$dt2                = $db2->fetch_array();
		$kode               = $dt2['kodeTerbesar'];    
		$urutan             = (int) substr($kode, 3, 3); 
		$urutan++;
		$huruf              = "DT";
		$detailpenjualan_id	= $huruf . sprintf("%03s", $urutan);

        foreach ($_SESSION["keranjang"] as $barang_id => $jumlah) 
	    {
            $ambil=$koneksi->query("SELECT * FROM barang WHERE barang_id='$barang_id'");
		    $perbarang      = $ambil->fetch_assoc();
            $qty            = $jumlah;
		    $harga          = $perbarang['barang_harga'];
            $total_barang   = $perbarang['barang_harga']*$qty;

           $koneksi->query("INSERT INTO detailpenjualan (detailpenjualan_id, penjualan_id, barang_id, qty, harga, total_harga) 
            VALUES ('$detailpenjualan_id', '$penjualan_id', '$barang_id', '$qty', '$harga', '$total_beli')") or die (mysqli_error($koneksi));

            $koneksi->query("UPDATE barang SET barang_stok=barang_stok-$jumlah WHERE barang_id='$barang_id'")or die (mysqli_error($koneksi));
        }
        $db3                = $koneksi->query("SELECT max(pembayaranjual_id) as kodeTerbesar FROM pembayaranjual");
		$dt3                = $db3->fetch_array();
		$kode               = $dt3['kodeTerbesar'];    
		$urutan             = (int) substr($kode, 3, 3); 
		$urutan++;
		$huruf              = "PJ";
		$pembayaranjual_id	= $huruf . sprintf("%03s", $urutan);
        $sql2 = $koneksi->query("INSERT INTO pembayaranjual (pembayaranjual_id, penjualan_id, admin_id, total_bayar, total_beli, tanggal_pembayaran) VALUES ('$pembayaranjual_id', '$penjualan_id', '$admin_id', '$total_bayar', '$total_beli', '$tanggal_penjualan') ");
        $kembalian = $total_bayar - $total_beli;
        if($sql && $sql2){
            $koneksi->query("INSERT INTO logscontent (logscontent_id, logscontent_status, logscontent_desc, logscontent_read, postdated, admin_id) VALUES(NULL, 'Simpan', 'Data Transaksi: $penjualan_id', '1', '$updated', '$_SESSION[admin_id]')")or die(mysqli_error($koneksi));
            $_SESSION['success'] = 'Transaksi Berhasil! kembalian anda "'.number_format($kembalian).'" ! ';
            unset($_SESSION['keranjang']);
        }

        echo "<meta http-equiv='refresh' content='0; url=index.php?m=transaksi'>";

    }
    
    
?>