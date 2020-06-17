<?php
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

# JIKA PENYIMPANAN SUKSES
if(isset($_GET['Aksi']) and $_GET['Aksi']=="Sukses"){
	echo "<br><br><center> <b>SELAMAT, PENAFTARAN ANDA SUDAH KAMI TERIMA </b><br> Sekarang, Anda dapat login untuk melakukan pemesanan </center>";
	echo "<meta http-equiv='refresh' content='2; url='?open=Barang'>";
	exit;
}
// untuk membuat kode otomatis
$kodeoto = buatKode("tb_retail", "R", $mysqli);
?>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self" enctype="multipart/form-data">
	
	<!-- untuk kode retail -->
	<input type="hidden" name="inpidretail" value="<?= $kodeoto ?>">

	<table width="100%" border="0" cellpadding="4" cellspacing="0">
		<tr align="center">
			<td height="22" colspan="3" bgcolor="#CCCCCC" class="HEAD"> <b>PENDAFTARAN RETAIL</b> </td>
		</tr>
		<tr>
			<td width="100"><b>Nama Pemilik </b></td>
			<td><b>:</b></td>
			<td>
				<input type="text" name="inpnamapemilik" size="60" maxlength="60" placeholder="Masukkan Nama Anda" />
			</td>
		</tr>
		<tr>
			<td width="100"><b>Nama Toko </b></td>
			<td><b>:</b></td>
			<td>
				<input type="text" name="inpnamatoko" size="60" maxlength="60" placeholder="Masukkan Nama Toko" />
			</td>
		</tr>
		<tr>
			<td width="100"><b>Tanggal Lahir </b></td>
			<td><b>:</b></td>
			<td>
				<input type="date" name="inptgllhrpemilik" size="60" maxlength="60" />
			</td>
		</tr>
		<tr>
			<td width="100"><b>Foto KTP </b></td>
			<td><b>:</b></td>
			<td>
				<input type="file" name="inpfotoktp" size="60" maxlength="60" placeholder="Masukkan Nama Retail" />
			</td>
		</tr>
		
		<tr>
			<td><b>No. Hp / Telepon</b></td>
			<td><b>:</b></td>
			<td>
				<input type="text" name="inpnohptelpon" size="60" maxlength="60" placeholder="Masukkan No. Hp / Telepon" />
			</td>
		</tr>
		<tr>
			<td><b>Fax</b></td>
			<td><b>:</b></td>
			<td>
				<input type="text" name="inpfax" size="60" maxlength="60" placeholder="Masukkan Fax" />
			</td>
		</tr>
		<tr>
			<td><b>Email</b></td>
			<td><b>:</b></td>
			<td>
				<input type="email" name="inpemail" size="60" maxlength="60" placeholder="Masukkan Email" />
			</td>
		</tr>
		<tr>
			<td><b>Website</b></td>
			<td><b>:</b></td>
			<td>
				<input type="text" name="inpwebsite" size="60" maxlength="60" placeholder="Masukkan Official Website" />
			</td>
		</tr>
		<tr>
			<td><b>Alamat</b></td>
			<td><b>:</b></td>
			<td>
				<textarea name="inpalamat" cols="61" rows="3" placeholder="Masukkan Alamat"></textarea>
			</td>
		</tr>
		<tr>
			<td height="20" colspan="3" bgcolor="#F5F5F5"><strong>DATA LOGIN </strong></td>
		</tr>
		<tr>
			<td><b>Username</b></td>
			<td><b>:</b></td>
			<td>
				<input type="text" name="inpusername" size="60" maxlength="40" placeholder="Masukkan Username" />
			</td>
		</tr>
		<tr>
			<td><b>Password</b></td>
			<td><b>:</b></td>
			<td>
				<input type="password" name="inppassword_1" id="inppassword_1" size="60" maxlength="40" placeholder="Masukkan Password" />
			</td>
		</tr>
		<tr>
			<td><b>Password (Lagi) </b></td>
			<td><b>:</b></td>
			<td>
				<input type="password" name="inppassword_2" id="inppassword_2" size="60" maxlength="40" placeholder="Masukkan Password Kembali	" />
				<span class="pesan"></span>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
				<input type="submit" name="btnDaftar" value="Daftar"></td>
		</tr>
	</table>
