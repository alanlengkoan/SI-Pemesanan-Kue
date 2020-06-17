<?php
include_once "inc.session.php";
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['SES_PELANGGAN'];

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	$arrData = count($_POST['txtJum']); 
	$qty = 1;
	for ($i=0; $i < $arrData; $i++) {
		# Melewati biar tidak 0 atau minus
		if ($_POST['txtJum'][$i] < 1) {
			$qty = 1;
		}
		else {
			$qty = $_POST['txtJum'][$i];
		}
					
		# Simpan Perubahan
		$KodeBrg	= $_POST['txtKodeH'][$i];
		$tanggal	= date('Y-m-d');
    $jam		= date('G:i:s');

    $sql_1 = "SELECT * FROM barang WHERE kd_barang = '$KodeBrg'";
    $qry_1 = mysqli_query($mysqli, $sql_1) or die(mysqli_error($mysqli));
    $row_1 = mysqli_fetch_array($qry_1, MYSQLI_ASSOC);

    $sql_3 = "SELECT * FROM tmp_keranjang WHERE kd_barang='$KodeBrg'";
    $qry_3 = mysqli_query($mysqli, $sql_3) or die(mysqli_error($mysqli));
    $row_3 = mysqli_fetch_array($qry_3, MYSQLI_ASSOC);

    $stok  = ($row_1['stok'] + $row_3['jumlah']) - $qty;
    $sql_2 = "UPDATE barang SET stok = '$stok' WHERE kd_barang = '$KodeBrg'";
    $qry_2 = mysqli_query($mysqli, $sql_2) or die(mysqli_error($mysqli));
		
		$sql = "UPDATE tmp_keranjang SET jumlah = '$qty', tanggal='$tanggal' WHERE kd_barang='$KodeBrg'";
		$query = mysqli_query($mysqli, $sql) or die ("Cek data barang".mysqli_error($mysqli));
	}
	// Refresh
	echo "<meta http-equiv='refresh' content='0; url=?open=Keranjang-Belanja'>";
	exit;	
}

# MENGHAPUS DATA BARANG YANG ADA DI KERANJANG
// Membaca Kode dari URL
if(isset($_GET['aksi']) and trim($_GET['aksi'])=="Hapus"){ 
	// Membaca Id data yang dihapus
  $idHapus = $_GET['idHapus'];
  $kdbrg   = $_GET['kd_barang'];
  
  $sql_1 = "SELECT * FROM barang WHERE kd_barang = '$kdbrg'";
  $qry_1 = mysqli_query($mysqli, $sql_1) or die(mysqli_error($mysqli));
  $row_1 = mysqli_fetch_array($qry_1, MYSQLI_ASSOC);

  $sql_3 = "SELECT * FROM tmp_keranjang WHERE kd_barang = '$kdbrg'";
  $qry_3 = mysqli_query($mysqli, $sql_3) or die(mysqli_error($mysqli));
  $row_3 = mysqli_fetch_array($qry_3, MYSQLI_ASSOC);

  $stok  = $row_1['stok'] + $row_3['jumlah'];
  $sql_4 ="UPDATE barang SET stok = '$stok' WHERE kd_barang = '$kdbrg'";
  mysqli_query($mysqli, $sql_4) or die(mysqli_error($mysqli));
	
	// Menghapus data keranjang sesuai Kode yang dibaca di URL
	$mySql = "DELETE FROM tmp_keranjang  WHERE id='$idHapus' AND kd_pelanggan='$KodePelanggan'";
	$myQry = mysqli_query($mysqli, $mySql) or die ("Eror hapus data".mysqli_error($mysqli));
	if($myQry){
		echo "<meta http-equiv='refresh' content='0; url=?open=Keranjang-Belanja'>";
	}
}

# MEMERIKSA DATA DALAM KERANJANG
$cekSql = "SELECT * FROM tmp_keranjang WHERE  kd_pelanggan='$KodePelanggan'";
$cekQry = mysqli_query($mysqli, $cekSql) or die (mysqli_error($mysqli));
$cekQty = mysqli_num_rows($cekQry);
if($cekQty < 1){
	echo "<br><br>";
	echo "<center>";
	echo "<b> KERANJANG BELANJA KOSONG </b>";
	echo "<center>";
	
	// Jika Keranjang masih Kosong, maka halaman Refresh ke data Barang
	echo "<meta http-equiv='refresh' content='2; url=?page=Barang'>";
	exit;
}
?>
<html>

<head>
  <title>Keranjang Belanja</title>

