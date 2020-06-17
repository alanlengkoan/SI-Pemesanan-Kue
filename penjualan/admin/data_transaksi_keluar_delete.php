<?php
include_once "../../library/inc.library.php";

$Kode  = $_GET['Kode'];
$mySql = "DELETE FROM tb_retail_transaksi WHERE kd_transaksi = '$Kode'";
$myQry = mysqli_query($mysqli, $mySql) or die ("MySQL Salah! ".mysqli_error($mysqli));

mysqli_query($mysqli, "DELETE FROM tb_retail_pemesanan WHERE kd_transaksi = '$Kode'") or die ("MySQL Salah! ".mysqli_error($mysqli));

if($myQry == true) {
    echo "<meta http-equiv='refresh' content='0; url=?open=Data-Transaksi-Keluar'>";
}