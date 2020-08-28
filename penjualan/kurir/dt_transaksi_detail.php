<?php 
// untuk cek session
include_once "session.php";
// memanggil data
$kd  = $_GET['Kode'];
$sql = "SELECT tb_retail_pemesanan.kd_transaksi, tb_retail.nama_pemilik, tb_retail.nomor, tb_retail.fax, tb_retail.email, tb_retail.website, tb_retail.alamat, kategori.nm_kategori, barang.nm_barang, tb_retail_transaksi.kd_barang, tb_retail_transaksi.jumlah, tb_retail_transaksi.harga, tb_retail_transaksi.sub_total FROM tb_retail_pemesanan INNER JOIN tb_retail_transaksi ON tb_retail_pemesanan.kd_transaksi = tb_retail_transaksi.kd_transaksi INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail INNER JOIN barang ON tb_retail_transaksi.kd_barang = barang.kd_barang INNER JOIN kategori ON barang.kd_kategori = kategori.kd_kategori WHERE tb_retail_pemesanan.kd_transaksi = '$kd'";
$qry = mysqli_query($mysqli, $sql) or die ("MySQL salah! ".mysqli_error($mysqli));
$row = mysqli_fetch_array($qry, MYSQLI_ASSOC);
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
                    <h1 class="page-header">Detail Pembayaran</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Pesanan
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">ID Order</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row['kd_transaksi'] ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Nama Pemilik</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row['nama_pemilik'] ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Nomor</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row['nomor'] ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Fax</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row['fax'] ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Email</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row['email'] ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Website</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $row['website'] ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Alamat</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <textarea class="form-control" readonly="readonly"><?= $row['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Pembayaran
                        </div>
                        <div class="panel-body">

                            <?php 
                            $sql_p = "SELECT * FROM tb_retail_pemesanan WHERE kd_transaksi = '$kd'";
                            $qry_p = mysqli_query($mysqli, $sql_p) or die ("MySQL salah! ".mysqli_error($mysqli));
                            $rows  = mysqli_fetch_array($qry_p, MYSQLI_ASSOC);
                            ?>

                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Status Pengiriman</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= $rows['status_pengiriman'] ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Status Pembayaran</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="<?= ($rows['status_pembayaran'] != 'lunas') ? 'Belum Lunas' : 'Lunas' ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Jumlah Pembayaran</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="Rp. <?= number_format($rows['jumlah_pembayaran']) ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-sm-2 col-lg-2 control-label">Sisah Pembayaran</label>
                                    <div class="col-xs-10 col-sm-10 col-lg-10">
                                        <input type="text" class="form-control" value="Rp. <?= number_format($rows['sisah_pembayaran']) ?>" readonly="readonly" />
                                    </div>
                                </div>
                            </form>

                            <hr />

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
                                    $no = 1;

                                    $sql_i = "SELECT tb_retail_pemesanan.kd_transaksi, tb_retail.nama_pemilik, tb_retail.nomor, tb_retail.fax, tb_retail.email, tb_retail.website, tb_retail.alamat, kategori.nm_kategori, barang.nm_barang, tb_retail_transaksi.kd_barang, tb_retail_transaksi.jumlah, tb_retail_transaksi.harga, tb_retail_transaksi.sub_total FROM tb_retail_pemesanan INNER JOIN tb_retail_transaksi ON tb_retail_pemesanan.kd_transaksi = tb_retail_transaksi.kd_transaksi INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail INNER JOIN barang ON tb_retail_transaksi.kd_barang = barang.kd_barang INNER JOIN kategori ON barang.kd_kategori = kategori.kd_kategori WHERE tb_retail_pemesanan.kd_transaksi = '$kd'";
                                    $qry_i = mysqli_query($mysqli, $sql_i) or die ("MySQL salah! ".mysqli_error($mysqli));

                                    $sql_p = "SELECT * FROM tb_retail_pemesanan WHERE kd_transaksi = '$kd'";
                                    $qry_p = mysqli_query($mysqli, $sql_p) or die ("MySQL salah! ".mysqli_error($mysqli));
                                    $datas = mysqli_fetch_array($qry_p, MYSQLI_ASSOC);
                                    ?>
                                    <?php while ($rows = mysqli_fetch_array($qry_i, MYSQLI_ASSOC)) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $rows['kd_barang'] ?></td>
                                            <td><?= $rows['nm_kategori'] ?></td>
                                            <td><?= $rows['nm_barang'] ?></td>
                                            <td><?= $rows['jumlah'] ?></td>
                                            <td>Rp. <?= number_format($rows['harga']) ?> </td>
                                            <td>Rp. <?= number_format($rows['sub_total']) ?> </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" align="center">
                                            <p style="margin: 0;">Total</p>
                                        </td>
                                        <td>Rp. <?= number_format($datas['total']) ?></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <a href="dt_transaksi.php" class="btn btn-primary">Kembali</a>&nbsp;
                            <a href="dt_transaksi_cetak.php?kode=<?= $kd ?>" class="btn btn-success" target="_blank">Cetak</a>
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

</body>

</html>