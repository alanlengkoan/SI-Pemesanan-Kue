<?php
include_once "../../library/inc.library.php";

$kd  = $_GET['kode'];
$sql = "SELECT tb_retail_pemesanan.kd_transaksi, tb_retail.nama_pemilik, tb_retail.nomor, tb_retail.fax, tb_retail.email, tb_retail.website, tb_retail.alamat, kategori.nm_kategori, barang.nm_barang, tb_retail_transaksi.kd_barang, tb_retail_transaksi.jumlah, tb_retail_transaksi.harga, tb_retail_transaksi.sub_total FROM tb_retail_pemesanan INNER JOIN tb_retail_transaksi ON tb_retail_pemesanan.kd_transaksi = tb_retail_transaksi.kd_transaksi INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail INNER JOIN barang ON tb_retail_transaksi.kd_barang = barang.kd_barang INNER JOIN kategori ON barang.kd_kategori = kategori.kd_kategori WHERE tb_retail_pemesanan.kd_transaksi = '$kd'";
$qry = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));
$row = mysqli_fetch_array($qry, MYSQLI_ASSOC);
?>

<title>Transaksi Pemesanan <?= $row['nama_pemilik'] ?> </title>

<h2>Data Pesanan</h2>

<table class="table-list" width="100%" align="center">
    <tr>
        <td width="100">ID Order</td>
        <td width="20">:</td>
        <td>
            <?= $row['kd_transaksi'] ?>
        </td>
    </tr>
    <tr>
        <td width="100">Nama Pemilik</td>
        <td width="20">:</td>
        <td>
            <?= $row['nama_pemilik'] ?>
        </td>
    </tr>
    <tr>
        <td width="100">Nomor</td>
        <td width="20">:</td>
        <td>
            <?= $row['nomor'] ?>
        </td>
    </tr>
    <tr>
        <td width="100">Fax</td>
        <td width="20">:</td>
        <td>
            <?= $row['fax'] ?>
        </td>
    </tr>
    <tr>
        <td width="100">Email</td>
        <td width="20">:</td>
        <td>
            <?= $row['email'] ?>
        </td>
    </tr>
    <tr>
        <td width="100">Website</td>
        <td width="20">:</td>
        <td>
            <?= $row['website'] ?>
        </td>
    </tr>
    <tr>
        <td width="100">Alamat</td>
        <td width="20">:</td>
        <td>
            <?= $row['alamat'] ?>
        </td>
    </tr>
</table>

<br />

<h2>Data Pembayaran</h2>

<?php 
$sql_p = "SELECT * FROM tb_retail_pemesanan WHERE kd_transaksi = '$kd'";
$qry_p = mysqli_query($mysqli, $sql_p) or die ("MySQL salah! ".mysqli_error($mysqli));
$rows  = mysqli_fetch_array($qry_p, MYSQLI_ASSOC);
?>

<table width="100%" align="center">
    <tr>
        <td width="150">Status Pengiriman</td>
        <td width="20">:</td>
        <td>
            <?= $rows['status_pengiriman'] ?>
        </td>
    </tr>
    <tr>
        <td width="150">Status Pembayaran</td>
        <td width="20">:</td>
        <td>
            <?= ($rows['status_pembayaran'] != 'lunas') ? 'Belum Lunas' : 'Lunas' ?>
        </td>
    </tr>
    <tr>
        <td width="150">Jumlah Pembayaran</td>
        <td width="20">:</td>
        <td>
            Rp. <?= number_format($rows['jumlah_pembayaran']) ?>
        </td>
    </tr>
    <tr>
        <td width="150">Sisah Pembayaran</td>
        <td width="20">:</td>
        <td>
            Rp. <?= number_format($rows['sisah_pembayaran']) ?>
        </td>
    </tr>
</table>

<br />

<table width="100%" align="center">
    <thead>
        <tr>
            <th>Kode Barang</th>
            <th>Kategori Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        $sql_i = "SELECT tb_retail_transaksi.kd_transaksi, tb_retail.nama, kategori.nm_kategori, barang.nm_barang, tb_retail_transaksi.kd_barang, tb_retail_transaksi.jumlah, tb_retail_transaksi.harga, tb_retail_transaksi.sub_total FROM tb_retail_transaksi INNER JOIN tb_retail ON tb_retail_transaksi.id_retail = tb_retail.id_retail INNER JOIN barang ON tb_retail_transaksi.kd_barang = barang.kd_barang INNER JOIN kategori ON barang.kd_kategori = kategori.kd_kategori WHERE kd_transaksi = '$kd'";
        $qry_i = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));
        ?>
        <?php while ($rows = mysqli_fetch_array($qry_i, MYSQLI_ASSOC)) { 
            $total += $rows['sub_total'];
            ?>
            <tr>
                <td><?= $rows['kd_barang'] ?></td>
                <td><?= $rows['nm_kategori'] ?></td>
                <td><?= $rows['nm_barang'] ?></td>
                <td><?= $rows['jumlah'] ?></td>
                <td>Rp. <?= number_format($rows['harga']) ?></td>
                <td>Rp. <?= number_format($rows['sub_total']) ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" align="center">
                <h2 style="margin: 0;">Total</h2>
            </td>
            <td>Rp. <?= number_format($total) ?></td>
        </tr>
    </tfoot>
</table>

<script>
    window.print();
</script>