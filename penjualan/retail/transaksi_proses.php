<?php
include_once "inc.session.php";
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan = $_SESSION['SES_PELANGGAN'];

// memeriksa keranjang pesanan
$cekSql  = "SELECT * FROM tb_retail_pesanan";
$cekQry  = mysqli_query($mysqli, $cekSql) or die (mysqli_error($mysqli));
$cekQty  = mysqli_num_rows($cekQry);

// mengambil data retail
$sql_2 = "SELECT * FROM tb_retail WHERE id_retail = '$KodePelanggan'";
$qry_2 = mysqli_query($mysqli, $sql_2) or die("MySQL Salah! ".mysqli_error($mysqli));
$dtret = mysqli_fetch_array($qry_2, MYSQLI_ASSOC);

// untuk mengecek / membuat data transaksi
$sql    = "SELECT kd_transaksi FROM tb_retail_pemesanan";
$carkod = mysqli_query($mysqli, $sql);
$datkod = mysqli_fetch_array($carkod, MYSQLI_ASSOC);
$jumdat = mysqli_num_rows($carkod);

if ($datkod) {
  $nilkod  = substr($jumdat[0], 1);
  $kode    = (int) $nilkod;
  $kode    = $jumdat + 1;
  $kodeoto = "TRS".sprintf("%04s", $kode);
} else {
  $kodeoto = "TRS0001";
}
?>

<!-- apa bila keranjang masih kosong -->
<?php if ($cekQty < 1) : ?>
<h2 style="margin: 100px 0 100px 0;">BELUM ADA TRANSAKSI</h2>
<meta http-equiv='refresh' content='2; url=?page=Barang'>
<?php exit; endif; ?>

<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="table-list">
		<tr>
			<td height="22" colspan="5" bgcolor="#CCCCCC"><strong>DATA BELANJA</strong></td>
		</tr>
		<tr>
			<td width="25" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
			<td width="800" height="22" bgcolor="#F5F5F5"><strong>Nama Kue </strong></td>
			<td width="129" align="right" bgcolor="#F5F5F5"><strong>Harga (Rp)</strong></td>
			<td width="66" align="center" bgcolor="#F5F5F5"><strong>Jumlah</strong></td>
			<td width="150" align="right" bgcolor="#F5F5F5"><strong>Sub Total (Rp)</strong></td>
		</tr>
		<?php
		$sql_1 = "SELECT tb_retail_pesanan.kd_barang, kategori.nm_kategori, barang.nm_barang, tb_retail_pesanan.jumlah, tb_retail_pesanan.harga, tb_retail_pesanan.sub_total FROM tb_retail_pesanan INNER JOIN barang ON tb_retail_pesanan.kd_barang = barang.kd_barang INNER JOIN kategori ON barang.kd_kategori = kategori.kd_kategori";
		$qri_1 = mysqli_query($mysqli, $sql_1) or die ("Gagal SQL".mysqli_error($mysqli));
		$nomor = 1;
		$jumlh = 0;
		$total = 0;
		while ($rows = mysqli_fetch_array($qri_1, MYSQLI_ASSOC)) {
			$jumlh += $rows['jumlah'];
			$total += $rows['sub_total'];
			?>
		<tr>
			<td align="center"><?= $nomor ?></td>
			<td><a href="?open=Barang-Lihat&amp;Kode=<?= $rows['kd_barang'] ?>" target="_blank"><?= $rows['nm_barang'] ?></a></td>
			<td align="right">Rp.<?= format_angka($rows['harga']) ?></td>
			<td align="center"><?= $rows['jumlah'] ?></td>
			<td align="right">Rp. <?= format_angka($rows['sub_total']) ?></td>

			<!-- untuk data yg akan tersimpan kedalam tabel transaksi -->
			<input type="hidden" name="inpkd_barang[]" value="<?= $rows['kd_barang'] ?>" required="required" />
			<input type="hidden" name="inpjml_barang[]" value="<?= $rows['jumlah'] ?>" required="required" />
			<input type="hidden" name="inphrg_barang[]" value="<?= $rows['harga'] ?>" required="required" />
			<input type="hidden" name="inpsbt_barang[]" value="<?= $rows['sub_total'] ?>" required="required" />
		</tr>
		<?php } ?>
		<tr>
			<td colspan="3" align="right"><b>TOTAL BELANJA :</b></td>
			<td align="center" bgcolor="#F5F5F5"><?= $jumlh ?></td>
			<td align="right" bgcolor="#F5F5F5">
				<input type="hidden" name="inptotal" value="<?= (tanggalbulan($row['tgl_lahir']) == tanggalbulan(date('Y-m-d'))) ? $total*(30/100) : $total ?>" />
				<strong>Rp. <?= (tanggalbulan($row['tgl_lahir']) == tanggalbulan(date('Y-m-d'))) ? format_angka($total*(30/100)) : format_angka($total) ?></strong>
			</td>
		</tr>
	</table>
	<input type="hidden" name="inpkdtransaksi" value="<?= $kodeoto ?>" required="required" />
	<input type="hidden" name="inpidretail" value="<?= $KodePelanggan ?>" required="required" />

	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
		<tr align="center">
			<td height="22" colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td height="22" colspan="3" bgcolor="#CCCCCC"><b> DATA RETAIL YANG AKAN DIKIRIM </b></td>
		</tr>
		<tr>
			<td width="426"><b>Nama Penerima</b></td>
			<td width="5"><strong>:</strong></td>
			<td width="753">
				<input name="txtNama" type="text" style="width: 100%" value="<?= $dtret['nama_pemilik'] ?>" />
			</td>
		</tr>
		<tr>
			<td><b>No. Telepon</b></td>
			<td><strong>:</strong></td>
			<td>
				<input name="txtNoTelp" type="text" style="width: 100%" value="<?= $dtret['nomor'] ?>" />
			</td>
		</tr>
		<tr>
			<td><b>Alamat </b></td>
			<td><strong>:</strong></td>
			<td>
				<textarea name="txtAlamat" cols="50" rows="2"><?= $dtret['alamat'] ?></textarea>
			</td>
		</tr>
		<tr>
			<td><b>Metode Pembayaran</b></td>
			<td>:</td>
			<td>
				<select name="inpmetodetransfer" id="inpmetodetransfer" style="width: 100%">
					<option value="-"></option>
					<option value="transfer">Transfer</option>
					<option value="cod">COD</option>
				</select>
			</td>
		</tr>
		<tr id="bank">
			<td><b>Bank</b></td>
			<td>:</td>
			<td>
				<select name="inpbank" id="inpbank" style="width: 100%">
					<option value="-"></option>
					<option value="bri">BRI</option>
					<option value="bni">BNI</option>
				</select>
			</td>
		</tr>
		<tr id="norek">
			<td><b>Nomor Rekening</b></td>
			<td>:</td>
			<td>
				<input type="text" name="inpnorek" id="inpnorek" style="width: 100%" value="-" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input name="btnSimpan" type="submit" value="Proses" class="butpink" /></td>
		</tr>
	</table>
