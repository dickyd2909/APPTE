<?php
    if(isset($_GET['m'])){
        switch ($_GET['m']) {
            // MAIN
            case 'dashboard': include("../modules/main/main.php"); break;
            // ====================================================================================================
            // ADMIN
            case 'admin': include("../modules/admin/admin_index.php"); break;
            case 'adminsimpan': include("../controller/admincontroller.php"); break;
            case 'adminupdate': include("../controller/admincontroller.php"); break;
            case 'adminhapus': include("../controller/admincontroller.php"); break;
			case 'adminsetting': include("../modules/admin/admin_setting.php"); break;
			case 'adminedit': include("../modules/admin/admin_edit.php"); break;
			case 'adminprofilupdate': include("../controller/admincontroller.php"); break;
            // ====================================================================================================
            // KATEGORI
            case 'admincat': include("../modules/admincat/admincat_index.php"); break;
            case 'admincatsimpan': include("../controller/admincatcontroller.php"); break;
            case 'admincatupdate': include("../controller/admincatcontroller.php"); break;
            case 'admincathapus': include("../controller/admincatcontroller.php"); break;
            // ====================================================================================================
			// KATEGORI KONTEN
            case 'contentcat': include("../modules/contentcat/contentcat_index.php"); break;
            case 'contentcatsimpan': include("../controller/contentcatcontroller.php"); break;
            case 'contentcatupdate': include("../controller/contentcatcontroller.php"); break;
            case 'contentcathapus': include("../controller/contentcatcontroller.php"); break;
            // ====================================================================================================
			// KONTEN
            case 'content': include("../modules/content/content_index.php"); break;
            case 'contentsimpan': include("../controller/contentcontroller.php"); break;
            case 'contentupdate': include("../controller/contentcontroller.php"); break;
            case 'contenthapus': include("../controller/contentcontroller.php"); break;
            // ====================================================================================================
            // CUSTOMER
            case 'customer': include("../modules/customer/customer_index.php"); break;
            case 'customersimpan': include("../controller/customercontroller.php"); break;
            case 'customerupdate': include("../controller/customercontroller.php"); break;
            case 'customerhapus': include("../controller/customercontroller.php"); break;
            // ====================================================================================================
            // BARANG / PRODUK
            case 'produk': include("../modules/produk/produk_index.php"); break;
            case 'produksimpan': include("../controller/produkcontroller.php"); break;
            case 'produkupdate': include("../controller/produkcontroller.php"); break;
            case 'produkhapus': include("../controller/produkcontroller.php"); break;
            // ====================================================================================================
            // BARANG / PRODUK
            case 'supplier': include("../modules/supplier/supplier_index.php"); break;
            case 'suppliersimpan': include("../controller/suppliercontroller.php"); break;
            case 'supplierupdate': include("../controller/suppliercontroller.php"); break;
            case 'supplierhapus': include("../controller/suppliercontroller.php"); break;
            // ====================================================================================================
			// PENJUALAN
            case 'penjualan': include("../modules/penjualan/penjualan_index.php"); break;
            case 'detailpenjualan': include("../modules/penjualan/detailpenjualan.php"); break;
            case 'statuspenjualan': include("../controller/penjualancontroller.php"); break;
            case 'supplierhapus': include("../controller/suppliercontroller.php"); break;
            // ====================================================================================================
			// SLIDESHOW
            case 'slideshow': include("../modules/slideshow/slideshow_index.php"); break;
            case 'slideshowsimpan': include("../controller/slideshowcontroller.php"); break;
            case 'slideshowupdate': include("../controller/slideshowcontroller.php"); break;
            case 'slideshowhapus': include("../controller/slideshowcontroller.php"); break;
            // ====================================================================================================
			// MENU
            case 'menu': include("../modules/menu/menu_index.php"); break;
            case 'menusimpan': include("../controller/menucontroller.php"); break;
            case 'menuupdate': include("../controller/menucontroller.php"); break;
            case 'menuhapus': include("../controller/menucontroller.php"); break;
            // ====================================================================================================
			//LOGO
			case 'logosetting': include("../modules/logo/logo_index.php");break;
			case 'logoedit': include("../modules/logo/logo_edit.php");break;
			case 'logoupdate': include("../controller/admincontroller.php"); break;
			// ====================================================================================================
			// ====================================================================================================
			//METADATA
			case 'metadatasetting': include("../modules/metadata/metadata_index.php");break;
			case 'metadataedit': include("../modules/metadata/metadata_edit.php");break;
			case 'metadataupdate': include("../controller/settingcontroller.php"); break;
			// ====================================================================================================
			//LOGS
			case 'logsvisitor': include("../modules/logs/logsvisitor.php");break;
			case 'logscontent': include("../modules/logs/logscontent.php");break;
			// ====================================================================================================
			// BERITA
            case 'berita': include("../modules/berita/berita_index.php"); break;
            case 'beritasimpan': include("../controller/beritacontroller.php"); break;
            case 'beritaupdate': include("../controller/beritacontroller.php"); break;
            case 'beritahapus': include("../controller/beritacontroller.php"); break;
            // ====================================================================================================
        }
    }
?>