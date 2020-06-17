<?php include_once "../../library/inc.library.php"; ?>

<h2>Konfirmasi Pembayaran</h2>

<table class="table-list" width="100%" align="center">
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
        $kd    = $_GET['Kode'];
        $sql_i = "SELECT tb_retail_pemesanan.kd_transaksi, tb_retail.nama_pemilik, tb_retail.nomor, tb_retail.fax, tb_retail.email, tb_retail.website, tb_retail.alamat, kategori.nm_kategori, barang.nm_barang, tb_retail_transaksi.kd_barang, tb_retail_transaksi.jumlah, tb_retail_transaksi.harga, tb_retail_transaksi.sub_total FROM tb_retail_pemesanan INNER JOIN tb_retail_transaksi ON tb_retail_pemesanan.kd_transaksi = tb_retail_transaksi.kd_transaksi INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail INNER JOIN barang ON tb_retail_transaksi.kd_barang = barang.kd_barang INNER JOIN kategori ON barang.kd_kategori = kategori.kd_kategori WHERE tb_retail_pemesanan.kd_transaksi = '$kd'";
        $qry_i = mysqli_query($mysqli, $sql_i) or die ("MySQL salah! ".mysqli_error($mysqli));

        $qry_t = mysqli_query($mysqli, $sql_i) or die ("MySQL salah! ".mysqli_error($mysqli));
        $data  = mysqli_fetch_array($qry_t, MYSQLI_ASSOC);

        $sql_p = "SELECT * FROM tb_retail_pemesanan WHERE kd_transaksi = '$kd'";
        $qry_p = mysqli_query($mysqli, $sql_p) or die ("MySQL salah! ".mysqli_error($mysqli));
        $datas = mysqli_fetch_array($qry_p, MYSQLI_ASSOC);
        ?>
        <?php while ($rows = mysqli_fetch_array($qry_i, MYSQLI_ASSOC)) { ?>
            <tr>
                <td> <?= $rows['kd_barang'] ?> </td>
                <td> <?= $rows['nm_kategori'] ?> </td>
                <td> <?= $rows['nm_barang'] ?> </td>
                <td> <?= $rows['jumlah'] ?> </td>
                <td>Rp. <?= number_format($rows['harga']) ?> </td>
                <td>Rp. <?= number_format($rows['sub_total']) ?> </td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" align="center">
                <h2 style="margin: 0;">Total</h2>
            </td>
            <td>Rp. <?= number_format($datas['total']) ?></td>
        </tr>
    </tfoot>
</table>

<br />

<form method="post">
    <table>
        <tr>
            <td>ID Order</td>
            <td>:</td>
            <td>
                <input type="text" value="<?= $kd ?>" readonly />
            </td>
        </tr>
        <tr>
            <td>Nama Pemilik</td>
            <td>:</td>
            <td>
                <input type="text" value="<?= $data['nama_pemilik'] ?>" readonly required />
            </td>
        </tr>
        <tr>
            <td>Total Pembelian</td>
            <td>:</td>
            <td>
                <input type="text" name="inptotalpembelian" id="inptotalpembelian" value="<?= $datas['total'] ?>" readonly required />
            </td>
        </tr>
        <tr>
            <td>Jumlah Pembayaran</td>
            <td>:</td>
            <td>
                <input type="text" name="inpjumlahpembayaran" id="inpjumlahpembayaran" value="0" required />
            </td>
        </tr>
        <tr>
            <td>Sisah Pembayaran</td>
            <td>:</td>
            <td>
                <input type="text" name="inpsisahpembayaran" id="inpsisahpembayaran" value="0" readonly required />
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>
                <input type="text" id="inpstatuspembayaran" value="Belum Lunas" readonly required />
            </td>
        </tr>
        <tr>
            <td>
                <a href="?open=Data-Transaksi-Keluar">Batal</a>
                <input type="submit" name="bayar" value="Bayar" />
            </td>
        </tr>
    </table>
</form>

<script src="../../assets/js/jquery-3.2.1.min.js"></script>

<script>
    var untukJumlahBarang = function () {
        $('#inpjumlahpembayaran').keyup(function () {
            var jumlah = $(this).val();
            var total  = $('#inptotalpembelian').val();
            var hasil  = parseInt(jumlah) - parseInt(total);          

            if (!isNaN(hasil)) {
                $('#inpsisahpembayaran').val(Math.abs(hasil));

                if (parseInt(jumlah) < total) {
                    $('#inpstatuspembayaran').val('Belum Lunas');
                } else {
                    $('#inpstatuspembayaran').val('Lunas');
                }

            } else {
                $('#inpsisahpembayaran').val(0);
                $('#inpstatuspembayaran').val('Belum Lunas');
            }
        });
    }();

    // eksekusi jquery
    jQuery(document).ready(function () {
        untukJumlahBarang;
    });
</script>

<?php 
if (isset($_POST['bayar'])) {

    $totalpembelian   = $_POST['inptotalpembelian'];
    $jumlahpembayaran = $_POST['inpjumlahpembayaran'];
    $sisahpembyarana  = $_POST['inpsisahpembayaran'];
    $statuspengiriman = "delivered";

    if ($jumlahpembayaran > $totalpembelian) {
        echo "Mohon Maaf Jumlah Transfer yang Anda Masukkan Lebih dari Total : Rp. ".number_format($totalpembelian)."!";
    } else if ($jumlahpembayaran >= $totalpembelian) {

        $statuspembayaran = "lunas";
        $sql = "UPDATE tb_retail_pemesanan SET status_pengiriman = '$statuspengiriman', status_pembayaran = '$statuspembayaran', jumlah_pembayaran = '$jumlahpembayaran', sisah_pembayaran = '$sisahpembyarana' WHERE kd_transaksi = '$kd'";
        $qry = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));
        if ($qry == true) {
            echo "<meta http-equiv='refresh' content='0; url=?open=Data-Transaksi-Keluar'>";
        }

    } else {

        $statuspembayaran = "belum_lunas";
        $sql = "UPDATE tb_retail_pemesanan SET status_pengiriman = '$statuspengiriman', status_pembayaran = '$statuspembayaran', jumlah_pembayaran = '$jumlahpembayaran', sisah_pembayaran = '$sisahpembyarana' WHERE kd_transaksi = '$kd'";
        $qry = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));
        if ($qry == true) {
            echo "<meta http-equiv='refresh' content='0; url=?open=Data-Transaksi-Keluar'>";
        }

    }
}
?>