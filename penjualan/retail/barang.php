<?php
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

# Nomor Halaman (Paging)
$baris   = 10;
$hal     = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * FROM barang";
$pageQry = mysqli_query($mysqli, $pageSql) or die ("error paging: ".mysql_error());
$jml     = mysqli_num_rows($pageQry);
$maks    = ceil($jml/$baris);
$mulai   = $baris * ($hal-1);
?>
<html>

<body>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<td colspan="2" align="center" bgcolor="#CCCCCC" scope="col">
				<font color="#FF0066"><strong>KOLEKSI BARANG </strong></font>
			</td>
		</tr>
		<?php
		// Menampilkan daftar barang
		$barangSql = "SELECT barang.*,  kategori.nm_kategori FROM barang LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori ORDER BY barang.kd_barang ASC LIMIT $mulai, $baris";
		$barangQry = mysqli_query($mysqli, $barangSql) or die ("Gagal Query".mysql_error()); 
		$nomor = 0;
		while ($barangData = mysqli_fetch_array($barangQry)) {
			$nomor++;
			$KodeBarang = $barangData['kd_barang'];
			$KodeKategori = $barangData['kd_kategori'];
			
			// Membaca file gambar
			($barangData['file_gambar'] == "") ? $fileGambar = "noimage.jpg" : $fileGambar	= $barangData['file_gambar'];
			// Warna baris data
			($nomor%2==1) ? $warna = "" : $warna = "#F5F5F5";

		?>
		<tr>
			<td width="19%" align="center">
				<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><img src="../img-barang/<?php echo $fileGambar; ?>" width="100" border="0"> </a> <br> <div class='harga'>Rp. <?php echo format_angka($barangData['harga_retail']); ?> </div><br>
				<a <?= ($barangData['stok'] <= 0) ? '' : 'href="?open=Barang-Beli&Kode='.$KodeBarang.'"' ?>> <img src="../assets/images/beli.gif" alt=""></a>
			</td>
			<td width="81%" valign="top">
				<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"> <div class='judul'><?php echo $barangData['nm_barang']; ?> </div> </a>

				<p><?php echo substr($barangData['keterangan'], 0, 200); ?> ....</p>
				<p><strong>Stok :</strong> <?= ($barangData['stok'] <= 0) ? 'Stok Habis' : $barangData['stok'] ?></p>
				<strong>Kategori :</strong> <a href="?open=Kategori-Barang&Kode=<?php echo $KodeKategori; ?>"> <?php echo $barangData['nm_kategori']; ?> </a>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="2" align="center" bgcolor="#F5F5F5">
				<b>Halaman:
					<?php
					for ($h = 1; $h <= $maks; $h++) {
							echo "[  <a href='?hal=$h'>$h</a> ]";
					}
					?>
				</b>
			</td>
		</tr>
	</table>
</body>

</html>