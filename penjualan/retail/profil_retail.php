<?php
$kdpelanggan = $_SESSION['SES_PELANGGAN'];
$sql_1 = "SELECT * FROM tb_retail WHERE id_retail = '$kdpelanggan'";
$qry_1 = mysqli_query($mysqli, $sql_1) or die ("MySQL Salah! ".mysql_error());
$rows  = mysqli_fetch_array($qry_1, MYSQLI_ASSOC);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Riolo Traditional Taste</title>
</head>

<body bgcolor="#FFCCFF" background="../assets/images/background.png">
        
    <h2>Profil Retail</h2>

    <table style="margin-bottom: 50px;" bgcolor="#FFCCFF">
        <tr>
            <td width="150">Nama Pemilik</td>
            <td width="10">:</td>
            <td width="150"><?= $rows['nama_pemilik'] ?></td>
            <td rowspan="6"> 
                <img src="<?= ($rows['foto_ktp'] == null) ? '../assets/images/retail.png' : '../img-retail/'.$rows['foto_ktp'] ?>" title="<?= $rows['nama_pemilik'] ?>" width="200" height="200" />
                <img src="<?= ($rows['foto'] == null) ? '../assets/images/retail.png' : '../img-retail/'.$rows['foto'] ?>" title="<?= $rows['nama_toko'] ?>" width="200" height="200" />
            </td>
        </tr>
        <tr>
            <td>Nama Toko</td>
            <td>:</td>
            <td><?= $rows['nama_toko'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><?= IndonesiaTgl($rows['tgl_lahir']) ?></td>
        </tr>
        <tr>
            <td>No. Hp / Telepon</td>
            <td>:</td>
            <td><?= $rows['nomor'] ?></td>
        </tr>
        <tr>
            <td>Fax</td>
            <td>:</td>
            <td><?= $rows['fax'] ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?= $rows['email'] ?></td>
        </tr>
        <tr>
            <td>Website</td>
            <td>:</td>
            <td><a href="<?= $rows['website'] ?>" target="_blank"><?= $rows['website'] ?></a></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $rows['alamat'] ?></td>
        </tr>
        <tr>
            <td>
                <a href="?open=Barang"><img src="../assets/images/hapus.gif" width="22" height="22" /></a>&nbsp;
                <a href="?open=Profil-Retail-Ubah"><img src="../assets/images/ubah.gif" /></a>
            </td>
        </tr>
    </table>

</body>

</html>