<?php 
	function mod($file) {
		$dir = "modules/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
?>