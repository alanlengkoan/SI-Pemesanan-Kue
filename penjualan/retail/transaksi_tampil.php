<?php
include_once "inc.session.php";
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan = $_SESSION['SES_PELANGGAN'];
$mySql = "SELECT DISTINCT( tb_retail_pemesanan.kd_transaksi ), tb_retail.nama_pemilik, tb_retail_pemesanan.status_pengiriman, tb_retail_pemesanan.metode_pembayaran, tb_retail_pemesanan.status_pembayaran, tb_retail_pemesanan.total, tb_retail_pemesanan.waktu, SUM( tb_retail_transaksi.sub_total ) AS sub_total FROM tb_retail_pemesanan INNER JOIN tb_retail_transaksi ON tb_retail_pemesanan.kd_transaksi = tb_retail_transaksi.kd_transaksi INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail WHERE tb_retail_pemesanan.id_retail = '$KodePelanggan' GROUP BY tb_retail_pemesanan.id_pemesanan_retail";
$myQry = mysqli_query($mysqli, $mySql) or die ("Gagal query".mysqli_error($mysqli));
?>

<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td height="22" colspan="8" bgcolor="#CCCCCC"> <b>DAFTAR PEMESANAN</b> </td>
  </tr>
  <tr bgcolor="#dfe9ff">
    <td width="4%" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="13%" bgcolor="#F5F5F5"><strong>Kode Transaksi</strong></td>
    <td width="14%" bgcolor="#F5F5F5"><strong>Tanggal</strong></td>
    <td width="24%" bgcolor="#F5F5F5"><strong>Nama Penerima </strong></td>
    <td width="14%" align="right" bgcolor="#F5F5F5"><strong>Total (Rp)</strong></td>
    <td width="4%" align="center" bgcolor="#F5F5F5"><strong>Status Pengiriman</strong></td>
    <td width="4%" align="center" bgcolor="#F5F5F5"><strong>Status Pembayaran</strong></td>
    <td width="4%" align="center" bgcolor="#F5F5F5"><strong>Tools</strong></td>
  </tr>
  <?php
  $no = 1;
  while ($myData = mysqli_fetch_array($myQry)) {
    ?>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><?= $no++; ?></td>
    <td bgcolor="#FFFFFF"><?= $myData['kd_transaksi']; ?></td>
    <td bgcolor="#FFFFFF"><?= IndonesiaTgl($myData['waktu']); ?></td>
    <td bgcolor="#FFFFFF"><?= $myData['nama_pemilik']; ?></td>
    <td align="right" bgcolor="#FFFFFF">Rp. <?= format_angka($myData['total']); ?></td>
    <td align="right" bgcolor="#FFFFAA"><?= $myData['status_pengiriman']; ?></td>
    <td align="center" bgcolor="#FFFFCC"><?= ($myData['status_pembayaran'] != "lunas") ? "Belum Lunas" : "Lunas" ?></td>
    <td align="center">
      <?php if ( $myData['metode_pembayaran'] == 'transfer' ) { ?>
        <?php if ($myData['status_pembayaran'] == 'lunas') { ?>
          <a href="transaksi_lihat.php?Kode=<?= $myData['kd_transaksi']; ?>" target="_blank" alt="Lihat Data" ><img src="../assets/images/btn_print.png"></a>
        <?php } else { ?>
          <a href="?open=Konfirmasi&Kode=<?= $myData['kd_transaksi']; ?>" target="_blank" alt="Lihat Data" >Konfirmasi</a>
        <?php } ?>
      <?php } else { ?>
        <?php if ($myData['status_pembayaran'] != 'lunas') : ?>
          <a href="?open=Transaksi-Detail&Kode=<?= $myData['kd_transaksi']; ?>" alt="Detail Data"><img src="../assets/images/detail.png" style="width: 30px; height: 30px;"></a>
        <?php else: ?>
          <a href="transaksi_lihat.php?Kode=<?= $myData['kd_transaksi']; ?>" target="_blank" alt="Lihat Data"><img src="../assets/images/btn_print.png"></a>
        <?php endif; ?>
      <?php } ?>
    </td>
  </tr>
  <?php } ?>
</table>