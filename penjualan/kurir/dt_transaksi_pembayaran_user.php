<?php 
// untuk cek session
include_once "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kurir</title>

    <link href="../assets/kurir/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/kurir/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../assets/kurir/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../assets/kurir/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Sistem Informasi Pengantaran Kurir</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="dt_transaksi.php"><i class="fa fa-money fa-fw"></i> Data Transaksi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Konfirmasi Pembayaran</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Pemesanan
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
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
                                    $kd = $_GET['Kode'];
                                    $no = 1;
                                    $total = 0;
                                    $kirim = 0;

                                    $sql_i = "SELECT pemesanan_item.kd_barang, kategori.nm_kategori, barang.nm_barang, pemesanan_item.jumlah, barang.harga_jual, ( pemesanan_item.harga * pemesanan_item.jumlah ) AS sub_total, provinsi.biaya_kirim FROM pemesanan LEFT JOIN pemesanan_item ON pemesanan.no_pemesanan = pemesanan_item.no_pemesanan LEFT JOIN barang ON pemesanan_item.kd_barang = barang.kd_barang LEFT JOIN kategori ON barang.kd_kategori = kategori.kd_kategori LEFT JOIN provinsi ON pemesanan.kd_provinsi = provinsi.kd_provinsi WHERE pemesanan.no_pemesanan = pemesanan_item.no_pemesanan AND pemesanan.no_pemesanan = '$kd' ORDER BY pemesanan_item.kd_barang";
                                    $qry_i = mysqli_query($mysqli, $sql_i) or die ("MySQL salah! ".mysqli_error($mysqli));
                                    ?>
                                    <?php while ($rows = mysqli_fetch_array($qry_i, MYSQLI_ASSOC)) : ?>
                                        <?php $total += $rows['sub_total'] + $rows['biaya_kirim']; ?>
                                        <?php $kirim = $rows['biaya_kirim'] ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $rows['kd_barang'] ?></td>
                                            <td><?= $rows['nm_kategori'] ?></td>
                                            <td><?= $rows['nm_barang'] ?></td>
                                            <td><?= $rows['jumlah'] ?></td>
                                            <td>Rp. <?= number_format($rows['harga_jual']) ?> </td>
                                            <td>Rp. <?= number_format($rows['sub_total']) ?> </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" align="center">
                                            <p style="margin: 0;">Total Biaya Kirim</p>
                                        </td>
                                        <td>Rp. <?= number_format($kirim) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" align="center">
                                            <p style="margin: 0;">Total</p>
                                        </td>
                                        <td>Rp. <?= number_format($total) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Pelanggan
                        </div>
                        <div class="panel-body">
                            <?php 
                            $sql_1 = "SELECT pemesanan.*, pelanggan.nm_pelanggan, provinsi.* FROM pemesanan, pelanggan, provinsi WHERE pemesanan.kd_pelanggan=pelanggan.kd_pelanggan AND pemesanan.kd_provinsi=provinsi.kd_provinsi AND pemesanan.no_pemesanan ='$kd'";
                            $qry_1 = mysqli_query($mysqli, $sql_1) or die ("MySQL salah! ".mysqli_error($mysqli));
                            $row_1 = mysqli_fetch_array($qry_1, MYSQLI_ASSOC);
                            ?>
                            <form class="form-horizontal" method="post" role="form">
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">No Pemesanan</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $kd ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Tanggal</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= IndonesiaTgl($row_1['tgl_pemesanan']) ?>" readonly="readonly" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Kode Pelanggan</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row_1['kd_pelanggan'] ?>" readonly="readonly" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Nama Pelanggan</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row_1['nm_pelanggan'] ?>" readonly="readonly" required="required" />
                                    </div>
                                </div>
                                
                                <hr />

                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Nama Penerima</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row_1['nama_penerima'] ?>" readonly="readonly" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Alamat Penerima</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row_1['alamat_lengkap'] ?>" readonly="readonly" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Kecamatan</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row_1['nm_provinsi'] ?>" readonly="readonly" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">No, Telepon</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row_1['no_telepon'] ?>" readonly="readonly" required="required" />
                                    </div>
                                </div>

                                <hr />

                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Biaya Pengiriman</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $kirim ?>" readonly="readonly" required="required" />
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Total Pembelian</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" name="inptotalpembelian" id="inptotalpembelian" class="form-control" value="<?= $total ?>" readonly="readonly" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Jumlah Pembayaran</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" name="inpjumlahpembayaran" id="inpjumlahpembayaran" class="form-control" value="0" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Sisah Pembayaran</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" name="inpsisahpembayaran" id="inpsisahpembayaran" class="form-control" value="0" readonly="readonly" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Status</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" id="inpstatuspembayaran" class="form-control" value="Belum Lunas" readonly="readonly" required="required" />
                                    </div>
                                </div>
                                <a href="dt_transaksi.php" class="btn btn-danger">Batal</a>
                                <input type="submit" name="bayar" class="btn btn-success" value="Bayar" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="../assets/kurir/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/kurir/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/kurir/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../assets/kurir/dist/js/sb-admin-2.js"></script>

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

</body>

</html>

<?php 
if (isset($_POST['bayar'])) {

    $totalpembelian   = $_POST['inptotalpembelian'];
    $jumlahpembayaran = $_POST['inpjumlahpembayaran'];
    $sisahpembyarana  = $_POST['inpsisahpembayaran'];

    if ($jumlahpembayaran > $totalpembelian) {
        echo "<script>alert('Mohon Maaf Jumlah Uang yang Anda Masukkan Lebih dari Total : Rp. ".number_format($totalpembelian)." !')</script>";
    } else if ($jumlahpembayaran >= $totalpembelian) {

        $statuspembayaran = "Lunas";
        $sql = "UPDATE pemesanan SET status_bayar = '$statuspembayaran' WHERE no_pemesanan = '$kd'";
        $qry = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));
        if ($qry == true) {
            echo "<script>document.location.href = 'dt_transaksi.php';</script>";
        }

    } else {
        echo "<script>alert('Mohon Maaf Jumlah Uang yang Anda Masukkan Kurang dari Total : Rp. ".number_format($totalpembelian)." !')</script>";
    }
}
?>