</form>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>

	var untukCekAlamat = function () {
		$('#form_transaksi input').on('change', function () {
			var value = $('input[name=cek_alamat]:checked', '#form_transaksi').val();
			if (value != 'iya') {
				$('#txtAlamat').removeAttr('readonly');
			} else {
				$('#txtAlamat').attr('readonly', 'readonly');
			}
		});
	}();

	var untukMetodePembayaran = function () {
		$('#bank').css('display', 'none');
		$('#norek').css('display', 'none');

		$('#inpmetodetransfer').change(function () {
			var value_tf = $(this).val();
			if (value_tf == 'transfer') {
				$("#bank").show();
			} else {
				$("#bank").hide();
			}
		});

		$('#inpbank').change(function () {
			var value_bank = $(this).val();
			if (value_bank != '-') {
				$("#norek").show();
			} else {
				$("#norek").hide();
			}
		});
	}();

	// eksekusi jquery
    jQuery(document).ready(function () {
        untukCekAlamat;
        untukMetodePembayaran;
    });

</script>

<?php 
if(isset($_POST['btnSimpan'])){
	
	$kdtransaksi = $_POST['inpkdtransaksi'];
	$kdbarang    = $_POST['inpkd_barang'];
	$jumlah      = $_POST['inpjml_barang'];
	$harga       = $_POST['inphrg_barang'];
	$subtotal    = $_POST['inpsbt_barang'];
	$total       = $_POST['inptotal'];
	$pembayaran  = $_POST['inpmetodetransfer'];
	$bank        = $_POST['inpbank'];
	$norek       = $_POST['inpnorek'];

	$idretail = $_POST['inpidretail'];
	$stuspeng = "onprocess";
	$stuspem  = "proses";
	$waktu    = date('Y-m-d');

	// untuk menyimpan hasil transaksi
	$sql_4 = "INSERT INTO tb_retail_pemesanan (kd_transaksi, id_retail, status_pengiriman, status_pembayaran, total, waktu, metode_pembayaran, bank, norek) VALUES ('$kdtransaksi', '$idretail', '$stuspeng', '$stuspem', '$total', '$waktu', '$pembayaran', '$bank', '$norek')";
	$qry_4 = mysqli_query($mysqli, $sql_4) or die ("MySQL salah! ".mysqli_error($mysqli));

	// untuk menyimpan pesanan retail
	for ($i = 0; $i < count($kdbarang); $i++) { 
		$sql_3 = "INSERT INTO tb_retail_transaksi (kd_transaksi, kd_barang, jumlah, harga, sub_total) VALUES ('$kdtransaksi', '$kdbarang[$i]', '$jumlah[$i]', '$harga[$i]', '$subtotal[$i]')";
		$qry_3 = mysqli_query($mysqli, $sql_3) or die ("MySQL salah! ".mysqli_error($mysqli));
	}

	if ($qry_3 == true) {
		mysqli_query($mysqli, "TRUNCATE TABLE tb_retail_pesanan");
		echo "<meta http-equiv='refresh' content='0; url=?open=Transaksi-Tampil&Act=Sukses'>";
	} else {
		echo "<script>alert('Gagal!')</script>";
		echo "<script>document.location.href='?open=Transaksi-Proses';</script>";
	}

}
?>