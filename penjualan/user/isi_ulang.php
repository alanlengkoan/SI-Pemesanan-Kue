<?php
include_once "inc.session.php";
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['SES_PELANGGAN'];
$sql = "SELECT a.nm_pelanggan FROM pelanggan AS a INNER JOIN isi_ulang AS b ON a.kd_pelanggan = b.kd_pelanggan WHERE a.kd_pelanggan = '$KodePelanggan'";
$qry = mysqli_query($mysqli, $sql) or die ("MySQL Salah! ".mysqli_error($mysqli));

// kode otomatis
$kodeoto = buatKode("isi_ulang", "U", $mysqli);
?>

<?php if (mysqli_num_rows($qry) > 0) : ?>
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
        <td height="22" colspan="3" bgcolor="#CCCCCC"> <b>ISI ULANG</b> </td>
        <td height="22" align="right" colspan="3" bgcolor="#CCCCCC">
            <a href="?open=Isi-Ulang-Tambah" target="_self"><img src="../assets/images/btn_add_data.png" height="30" border="0" /></a>
        </td>
    </tr>
    <tr bgcolor="#dfe9ff">
        <td><strong>No</strong></td>
        <td><strong>Nama</strong></td>
        <td><strong>Jenis Kelamin</strong></td>
        <td><strong>Email</strong></td>
        <td><strong>No. Hp</strong></td>
    </tr>
    <?php
    // menampilkan hasil top up
    $nomor = 1;
    $mySql = "SELECT a.isi_dompet, b.nm_pelanggan, b.kelamin, b.email, b.no_telepon FROM isi_ulang AS a INNER JOIN pelanggan AS b ON a.kd_pelanggan = b.kd_pelanggan WHERE a.kd_pelanggan = '$KodePelanggan'";
    $myQry = mysqli_query($mysqli, $mySql) or die ("Gagal query".mysql_error());
    while ($row = mysqli_fetch_array($myQry,  MYSQLI_ASSOC)) { ?>
        <tr>
            <td><?= $nomor++ ?></td>
            <td><?= $row['nm_pelanggan'] ?></td>
            <td><?= $row['kelamin'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['no_telepon'] ?></td>
        </tr>
        <?php } ?>
</table>
<?php else: ?>
<?php 
$sql_cek = "SELECT a.nm_pelanggan FROM pelanggan AS a WHERE a.kd_pelanggan = '$KodePelanggan'";
$qry_cek = mysqli_query($mysqli, $sql_cek) or die ("MySQL Salah! ".mysqli_error($mysqli));
$row = mysqli_fetch_array($qry_cek, MYSQLI_ASSOC);
?>
<form method="post" name="frmadd" target="_self">
    <table class="table-list" width="100%" style="margin-top:0px;">
        <tr>
            <th colspan="3">ISI ULANG PELANGGAN</th>
        </tr>
        <tr>
            <td width="18%"><strong>Kode</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%">
                <input type="hidden" name="txtNama" value="<?= $KodePelanggan ?>" required />
                <input type="text" name="textfield" value="<?= $kodeoto ?>" size="10" maxlength="10" readonly="readonly" />
            </td>
        </tr>
        <tr>
            <td><strong>Nama Pelanggan</strong></td>
            <td><strong>:</strong></td>
            <td>
                <input type="text" value="<?= $row['nm_pelanggan'] ?>" size="10" maxlength="10" readonly="readonly" />
            </td>
        </tr>
        <tr>
            <td><strong>Saldo</strong></td>
            <td><strong>:</strong></td>
            <td>
                <input type="number" name="saldo" value="0" size="80" maxlength="100" />
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="btnTambah" value="TAMBAH" style="cursor:pointer;">
            </td>
        </tr>
    </table>
</form>
<?php endif; ?>

<?php 
if(isset($_POST['btnTambah'])) {
    $idisiulang = $_POST['textfield'];
    $txtNama    = str_replace("'","&acute;", $_POST['txtNama']);
    $saldo      = $_POST['saldo'];
	
	// validasi error pada form
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Pelanggan</b> tidak boleh kosong !";		
	}
	if (trim($saldo)=="") {
		$pesanError[] = "Data <b>Saldo</b> tidak boleh kosong !";		
	}
    
    $mySql = "INSERT INTO isi_ulang SET id_isi_ulang = '$idisiulang', kd_pelanggan = '$txtNama', isi_dompet = '$saldo' ";
    $myQry = mysqli_query($mysqli, $mySql) or die ("Query salah : ".mysqli_error($mysqli));
    if($myQry == true) {
        echo "<meta http-equiv='refresh' content='0; url=?open=Isi-Ulang'>";
    }
}
?>