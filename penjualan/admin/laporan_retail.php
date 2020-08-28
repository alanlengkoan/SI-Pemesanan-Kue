<?php
include_once "../../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../../library/inc.connection.php"; // Membuka koneksi
include_once "../../library/inc.library.php";    // Membuka librari peringah fungsi

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris    = 50;
$hal      = isset($_GET['hal']) ? $_GET['hal'] : 0;
$sql      = "SELECT * FROM pelanggan";
$qry      = mysqli_query($mysqli, $sql) or die ("error paging: ".mysqli_error($mysqli));
$jml      = mysqli_num_rows($qry);
$maksData = ceil($jml/$baris);
?>
<b><h2><font color="#FF0066">DATA RETAIL</font></h2></b>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><font color="#FF0066"><strong>No</strong></font></td>
    <td width="101" bgcolor="#CCCCCC"><font color="#FF0066"><strong>Id Retail </strong></font></td>
    <td width="179" bgcolor="#CCCCCC"><font color="#FF0066"><strong>Nama Pemilik </strong></font></td>
    <td width="70" bgcolor="#CCCCCC"><font color="#FF0066"><strong>Tanggal Lahir</strong></font></td>
    <td width="105" bgcolor="#CCCCCC"><font color="#FF0066"><strong>No. Hp </strong></font></td>
    <td width="144" bgcolor="#CCCCCC"><font color="#FF0066"><strong> E-Mail  </strong></font></td>
    <td width="140" bgcolor="#CCCCCC"><font color="#FF0066"><strong>Username</strong></font></td>
</tr>
<?php
$mySql = "SELECT * FROM tb_retail ORDER BY id_retail DESC LIMIT $hal, $baris";
$myQry = mysqli_query($mysqli, $mySql)  or die ("Query salah : ".mysqli_error($mysqli));
$nomor = $hal; 
while ($myData = mysqli_fetch_array($myQry, MYSQLI_ASSOC)) {
	?>
    <tr>
        <td align="center"><?= $nomor++ ?></td>
        <td><?= $myData['id_retail'] ?></td>
        <td><?= $myData['nama_pemilik'] ?></td>
        <td><?= IndonesiaTgl($myData['tgl_lahir']) ?></td>
        <td><?= $myData['nomor'] ?></td>
        <td><?= $myData['email'] ?></td>
        <td><?= $myData['username'] ?></td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="3" bgcolor="#CCCCCC"><font color="#FF0066"><b>Jumlah Data :</b></font> <?php echo $jml; ?> </td>
        <td colspan="4" align="right" bgcolor="#CCCCCC"><font color="#FF0066"><b>Halaman ke :</b></font>
            <?php for ($h = 1; $h <= $maksData; $h++) { ?>
            <?php $list[$h] = $baris * $h - $baris; ?>
            <a href='?open=Laporan-Retail&hal=<?= $list[$h] ?>'><?= $h ?></a>
            <?php } ?>
        </td>
    </tr>
</table>
