<?php
session_start();
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";
?>
<html>

<head>
  <title>Riolo Desert</title>
  <meta name="robots" content="index, follow">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  <link href="../assets/style/styles_user.css" rel="stylesheet" type="text/css">
  <link href="../assets/style/button.css" rel="stylesheet" type="text/css">

  <style type="text/css">
    body {
      background-color: #FF6666;
      background-image: url(../assets/images/background.png);
    }

    .butpink {
      background-color: rgb(255, 204, 204);
      border-radius: 10px;
      font-family: auto;
    }

    .butpink:hover {
      background-color: rgb(255, 0, 102);
      cursor: pointer;
      font-family: fantasy;
    }

    .gm:hover {
      box-shadow: 2px;
    }
  </style>
</head>

<body topmargin="3">
  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFCC" class="border">
    <tr bgcolor="#FFFFFF">
      <td height="24" align="right" bgcolor="#F5F5F5"><?php include "inc.login_status.php"; ?></td>
    </tr>
    <tr>
      <td height="43" bgcolor="#FFFFFF"><a href="?open=Home"><img src="../assets/images/unnamed.png" alt="TOKO KUE ONLINE" width="800" height="200" border="0"></a></td>
    </tr>
  </table>
  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="header">
      <td width="261" height="25" valign="middle" bgcolor="#F5F5F5"> </td>
      <td width="98" align="center" bgcolor="#F5F5F5"><a href="?open=Home" target="_self">
          <font color="#FF0066"><b>HOME</b></font>
        </a></td>
      <td width="98" align="center" bgcolor="#F5F5F5"><a href="?open=Profil" target="_self">
          <font color="#FF0066"><b>PROFIL</b></font>
        </a></td>
      <td width="140" align="center" bgcolor="#F5F5F5"><a href="?open=Barang" target="_self">
          <font color="#FF0066"><b>KOLEKSI KUE</b></font>
        </a></td>
      <td width="101" align="center" bgcolor="#F5F5F5"><a href="?open=Panduan" target="_self">
          <font color="#FF0066"><b>PANDUAN</b></font>
        </a></td>
    </tr>
  </table>
  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="22" colspan="3" align="right" bgcolor="#FFCCCC" class="head">
        <form action="?open=Barang-Pencarian" method="post" name="form1">
          <strong>
            <font color="#FF0066">Cari Barang</font>
          </strong>
          <input name="txtKeyword" type="text" size="30" maxlength="100">
          <input type="submit" name="btnCari" value=" Cari ">
        </form>
      </td>
    </tr>
    <tr>
      <td width="182" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="5" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="611" align="right" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>

      <td align="center" valign="top" bgcolor="#FFFFFF" class="utama"><?php include "login.php"; ?>
        <table width="100%" border="0" cellpadding="2" cellspacing="0">

          <tr align="center">
            <td width="167" height="22" bgcolor="#FFCCCC" class="head">
              <font color="#FF0066"><b>KATEGORI</b></font>
            </td>
          </tr>
          <?php
          $mySql = "SELECT * FROM kategori ORDER BY nm_kategori";
          $myQry = mysqli_query($mysqli, $mySql);
          while($myData = mysqli_fetch_array($myQry, MYSQLI_ASSOC)) { ?>
          <tr>
            <td>
              <b> <img src="../assets/images/ikon.png" width="9" height="9"> <a
                  href="?open=Barang-Kategori&Kode=<?=$myData['kd_kategori']?>"> <?=$myData['nm_kategori']?> </a> </b>
            </td>
          </tr>
          <?php } ?>

        </table>
      </td>

      <td>&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFFF" class="utama">
        <?php include "buka_file.php"; ?>
      </td>
    </tr>
    <tr>
      <td height="4">&nbsp;</td>
      <td height="4">&nbsp;</td>
      <td height="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#F5F5F5" class="FOOT">&nbsp;</td>
    </tr>
  </table>
</body>

</html>