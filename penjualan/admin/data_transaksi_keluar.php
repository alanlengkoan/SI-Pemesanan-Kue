<?php
include_once "../../library/inc.sesadmin.php";
?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
    <tr>
        <td colspan="2" align="right">
            <h1>
                <font color="#FF0066">DATA TRANSAKSI KELUAR</font>
            </h1>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" align="right"><a href="?open=Data-Transaksi-Keluar-Add" target="_self"><img src="../assets/images/btn_add_data.png" border="0" /></a></td>
    </tr>

    <tr>
        <td colspan="2">
            <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Retail</th>
                    <th>Status Pengiriman</th>
                    <th>Waktu</th>
                    <th>Status Pembayaran</th>
                    <th align="center">Tools</th>
                </tr>
                <?php
                $nomor = 1;
                $mySql = "SELECT tb_retail_pemesanan.kd_transaksi, tb_retail.nama_pemilik, tb_retail_pemesanan.status_pengiriman, tb_retail_pemesanan.status_pembayaran, tb_retail_pemesanan.waktu, SUM( tb_retail_transaksi.sub_total ) AS sub_total FROM tb_retail_pemesanan INNER JOIN tb_retail_transaksi ON tb_retail_pemesanan.kd_transaksi = tb_retail_transaksi.kd_transaksi INNER JOIN tb_retail ON tb_retail_pemesanan.id_retail = tb_retail.id_retail GROUP BY tb_retail_pemesanan.id_pemesanan_retail";
                $myQry = mysqli_query($mysqli, $mySql)  or die ("Query salah : ".mysqli_error($mysqli));
                ?>
                <?php if(mysqli_num_rows($myQry) > 0): ?>
                    <?php while ($row = mysqli_fetch_array($myQry)) { ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $row['kd_transaksi'] ?></td>
                        <td><?= $row['nama_pemilik'] ?></td>
                        <td><?= $row['status_pengiriman'] ?></td>
                        <td><?= $row['waktu'] ?></td>
                        <td><?= ($row['status_pembayaran'] != 'lunas') ? 'Belum Lunas' : 'Lunas' ?></td>
                        <td width="100" align="center">
                            <?php if ($row['status_pembayaran'] == 'proses') { ?>
                                <a href="?open=Data-Transaksi-Keluar-Pembayaran&Kode=<?= $row['kd_transaksi'] ?>" target="_self" alt="Edit Data"><img src="../assets/images/payment.png" style="width: 30px; height: 30px;"></a>
                            <?php } else if ($row['status_pembayaran'] == 'belum_lunas') { ?>
                                <a href="?open=Data-Transaksi-Keluar-Pelunasan&Kode=<?= $row['kd_transaksi'] ?>" target="_self" alt="Edit Data"><img src="../assets/images/repayment.png" style="width: 30px; height: 30px;"></a>
                            <?php } else { ?>
                                <a href="?open=Data-Transaksi-Keluar-Detail&Kode=<?= $row['kd_transaksi'] ?>" target="_self" alt="Edit Data"><img src="../assets/images/detail.png" style="width: 30px; height: 30px;"></a>
                            <?php } ?>
                            <a href="?open=Data-Transaksi-Keluar-Delete&Kode=<?= $row['kd_transaksi'] ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA KATEGORI INI ... ?')"><img src="../assets/images/b_drop.png" style="width: 30px; height: 30px;"></a>
                        </td>
                    </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" align="center"><b>Data Transaksi Keluar tidak ada !</b></td>
                    </tr>
                <?php endif; ?>
                
            </table>
        </td>
    </tr>
</table>