<?php
include_once "../../library/inc.sesadmin.php";
error_reporting(0);
$id    = $_GET['Kode'];
$sql_1 = "SELECT * FROM tb_retail WHERE id_retail = '$id'";
$qry_1 = mysqli_query($mysqli, $sql_1) or die ("MySQL Salah! ".mysql_error());
$rows  = mysqli_fetch_array($qry_1, MYSQLI_ASSOC);

if (mysqli_num_rows($qry_1) > 0) {
    // mengambil foto lama
    $fotolamakto = $rows['foto_ktp'];
    $fotolamatko = $rows['foto'];
    // menghapus foto yg tersimpan dalam file dan akan diganti
    unlink("../img-retail/".$fotolamakto);
    unlink("../img-retail/".$fotolamatko);
    // untuk menghapus data
    $sql_2 = "DELETE FROM tb_retail WHERE id_retail = '$id'";
    $qry_2 = mysqli_query($mysqli, $sql_2) or die ("MySQL Salah!".mysqli_error($mysqli));
    if ($qry_2 == true) {
        echo "<script>alert('Berhasil!')</script>";
        echo "<script>document.location.href='?open=Data-Retail';</script>";
    }
}