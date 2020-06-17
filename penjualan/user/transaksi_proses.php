<?php
include_once "inc.session.php";
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan = $_SESSION['SES_PELANGGAN'];

# MEMERIKSA DATA DALAM KERANJANG
$cekSql  = "SELECT * FROM tmp_keranjang WHERE  kd_pelanggan='$KodePelanggan'";
$cekQry  = mysqli_query($mysqli, $cekSql) or die (mysqli_error($mysqli));
$cekQty  = mysqli_num_rows($cekQry);
$harga_k = mysqli_fetch_assoc($cekQry);
$cekhrg  = $harga_k['harga'];

$total_bayar  = "SELECT * FROM total_bayar WHERE kd_pelanggan='$KodePelanggan'";
$total_bayar2 = mysqli_query($mysqli, $total_bayar) or die ("Gagal query hapus keranjang".mysqli_error($mysqli));
$tt           = mysqli_fetch_assoc($total_bayar2);
$total_bayar1 = $tt['total'];

$mySql1            = "SELECT * from provinsi";
$myQry1            = mysqli_query($mysqli, $mySql1) or die ("Gagal query".mysqli_error($mysqli));
$krm               = mysqli_fetch_assoc($myQry1);
$biaya_kirim1      = $krm['biaya_kirim'];
$total_semua_bayar = $biaya_kirim1 + $total_bayar1;

// untuk data user
$sql_user = "SELECT * FROM pelanggan WHERE kd_pelanggan = '$KodePelanggan'";
$qry_user = mysqli_query($mysqli, $sql_user) or die("Gagal! ".mysqli_error($mysqli));
$row_user = mysqli_fetch_array($qry_user, MYSQLI_ASSOC);

if($cekQty < 1){
	echo "<br><br>";
	echo "<center>";
	echo "<b> BELUM ADA TRANSAKSI </b>";
	echo "<center>";
	// Jika Keranjang masih Kosong, maka halaman Refresh ke data Barang
	echo "<meta http-equiv='refresh' content='2; url=?page=Barang'>";
	exit;
}

# MEMBACA DATA DARI FORM, untuk ditampilkan kembali pada form
$dataNama     = isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataAlamat   = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
$dataProvinsi = isset($_POST['cmbProvinsi']) ? $_POST['cmbProvinsi'] : '';
$dataNoTelp   = isset($_POST['txtNoTelp']) ? $_POST['txtNoTelp'] : '';
?>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="table-list">
	<tr>
		<td height="22" colspan="5" bgcolor="#CCCCCC"><strong>DATA BELANJA </strong></td>
	</tr>
	<tr>
		<td width="25" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
		<td width="913" height="22" bgcolor="#F5F5F5"><strong>Nama Kue </strong></td>
		<td width="129" align="right" bgcolor="#F5F5F5"><strong>Harga (Rp)</strong></td>
		<td width="66" align="center" bgcolor="#F5F5F5"><strong>Jumlah</strong></td>
		<td width="128" align="right" bgcolor="#F5F5F5"><strong>Total (Rp)</strong></td>
	</tr>
	<?php
  	// buat variabel data
	$subTotal	= 0;
	$totalHarga	= 0;
	$totalBarang = 0;
	
  // Menampilkan daftar barang yang sudah dipilih (ada d Keranjang)
	$mySql = "SELECT barang.nm_barang, tmp_keranjang.* FROM tmp_keranjang LEFT JOIN barang ON tmp_keranjang.kd_barang=barang.kd_barang WHERE barang.kd_barang=tmp_keranjang.kd_barang AND tmp_keranjang.kd_pelanggan='$KodePelanggan' ORDER BY tmp_keranjang.id";
	$myQry = mysqli_query($mysqli, $mySql) or die ("Gagal SQL".mysqli_error($mysqli));
	$nomor	= 0;
	while ($myData = mysqli_fetch_array($myQry)) {
		$nomor++;
	  // Mendapatkan total harga (harga * jumlah)
		$subTotal= $myData['harga'] * $myData['jumlah']; 

	  // Mendapatkan total harga  dari seluruh  barang
		$totalHarga = $totalHarga + $subTotal; 

	  // Mendapatkan total barang
		$totalBarang = $totalBarang + $myData['jumlah']; 
		?>
		<tr>
			<td align="center"><?php echo $nomor; ?></td>
			<td><a href="?open=Barang-Lihat&amp;Kode=<?php echo $myData['kd_barang']; ?>" target="_blank"><?php echo $myData['nm_barang']; ?></a></td>
			<td align="right">Rp.<?php echo format_angka($myData['harga']); ?></td>
			<td align="center"><?php echo $myData['jumlah']; ?></td>
			<td align="right">Rp. <?php echo format_angka($subTotal); ?></td>
		</tr>
	<?php } ?>
	<?php 

	mysqli_query($mysqli, "INSERT into mysqli values('', '$KodePelanggan', '$totalHarga')");
	mysqli_query($mysqli, "UPDATE total_bayar mysqli total = '$totalHarga' where kd_pelanggan = '$KodePelanggan'");

	?>
	<tr>
		<td colspan="3" align="right"><b>TOTAL BELANJA :</b></td>
		<td align="center" bgcolor="#F5F5F5"><?php echo $totalBarang; ?></td>
		<td align="right" bgcolor="#F5F5F5"><strong>Rp. <?php echo format_angka($totalHarga); ?></strong></td>
	</tr>
