<?php
// Validasi : Halaman ini hanya untuk yang sudah login
include_once "../../library/inc.sesadmin.php";
include_once "../../library/inc.library.php";

// untuk membuat kode otomatis
$sql    = "SELECT kd_transaksi FROM tb_retail_pemesanan";
$carkod = mysqli_query($mysqli, $sql);
$datkod = mysqli_fetch_array($carkod, MYSQLI_ASSOC);
$jumdat = mysqli_num_rows($carkod);

if ($datkod) {
  $nilkod  = substr($jumdat[0], 1);
  $kode    = (int) $nilkod;
  $kode    = $jumdat + 1;
  $kodeoto = "TRS".sprintf("%04s", $kode);
} else {
  $kodeoto = "TRS0001";
}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" target="_self">
    <h2>Data Pesanan</h2>

    <table class="table-list" width="100%" align="center">
        <tr>
            <td>ID Order</td>
            <td>:</td>
            <td>
                <input type="text" name="inpkdtransaksi" value="<?= $kodeoto ?>" readonly="readonly" />
            </td>
        </tr>
        <tr>
            <td>Nama Retail</td>
            <td>:</td>
            <td>
                <select name="inpidretail" required>
                    <option value="">- Pilih Retail -</option>
                    <?php 
                    $qry_sql = mysqli_query($mysqli, "SELECT * FROM tb_retail ORDER BY nama_pemilik ASC") or die ("Query salah : ".mysqli_error($mysqli));
                    while ($row = mysqli_fetch_array($qry_sql, MYSQLI_ASSOC)) { ?>
                        <option value="<?= $row['id_retail'] ?>"><?= $row['nama_pemilik'] ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Status Pengantaran</td>
            <td>:</td>
            <td>
                <select name="inpstatuspengantaran" required>
                    <option>- Status Pengantaran -</option>
                    <option value="onprocess">On-Process</option>
                    <option value="delivered">Delivered</option>
                    <option value="redelivered">Redelivered</option>
                </select>
            </td>
        </tr>
    </table>

    <br />

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
            $total = 0;
            $sql_p = "SELECT tb_retail_pesanan.kd_barang, kategori.nm_kategori, barang.nm_barang, tb_retail_pesanan.jumlah, tb_retail_pesanan.harga, tb_retail_pesanan.sub_total FROM tb_retail_pesanan INNER JOIN barang ON tb_retail_pesanan.kd_barang = barang.kd_barang INNER JOIN kategori ON barang.kd_kategori = kategori.kd_kategori";
            $qry_p = mysqli_query($mysqli, $sql_p) or die ("MySQL salah! ".mysqli_error($mysqli));
            ?>

            <?php if (mysqli_num_rows($qry_p) > 0) : ?>
                <?php while ($row = mysqli_fetch_array($qry_p, MYSQLI_ASSOC)) { 
                    $total += $row['sub_total'];
                    ?>
                    <tr>
                        <td> <input type="hidden" name="inpkd_barang[]" value="<?= $row['kd_barang'] ?>"> <?= $row['kd_barang'] ?></td>
                        <td><?= $row['nm_kategori'] ?></td>
                        <td><?= $row['nm_barang'] ?></td>
                        <td> <input type="hidden" name="inpjml_barang[]" value="<?= $row['jumlah'] ?>"> <?= $row['jumlah'] ?></td>
                        <td> <input type="hidden" name="inphrg_barang[]" value="<?= $row['harga'] ?>">Rp. <?= number_format($row['harga']) ?></td>
                        <td> <input type="hidden" name="inpsbt_barang[]"value="<?= $row['sub_total'] ?>">Rp. <?= number_format($row['sub_total']) ?></td>
                    </tr>
                <?php } ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" align="center"><h2 style="margin: 0;">Belum Ada Pesanan!</h2></td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" align="center"><h2 style="margin: 0;">Total</h2></td>
                <td>
                    Rp. <?= number_format($total) ?> <input type="hidden" name="inptotal" value="<?= $total ?>" />
                </td>
            </tr>
        </tfoot>
    </table>
    <input type="submit" name="proses" value="Proses">
</form>

<script src="../../assets/js/jquery-3.2.1.min.js"></script>

<?php
if (isset($_POST['proses'])) {

    $kdtransaksi = $_POST['inpkdtransaksi'];
    $idretail    = $_POST['inpidretail'];
    $idbarang    = $_POST['inpkd_barang'];
    $jumlah      = $_POST['inpjml_barang'];
    $harga       = $_POST['inphrg_barang'];
    $subtotal    = $_POST['inpsbt_barang'];
    $total       = $_POST['inptotal'];

    $status      = $_POST['inpstatuspengantaran'];
    $waktu       = date('Y-m-d');

    $sql_i = "INSERT INTO tb_retail_pemesanan (kd_transaksi, id_retail, status_pengiriman, total, waktu) VALUES ('$kdtransaksi', '$idretail', '$status', '$total', '$waktu')";
    mysqli_query($mysqli, $sql_i) or die ("MySQL salah! ".mysqli_error($mysqli));

    for ($i = 0; $i < count($idbarang); $i++) { 
        $sql_t = "INSERT INTO tb_retail_transaksi (kd_transaksi, kd_barang, jumlah, harga, sub_total) VALUES ('$kdtransaksi', '$idbarang[$i]', '$jumlah[$i]', '$harga[$i]', '$subtotal[$i]')";
        $qry_t = mysqli_query($mysqli, $sql_t) or die ("MySQL salah! ".mysqli_error($mysqli));
    }

    if ($qry_t == true) {
        mysqli_query($mysqli, "TRUNCATE TABLE tb_retail_pesanan");
        echo "<meta http-equiv='refresh' content='0; url=?open=Data-Transaksi-Keluar'>";
    }
    
}
?>