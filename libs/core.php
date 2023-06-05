<?php 
	function site($file) {
		include "../config/database.php";
		$dir = "view/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
	
	function art($file) {
		$dir = "module/artikel/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
	
	function blog($file) {
		$dir = "module/berita/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
	
	function sys($file) {
		$dir = "system/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
?>