</table>
<form name="form1" method="post" id="form_transaksi" action="<?php $_SERVER['PHP_SELF']; ?>">
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
		<tr align="center">
			<td height="22" colspan="3">&nbsp;</td>
		</tr>
		<tr> 
			<td height="22" colspan="3" bgcolor="#CCCCCC"><b> ALAMAT TUJUAN PENGIRIMAN KUE </b></td>
		</tr>
		<tr> 
			<td width="426"><b>&nbsp;&nbsp;Nama Penerima</b></td>
			<td width="5"><strong>:</strong></td>
			<td width="753"><input name="txtNama" type="text" style="width: 100%" value="<?php echo $dataNama; ?>"></td>
		</tr>
		<tr>
			<td><b>&nbsp;&nbsp;Alamat  </b></td>
			<td><strong>:</strong></td>
			<td>
				<textarea name="txtAlamat" id="txtAlamat" cols="50" rows="2" readonly><?= $row_user['alamat_lengkap'] ?></textarea>
				<p style="margin: 0;">Apakah sesuai dengan alamat pemesanan ?</p>
				<input type="radio" name="cek_alamat" id="iya" value="iya"> <label for="iya">Iya</label>	
				<input type="radio" name="cek_alamat" id="tidak" value="tidak"> <label for="tidak">Tidak</label>
			</td>
		</tr>
		<tr> 
			<td><b>&nbsp;&nbsp;Kecamatan </b></td>
			<td><strong>:</strong></td>
			<td> <select name="cmbProvinsi" style="width: 100%">
				<option value="KOSONG" selected>....</option>
				<?php
				$comboSql = "SELECT * FROM provinsi ORDER BY nm_provinsi ASC";
				$comboQry = mysqli_query($mysqli, $comboSql) or die ("Gagal query".mysqli_error($mysqli));
				while ($comboData =mysqli_fetch_array($comboQry)) {
					if ($comboData['kd_provinsi']==$dataProvinsi) {
						$cek="selected";
					}
					else {
						$cek="";
					}
					echo "<option value='$comboData[kd_provinsi]' $cek>$comboData[nm_provinsi]</option>";
				}
				?>
			</select> </td>
		</tr>
		<tr> 
			<td><b>&nbsp;&nbsp;No. Telepon</b></td>
			<td><strong>:</strong></td>
			<td> <input name="txtNoTelp" type="text" style="width: 100%" value="<?php echo $dataNoTelp; ?>"></td>
		</tr>
		<tr>
			<td><b>&nbsp;&nbsp;Metode Pembayaran</b></td>
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
			<td><b>&nbsp;&nbsp;Bank</b></td>
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
			<td><b>&nbsp;&nbsp;Nomor Rekening</b></td>
			<td>:</td>
			<td>
				<input type="text" name="inpnorek" id="inpnorek" style="width: 100%" value="-" />
			</td>
		</tr>
		<tr> 
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input name="btnSimpan" type="submit" value=" Simpan " class="butpink" /></td>
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
# SAAT TOMBOL SIMPAN DIKLIK, Masuk ke proses simpan data
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNama	= $_POST['txtNama'];
	$txtNama	= str_replace("'","&acute;",$txtNama);

	$txtAlamat	= $_POST['txtAlamat'];
	$txtAlamat	= str_replace("'","&acute;",$txtAlamat);
	
	$cmbProvinsi= $_POST['cmbProvinsi'];
	
	$txtNoTelp	= $_POST['txtNoTelp'];
	$txtNoTelp	= str_replace("'","&acute;",$txtNoTelp);

	// metode pembayaran
	$txtMetodetf = $_POST['inpmetodetransfer'];
	$txtBank     = $_POST['inpbank'];
	$txtNorek    = $_POST['inpnorek'];

	
	// Validasi, jika data kosong kirimkan pemesanan error
	$pesanError = array();
	if (trim($txtNama) =="") {
		$pesanError[] = "Data <b>Nama Penerima</b> masih kosong";
	}
	if (trim($txtAlamat) =="") {
		$pesanError[] = "Data <b>Alamat Tujuan Pengiriman</b> masih kosong";
	}
	if (trim($cmbProvinsi) =="KOSONG") {
		$pesanError[] =  "Data <b>Kecamatan Pengiriman</b> belum dipilih";
	}
	if (trim($txtNoTelp) =="") {
		$pesanError[] = "Data <b>No. Telepon</b> masih kosong";
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
		echo " <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$KodePemesanan	= buatKode("pemesanan", "PS", $mysqli);
		$tanggal		= date('Y-m-d');
		
		# SIMPAN DATA IDENTITAS PENGIRIMAN KE DATABASE
		$mySql	= "INSERT INTO pemesanan (no_pemesanan, tgl_pemesanan, kd_pelanggan, nama_penerima, alamat_lengkap, kd_provinsi, no_telepon, metode_pembayaran, bank, norek) VALUES('$KodePemesanan', '$tanggal', '$KodePelanggan', '$txtNama', '$txtAlamat', '$cmbProvinsi', '$txtNoTelp', '$txtMetodetf', '$txtBank', '$txtNorek')";
		$myQry	= mysqli_query($mysqli, $mySql) or die ("Gagal query 1".mysqli_error($mysqli));

		if($myQry){
			// Membaca data dari TMP (Kantong belanja)
			$bacaSql	= "SELECT * FROM tmp_keranjang WHERE kd_pelanggan='$KodePelanggan'";
			$bacaQry	= mysqli_query($mysqli, $bacaSql) or die ("Gagal query 2".mysqli_error($mysqli));
			while ($bacaData = mysqli_fetch_array($bacaQry)) {
				// Simpan data dari Keranjang belanja ke Pemesanan_Item
				$Kode 	= $bacaData['kd_barang'];
				$Harga	= $bacaData['harga'];
				$Jumlah	= $bacaData['jumlah'];
				
				$simpanSql="INSERT INTO pemesanan_item(no_pemesanan, kd_barang, harga, jumlah) VALUES('$KodePemesanan', '$Kode', '$Harga', '$Jumlah')";
				mysqli_query($mysqli, $simpanSql) or die ("Gagal query simpan".mysqli_error($mysqli));
			}
			
			
			// Kosongkan data Keranjang milik Pelanggan 
			$hapusSql	= "DELETE FROM tmp_keranjang WHERE kd_pelanggan='$KodePelanggan'";
			mysqli_query($mysqli, $hapusSql) or die ("Gagal query hapus keranjang".mysqli_error($mysqli));
			$hapusSqlT	= "DELETE FROM total_bayar WHERE kd_pelanggan='$KodePelanggan'";
			mysqli_query($mysqli, $hapusSqlT) or die ("Gagal query hapus keranjang".mysqli_error($mysqli));

			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=Transaksi-Tampil&Act=Sukses'>";
		}
		exit;
	}	
}
?>