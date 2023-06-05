<?php 
    include "../config/database.php";
?>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<meta name="generator" content="cms-phpnative">
	<meta name="robots" content="index, follow">
	<meta name="developer" content="dickydarmawan">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="author" content="Dicky Darmawan">
    <link href="../cms/assets/images/logo/olshop_maliniart_-_jakarta__indonesia_d2073.png" rel="shortcut icon" type="image/x-icon" />
    <style type="text/css">
         body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Arial";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    .rangkassurat{margin:0 auto;background:#fff;padding:20px;}
    .tabel{border-bottom: 5px solid #000;padding:2px;}
    .tengah{text-align: center;line-height: 5px;}
    .tengah h4{margin:0 auto;padding:0;line-height: 20px;}
    .tengah h3{margin:0 auto;padding:0;line-height: 20px;}
    .tengah b{margin:1% auto 0;padding:0;line-height: 20px;font-size: 14px;}
    .tabel2 tr{margin:1% auto;}
    </style>
    <title>Ipsum Official Website Online Store</title>
</head>
<Body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="rangkassurat">
                    <table class="tabel" width="100%">
                        <tr>
                            <td><img src="../cms/assets/images/logo/olshop_maliniart_-_jakarta__indonesia_d2073.png" alt=""></td>
                            <td class="tengah">
                                <h4>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h4>
                                <h4>MENTERI KOPERASI DAN USAHA KECIL DAN MENENGAH</h4>
                                <h3>LAPORAN PENJUALAN KOPERASI MULTI PIHAK LOREM IPSUM BANDUNG</h3>
                                <b>Jl. Phh. Mustofa No.23, Neglasari, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40124</b>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="datadetail">
                    <?php
                        $tanggal1 = $_POST['filter1'];
                        $tanggal2 = $_POST['filter2'];
                        $db = $koneksi->query("SELECT * FROM penjualan INNER JOIN pembayaranjual ON penjualan.penjualan_id = pembayaranjual.penjualan_id INNER JOIN customer ON penjualan.customer_id = customer.customer_id WHERE tanggal_penjualan >= '$tanggal1' AND tanggal_penjualan <= '$tanggal2' ") or die (mysqli_error($koneksi));
                        while($dt = $db->fetch_array()){
                    ?>
                        <table class="tabel2" width="60%">
                            <tr>
                                <td>ID TRANSAKSI</td>
                                <td>:</td>
                                <td><?= $dt['penjualan_id']; ?></td>
                            </tr>
                            <tr>
                                <td>CUSTOMER</td>
                                <td>:</td>
                                <td><?= $dt['customer_nama']; ?></td>
                            </tr>
                            <tr>
                                <td>TANGGAL</td>
                                <td>:</td>
                                <td><?= $dt['tanggal_penjualan']; ?></td>
                            </tr>
                            <tr>
                                <td>PEMBAYARAN</td>
                                <td>:</td>
                                <td>Rp.<?= number_format($dt['total_bayar']); ?></td>
                            </tr>
                        </table>
                        <h3>Detail Pembelian</h3>
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $total = 0;
                                    $no = 1;
                                    $ddb = $koneksi->query("SELECT * FROM detailpenjualan INNER JOIN barang ON detailpenjualan.barang_id = barang.barang_id WHERE penjualan_id = '$dt[penjualan_id]' ");
                                    while($ddt = $ddb->fetch_array()){
                                ?>
                                    <tr>
                                        <td width="1%" align="center"><?= $no++ ?></td>
                                        <td><?= $ddt['barang_nama']; ?></td>
                                        <td width="1%" align="center"><?= $ddt['qty']; ?></td>
                                        <td>Rp. <?= number_format($ddt['harga']); ?></td>
                                        <td>Rp. <?= number_format($ddt['total_harga']); ?></td>
                                    </tr>
                                <?php $total += $ddt['total_harga']; } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td>Rp. <?= number_format($total); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    
                    <?php } ?>

                </div>
            </div>    
        </div>
    </div>
    <script type="text/javascript">window.print();</script>
</Body>
</html>