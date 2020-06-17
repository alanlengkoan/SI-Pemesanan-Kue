<?php
$kdpelanggan = $_SESSION['SES_PELANGGAN'];
$sql_1 = "SELECT * FROM tb_retail WHERE id_retail = '$kdpelanggan'";
$qry_1 = mysqli_query($mysqli, $sql_1) or die ("MySQL Salah! ".mysql_error());
$rows  = mysqli_fetch_array($qry_1, MYSQLI_ASSOC);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Riolo Traditional Taste</title>
</head>

<body bgcolor="#FFCCFF" background="../assets/images/background.png">
        
    <h2>Ubah Profil Retail</h2>

    <form method="post" enctype="multipart/form-data">
        <table style="margin-bottom: 50px;" bgcolor="#FFCCFF">
            <tr>
                <td width="150">Nama Pemilik</td>
                <td width="10">:</td>
                <td width="150">
                    <input type="text" name="inpnamapemilik" value="<?= $rows['nama_pemilik'] ?>" />
                </td>
                <td rowspan="6">
                    <img src="<?= ($rows['foto_ktp'] == null) ? '../assets/images/retail.png' : '../img-retail/'.$rows['foto_ktp'] ?>" title="<?= $rows['nama_pemilik'] ?>" width="200" height="200" />
                    <br /><br />
                    <input type="file" name="inpfotoktp" id="inpfotoktp" disabled="disabled" />
                    <input type="checkbox" name="inpubahfotoktp" id="inpubahfotoktp" value="centang" /> Centang jika ingin mengubah gambar!
                    
                    <hr />
                    
                    <img src="<?= ($rows['foto'] == null) ? '../assets/images/retail.png' : '../img-retail/'.$rows['foto'] ?>" title="<?= $rows['nama_toko'] ?>" width="200" height="200" />
                    <br /><br />
                    <input type="file" name="inpfototko" id="inpfototko" disabled="disabled" />
                    <input type="checkbox" name="inpubahfototko" id="inpubahfototko" value="centang" /> Centang jika ingin mengubah gambar!
                </td>
            </tr>
            <tr>
                <td>Nama Toko</td>
                <td>:</td>
                <td>
                    <input type="text" name="inpnamatoko" value="<?= $rows['nama_toko'] ?>" />
                </td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>
                    <input type="date" name="inptgllhrpemilik" value="<?= $rows['tgl_lahir'] ?>" />
                </td>
            </tr>
            <tr>
                <td>No. Hp / Telepon</td>
                <td>:</td>
                <td>
                    <input type="text" name="inpnomor" value="<?= $rows['nomor'] ?>" />
                </td>
            </tr>
            <tr>
                <td>Fax</td>
                <td>:</td>
                <td>
                    <input type="text" name="inpfax" value="<?= $rows['fax'] ?>" />
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>
                    <input type="text" name="inpemail" value="<?= $rows['email'] ?>" />
                </td>
            </tr>
            <tr>
                <td>Website</td>
                <td>:</td>
                <td>
                    <input type="text" name="inpwebsite" value="<?= $rows['website'] ?>" />
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>
                    <textarea name="inpalamat" cols="21" rows="5"><?= $rows['alamat'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td>    
                    <input type="submit" name="ubah" value="Ubah" />
                </td>
            </tr>
        </table>
    </form>

    <!-- jquery -->
    <script src="../../assets/js/jquery-3.2.1.min.js"></script>

    <script>
        var untukUbahFotoKtp = function () {
            $('#inpubahfotoktp').on('click', function() {
                var value = $('input[name="inpubahfotoktp"]:checked').val();            
                if (value == 'centang') {
                    $('#inpfotoktp').removeAttr('disabled');
                    $('#inpfotoktp').attr('required', 'required');
                } else {
                    $('#inpfotoktp').removeAttr('required');
                    $('#inpfotoktp').attr('disabled', 'disabled');
                }
            });
        }();

        var untukUbahFoto = function () {
            $('#inpubahfototko').on('click', function() {
                var value = $('input[name="inpubahfototko"]:checked').val();            
                if (value == 'centang') {
                    $('#inpfototko').removeAttr('disabled');
                    $('#inpfototko').attr('required', 'required');
                } else {
                    $('#inpfototko').removeAttr('required');
                    $('#inpfototko').attr('disabled', 'disabled');
                }
            });
        }();

        // eksekusi jquery
        jQuery(document).ready(function () {
            untukUbahFotoKtp;
            untukUbahFoto;
        });
    </script>

</body>

</html>

<?php 
if (isset($_POST['ubah'])) {
    
    $nmapemilik = $_POST['inpnamapemilik'];
    $nmatoko    = $_POST['inpnamatoko'];
    $tgllhr     = $_POST['inptgllhrpemilik'];

    $nomor      = $_POST['inpnomor'];
    $fax        = $_POST['inpfax'];
    $email      = $_POST['inpemail'];
    $www        = $_POST['inpwebsite'];
    $alamat     = $_POST['inpalamat'];

    if (isset($_POST['inpubahfotoktp']) || isset($_POST['inpubahfototko'])) {

        // mengecek apa saja foto yang akan diubah
        if (isset($_POST['inpubahfotoktp']) && isset($_POST['inpubahfototko'])) {

            // untuk foto ktp
            $nmafotoktp = $_FILES['inpfotoktp']['name'];
            $tmpfotoktp = $_FILES['inpfotoktp']['tmp_name'];
            $szefotoktp = $_FILES['inpfotoktp']['size'];
            $errfotoktp = $_FILES['inpfotoktp']['error'];

            // untuk foto toko
            $nmafototko = $_FILES['inpfototko']['name'];
            $tmpfototko = $_FILES['inpfototko']['tmp_name'];
            $szefototko = $_FILES['inpfototko']['size'];
            $errfototko = $_FILES['inpfototko']['error'];

            // untuk format foto
            $frmfoto = array('jpeg', 'jpg', 'png');
            // untuk ukuran foto
            $ukrfoto = 10 * 1024 * 1024;

            if ($errfotoktp == 0 || $errfototko == 0) {
                if ($szefotoktp > $ukrfoto || $szefototko > $ukrfoto) {
                    echo "<script>alert('Ukuran foto terlalu besar!')</script>";
                    exit;
                } else if (!in_array(pathinfo($nmafotoktp, PATHINFO_EXTENSION), $frmfoto) || !in_array(pathinfo($nmafototko, PATHINFO_EXTENSION), $frmfoto)) {
                    echo "<script>alert('Ekstensi foto harus jpeg, jpg, png!')</script>";
                    exit;
                } else if (file_exists("../img-retail/".$nmafotoktp) || file_exists("../img-retail/".$nmafototko)) {
                    echo "<script>alert('Nama foto sudah ada!')</script>";
                    exit;
                } else {

                    $sql_2 = "UPDATE tb_retail SET nama_pemilik = '$nmapemilik', nama_toko = '$nmatoko', tgl_lahir = '$tgllhr', foto_ktp = '$nmafotoktp', foto = '$nmafototko', nomor = '$nomor', fax = '$fax', email = '$email', website = '$www', alamat = '$alamat' WHERE id_retail = '$kdpelanggan'";;
                    $qry_2 = mysqli_query($mysqli, $sql_2) or die ("MySQL Salah! ".mysqli_error($mysqli));

                    if ($qry_2 == true) {
                        // untuk mengambil foto lama
                        $fotolamakto = $rows['foto_ktp'];
                        $fotolamatko = $rows['foto'];
                        // menghapus foto yg tersimpan dalam file dan akan diganti
                        unlink("../img-retail/".$fotolamakto);
                        unlink("../img-retail/".$fotolamatko);
                        // mengupload gambar baru
                        move_uploaded_file($tmpfotoktp, "../img-retail/".$nmafotoktp);
                        move_uploaded_file($tmpfototko, "../img-retail/".$nmafototko);

                        echo "<script>alert('Berhasil!')</script>";
                        echo "<script>document.location.href='?open=Profil-Retail';</script>";
                    } else {
                        echo "<script>alert('Gagal!')</script>";
                        echo "<script>document.location.href='?open=Profil-Retail';</script>";
                    }

                }
            }
            exit;

        } else if (isset($_POST['inpubahfotoktp'])) {
            
            // untuk foto ktp
            $nmafoto = $_FILES['inpfotoktp']['name'];
            $tmpfoto = $_FILES['inpfotoktp']['tmp_name'];
            $szefoto = $_FILES['inpfotoktp']['size'];
            $errfoto = $_FILES['inpfotoktp']['error'];

            $fotolama = $rows['foto_ktp'];
            $sql_u = "UPDATE tb_retail SET nama_pemilik = '$nmapemilik', nama_toko = '$nmatoko', tgl_lahir = '$tgllhr', foto_ktp = '$nmafoto', nomor = '$nomor', fax = '$fax', email = '$email', website = '$www', alamat = '$alamat' WHERE id_retail = '$kdpelanggan'";

        } else if (isset($_POST['inpubahfototko'])) {
            
            // untuk foto toko
            $nmafoto = $_FILES['inpfototko']['name'];
            $tmpfoto = $_FILES['inpfototko']['tmp_name'];
            $szefoto = $_FILES['inpfototko']['size'];
            $errfoto = $_FILES['inpfototko']['error'];

            $fotolama = $rows['foto'];
            $sql_u = "UPDATE tb_retail SET nama_pemilik = '$nmapemilik', nama_toko = '$nmatoko', tgl_lahir = '$tgllhr', foto = '$nmafoto', nomor = '$nomor', fax = '$fax', email = '$email', website = '$www', alamat = '$alamat' WHERE id_retail = '$kdpelanggan'";

        }

        // untuk format foto
        $frmfoto = array('jpeg', 'jpg', 'png');
        // untuk ukuran foto
        $ukrfoto = 10 * 1024 * 1024;
        if ($errfoto == 0) {
            if ($szefoto > $ukrfoto) {
                echo "<script>alert('Ukuran foto terlalu besar!')</script>";
                exit;
            } else if (!in_array(pathinfo($nmafoto, PATHINFO_EXTENSION), $frmfoto)) {
                echo "<script>alert('Ekstensi foto harus jpeg, jpg, png!')</script>";
                exit;
            } else if (file_exists("../img-retail/".$nmafoto)) {
                echo "<script>alert('Nama foto sudah ada!')</script>";
                exit;
            } else {

                $sql_2 = $sql_u;
                $qry_2 = mysqli_query($mysqli, $sql_2) or die ("MySQL Salah! ".mysqli_error($mysqli));

                if ($qry_2 == true) {
                    // untuk mengambil foto lama
                    $nmafotolama = $fotolama;
                    // menghapus foto yg tersimpan dalam file dan akan diganti
                    unlink("../img-retail/".$nmafotolama);
                    // mengupload gambar baru
                    move_uploaded_file($tmpfoto, "../img-retail/".$nmafoto);

                    echo "<script>alert('Berhasil!')</script>";
                    echo "<script>document.location.href='?open=Profil-Retail';</script>";
                } else {
                    echo "<script>alert('Gagal!')</script>";
                    echo "<script>document.location.href='?open=Profil-Retail';</script>";
                }

            }
        }

    } else {

        // foto tidak diubah
        $sql_3 = "UPDATE tb_retail SET nama_pemilik = '$nmapemilik', nama_toko = '$nmatoko', tgl_lahir = '$tgllhr', nomor = '$nomor', fax = '$fax', email = '$email', website = '$www', alamat = '$alamat' WHERE id_retail = '$kdpelanggan'";
        $qry_3 = mysqli_query($mysqli, $sql_3) or die ("MySQL Salah! ".mysqli_error($mysqli));

        if ($qry_3 == true) {
            echo "<script>alert('Berhasil!')</script>";
            echo "<script>document.location.href='?open=Profil-Retail';</script>";
        } else {
            echo "<script>alert('Gagal!')</script>";
            echo "<script>document.location.href='?open=Profil-Retail';</script>";
        }
        
    }
    
}
?>