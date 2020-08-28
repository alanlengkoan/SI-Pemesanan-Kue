<?php
include_once "inc.session.php";
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan = $_SESSION['SES_PELANGGAN'];
$sql   = "SELECT b.nm_pelanggan, a.isi_dompet FROM isi_ulang AS a INNER JOIN pelanggan AS b ON a.kd_pelanggan = b.kd_pelanggan WHERE a.kd_pelanggan = '$KodePelanggan'";
$query = mysqli_query($mysqli, $sql) or die ("MySQL Salah! ".mysqli_error($mysqli));
$row   = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" target="_self">
    <table class="table-list" width="100%" style="margin-top:0px;">
        <tr>
            <th colspan="3">ISI ULANG PELANGGAN</th>
        </tr>
        <tr>
            <td width="18%"><strong>Kode Pelanggan</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%">
                <input type="text" name="txtNama" value="<?= $KodePelanggan ?>" size="10" maxlength="10" readonly="readonly" />
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
                <input type="number" name="saldo" value="<?= $row['isi_dompet'] ?>" size="80" maxlength="100" />
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="btnSimpan" value="SIMPAN" style="cursor:pointer;">
            </td>
        </tr>
    </table>
</form>

<?php
if(isset($_POST['btnSimpan'])) {

    $txtNama = str_replace("'","&acute;", $_POST['txtNama']);
	$saldo   = $_POST['saldo'];
	
	// validasi error pada form
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Pelanggan</b> tidak boleh kosong !";		
	}
	if (trim($saldo)=="") {
		$pesanError[] = "Data <b>Saldo</b> tidak boleh kosong !";		
	}
    
    $mySql = "UPDATE isi_ulang SET isi_dompet = '$saldo' WHERE kd_pelanggan = '$txtNama'";
    $myQry = mysqli_query($mysqli, $mySql) or die ("Query salah : ".mysqli_error($mysqli));
    if($myQry == true) {
        echo "<meta http-equiv='refresh' content='0; url=?open=Isi-Ulang'>";
    }
	
}
?>