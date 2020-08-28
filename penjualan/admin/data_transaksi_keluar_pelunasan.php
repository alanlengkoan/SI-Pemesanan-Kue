<?php
include_once "../../library/inc.library.php";
$kd    = $_GET['Kode'];
$total = 0;
$sql_i = "SELECT tb_retail.nama_pemilik, tb_retail_pemesanan.status_pembayaran, tb_retail_pemesanan.jumlah_pembayaran, tb_retail_pemesanan.sisah_pembayaran FROM tb_retail_pemesanan INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail WHERE tb_retail_pemesanan.kd_transaksi = '$kd'";
$qry_i = mysqli_query($mysqli, $sql_i) or die ("MySQL salah! ".mysqli_error($mysqli));
$rows  = mysqli_fetch_array($qry_i, MYSQLI_ASSOC);

$sql_t = "SELECT tb_retail_transaksi.sub_total FROM tb_retail_transaksi WHERE tb_retail_transaksi.kd_transaksi = '$kd'";
$qry_t = mysqli_query($mysqli, $sql_t) or die ("MySQL salah! ".mysqli_error($mysqli));
$total = 0;
while ($row = mysqli_fetch_array($qry_t, MYSQLI_ASSOC)) { 
    $total += $row['sub_total'];
}
?>

<h2>Konfirmasi Pelunasan</h2>

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
                <input type="text" value="<?= $rows['nama_pemilik'] ?>" readonly required />
            </td>
        </tr>
        <tr>
            <td>Total Pembelian</td>
            <td>:</td>
            <td>
                <input type="text" value="<?= $total ?>" required />
            </td>
        </tr>
        <tr>
            <td>Utang</td>
            <td>:</td>
            <td>
                <input type="text" name="inputang" id="inputang" value="<?= $rows['sisah_pembayaran'] ?>" required />
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
                <input type="text" name="inpsisahpembayaran" id="inpsisahpembayaran" value="<?= $rows['sisah_pembayaran'] ?>" readonly required />
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
            var sisah  = $('#inputang').val();
            if (parseInt(jumlah) < Math.abs(sisah) || jumlah == "") {
                $('#inpstatuspembayaran').val('Belum Lunas');
            } else {
                $('#inpstatuspembayaran').val('Lunas');
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

    $utangpembelian   = $_POST['inputang'];
    $jumlahpembayaran = $_POST['inpjumlahpembayaran'];
    $sisahpembayaran  = $_POST['inpsisahpembayaran'];

    if ($jumlahpembayaran > $utangpembelian) {
        echo "Mohon Maaf Jumlah Transfer yang Anda Masukkan Lebih dari Sisah Pembayaran : Rp. ".number_format($sisahpembayaran)."!";
    } else if ($jumlahpembayaran >= $utangpembelian) {

        $statuspembayaran = "lunas";
        $sumjumlahpembayaran = ($jumlahpembayaran + $rows['jumlah_pembayaran']);
        $sql = "UPDATE tb_retail_pemesanan SET status_pembayaran = '$statuspembayaran', jumlah_pembayaran = '$sumjumlahpembayaran', sisah_pembayaran = '0' WHERE kd_transaksi = '$kd'";
        $qry = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));
        if ($qry == true) {
            echo "<meta http-equiv='refresh' content='0; url=?open=Data-Transaksi-Keluar'>";
        }

    } else {

        $statuspembayaran = "belum_lunas";
        $sumjumlahpembayaran = ($jumlahpembayaran + $rows['jumlah_pembayaran']);
        $sql = "UPDATE tb_retail_pemesanan SET status_pembayaran = '$statuspembayaran', jumlah_pembayaran = '$sumjumlahpembayaran', sisah_pembayaran = '$sisahpembayaran' WHERE kd_transaksi = '$kd'";
        $qry = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));
        if ($qry == true) {
            echo "<meta http-equiv='refresh' content='0; url=?open=Data-Transaksi-Keluar'>";
        }

    }
}
?>