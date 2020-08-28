<?php
if(isset($_GET['open'])) {
	switch($_GET['open']){
		case '' :				
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";
			break;
		case 'Login' :				
			if(!file_exists ("login.php")) die ("Sorry Empty Page!"); 
			include "login.php";
			break;
		case 'Login-Validasi' :				
			if(!file_exists ("login_validasi.php")) die ("Sorry Empty Page!"); 
			include "login_validasi.php";
			break; 
		case 'Logout' :				
			if(!file_exists ("login_out.php")) die ("Sorry Empty Page!"); 
			include "login_out.php";
			break;		
		case 'Halaman-Utama' :				
			if(!file_exists ("main.php")) die ("Sorry Empty Page!"); 
			include "main.php";	
			break;		
		case 'Password-Admin' :				
			if(!file_exists ("password_admin.php")) die ("Sorry Empty Page!"); 
			include "password_admin.php";
			break;						
		case 'Provinsi-Data' :				
			if(!file_exists ("provinsi_data.php")) die ("Sorry Empty Page!"); 
			include "provinsi_data.php";
			break;		
		case 'Provinsi-Add' :				
			if(!file_exists ("provinsi_add.php")) die ("Sorry Empty Page!"); 
			include "provinsi_add.php";
			break;		
		case 'Provinsi-Delete' :
			if(!file_exists ("provinsi_delete.php")) die ("Sorry Empty Page!"); 
			include "provinsi_delete.php";
			break;		
		case 'Provinsi-Edit' :
			if(!file_exists ("provinsi_edit.php")) die ("Sorry Empty Page!"); 
			include "provinsi_edit.php";
			break;
		case 'Kategori-Data' :
			if(!file_exists ("kategori_data.php")) die ("Sorry Empty Page!"); 
			include "kategori_data.php";
			break;		
		case 'Kategori-Add' :
			if(!file_exists ("kategori_add.php")) die ("Sorry Empty Page!"); 
			include "kategori_add.php";	
			break;		
		case 'Kategori-Delete' :
			if(!file_exists ("kategori_delete.php")) die ("Sorry Empty Page!"); 
			include "kategori_delete.php";
			break;		
		case 'Kategori-Edit' :
			if(!file_exists ("kategori_edit.php")) die ("Sorry Empty Page!"); 
			include "kategori_edit.php";
			break;
		case 'Barang-Data':				
			if(!file_exists ("barang_data.php")) die ("Sorry Empty Page!"); 
			include "barang_data.php";
			break;		
		case 'Barang-Add':
			if(!file_exists ("barang_add.php")) die ("Sorry Empty Page!"); 
			include "barang_add.php";
			break;		
		case 'Barang-Delete':
			if(!file_exists ("barang_delete.php")) die ("Sorry Empty Page!"); 
			include "barang_delete.php";
			break;	
		case 'Barang-Edit':
			if(!file_exists ("barang_edit.php")) die ("Sorry Empty Page!"); 
			include "barang_edit.php";
			break;
		case 'Pelanggan-Data' :
			if(!file_exists ("pelanggan_data.php")) die ("Sorry Empty Page!"); 
			include "pelanggan_data.php";
			break;
		case 'Pelanggan-Delete' :
			if(!file_exists ("pelanggan_delete.php")) die ("Sorry Empty Page!"); 
			include "pelanggan_delete.php";
			break;

		case 'Data-Retail':
			if(!file_exists ("data_retail.php")) die ("Sorry Empty Page!"); 
			include "data_retail.php";
			break;
		case 'Data-Retail-Tambah':
			if(!file_exists ("data_retail_tambah.php")) die ("Sorry Empty Page!"); 
			include "data_retail_tambah.php";
			break;
		case 'Data-Retail-Edit':
			if(!file_exists ("data_retail_edit.php")) die ("Sorry Empty Page!"); 
			include "data_retail_edit.php";
			break;
		case 'Data-Retail-Delete':
			if(!file_exists ("data_retail_delete.php")) die ("Sorry Empty Page!"); 
			include "data_retail_delete.php";
			break;

		case 'Data-Transaksi-Keluar':
			if(!file_exists ("data_transaksi_keluar.php")) die ("Sorry Empty Page!"); 
			include "data_transaksi_keluar.php";
			break;
		case 'Data-Transaksi-Keluar-Add':
			if(!file_exists ("data_transaksi_keluar_add.php")) die ("Sorry Empty Page!"); 
			include "data_transaksi_keluar_add.php";
			break;
		case 'Data-Transaksi-Keluar-Detail':
			if(!file_exists ("data_transaksi_keluar_detail.php")) die ("Sorry Empty Page!"); 
			include "data_transaksi_keluar_detail.php";
			break;
		case 'Data-Transaksi-Keluar-Delete':
			if(!file_exists ("data_transaksi_keluar_delete.php")) die ("Sorry Empty Page!"); 
			include "data_transaksi_keluar_delete.php";
			break;
		case 'Data-Transaksi-Keluar-Proses':
			if(!file_exists ("data_transaksi_keluar_proses.php")) die ("Sorry Empty Page!"); 
			include "data_transaksi_keluar_proses.php";
			break;
		case 'Data-Transaksi-Keluar-Pembayaran':
			if(!file_exists ("data_transaksi_keluar_pembayaran.php")) die ("Sorry Empty Page!"); 
			include "data_transaksi_keluar_pembayaran.php";
			break;
		case 'Data-Transaksi-Keluar-Pelunasan':
			if(!file_exists ("data_transaksi_keluar_pelunasan.php")) die ("Sorry Empty Page!"); 
			include "data_transaksi_keluar_pelunasan.php";
			break;

		case 'Data-Kurir' :				
			if(!file_exists ("data_kurir.php")) die ("Sorry Empty Page!"); 
			include "data_kurir.php";
			break;
		
		case 'Pemesanan-Barang' :				
			if(!file_exists ("pemesanan_tampil.php")) die ("Sorry Empty Page!"); 
			include "pemesanan_tampil.php";
			break;
		case 'Pemesanan-Lihat' :				
			if(!file_exists ("pemesanan_lihat.php")) die ("Sorry Empty Page!"); 
			include "pemesanan_lihat.php";
			break;
		case 'Pemesanan-Bayar' :				
			if(!file_exists ("pemesanan_bayar.php")) die ("Sorry Empty Page!"); 
			include "pemesanan_bayar.php";
			break;
		case 'Laporan-Retail' :	
			if(!file_exists ("laporan_retail.php")) die ("Sorry Empty Page!"); 
			include "laporan_retail.php";
			break;	
		case 'Laporan' :	
			if(!file_exists ("menu_laporan.php")) die ("Sorry Empty Page!"); 
			include "menu_laporan.php";
			break;						
		case 'Laporan-Kecamatan' :				
			if(!file_exists ("laporan_provinsi.php")) die ("Sorry Empty Page!"); 
			include "laporan_provinsi.php";
			break;	
		case 'Laporan-Kategori' :				
			if(!file_exists ("laporan_kategori.php")) die ("Sorry Empty Page!"); 
			include "laporan_kategori.php";
			break;		
		case 'Laporan-Barang' :	
			if(!file_exists ("laporan_barang.php")) die ("Sorry Empty Page!"); 
			include "laporan_barang.php";
			break;
		case 'Laporan-Pelanggan' :
			if(!file_exists ("laporan_pelanggan.php")) die ("Sorry Empty Page!"); 
			include "laporan_pelanggan.php";
			break;
		case 'Laporan-Pemesanan-Pelanggan' :
			if(!file_exists ("laporan_pemesanan_pelanggan.php")) die ("Sorry Empty Page!"); 
			include "laporan_pemesanan_pelanggan.php";
			break;
		case 'Laporan-Pemesanan-Retail' :
			if(!file_exists ("laporan_pemesanan_retail.php")) die ("Sorry Empty Page!"); 
			include "laporan_pemesanan_retail.php";
			break;
		case 'Laporan-Barang-Keluar-User' :
			if(!file_exists ("laporan_barang_keluar_user.php")) die ("Sorry Empty Page!"); 
			include "laporan_barang_keluar_user.php";
			break;
		case 'Laporan-Barang-Keluar-Retail' :
			if(!file_exists ("laporan_barang_keluar_retail.php")) die ("Sorry Empty Page!"); 
			include "laporan_barang_keluar_retail.php";
			break;
		case 'Laporan-Bulanan' :
			if(!file_exists ("laporan_bulanan.php")) die ("Sorry Empty Page!"); 
			include "laporan_bulanan.php";
			break;
		default:
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";
			break;
	}
}
else {
	if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";	 
}
?>