</form>

<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script>
	var untukCocokPassword = function () {
		$('#inppassword_2').keyup(function(event) { 
			var passwd_1 = $('#inppassword_1').val();
			var passwd_2 = $(this).val();

			if (passwd_1 != passwd_2) {
				$(':input[type="submit"]').prop('disabled', true);
				$('.pesan').html('Password tidak sesuai!');
				exit;
			} else {
				$(':input[type="submit"]').prop('disabled', false);
				$('.pesan').html('Password sesuai!');
				return true;
			}
		}); 
	}();

	// eksekusi jquery
    jQuery(document).ready(function () {
        untukCocokPassword;
    });
</script>

<?php 
if (isset($_POST['btnDaftar'])) {
	
	$idretail   = str_replace("'", "&acute;", $_POST['inpidretail']);
	$nmapemilik = str_replace("'", "&acute;", $_POST['inpnamapemilik']);
	$nmatoko    = str_replace("'", "&acute;", $_POST['inpnamatoko']);
	$tgllhr     = str_replace("'", "&acute;", $_POST['inptgllhrpemilik']);
	$nohp       = str_replace("'", "&acute;", $_POST['inpnohptelpon']);
	$fax        = str_replace("'", "&acute;", $_POST['inpfax']);
	$website    = str_replace("'", "&acute;", $_POST['inpwebsite']);
	$alamat     = str_replace("'", "&acute;", $_POST['inpalamat']);
	$usernm     = str_replace("'", "&acute;", $_POST['inpusername']);
	$pass_1     = str_replace("'", "&acute;", $_POST['inppassword_1']);
	$pass_crack = md5($pass_1);
	// untuk email
	$email = str_replace("'", "&acute;", $_POST['inpemail']);
	$pesan = "Selamat email Anda telah aktif!";

	// untuk input gambar
	$nmaftoktp = $_FILES['inpfotoktp']['name'];
	$tmpftoktp = $_FILES['inpfotoktp']['tmp_name'];
	$szeftoktp = $_FILES['inpfotoktp']['size'];
	$errftoktp = $_FILES['inpfotoktp']['error'];
	// untuk format foto
	$frmftoktp = array('jpeg', 'jpg', 'png');
	// untuk ukuran foto
	$ukrftoktp = 10 * 1024 * 1024;
	// mengecek error pada gambar
	if ($errftoktp == 0) {

		if ($szeftoktp > $ukrftoktp) {
			echo "<script>alert('Ukuran foto terlalu besar!')</script>";
			exit;
		} else if (!in_array(pathinfo($nmaftoktp, PATHINFO_EXTENSION), $frmftoktp)) {
			echo "<script>alert('Ekstensi foto harus jpeg, jpg, png!')</script>";
			exit;
		} else if (file_exists("../img-retail/".$nmaftoktp)) {
			echo "<script>alert('Nama foto sudah ada!')</script>";
			exit;
		} else {

			// untuk menyimpan data ke dalam database
			$sql_i = "INSERT INTO tb_retail (id_retail, nama_pemilik, nama_toko, tgl_lahir, foto_ktp, nomor, fax, email, website, alamat, username, password) VALUES ('$idretail', '$nmapemilik', '$nmatoko', '$tgllhr', '$nmaftoktp', '$nohp', '$fax', '$email', '$website', '$alamat', '$usernm', '$pass_crack')";
			$qry_i = mysqli_query($mysqli, $sql_i);
	
			if ($qry_i == true) {
				if (kirim_email($email, $pesan) == '') {
					// upload gambar atau menyimpan gambar
					move_uploaded_file($tmpftoktp, "../img-retail/".$nmaftoktp);
					echo "Berhasil!";
				} else {
					echo "Gagal!";
				}
			} else {
				echo "Gagal!";
			}

		}
	}

}
?>