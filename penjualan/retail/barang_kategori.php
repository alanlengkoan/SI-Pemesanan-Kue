<?php
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";


# Membaca Kode filter Kategori
if(isset($_GET['Kode'])) {
	// Membaca Kode dari URL
	$Kode	= $_GET['Kode'];
	
	if (trim($_GET['Kode']) == "") {
		$filterSql = " ";
	}
	else {
		$filterSql = "WHERE barang.kd_kategori='$Kode'";
	}
}

# Membaca data kategori
$infoSql = "SELECT * FROM kategori  WHERE kd_kategori='$Kode'";
$infoQry = mysqli_query($mysqli, $infoSql);
$infoData= mysqli_fetch_array($infoQry);


# Nomor Halaman (Paging)
$baris   = 10;
$hal     = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * FROM barang $filterSql ";
$pageQry = mysqli_query($mysqli, $pageSql);
$jml     = mysqli_num_rows($pageQry);
$maks    = ceil($jml/$baris);
$mulai   = $baris * ($hal-1);
?>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="2" align="center" bgcolor="#00FFFF"><strong>KOLEKSI BARANG <?php echo strtoupper($infoData['nm_kategori']); ?></strong></td>
  </tr>
	<?php 
	// Menampilkan daftar barang
	$barangSql = "SELECT barang.*,  kategori.nm_kategori FROM barang LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori $filterSql ORDER BY barang.kd_barang ASC LIMIT $mulai, $baris";
	$barangQry = mysqli_query($mysqli, $barangSql) or die ("Gagal Query".mysql_error()); 
	$nomor = 0;
	while ($barangData = mysqli_fetch_array($barangQry, MYSQLI_ASSOC)) {
		$nomor++;
		$KodeBarang = $barangData['kd_barang'];
		$KodeKategori = $barangData['kd_kategori'];
		
		// Membaca file gambar
		if ($barangData['file_gambar']=="") {
			$fileGambar = "noimage.jpg";
		}
		else {
			$fileGambar	= $barangData['file_gambar'];
		}
	?>
	<tr>
		<td width="27%">
		<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><img src="../img-barang/<?php echo $fileGambar; ?>" width="100" border="0"> </a> <br> <div class='harga'>Rp. <?php echo format_angka($barangData['harga_retail']); ?> </div><br>
			<a <?= ($barangData['stok'] <= 0) ? '' : 'href="?open=Barang-Beli&Kode='.$KodeBarang.'"' ?> class="button orange small"><strong>Beli</strong></a>
		</td>
		<td width="73%">
			<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>">
				<div class='judul'> <?php echo $barangData['nm_barang']; ?> </div>
			</a>

			<p><?php echo substr($barangData['keterangan'], 0, 200); ?> ....</p>
			<p><strong>Stok :</strong> <?= ($barangData['stok'] <= 0) ? 'Stok Habis' : $barangData['stok'] ?> </p>
			<strong>Kategori :</strong> <a href="?open=Kategori-Barang&Kode=<?php echo $KodeKategori; ?>">
				<?php echo $barangData['nm_kategori']; ?> </a>
		</td>
	</tr>
	<?php } ?>
  <tr>
    <td colspan="2" align="center" bgcolor="#F5F5F5">
	<b>Halaman:
    <?php
	for ($h = 1; $h <= $maks; $h++) {
			echo "[  <a href='?open=Barang-Kategori&Kode=$KodeKategori&hal=$h'>$h</a> ]";
	}
	?>
    </b></td>
  </tr>
</table>
