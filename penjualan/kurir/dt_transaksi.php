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

    <!-- datatables -->
    <link href="../assets/kurir/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../assets/kurir/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

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
                    <h1 class="page-header">Data Transaksi</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Transaksi Pembelian
                        </div>
                        <div class="panel-body">

                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#user" data-toggle="tab">Transaksi User</a>
                                </li>
                                <li>
                                    <a href="#retail" data-toggle="tab">Transaksi Retail</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="user">
                                    <h4>Data Transaksi User</h4>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="data-transaksi-user">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Transaksi</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Total Beli (Rp)</th>
                                                <th>Status Pembayaran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            $sql_1 = "SELECT pemesanan.*, provinsi.nm_provinsi, provinsi.biaya_kirim, SUM( pemesanan_item.harga * pemesanan_item.jumlah ) AS total_bayar, SUM( pemesanan_item.jumlah ) AS total_barang FROM pemesanan INNER JOIN provinsi ON pemesanan.kd_provinsi = provinsi.kd_provinsi INNER JOIN pemesanan_item ON pemesanan.no_pemesanan = pemesanan_item.no_pemesanan WHERE metode_pembayaran = 'cod' GROUP BY no_pemesanan";
                                            $qry_1 = mysqli_query($mysqli, $sql_1) or die("MySQL salah !".mysqli_erro($mysqli));
                                            ?>
                                            <?php while ($row_1 = mysqli_fetch_array($qry_1, MYSQLI_ASSOC)) : ?>
                                                <?php $totalbayar = $row_1['total_bayar']; ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $row_1['no_pemesanan'] ?></td>
                                                    <td><?= $row_1['nama_penerima'] ?></td>
                                                    <td><?= IndonesiaTgl($row_1['tgl_pemesanan']) ?></td>
                                                    <td><?= format_angka($totalbayar); ?></td>
                                                    <td><?= $row_1['status_bayar'] ?></td>
                                                    <td align="center">
                                                        <?php if($row_1['status_bayar'] == "Pesan") { ?> 
                                                            <a href="dt_transaksi_pembayaran_user.php?Kode=<?php echo $row_1['no_pemesanan']; ?>" class="btn btn-default">Pembayaran</a>
                                                        <?php } else { ?> 
                                                            <a href="dt_transaksi_detail_user.php?Kode=<?php echo $row_1['no_pemesanan']; ?>" class="btn btn-default">Detail</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="retail">
                                    <h4>Data Transaksi Retail</h4>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="data-transaksi-retail">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Transaksi</th>
                                                <th>Nama Pemilik</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Total Beli (Rp)</th>
                                                <th>Status Pengiriman</th>
                                                <th>Status Pembayaran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            $sql_2 = "SELECT tb_retail_pemesanan.kd_transaksi, tb_retail.nama_pemilik, tb_retail_pemesanan.status_pengiriman, tb_retail_pemesanan.status_pembayaran, tb_retail_pemesanan.waktu, SUM( tb_retail_transaksi.sub_total ) AS sub_total FROM tb_retail_pemesanan INNER JOIN tb_retail_transaksi ON tb_retail_pemesanan.kd_transaksi = tb_retail_transaksi.kd_transaksi INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail WHERE metode_pembayaran = 'cod' GROUP BY tb_retail_pemesanan.id_pemesanan_retail";
                                            $qry_2 = mysqli_query($mysqli, $sql_2) or die("MySQL salah !".mysqli_erro($mysqli));
                                            ?>
                                            <?php while ($row_2 = mysqli_fetch_array($qry_2, MYSQLI_ASSOC)) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $row_2['kd_transaksi'] ?></td>
                                                    <td><?= $row_2['nama_pemilik'] ?></td>
                                                    <td><?= IndonesiaTgl($row_2['waktu']) ?></td>
                                                    <td><?= format_angka($row_2['sub_total']) ?></td>
                                                    <td><?= $row_2['status_pengiriman'] ?></td>
                                                    <td><?= ($row_2['status_pembayaran'] != 'lunas') ? 'Belum Lunas' : 'Lunas' ?></td>
                                                    <td align="center">
                                                        <?php if ($row_2['status_pembayaran'] == 'proses') { ?>
                                                            <a href="dt_transaksi_pembayaran.php?Kode=<?= $row_2['kd_transaksi'] ?>" class="btn btn-primary" alt="Edit Data">Pembayaran</a>
                                                        <?php } else if ($row_2['status_pembayaran'] == 'belum_lunas') { ?>
                                                            <a href="dt_transaksi_pelunasan.php?Kode=<?= $row_2['kd_transaksi'] ?>" class="btn btn-warning" alt="Edit Data">Pelunasan</a>
                                                        <?php } else { ?>
                                                            <a href="dt_transaksi_detail.php?Kode=<?= $row_2['kd_transaksi'] ?>" class="btn btn-default" alt="Edit Data">Detail</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>                                                
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

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

    <!-- datatables -->
    <script src="../assets/kurir/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/kurir/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../assets/kurir/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <script>
        $(document).ready(function() {
            $('#data-transaksi-user').DataTable({
                responsive: true
            });

            $('#data-transaksi-retail').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>