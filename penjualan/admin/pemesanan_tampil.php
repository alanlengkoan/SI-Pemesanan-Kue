<?php
include_once "../../library/inc.sesadmin.php";
include_once "../../library/inc.library.php";

$SqlPeriode = ""; $awalTgl = ""; $akhirTgl = ""; $tglAwal = ""; $tglAkhir = "";

# Set Tanggal skrg
$awalTgl = isset($_GET['awalTgl']) ? $_GET['awalTgl'] : "01-".date('m-Y');
$tglAwal = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : $awalTgl ;

$akhirTgl = isset($_GET['akhirTgl']) ? $_GET['akhirTgl'] : date('d-m-Y');
$tglAkhir = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : $akhirTgl;

# Jika Tombol Tampilkan diklik
if (isset($_POST['btnTampil'])) {
	$SqlPeriode = " tgl_pemesanan BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."'";
}
else {
	$SqlPeriode = " tgl_pemesanan BETWEEN '".InggrisTgl($awalTgl)."' AND '".InggrisTgl($akhirTgl)."'";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris    = 50;
$hal      = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql  = "SELECT * FROM pemesanan WHERE $SqlPeriode";
$pageQry  = mysqli_query($mysqli, $pageSql) or die ("error paging: ".mysqli_error($mysqli));
$jml      = mysqli_num_rows($pageQry);
$maksData = ceil($jml/$baris);
?>
<h1><b><font color="#FF0066">DAFTAR PEMESANAN </font></b></h1>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="550" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><b><font color="#FF0066">FILTER DATA </font></b></td>
    </tr>
    <tr>
      <td width="55"><b><font color="#666666">Periode </font></b></td>
      <td width="5"><b>:</b></td>
      <td width="426"><input name="txtTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" /> 
        s/d 
          <input name="txtTglAkhir" type="text" class="tcal"  value="<?php echo $tglAkhir; ?>" />
      <input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>

<table width="850" border="0" cellpadding="2" cellspacing="1" class="table-list" >
  <tr>
    <th width="4%" align="center" bgcolor="#CCCCCC"><font color="#FF0066"><b>No</b></font></th>
    <th width="10%" bgcolor="#CCCCCC"><font color="#FF0066"><b>No Pesan </b></font></th>
    <th width="11%" bgcolor="#CCCCCC"><font color="#FF0066"><b>Tanggal</b></font></th>
    <th width="19%" bgcolor="#CCCCCC"><font color="#FF0066"><strong>Nama Pelanggan </strong></font></th>
    <th width="14%" align="right" bgcolor="#CCCCCC"><font color="#FF0066"><b>Total  Beli (Rp) </b></font></th>
    <th width="10%" align="right" bgcolor="#CCCCCC"><font color="#FF0066"><strong>Status </strong></font></th>
    <td align="center" bgcolor="#CCCCCC"><font color="#FF0066"><b>Tools</b></font></td>
  </tr>
  <?php
  // Deklrasi variabel angka
  $totalBayar = 0;
  $unikTransfer = 0;

  // Menampilkan daftar transaksi
  $mySql = "SELECT pemesanan.*, pelanggan.nm_pelanggan, provinsi.biaya_kirim FROM pelanggan, pemesanan, provinsi WHERE pelanggan.kd_pelanggan=pemesanan.kd_pelanggan AND pemesanan.kd_provinsi=provinsi.kd_provinsi AND $SqlPeriode ORDER BY RIGHT(pemesanan.no_pemesanan,5) DESC";
  $myQry = mysqli_query($mysqli, $mySql) or die ("Gagal query".mysqli_error($mysqli));
  $nomor = 0;
  while ($myData =mysqli_fetch_array($myQry)) {
	  $nomor++;
	  $Kode    = $myData['no_pemesanan'];
	  $digitHp = substr($myData['no_telepon'],-3);  // ambil 3 digit no HP
	  
	  # MENGHITUNG TOTAL BAYAR, TOTAL JUMLAH BARANG dengan perintah SQL
    $my2Sql  = "SELECT SUM(harga * jumlah) As total_bayar, SUM(jumlah) As total_barang FROM pemesanan_item WHERE no_pemesanan='$Kode'";
    $my2Qry  = mysqli_query($mysqli, $my2Sql) or die ("Gagal query".mysqli_error($mysqli));
    $my2Data = mysqli_fetch_array($my2Qry);
		
		// Menghitung Total Bayar dari harga setelah diskon, dikali jumlah barang
		$totalBayar   = $my2Data['total_bayar'] + $myData['biaya_kirim'];
		$unikTransfer = substr($totalBayar,0,-3).$digitHp;
  ?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_pemesanan']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_pemesanan']); ?></td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
    <td align="right">Rp. <b><?php echo format_angka($totalBayar); ?></b></td>
    <td align="right" bgcolor="#FFFF66"><?php echo $myData['status_bayar']; ?></td>
    <td width="9%" align="center"><a href="pemesanan_lihat.php?Kode=<?php echo $Kode; ?>" target="_blank" style="background-color: transparent;"><img src="../assets/images/detail.png" style="width: 30px; height: 30px;"></a> </td>
  </tr>
  <?php } ?>
</table>
