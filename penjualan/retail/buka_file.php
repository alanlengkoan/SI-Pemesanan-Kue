<?php
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

if(isset($_GET['open'])) {

	$open = $_GET['open'];
	$file = str_replace("-", "_", strtolower($open));
	if (file_exists($file.".php")) {
		include_once $file.".php";		
	} else {
		include_once "barang.php";
	}
	
} else {

	include_once "barang.php";

}
?>