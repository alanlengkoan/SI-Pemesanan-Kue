<?php
include_once "../../library/inc.sesadmin.php";
?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
    <tr>
        <td colspan="2" align="right">
            <h1>
                <font color="#FF0066">DATA RETAIL</font>
            </h1>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" align="right"><a href="?open=Data-Retail-Tambah" target="_self"><img src="../assets/images/btn_add_data.png" border="0" /></a></td>
    </tr>

    <tr>
        <td colspan="2">
            <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Nomor</th>
                    <th>Fax</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Alamat</th>
                    <th>Tanggal Daftar</th>
                    <th align="center">Tools</th>
                </tr>
                <?php
                $nomor = 1;
                $mySql = "SELECT * FROM tb_retail ORDER BY nama_toko ASC";
                $myQry = mysqli_query($mysqli, $mySql)  or die ("Query salah : ".mysqli_error($mysqli));
                ?>

                <?php if(mysqli_num_rows($myQry) > 0): ?>
                    <?php while ($myData = mysqli_fetch_array($myQry)) { ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $myData['nama_pemilik'] ?></td>
                        <td><?= $myData['nomor'] ?></td>
                        <td><?= $myData['fax'] ?></td>
                        <td><?= $myData['email'] ?></td>
                        <td><?= $myData['website'] ?></td>
                        <td><?= $myData['alamat'] ?></td>
                        <td><?= $myData['tgl_daftar'] ?></td>
                        <td width="100" align="center">
                            <a href="?open=Data-Retail-Edit&Kode=<?= $myData['id_retail'] ?>" target="_self" alt="Edit Data"><img src="../assets/images/b_edit.png" style="width: 30px; height: 30px;"></a>
                            <a href="?open=Data-Retail-Delete&Kode=<?= $myData['id_retail'] ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA KATEGORI INI ... ?')"><img src="../assets/images/b_drop.png" style="width: 30px; height: 30px;"></a>
                        </td>
                    </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" align="center"><b>Data Retail tidak ada !</b></td>
                    </tr>
                <?php endif; ?>
                
            </table>
        </td>
    </tr>
</table>