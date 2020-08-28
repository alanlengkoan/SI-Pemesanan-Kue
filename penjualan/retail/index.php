<?php
session_start();
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";

function kirimNotifikasi($judul, $isi) {
    $pushisi = array(
        'en' => $isi
    );

    $pushjudul = array(
        'en' => $judul
    );

    $fields = array(
        'app_id' => "5ba62396-061d-4e07-8099-6cc17d88413a",
        'included_segments' => array(
            'All'
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'headings' => $pushjudul,
        'contents' => $pushisi,
    );
    
    $fields = json_encode($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MDMxZGFkN2EtNDA5Ny00NzE4LWJkNGMtMDA0MTQwZDAxM2Y5'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

function tanggalbulan($date) {
    $tgl = date('d', strtotime($date));
    $bln = date('m', strtotime($date));
    return $tgl."-".$bln;
}

$id_retail = (isset($_SESSION['SES_PELANGGAN'])) ? $_SESSION['SES_PELANGGAN'] : '' ;
$sql = "SELECT * FROM tb_retail WHERE id_retail = '$id_retail'";
$qry = mysqli_query($mysqli, $sql)  or die ("MySQL Salah!".mysqli_error($mysqli));
$row = mysqli_fetch_array($qry, MYSQLI_ASSOC);

// untuk mengecek tanggal lahir dan tanggal sekarang
if (tanggalbulan($row['tgl_lahir']) == tanggalbulan(date('Y-m-d'))) {

  $judul = "Selamat Ulang Tahun ".$row['nama_pemilik']."!";
  $isi   = "Apa kabar, kami akan memberikan Anda Cashback sebesar 30%!";
  // untuk mengirim pesan notifikasi
  $response = kirimNotifikasi($judul, $isi);
  // untuk mengecek
  if ($response) {
      // echo "terkirim!";
  } else {
      // echo "gagal!";
  }

} else {
  // echo "tidak sama";
}
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
      <td height="43" bgcolor="#FFFFFF"><a href="?open=Home"><img src="../assets/images/unnamed.png"
            alt="TOKO KUE ONLINE" width="800" height="200" border="0"></a></td>
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

<!-- jquery -->
<script src="../../assets/js/jquery-3.2.1.min.js"></script>
<!-- onesignal js cdn -->
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "5ba62396-061d-4e07-8099-6cc17d88413a",
    });
  });

  OneSignal.push(function () {
    var isPushSupported = OneSignal.isPushNotificationsSupported();
    if (isPushSupported) {

      console.log('berhasil');

      OneSignal.isPushNotificationsEnabled(function (isEnabled) {

        if (isEnabled) {
          console.log("Push notifications are enabled!");
          // mengambil id user
          OneSignal.getUserId(function (userId) {
            console.log("OneSignal User ID:", userId);
          });

        } else {
          console.log("Push notifications are not enabled yet.");
          OneSignal.push(function () {
            OneSignal.showSlidedownPrompt();
          });
        }

      });

    } else {
      console.log('gagal');
    }
  });
</script>

</html>