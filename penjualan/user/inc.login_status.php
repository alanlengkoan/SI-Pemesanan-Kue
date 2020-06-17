<?php
if (isset($_SESSION['SES_PELANGGAN'])=="") {
	echo "<b>[ Status : Belum Login ";
	echo "| User : Tamu ] </b>";
}
else {
	echo "<b>[ Status : Login ";
	echo "| ID User : ".$_SESSION['SES_PELANGGAN'];
	echo "[ <a href='login_out.php'>Logout </a> ]</b>";	
}
?>