-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 08 Sep 2020 pada 19.51
-- Versi Server: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_pemesanankue`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kd_barang` char(5) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `harga_retail` int(12) NOT NULL,
  `stok` int(4) NOT NULL,
  `keterangan` text NOT NULL,
  `file_gambar` varchar(100) NOT NULL,
  `kd_kategori` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `harga_jual`, `harga_retail`, `stok`, `keterangan`, `file_gambar`, `kd_kategori`) VALUES
('B0002', 'Katirisala / Loyang', 60000, 40000, 1000, '<h4><strong>Terbuat dari ketan hitam dan gula merah</strong></h4>', 'B0002.katirisala.png', 'K001'),
('B0001', 'Barongko / Box', 60000, 40000, 993, '<h4>Terbuat dari pisang dan dibungkus dengan daun pisang</h4>', 'B0001.barongko.png', 'K001'),
('B0003', 'Mandapa / Loyang', 50000, 30000, 1000, '<h4><strong>Kue Mandapa favorite everyone. Tersedia juga&nbsp; dalam kemasan mini&nbsp;</strong></h4>', 'B0003.mandapa.png', 'K001'),
('B0004', 'Sikaporo / Loyang ', 45000, 25000, 1000, '<h4><strong>Terbuat dari telur bebek. ciri khasnya dibawah berwarna hijau dan diatas berwarna kuning.</strong></h4>', 'B0004.sikaporo.png', 'K001'),
('B0005', 'Pisang Balanda / Box', 50000, 30000, 1000, '<h4><strong>Terbuat dari bahan dasar pisang khusus yaitu pisang raja yang dibalur dengan kocokan telur lalu digoreng kemudian diisi kacang tanah, gula pasir dan mentega.</strong></h4>', 'B0005.pisang balana.png', 'K001'),
('B0006', 'Roko Unti / Box ', 40000, 20000, 1000, '<h4><strong>Terbuat dari tepung beras yang dicampur dengan santan dengan isi ditengahnya ialah buah pisang yang kemudian dibungkus dengan menggunakan daun pisang.</strong></h4>', 'B0006.roko2 unti.png', 'K001'),
('B0007', 'Cucuru Bayao / Box ', 60000, 40000, 1000, '<h4><strong>Terbuat dari telur dan kenari</strong></h4>', 'B0007.cucurbayao.png', 'K001'),
('B0008', 'Lapis Kenari / Loyang ', 60000, 40000, 1000, '<h4><strong>Terbuat dari bahan dasar tepung terigu, gula pasir, mentega yang diolah dan juga ditambahkan kenari.</strong></h4>', 'B0008.lapis kenari.png', 'K001'),
('B0009', 'Kaddo Bodong ', 50000, 30000, 1000, '<h4><strong>Terbuat dari bahan dasar tepung ketan, kelapa, gula pasir dan garam.</strong></h4>', 'B0009.kaddo bodong.png', 'K001'),
('B0010', 'Onde Onde ', 40000, 25000, 1000, '<h4><strong>Terbuat dari tepung beras ketan yang tipis dan lengket yang didalamnya berisi kelapa parut yang sudah bercampur dengan gula merah.</strong></h4>', 'B0010.onde2.png', 'K001'),
('B0011', 'Taripang / Box ', 40000, 25000, 1000, '<h4>Terbuat dari tepung ketan dibalut dengan gula merah yang dicairkan.</h4>', 'B0011.taripang.png', 'K001'),
('B0012', 'Putri Ayu / Box ', 40000, 25000, 1000, '<h4>Rasa manis dan pandan yang ditambah dengan rasa gurih kelapa parut.</h4>', 'B0012.putri ayu.png', 'K001'),
('B0013', 'Panada / Pcs ', 5000, 3000, 1000, '<h4>Didalamnya terdapat bihun, wortel dan ayam.</h4>', 'B0013.panaa.png', 'K003'),
('B0014', 'Dadar Fla / Box ', 40000, 25000, 1000, '<h4>Terbuat dari bahan dasar tepung terigu, telur, gula dan santan.</h4>', 'B0014.dadar fla.png', 'K001'),
('B0015', 'Bandang Lame / Box', 50000, 30000, 1000, '<h4>Terbuat dari bahan dasar ubi kayu / singkong</h4>', 'B0015.bandang lame.png', 'K001'),
('B0016', 'Kue Good Time', 75000, 50000, 1000, '<h4>More cookies available at Riolo!</h4>', 'B0016.kuie rambutan.png', 'K002'),
('B0017', 'Kue Rambutan ', 75000, 50000, 1000, '<h4>More cookies available at Riolo!</h4>', 'B0017.kue rambutaaan.png', 'K002'),
('B0018', 'Kue Hijau', 75000, 50000, 1000, '<h4>More cookies available at Riolo!</h4>', 'B0018.kue hijau.png', 'K002'),
('B0020', 'Kue Kastengel', 75000, 50000, 1000, '<h4>More cookies available at Riolo!</h4>', 'B0020.kue kastengel.png', 'K002'),
('B0019', 'Kue Corn Flakes', 75000, 50000, 1000, '<h4>More cookies available at Riolo!</h4>', 'B0019.kue corn flakes.png', 'K002'),
('B0021', 'Kue Spekulas ', 75000, 50000, 1000, '<h4>More cookies available at Riolo!</h4>', 'B0021.kue spekulas.png', 'K002'),
('B0022', 'Kue Tulip ', 75000, 50000, 1000, '<h4>More cookies available at Riolo!</h4>', 'B0022.kue tulip.png', 'K002'),
('B0023', 'Kue Pelangi ', 75000, 50000, 1000, '<h4>More cookies available at Riolo!</h4>', 'B0023.kuepelangi.png', 'K002'),
('B0024', 'Roti Oles ', 8000, 5000, 1000, '<h4>Asli Homemade! Cocok untuk sarapan. Tersedia 3 varian rasa Coklat, Selai Kaya dan mentega gula.&nbsp; Walaupun dingin rotinya akan tetap garing!&nbsp;</h4>', 'B0024.roti oles.png', 'K003'),
('B0025', 'Roti Isi Telur Keju', 13000, 8000, 1000, '<h4>&nbsp;Asli Homemade! Cocok untuk sarapan. Walaupun dingin rotinya akan tetap garing!&nbsp;</h4>', 'B0025.ROTI ISI TELUR KEJU.png', 'K003'),
('B0026', 'Roti Isi Telur Beef', 20000, 15000, 1000, '<h4>Asli Homemade! Cocok untuk sarapan. Walaupun dingin rotinya akan tetap garing!&nbsp;</h4>', 'B0026.roti isi telur beef.png', 'K003'),
('B0027', 'Roti Isi Chocomaltine / Tiramissu', 22000, 15000, 1000, '<h4>Asli Homemade! Cocok untuk sarapan. Pilih Chocomaltine? Atau Tiramissu? Wajib dicoba, dijamin enak! Karena Chocomaltine an Tiramissu nya ada Crunchy Crunchy nya.</h4>', 'B0027.chocomaltine tiramisu.png', 'K003'),
('B0028', 'Roti Isi Telur ', 10000, 8000, 1000, '<h4>Asli Homemade! Cocok untuk sarapan. Wajib dicoba, dijamin Enak! Walaupun dingin rotinya akan tetap garing!&nbsp;</h4>', 'B0028.roti isi telur.png', 'K003'),
('B0029', 'Roti Isi Nuttella ', 17000, 12000, 1000, '<h4>Specially for nutella lovers! Asli Homemade! Cocok untuk sarapan. Wajib dicoba, dijamin Enak! Walaupun dingin rotinya akan tetap garing!&nbsp;</h4>', 'B0029.roti isi nutella.png', 'K003'),
('B0030', 'Songkolo ', 20000, 12000, 1000, '<h4>Kalau biasanya songkolo dipadukan dengan ikan teri, ini spesial dengan menggunakan ikan asin dan ditambah dengan perasan jeruk nipis, dijamin nikmat!</h4>', 'B0030.SONGKOLO.png', 'K003'),
('B0031', 'Kerupuk Seledri ', 25000, 15000, 1000, '<h4>Terbuat dari bahan segar dan alami tanpa bahan pengawet</h4>', 'B0031.KERUPUK SELEDRI.png', 'K003'),
('B0032', 'Roti Isi Telur Keju Sosis ', 22000, 15000, 1000, '<h4>Asli Homemade! Buat cemilan atau jadi sarapan juga bisa.</h4>', 'B0032.roti isis telur keju sosis.png', 'K003'),
('B0033', 'Ayam Nasu Likku', 25000, 17000, 1000, '<h4>Masakan khas bugis dengan bumbu rempah rempah pilihan. 1 box = 2 potong ayam, 1 ikat buras dan sambal. Dijamin enak!</h4>', 'B0033.nasu likku.png', 'K003'),
('B0034', 'Yakatsu (ayam Katsu)', 35000, 22000, 1000, '<h4>Cheetos ala ala korea! Buat ngemil enak tambah nasi juga lebih enak. Cobain!</h4>', 'B0034.yakatsu cheetos.png', 'K003'),
('B0035', 'Ayam Cheetos', 30000, 20000, 1000, '<h4>Yang suka ngemil cheetos wajib coba! Paketnya lengkap ada kentang &amp; adar crispy</h4>', 'B0035.ayam cheetos.png', 'K003'),
('B0036', 'Ayam Cheetos + Nasi', 35000, 22000, 1000, '<h4>Yang pengen lebih kenyang bisa order ayam cheetos + nasi dijamin kenyang!</h4>', 'B0036.ayam cheetos nasi.png', 'K003'),
('B0037', 'Es Coklat Kopi ', 22000, 15000, 998, '<h4>Everything about coklat!&nbsp;</h4>\r\n<h4>Es Coklat Pisang (Manis)</h4>\r\n<h4>Es Coklat (Pekat Manis)</h4>\r\n<h4>Es Coklat Kopi (Pekat)</h4>', 'B0037.es coklat kopi.png', 'K004'),
('B0038', 'Es Pisang Coklat', 22000, 15000, 1000, '<h4>Everything about coklat!&nbsp;</h4>\r\n<h4>Es Coklat Pisang (Manis)</h4>\r\n<h4>Es Coklat (Pekat Manis)</h4>\r\n<h4>Es Coklat Kopi (Pekat)</h4>', 'B0038.es pisang coklat.png', 'K004'),
('B0039', 'Es Coklat ', 22000, 15000, 1000, '<h4>Everything about coklat!&nbsp;</h4>\r\n<h4>Es Coklat Pisang (Manis)</h4>\r\n<h4>Es Coklat (Pekat Manis)</h4>\r\n<h4>Es Coklat Kopi (Pekat)</h4>', 'B0039.es coklat.png', 'K004'),
('B0040', 'Sugar Milk Tea ', 22000, 15000, 1000, '<h4>Yang ga doyan kopi, don&acute;t worry! Di Riolo ada menu milktea yah. Ada 2 varian, Sugar Milktea dan Honey MIlktea.</h4>', 'B0040.sugar milk tea.png', 'K004'),
('B0041', 'Honey Milktea ', 22000, 15000, 1000, '<h4>Yang ga doyan kopi, don&acute;t worry! Di Riolo ada menu milktea yah. Ada 2 varian, Sugar Milktea dan Honey MIlktea.</h4>', 'B0041.honey milk tea real.png', 'K004'),
('B0042', 'Susu Cincau (suci) Original ', 20000, 12000, 1000, '<h4>Yang ga terlalu doyan gula aren / merah bisa order SuCi yang Ori aja yah. Rasanya tetap manis, dijamin gak bikin enek!</h4>', 'B0042.suci ori.png', 'K004'),
('B0043', 'Susu Cincau Pandan ', 22000, 15000, 1000, '<h4>Yuk cobain menu baru di Riolo!&nbsp;</h4>', 'B0043.suci pandan.png', 'K004'),
('B0044', 'Susu Cincau Aren ', 22000, 15000, 1000, '<h4>Ga usah itanya soal rasa, paling Best Seller di Riolo!</h4>', 'B0044.suci aren.png', 'K004'),
('B0045', 'Es Milo', 22000, 15000, 1000, '<h4>Buat yang ga doyan kopi an manis - manis cobain ini aja! Rasanya benar - benar Milo.</h4>', 'B0045.es milo.png', 'K004'),
('B0046', 'Es Kopi Susu ', 20000, 13000, 1000, '<h4>Rasa kopinya yang ga terlalu strong dan ada juga dengan rasa gurihnya!</h4>', 'B0046.es kopi susu.png', 'K004'),
('B0047', 'Tropical  Lemon', 22000, 15000, 1000, '<h4>Panas terik enaknya Tropical Lemon! Rasanya segar ditambah dengan coconut jelly</h4>', 'B0047.tropical lemon.png', 'K004'),
('B0048', 'Tropicalberi', 22000, 15000, 1000, '<h4>Panas terik enaknya Tropicalberi! Rasanya segar ditambah dengan coconut jelly</h4>', 'B0048.tropicalberi.png', 'K004'),
('B0049', 'Es Kopi Susu Pisang ', 23000, 16000, 1000, '<h4>Kopinya terasa, pisangnya terasa, creamy nya juga terasa!</h4>', 'B0049.es kopi susu pisang.png', 'K004'),
('B0050', 'Kopiato (kopi Macchiato)', 23000, 16000, 1000, '<h4>Rasa creamynya jadi bikin seimbang dengan rasa kopinya.</h4>', 'B0050.kopiato.png', 'K004'),
('B0051', 'Koreo Milky ', 25000, 18000, 1000, '<h4>Yang dooyan oreo wajib coba! Koreo Milky alias Kopi + Oreo</h4>', 'B0051.koreo milky.png', 'K004'),
('B0052', 'Redvelvet', 20000, 13000, 1000, '<h4>Manisnya pas, ada rasa pahitnya dikit yang bikin rasanya makin enak!</h4>', 'B0052.redevelvet.png', 'K004'),
('B0053', 'Susu Regal ', 22000, 15000, 1000, '<h4>Beda dari yang lain karena rasanya seperti Ice Cream Vanilla!</h4>', 'B0053.susu regal.png', 'K004'),
('B0054', 'Green Tea', 20000, 13000, 1000, '<h4>Panas terik paling pas cobain Greentea dari Riolo!&nbsp;</h4>', 'B0054.greentea.png', 'K004'),
('B0055', 'Thai Tea', 20000, 13000, 1000, '<h4>Panas terik paling pas cobain Thaitea dari Riolo!</h4>', 'B0055.thaitea.png', 'K004'),
('B0056', 'Ovaltine Macchiato', 22000, 15000, 1000, '<h4>Btw, Macchiato nya salted yah jadi rasanya lebih gurih!</h4>', 'B0056.ovaltine macchiato.png', 'K004'),
('B0057', 'Lemon Yakult ', 22000, 15000, 1000, '<h4>Menu baru di Riolo yang dijamin bikin segar! Lemon Yakult &amp; Strawberi Yakult lengkap dengan Coconut Jelly nya.</h4>', 'B0057.lemon yakult.png', 'K004'),
('B0058', 'Strawberi Yakult ', 22000, 15000, 1000, '<h4>Menu baru di Riolo yang dijamin bikin segar! Lemon Yakult &amp; Strawberi Yakult lengkap dengan Coconut Jelly nya.</h4>', 'B0058.strawberi yakult.png', 'K004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kd_kategori` char(10) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
('K001', 'Kue Basah'),
('K002', 'Kue Kering '),
('K003', 'Snack'),
('K004', 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kd_pelanggan` char(6) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`kd_pelanggan`, `nm_pelanggan`, `kelamin`, `email`, `no_telepon`, `username`, `password`, `tgl_daftar`) VALUES
('P00001', 'Alan Lengkoan', 'Laki-laki', 'alanlengkoan15@gmail.com', '085232321212', 'alan', '02558a70324e7c4f269c69825450cec8', '2019-09-21'),
('P0002', 'fahmi', 'Laki-laki', 'fahmi@gmail.com', '081907290637', 'fahmi', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-19'),
('P0003', 'ica', 'Perempuan', 'ica@gmail.com', '04119898', 'ica', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2019-10-29'),
('P0004', 'fiandra', 'Perempuan', 'fiandraa@gmail.com', '085255566766', 'fiandra', '827ccb0eea8a706c4c34a16891f84e7b', '2019-10-29'),
('P0005', 'faisyah wulandari', 'Perempuan', 'wfaisyah@gmail.com', '087878789876', 'faisyahw', '827ccb0eea8a706c4c34a16891f84e7b', '2019-10-30'),
('P0006', 'abi', 'Laki-laki', 'wfaisyah@gmail.com', '081907290637', 'abi', '827ccb0eea8a706c4c34a16891f84e7b', '2019-10-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `no_pemesanan` char(8) NOT NULL,
  `kd_pelanggan` char(6) NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `nama_penerima` varchar(60) NOT NULL,
  `alamat_lengkap` varchar(200) NOT NULL,
  `kd_provinsi` char(10) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status_bayar` enum('Pesan','Lunas','Belum Lunas') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`no_pemesanan`, `kd_pelanggan`, `tgl_pemesanan`, `nama_penerima`, `alamat_lengkap`, `kd_provinsi`, `no_telepon`, `status_bayar`) VALUES
('PS0001', 'P00001', '2019-11-20', 'alan', 'gowa', 'P0003', '0411838033', 'Lunas'),
('PS0002', 'P00001', '2019-11-20', 'alan', 'gowa', 'P0003', '0411838033', 'Lunas'),
('PS0003', 'P0003', '2019-10-29', 'ica', 'gagak', 'P0005', '081907290637', 'Lunas'),
('PS0004', 'P0003', '2019-10-29', 'fahmi', 'gagak', 'P0007', '087810272034', 'Lunas'),
('PS0005', '1', '2019-10-29', 'abi', 'jalan antang', 'P0006', '8888', 'Lunas'),
('PS0006', 'P0004', '2019-10-29', 'fiandra', 'jalan gagak ', 'P0005', '085255566766', 'Lunas'),
('PS0007', '1', '2019-10-30', 'ica', 'gagak', 'P0005', '085255566766', 'Pesan'),
('PS0008', 'P0005', '2019-10-30', 'ica', 'gagak', 'P0005', '085255566766', 'Lunas'),
('PS0009', 'P0006', '2019-10-30', 'abi', 'jalan gagak', 'P0006', '085298519898', 'Pesan'),
('PS0010', 'P0006', '2019-10-31', 'ai', 'gagak', 'P0012', '8888', 'Pesan'),
('PS0011', 'P0002', '2019-12-06', 'fahmi', 'tritura', 'P0005', '082189114505', 'Lunas'),
('PS0012', 'P00001', '2019-12-16', 'alan', 'Btp', 'P0010', '0411838033', 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_item`
--

CREATE TABLE `pemesanan_item` (
  `id` int(4) NOT NULL,
  `no_pemesanan` char(8) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan_item`
--

INSERT INTO `pemesanan_item` (`id`, `no_pemesanan`, `kd_barang`, `harga`, `jumlah`) VALUES
(1, 'PS0001', 'B0001', 20000, 4),
(2, 'PS0002', 'B0002', 25000, 3),
(3, 'PS0002', 'B0001', 20000, 3),
(4, 'PS0003', 'B0002', 25000, 2),
(5, 'PS0004', 'B0001', 20000, 2),
(6, 'PS0005', 'B0002', 25000, 1),
(7, 'PS0006', 'B0002', 25000, 1),
(8, 'PS0007', 'B0002', 60000, 1),
(9, 'PS0008', 'B0001', 60000, 1),
(10, 'PS0008', 'B0003', 50000, 1),
(11, 'PS0009', 'B0001', 60000, 1),
(12, 'PS0010', 'B0001', 60000, 1),
(13, 'PS0011', 'B0037', 22000, 1),
(14, 'PS0012', 'B0037', 22000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `kd_provinsi` char(7) NOT NULL,
  `nm_provinsi` varchar(100) NOT NULL,
  `biaya_kirim` int(12) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`kd_provinsi`, `nm_provinsi`, `biaya_kirim`) VALUES
('P0001', 'Biring Kanaya', 20000),
('P0002', 'Bontoala', 20000),
('P0007', 'Panakkukang ', 15000),
('P0006', 'Mariso', 12000),
('P0005', 'Manggala', 17000),
('P0004', 'Mamajang', 12000),
('P0003', 'Makassar', 15000),
('P0008', 'Rappocini', 13000),
('P0009', 'Tallo', 18000),
('P0010', 'Tamanlanrea', 18000),
('P0011', 'Ujung Pandang', 15000),
('P0012', 'Ujung Tanah ', 15000),
('P0013', 'Wajo', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kurir`
--

CREATE TABLE `tb_kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kurir`
--

INSERT INTO `tb_kurir` (`id_kurir`, `nama`, `kelamin`, `email`, `nohp`, `username`, `password`) VALUES
(1, 'Beni Miller', 'L', 'beni@gmail.com', '08767283212', 'beni', 'b94ce3c426a5ab6032624ab62a2b0b95');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_retail`
--

CREATE TABLE `tb_retail` (
  `id_retail` varchar(20) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_ktp` varchar(50) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `fax` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_retail`
--

INSERT INTO `tb_retail` (`id_retail`, `nama_pemilik`, `nama_toko`, `tgl_lahir`, `tgl_daftar`, `foto_ktp`, `nomor`, `fax`, `email`, `website`, `alamat`, `username`, `password`, `foto`) VALUES
('R0001', 'Bpk. Alan', 'Pt. Bucin Sejati', '2019-11-13', '2019-11-14 22:58:44', '26.jpg', '123', '123', 'alan@gmail.com', 'www.alamyes.com', 'test', 'alan', '02558a70324e7c4f269c69825450cec8', NULL),
('R0002', 'PT.Adikarya', 'Toko Fahmi', '1976-01-11', '2019-11-19 13:51:56', 'WhatsApp Image 2019-11-19 at 12.36.56.jpeg', '0411 3432', '7989', 'MM@gmail.com', 'PT.Adikarya.com', 'tritura', 'fahmi', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
('R0003', 'fahmi', 'pt.kuyu', '1997-10-10', '2019-10-28 18:56:31', '06cd0f7c2333df6021b2518c10477645.jpg', '081907290637', '7777', 'kuyu@gmail.com', 'kuyu.blogspot.com', 'gagak', 'kuyu', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
('R0004', 'deni', 'toko deni', '2019-10-28', '2019-10-28 19:00:55', '1ebb7a669f6382175997a72290a863ec.jpg', '0876567657', '98752', 'd@gmail.com', 'dens.blogspot.com', 'takalar', 'deni', 'd8578edf8458ce06fbc5bb76a58c5ca4', NULL),
('R0005', 'callista ', 'titatacake', '1998-12-12', '2019-10-29 10:28:29', '0b232d19a6f62b7c5673c310faea03ca.jpg', '081907290637', '-', 'kuyu@gmail.com', 'dens.blogspot.com', 'jalan gagak', 'titata', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
('R0006', 'a. ananda shakila ichsan', 'aneka kue', '2019-10-06', '2019-10-30 14:22:36', 'honey milk tea real.png', '081907290637', '-', 'nurafnimujjahidah@gmail.com', 'kuyu.blogspot.com', 'gagak ', 'ananda', '827ccb0eea8a706c4c34a16891f84e7b', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_retail_pemesanan`
--

CREATE TABLE `tb_retail_pemesanan` (
  `id_pemesanan_retail` int(11) NOT NULL,
  `kd_transaksi` varchar(20) NOT NULL,
  `id_retail` varchar(10) NOT NULL,
  `status_pengiriman` enum('onprocess','delivered','redelivered') DEFAULT NULL,
  `status_pembayaran` enum('proses','lunas','belum_lunas') NOT NULL,
  `jumlah_pembayaran` int(11) DEFAULT NULL,
  `sisah_pembayaran` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_retail_pemesanan`
--

INSERT INTO `tb_retail_pemesanan` (`id_pemesanan_retail`, `kd_transaksi`, `id_retail`, `status_pengiriman`, `status_pembayaran`, `jumlah_pembayaran`, `sisah_pembayaran`, `total`, `waktu`) VALUES
(1, 'TRS0001', 'R0001', 'delivered', 'lunas', 70000, 0, 70000, '2019-11-20'),
(2, 'TRS0002', 'R0004', 'delivered', 'lunas', 45000, 0, 45000, '2019-10-29'),
(3, 'TRS0003', 'R0003', 'delivered', 'lunas', 60000, 0, 60000, '2019-10-29'),
(4, 'TRS0004', 'R0005', 'delivered', 'lunas', 10000, 0, 10000, '2019-10-29'),
(5, 'TRS0005', 'R0006', 'delivered', 'lunas', 15000, 0, 15000, '2019-10-30'),
(6, 'TRS0006', 'R0006', 'delivered', 'belum_lunas', 0, 0, 40000, '2019-10-30'),
(7, 'TRS0007', 'R0006', 'onprocess', 'proses', NULL, NULL, 40000, '2019-10-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_retail_pesanan`
--

CREATE TABLE `tb_retail_pesanan` (
  `id_retail_pemesanan` int(11) NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `tb_retail_pesanan`
--
DELIMITER $$
CREATE TRIGGER `kurangjumlahbarang` AFTER INSERT ON `tb_retail_pesanan` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok-new.jumlah WHERE kd_barang = new.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_retail_transaksi`
--

CREATE TABLE `tb_retail_transaksi` (
  `id_retail_transaksi` int(11) NOT NULL,
  `kd_transaksi` varchar(15) NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_retail_transaksi`
--

INSERT INTO `tb_retail_transaksi` (`id_retail_transaksi`, `kd_transaksi`, `kd_barang`, `jumlah`, `harga`, `sub_total`) VALUES
(1, 'TRS0001', 'B0002', 2, 15000, 30000),
(2, 'TRS0001', 'B0001', 1, 40000, 40000),
(3, 'TRS0002', 'B0002', 3, 15000, 45000),
(4, 'TRS0003', 'B0002', 4, 15000, 60000),
(5, 'TRS0004', 'B0001', 1, 10000, 10000),
(6, 'TRS0005', 'B0026', 1, 15000, 15000),
(7, 'TRS0006', 'B0001', 1, 40000, 40000),
(8, 'TRS0007', 'B0001', 1, 40000, 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_keranjang`
--

CREATE TABLE `tmp_keranjang` (
  `id` int(5) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `kd_pelanggan` char(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Trigger `tmp_keranjang`
--
DELIMITER $$
CREATE TRIGGER `kurangbaranguser` AFTER INSERT ON `tmp_keranjang` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok-new.jumlah WHERE kd_barang = new.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `total_bayar`
--

CREATE TABLE `total_bayar` (
  `id_total_bayar` int(11) NOT NULL,
  `kd_pelanggan` varchar(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kd_pelanggan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`no_pemesanan`);

--
-- Indexes for table `pemesanan_item`
--
ALTER TABLE `pemesanan_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`kd_provinsi`);

--
-- Indexes for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `tb_retail`
--
ALTER TABLE `tb_retail`
  ADD PRIMARY KEY (`id_retail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_retail_pemesanan`
--
ALTER TABLE `tb_retail_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan_retail`);

--
-- Indexes for table `tb_retail_pesanan`
--
ALTER TABLE `tb_retail_pesanan`
  ADD PRIMARY KEY (`id_retail_pemesanan`);

--
-- Indexes for table `tb_retail_transaksi`
--
ALTER TABLE `tb_retail_transaksi`
  ADD PRIMARY KEY (`id_retail_transaksi`);

--
-- Indexes for table `tmp_keranjang`
--
ALTER TABLE `tmp_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_bayar`
--
ALTER TABLE `total_bayar`
  ADD PRIMARY KEY (`id_total_bayar`),
  ADD UNIQUE KEY `kd_pelanggan` (`kd_pelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pemesanan_item`
--
ALTER TABLE `pemesanan_item`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_retail_pemesanan`
--
ALTER TABLE `tb_retail_pemesanan`
  MODIFY `id_pemesanan_retail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_retail_pesanan`
--
ALTER TABLE `tb_retail_pesanan`
  MODIFY `id_retail_pemesanan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_retail_transaksi`
--
ALTER TABLE `tb_retail_transaksi`
  MODIFY `id_retail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tmp_keranjang`
--
ALTER TABLE `tmp_keranjang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `total_bayar`
--
ALTER TABLE `total_bayar`
  MODIFY `id_total_bayar` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
