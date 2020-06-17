<?php
include_once "inc.session.php";
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['SES_PELANGGAN'];

// Menampilkan data Barang dari tmp_keranjang (Keranjang Belanja)
$mySql = "SELECT barang.nm_barang, barang.file_gambar, kategori.nm_kategori, tb_retail_pesanan.* FROM tb_retail_pesanan LEFT JOIN barang ON tb_retail_pesanan.kd_barang = barang.kd_barang LEFT JOIN kategori ON barang.kd_kategori = kategori.kd_kategori";
$myQry = mysqli_query($mysqli, $mySql) or die ("Gagal SQL".mysqli_error($mysqli));
$total = 0;

// memeriksa pesanan dalam tb_retail pesanan
$sql_5  = "SELECT * FROM tb_retail_pesanan";
$qry_5  = mysqli_query($mysqli, $sql_5) or die (mysqli_error($mysqli));
$cekQty = mysqli_num_rows($qry_5);
?>
<html>

<head>
  <title>Keranjang Belanja</title>
</head>

<body>

  <!-- apa bila keranjang masih kosong -->
  <?php if ($cekQty < 1) : ?>
    <h2 style="margin: 100px 0 100px 0;">KERANJANG BELANJA KOSONG</h2>
    <meta http-equiv='refresh' content='2; url=?page=Barang'>
  <?php exit; endif; ?>

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
        <td width="150" align="right" bgcolor="#CCCCCC"><b>Sub Total (Rp)</b></td>
        <td width="16" align="center" bgcolor="#CCCCCC"><img src="../assets/images/aksi.gif" width="14" height="14"></td>
      </tr>
      <?php
      while ($myData = mysqli_fetch_array($myQry)) {
        $total += $myData['sub_total'];
        // Menampilkan gambar
        ($myData['file_gambar']=="") ? $fileGambar = "../img-barang/noimage.jpg" : $fileGambar	= $myData['file_gambar'];        
      ?>
      <tr>
        <td rowspan="3" align="center" valign="top">
          <img src="../img-barang/<?php echo $fileGambar; ?>" width="70" border="1">
        </td>
        <td>
          <a href="?open=Barang-Lihat&Kode=<?= $myData['kd_barang'] ?>" target="_blank"><strong><?php echo $myData['nm_barang']; ?></strong></a>
        </td>
        <td align="right">
          Rp.<?php echo format_angka($myData['harga']); ?>
        </td>
        <td align="center">
          <input type="hidden" name="inpkodebarang[]" value="<?= $myData['kd_barang'] ?>" />
          <input type="hidden" name="inphargabarang[]" value="<?= $myData['harga'] ?>" />
          <input type="text" name="inpjumlah[]" value="<?= $myData['jumlah'] ?>" size="2" maxlength="2" />
        </td>
        <td align="right">
          <span>Rp. <?php echo format_angka($myData['sub_total']); ?></span>
        </td>
        <td>
          <a href="?open=Keranjang-Belanja&aksi=Hapus&idHapus=<?php echo $myData['id_retail_pemesanan'];?>&kd_barang=<?= $myData['kd_barang'] ?>"><img src="../assets/images/hapus.gif" alt="Hapus data ini dari keranjang" width="16" height="16" border="0"></a>
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
        <td align="right" bgcolor="#CCCCCC"> <strong>Rp. <?= (tanggalbulan($row['tgl_lahir']) == tanggalbulan(date('Y-m-d'))) ? format_angka($total*(30/100)) : format_angka($total) ?></strong> </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
          <button name="btnSimpan" type="submit" style="background-color: transparent; border-color: transparent; cursor: pointer;"><img src="../assets/images/ubah.gif" alt=""></button>
        </td>
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


  <?php   
  // untuk ubah jumlah pesanan retail
  if(isset($_POST['btnSimpan'])) {
    
    $arrData   = count($_POST['inpkodebarang']);
    $idbarang  = $_POST['inpkodebarang'];
    $hrgbarang = $_POST['inphargabarang'];
    $jmlbarang = $_POST['inpjumlah'];

    for ($i=0; $i < $arrData; $i++) {
      // apa bila jumlah pesanan kurang dari 1
      $qty = ($jmlbarang[$i] < 1) ? 1 : $jmlbarang[$i] ;
      // untuk subtotal
      $subtotal = $qty * $hrgbarang[$i];

      $sql_1 = "SELECT * FROM barang WHERE kd_barang = '$idbarang[$i]'";
      $qry_1 = mysqli_query($mysqli, $sql_1) or die(mysqli_error($mysqli));
      $row_1 = mysqli_fetch_array($qry_1, MYSQLI_ASSOC);

      $sql_3 = "SELECT * FROM tb_retail_pesanan WHERE kd_barang = '$idbarang[$i]'";
      $qry_3 = mysqli_query($mysqli, $sql_3) or die(mysqli_error($mysqli));
      $row_3 = mysqli_fetch_array($qry_3, MYSQLI_ASSOC);

      $stok  = ($row_1['stok'] + $row_3['jumlah']) - $qty;
      $sql_2 = "UPDATE barang SET stok = '$stok' WHERE kd_barang = '$idbarang[$i]'";
      $qry_2 = mysqli_query($mysqli, $sql_2) or die(mysqli_error($mysqli));

      $sql_4 = "UPDATE tb_retail_pesanan SET jumlah = '$qty', sub_total = '$subtotal' WHERE kd_barang = '$idbarang[$i]'";
      $qry_4 = mysqli_query($mysqli, $sql_4) or die ("MySQL Salah! ".mysqli_error($mysqli));
    }
    // Refresh
    echo "<meta http-equiv='refresh' content='0; url=?open=Keranjang-Belanja'>";
    exit;	
  }

  // untuk menghapus data pemesanan dari keranjang
  if(isset($_GET['aksi']) && trim($_GET['aksi']) == "Hapus"){ 

    $idretailpesanan = $_GET['idHapus'];
    $kdbrg   = $_GET['kd_barang'];

    $sql_1 = "SELECT * FROM barang WHERE kd_barang = '$kdbrg'";
    $qry_1 = mysqli_query($mysqli, $sql_1) or die(mysqli_error($mysqli));
    $row_1 = mysqli_fetch_array($qry_1, MYSQLI_ASSOC);

    $sql_3 = "SELECT * FROM tb_retail_pesanan WHERE kd_barang = '$kdbrg'";
    $qry_3 = mysqli_query($mysqli, $sql_3) or die(mysqli_error($mysqli));
    $row_3 = mysqli_fetch_array($qry_3, MYSQLI_ASSOC);

    $stok  = $row_1['stok'] + $row_3['jumlah'];
    $sql_4 ="UPDATE barang SET stok = '$stok' WHERE kd_barang = '$kdbrg'";
    mysqli_query($mysqli, $sql_4) or die(mysqli_error($mysqli));
    
    $sql_2 = "DELETE FROM tb_retail_pesanan WHERE id_retail_pemesanan = '$idretailpesanan'";
    $qry_2 = mysqli_query($mysqli, $sql_2) or die ("MySQL Salah! ".mysqli_error($mysqli));
    if($qry_2 == true) {
      echo "<meta http-equiv='refresh' content='0; url=?open=Keranjang-Belanja'>";
    }

  }
  ?>