<body>
  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><img src="../assets/images/keranjang_belanja.gif" width="186" height="41"></td>
    </tr>
  </table>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
    <table width="99%" border="0" align="center" cellpadding="2" cellspacing="0" class="border">
      <tr>
        <td width="86" height="22" align="center" bgcolor="#CCCCCC"><strong>Gambar</strong></td>
        <td width="686" bgcolor="#CCCCCC"><b>Nama Kue</b></td>
        <td width="164" align="right" bgcolor="#CCCCCC"><b><b>Harga (Rp)</b></b></td>
        <td width="76" align="center" bgcolor="#CCCCCC"><b>Jumlah<b></b></b></td>
        <td width="150" align="right" bgcolor="#CCCCCC"><b>Total (Rp)</b></td>
        <td width="16" align="center" bgcolor="#CCCCCC"><img src="images/aksi.gif" width="14" height="14"></td>
      </tr>
      <?php
      // Menampilkan data Barang dari tmp_keranjang (Keranjang Belanja)
      $mySql = "SELECT barang.nm_barang, barang.file_gambar, kategori.nm_kategori, tmp_keranjang.* FROM tmp_keranjang LEFT JOIN barang ON tmp_keranjang.kd_barang=barang.kd_barang LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori WHERE tmp_keranjang.kd_pelanggan='$KodePelanggan' ORDER BY tmp_keranjang.id";
      $myQry = mysqli_query($mysqli, $mySql) or die ("Gagal SQL".mysqli_error($mysqli));
      $total = 0; $grandTotal = 0;
      $no	= 0;
      while ($myData = mysqli_fetch_array($myQry)) {
        $no++;
        // Menghitung sub total harga
        $total 		= $myData['harga'] * $myData['jumlah'];
        $grandTotal	= $grandTotal + $total;
        
        // Menampilkan gambar
        if ($myData['file_gambar']=="") {
          $fileGambar = "../img-barang/noimage.jpg";
        }
        else {
          $fileGambar	= $myData['file_gambar'];
        }
        
        #Kode Barang
        $Kode = $myData['kd_barang'];
      ?>
      <tr>
        <td rowspan="3" align="center" valign="top">
          <img src="../img-barang/<?php echo $fileGambar; ?>" width="70" border="1">
        </td>
        <td>
          <a href="?open=Barang-Lihat&Kode=<?php echo $Kode; ?>" target="_blank"><strong><?php echo $myData['nm_barang']; ?></strong></a>
        </td>
        <td align="right">
          Rp.<?php echo format_angka($myData['harga']); ?>
        </td>
        <td align="center">
          <input name="txtJum[]" type="text" value="<?php echo $myData['jumlah']; ?>" size="2" maxlength="2">
          <input name="txtKodeH[]" type="hidden" value="<?php echo $myData['kd_barang']; ?>">
        </td>
        <td align="right">
          <span>Rp. <?php echo format_angka($total); ?></span>
        </td>
        <td>
          <a href="?open=Keranjang-Belanja&aksi=Hapus&idHapus=<?php echo $myData['id'];?>&kd_barang=<?= $Kode ?>"><img src="../assets/images/hapus.gif" alt="Hapus data ini dari keranjang" width="16" height="16" border="0"></a>
        </td>
      </tr>
      <tr>
        <td>Kategori : <?php echo $myData['nm_kategori']; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?php } ?>
      <tr>
        <td align="center" valign="top">&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2" align="right"><strong>GRAND TOTAL : </strong></td>
        <td align="right" bgcolor="#CCCCCC"> <strong><?php echo "Rp. ".format_angka($grandTotal); ?></strong> </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><button name="btnSimpan" type="submit" style="background-color: transparent; border-color: transparent; cursor: pointer;"><img src="../assets/images/ubah.gif" alt=""></button></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="6" align="center">
          <a href="?open=Transaksi-Proses"><img src="../assets/images/lanjut.gif" alt="Lanjutkan Transaksi (Checkout)" border="0"></a></td>
      </tr>
    </table>
  </form>
  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
    <tr>
      <td height="22" colspan="2" bgcolor="#CCCCCC">&nbsp;&nbsp;<b>Keterangan Tombol</b></td>
    </tr>
    <tr>
      <td width="21%" align="center"><img src="../assets/images/step1.gif" alt=""></td>
      <td width="79%">Klik tombol <img src="../assets/images/ubah.gif" alt=""> untuk menyimpan perubahan jumlah kue yang akan dibeli.</td>
    </tr>
    <tr>
      <td align="center">
        <img src="../assets/images/step2.gif">
      </td>
      <td>
        Klik tombol <img src="../assets/images/lanjut.gif"> jika Anda sudah selesai memilih Kue dan ingin melanjutkan transaksi selanjutnya.
      </td>
    </tr>
  </table>
  
  <br><br><br>