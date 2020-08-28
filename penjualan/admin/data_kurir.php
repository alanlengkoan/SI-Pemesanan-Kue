<?php
include_once "../../library/inc.sesadmin.php";
?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
    <tr>
        <td colspan="2" align="right">
            <h1>
                <font color="#FF0066">DATA KURIR</font>
            </h1>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="2">
            <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    <th>Username</th>
                </tr>
                <?php
                $nomor = 1;
                $mySql = "SELECT * FROM tb_kurir";
                $myQry = mysqli_query($mysqli, $mySql)  or die ("Query salah : ".mysqli_error($mysqli));
                ?>

                <?php if(mysqli_num_rows($myQry) > 0): ?>
                    <?php while ($myData = mysqli_fetch_array($myQry)) : ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $myData['nama'] ?></td>
                        <td><?= ($myData['kelamin'] != 'P') ? 'Laki - laki' : 'Perempuan' ?></td>
                        <td><?= $myData['email'] ?></td>
                        <td><?= $myData['nohp'] ?></td>
                        <td><?= $myData['username'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" align="center"><b>Data Kurir tidak ada !</b></td>
                    </tr>
                <?php endif; ?>
                
            </table>
        </td>
    </tr>
</table>