<?php
include_once "inc.session.php";
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

// Program ini akan Dijalankan ketika Tombol BELI diklik, tombol BELI ada di halaman Produk Barang

// Baca Kode Pelanggan yang Login
$KodePelanggan = $_SESSION['SES_PELANGGAN'];

if(isset($_GET['Kode'])) {

	// Baca Kode Barang yang dipilih
	$Kode = $_GET['Kode'];

	$sql = "SELECT * FROM barang WHERE kd_barang='$Kode'";
	$qry = mysqli_query($mysqli, $sql) or mysqli_error($mysqli);
	$row = mysqli_fetch_array($qry, MYSQLI_ASSOC);

	if ($row['stok'] <= 0) {
		echo "<script>window.alert('Maaf stok abis!')</script>";
		echo "<script>window.location.href='?open=Barang'</script>";
	} else {
		// Baca data di dalam Keranjang Belanja	
		$cekSql = "SELECT * FROM tmp_keranjang WHERE kd_barang = '$Kode' AND kd_pelanggan = '$KodePelanggan'";
		$cekQry = mysqli_query($mysqli,$cekSql) or die ("MySQL Salah! ".mysqli_error($mysqli));
		if (mysqli_num_rows($cekQry) >=1) {
			// Jika barang sudah pernah dipilih, maka update saja jumlah barangnya (+1)
			$mySql = "UPDATE tmp_keranjang SET jumlah = jumlah + 1 WHERE kd_barang = '$Kode' AND kd_pelanggan = '$KodePelanggan'";

		} else {

			// Jika barang belum pernah dipilih, maka tambahkan baris baru ke keranjang
			$sql_2 = "SELECT * FROM barang WHERE kd_barang = '$Kode'";
			$qry_2 = mysqli_query($mysqli, $sql_2) or die ("MySQL Salah! ".mysqli_error($mysqli));
			$rows  = mysqli_fetch_array($qry_2);
			// ambil data barang
			$hrg_jual = $rows['harga_retail'];
			$subtotal = 1 * $hrg_jual;
			
			$sql_3 = "INSERT INTO tb_retail_pesanan (kd_barang, jumlah, harga, sub_total) VALUES('$Kode', '1', '$hrg_jual', '$subtotal')";
			$qry_3 = mysqli_query($mysqli, $sql_3) or die ("MySQL Salah! ".mysqli_error($mysqli));
		}
		
		if ($qry_3 == true) {
			
			echo "<meta http-equiv='refresh' content='0; url=?open=Keranjang-Belanja'>";

		}
	}
}

?>