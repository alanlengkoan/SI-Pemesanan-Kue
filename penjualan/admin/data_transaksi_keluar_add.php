<?php
// Validasi : Halaman ini hanya untuk yang sudah login
include_once "../../library/inc.sesadmin.php";
include_once "../../library/inc.library.php";

// untuk membuat kode otomatis
$sql    = "SELECT kd_transaksi FROM tb_retail_transaksi";
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
    <table class="table-list" width="100%" style="margin-top:0px;" align="center">
        <thead>
            <tr>
                <th>Pilih Kategori</th>
                <th>Pilih Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="inpkategori" id="inpkategori">
                        <option value="">- Pilih Kategori -</option>
                        <?php 
                        $qry_sql = mysqli_query($mysqli, "SELECT * FROM kategori ORDER BY nm_kategori ASC") or die ("Query salah : ".mysqli_error($mysqli));
                        while ($row = mysqli_fetch_array($qry_sql, MYSQLI_ASSOC)) { ?>
                            <option value="<?= $row['kd_kategori'] ?>"><?= $row['nm_kategori'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select name="inpidbarang" id="inpidbarang">
                        <option value="">- Pilih Produk -</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="inpjumlah" id="inpjumlah" value="0">
                </td>
                <td>
                    <input type="text" name="inpharga" id="inpharga" value="0" readonly>
                </td>
                <td>
                    <input type="text" name="inpsubtotal" id="inpsubtotal" value="0" readonly>
                </td>
            </tr>
        </tbody>
    </table>
    <input type="submit" name="tambah" value="Tambah">

    <hr />

    <h2>Data Pesanan</h2>
    
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
                        <td> <?= $row['kd_barang'] ?> </td>
                        <td> <?= $row['nm_kategori'] ?> </td>
                        <td> <?= $row['nm_barang'] ?> </td>
                        <td> <?= $row['jumlah'] ?> </td>
                        <td>Rp. <?= number_format($row['harga']) ?> </td>
                        <td>Rp. <?= number_format($row['sub_total']) ?> </td>
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
                <td>Rp. <?= number_format($total) ?></td>
            </tr>
        </tfoot>
    </table>
    <a href="?open=Data-Transaksi-Keluar-Proses"><img src="../assets/images/next.gif" style="height: 25px;" /></a>
</form>

<script src="../../assets/js/jquery-3.2.1.min.js"></script>

<script>
    var untukKategoriBarang = function () {
        $('#inpkategori').change(function () {
            var idkategori = $(this).val();
            $.ajax({
                method: 'GET',
                url: 'cek_produk.php',
                dataType: 'json',
                data: {
                    idkategori: idkategori
                },
                success: function (data) {
                    var html = "";
                    var i;
                    html += "<option value=''>- Pilih Produk -</option>";
                    for (i = 0; i < data.length; i++) {
                        html += "<option value=" + data[i].kd_barang + ">" + data[i].nm_barang + "</option>";
                    }
                    $('#inpidbarang').html(html);
                }
            });
        });
    }();

    var untukBarang = function () {
        $('#inpidbarang').change(function () {
            var idbarang = $(this).val();
            $.ajax({
                method: 'GET',
                url: 'cek_barang.php',
                dataType: 'json',
                data: {
                    idbarang: idbarang
                },
                success: function (data) {
                    $.each(data, function (i, row) {
                        $('#inpharga').val(row.harga_jual);
                    });
                }
            });
        });
    }();

    var untukJumlahBarang = function () {
        $('#inpjumlah').keyup(function () {
            var jumlah = $(this).val();
            var harga = $('#inpharga').val();
            var hasil = parseInt(jumlah) * parseInt(harga);
            if (!isNaN(hasil)) {
                $('#inpsubtotal').val(hasil);
            }
        });
    }();

    // eksekusi jquery
    jQuery(document).ready(function () {
        untukKategoriBarang;
        untukBarang;
        untukJumlahBarang;
    });
</script>

<?php
if (isset($_POST['tambah'])) {
    $idbarang = $_POST['inpidbarang'];
    $jumlah   = $_POST['inpjumlah'];
    $harga    = $_POST['inpharga'];
    $subtotal = $_POST['inpsubtotal'];

    $sql = "INSERT INTO tb_retail_pesanan (kd_barang, jumlah, harga, sub_total) VALUES ('$idbarang', '$jumlah', '$harga', '$subtotal')";
    $qry = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));

    if ($qry == true) {
        echo "<meta http-equiv='refresh' content='0; url=?open=Data-Transaksi-Keluar-Add'>";
    }

}
?>