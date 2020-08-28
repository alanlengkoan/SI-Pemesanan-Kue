<?php
include_once "../../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../../library/inc.connection.php"; // Membuka koneksi
include_once "../../library/inc.library.php";    // Membuka librari peringah fungsi

// Mengenalkan variabel teks
$SqlPeriode = ""; 
$awalTgl	= ""; 
$akhirTgl	= ""; 
$tglAwal	= ""; 
$tglAkhir	= "";

# Membuat sub Query dengan filter Periode data
if(isset($_POST['btnTampil'])) {
	// Membaca form dan memberi nilai tanggal sekarang
	$tglAwal  = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-Y');
	$tglAkhir = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');
	
	// SQL Jika tombol Tampil diklik
	$SqlPeriode = " waktu BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."'";
}
else {
	// Tanggal standar
	$awalTgl  = "01-".date('m-Y');
	$akhirTgl = date('d-m-Y');

	// SQL Jika tidak belum ada tombol diklik
	$SqlPeriode = " waktu BETWEEN '".InggrisTgl($awalTgl)."' AND '".InggrisTgl($akhirTgl)."'";
}
?>
<h2><b>
    <font color="#FF0066">LAPORAN PEMESANAN MASUK</font>
  </b></h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="550" border="0" class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC">
        <font color="#FF0066"><b>FILTER DATA </b></font>
      </td>
    </tr>
    <tr>
      <td width="55">
        <font color="#FF0066"><b>Periode </b></font>
      </td>
      <td width="5">
        <font color="#FF0066"><b>:</b></font>
      </td>
      <td width="426">
        <input name="txtTglAwal" type="text" class="tcal" value="<?php echo $awalTgl; ?>" size="20" />
        s/d
        <input name="txtTglAkhir" type="text" class="tcal" value="<?php echo $akhirTgl; ?>" size="20" />
        <input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>

<font color="#FF0066">Daftar transaksi periode tanggal pesan </font><b><?php echo $tglAwal; ?></b><font color="#FF0066"> s/d </font><b><?php echo $tglAkhir; ?></b><br /><br />

<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <th>No</th>
    <th>Kode Transaksi</th>
    <th>Nama Retail</th>
    <th>Status Pengiriman</th>
    <th>Waktu</th>
    <th>Status Pembayaran</th>
  </tr>
  <?php
  $nomor = 1;
  $mySql = "SELECT tb_retail_pemesanan.kd_transaksi, tb_retail.nama_pemilik, tb_retail_pemesanan.status_pengiriman, tb_retail_pemesanan.status_pembayaran, tb_retail_pemesanan.waktu, SUM( tb_retail_transaksi.sub_total ) AS sub_total FROM tb_retail_pemesanan INNER JOIN tb_retail_transaksi ON tb_retail_pemesanan.kd_transaksi = tb_retail_transaksi.kd_transaksi INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail AND $SqlPeriode GROUP BY tb_retail_pemesanan.id_pemesanan_retail";
  $myQry = mysqli_query($mysqli, $mySql)  or die ("Query salah : ".mysqli_error($mysqli));
  ?>
  <?php if(mysqli_num_rows($myQry) > 0): ?>
  <?php while ($row = mysqli_fetch_array($myQry)) { ?>
  <tr>
    <td><?= $nomor++; ?></td>
    <td><?= $row['kd_transaksi'] ?></td>
    <td><?= $row['nama_pemilik'] ?></td>
    <td><?= $row['status_pengiriman'] ?></td>
    <td><?= $row['waktu'] ?></td>
    <td><?= ($row['status_pembayaran'] != 'lunas') ? 'Belum Lunas' : 'Lunas' ?></td>
  </tr>
  <?php } ?>
  <?php else: ?>
  <tr>
    <td colspan="8" align="center"><b>Data Transaksi Keluar tidak ada !</b></td>
  </tr>
  <?php endif; ?>

</table>