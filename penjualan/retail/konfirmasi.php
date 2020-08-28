<?php
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

$i  = $_SESSION['SES_PELANGGAN'];
$ss = mysqli_query($mysqli, "SELECT * FROM tb_retail WHERE id_retail = '$i'");
$p  = mysqli_fetch_assoc($ss);

$kd = $_GET['Kode'];
$total = 0;
$sql_i = "SELECT tb_retail_pemesanan.kd_transaksi, tb_retail.nama_pemilik, tb_retail.nomor, tb_retail.fax, tb_retail.email, tb_retail.website, tb_retail.alamat, kategori.nm_kategori, barang.nm_barang, tb_retail_transaksi.kd_barang, tb_retail_transaksi.jumlah, tb_retail_transaksi.harga, tb_retail_transaksi.sub_total FROM tb_retail_pemesanan INNER JOIN tb_retail_transaksi ON tb_retail_pemesanan.kd_transaksi = tb_retail_transaksi.kd_transaksi INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail INNER JOIN barang ON tb_retail_transaksi.kd_barang = barang.kd_barang INNER JOIN kategori ON barang.kd_kategori = kategori.kd_kategori WHERE tb_retail_pemesanan.kd_transaksi = '$kd'";
$qry_i = mysqli_query($mysqli, $sql_i) or die ("MySQL salah! ".mysqli_error($mysqli));
while ($rows = mysqli_fetch_array($qry_i, MYSQLI_ASSOC)) {
	$total += $rows['sub_total'];
}
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
	<table width="100%" border="0" cellpadding="4" cellspacing="0">
		<tr bgcolor="#84B9D5">
			<td height="22" colspan="3" bgcolor="#CCCCCC" class="HEAD">
				<b><font color="#FF0066">KONFIRMASI PEMBAYARAN </font></b>
			</td>
		</tr>
		<tr>
			<td>
				<b><font color="#FF0066">Nama Pelanggan </font></b>
			</td>
			<td><b>:</b></td>
			<td>
				<input name="txtNama" type="text" value="<?php echo $p['nama_pemilik'] ?>" size="60" maxlength="100" readonly="readonly" style="border: none;" />
			</td>
		</tr>
		<tr>
			<td>
				<b><font color="#FF0066">Total </font></b>
			</td>
			<td><b>:</b></td>
			<td>
				<input name="txtTotal" type="text" value="<?php echo $total ?>" size="60" maxlength="100" readonly="readonly" style="border: none;" />
			</td>
		</tr>
		<tr>
			<td>
				<b><font color="#FF0066">Jumlah Transfer (Rp.) </font></b>
			</td>
			<td><b>:</b></td>
			<td>
				<input name="txtJumlahTransfer" type="text" required="required" />
			</td>
		</tr>
		<tr>
			<td>
				<b><font color="#FF0066">Keterangan</font></b>
			</td>
			<td><b>:</b></td>
			<td>
				<textarea name="txtKeterangan" cols="45" rows="4" required="required"></textarea>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="btnKirim" value=" Kirim "></td>
		</tr>
		<tr>
			<td colspan="3"><b>
					<font color="#666666">Catatan:</font>
				</b><br />
				<font color="#666666"><b>**)</b> Jumlah Transfer yang harus Anda tulis adalah sesuai dengan jumlah
					transfer yang telah dilakukan, gunakan 3 digit terakhir No HP Anda untuk tanda (misal : <b>Rp.
						300.231</b> ).</font><br />
				<br />
				<font color="#666666">(<strong>231</strong> didapat dari 3 digit terakhir No HP Pemesan/ Tujuan
					Pengiriman juga bisa) </font>
			</td>
		</tr>
	</table>
</form>

<?php
if(isset($_POST['btnKirim'])){
	
	$txtNama           = $_POST['txtNama'];
	$txtNama           = str_replace("'","&acute;",$txtNama);

	$txtTotal		   = $_POST['txtTotal'];
	$txtJumlahTransfer = $_POST['txtJumlahTransfer'];
	$txtJumlahTransfer = str_replace(".","",$txtJumlahTransfer);
	$txtJumlahTransfer = str_replace(",","",$txtJumlahTransfer);
	$txtJumlahTransfer = str_replace(" ","",$txtJumlahTransfer);
	$txtKeterangan     = $_POST['txtKeterangan'];
	$txtKeterangan     = str_replace("'","&acute;",$txtKeterangan);
	
	// Validasi form
	$pesanError = array();
	if (trim($txtNama) == "") {
		$pesanError[] = "Data <b>Nama Penerima</b>  masih kosong, isi sesuai nama akun Anda";
	}
	if (trim($txtJumlahTransfer) == "" or ! is_numeric(trim($txtJumlahTransfer))) {
		$pesanError[] = "Data <b> Jumlah Ditransfer (Rp)</b> masih kosong, dan <b> harus ditulis angka </b>";
	}
	if (trim($txtKeterangan) == "") {
		$pesanError[] = "Data <b> Keterangan </b> masih kosong";
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='pesanError' align='left'>";
		echo "<img src='../assets/images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "<br>"; 
	} else {
		
		if ($txtJumlahTransfer > $txtTotal) {
			echo "<script>alert('Mohon Maaf Jumlah Uang yang Anda Masukkan Lebih dari Total : Rp. ".number_format($txtTotal)." !')</script>";
		} else if ($txtJumlahTransfer >= $txtTotal) {
			
			$email = "riolodessert@gmail.com";
			$pesan = "Pemesanan dengan Kode ". $kd .", ";
			$pesan .= "telah melakukan transfer sebesar ".$txtJumlahTransfer.", denga total pembelian ".$txtTotal.".";

			// untuk mengirim email
			if (kirim_email($email, $pesan) == '') {
				$statuspembayaran = "lunas";
				$statuspengiriman = "delivered";
				$sql = "UPDATE tb_retail_pemesanan SET status_pengiriman = '$statuspengiriman', status_pembayaran = '$statuspembayaran', jumlah_pembayaran = '$txtJumlahTransfer', sisah_pembayaran = '0' WHERE kd_transaksi = '$kd'";
				$qry = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));
				if ($qry == true) {
					echo "<script>document.location.href = '?open=Transaksi-Tampil';</script>";
				}
			} else {
				echo "<div class='pesanError' align='left'> Maaf Gagal diproses! </div>";
			}

		} else {
			echo "<script>alert('Mohon Maaf Jumlah Uang yang Anda Masukkan Kurang dari Total : Rp. ".number_format($txtTotal)." !')</script>";
		}
	}	
}
?>