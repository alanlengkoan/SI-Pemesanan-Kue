<?php
// Validasi : Halaman ini hanya untuk yang sudah login
include_once "../../library/inc.sesadmin.php";
// untuk membuat kode otomatis
$kodeoto = buatKode("tb_retail", "R", $mysqli);
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" target="_self">
    <table class="table-list" width="100%" style="margin-top:0px;">
        <tr>
            <th colspan="3">TAMBAH DATA RETAIL</th>
        </tr>
        <tr>
            <td width="18%"><strong>ID Retail</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%">
                <input type="text" name="inpidretail" value="<?php echo $kodeoto; ?>" size="10" maxlength="10" readonly="readonly" />
            </td>
        </tr>
        <tr>
            <td width="18%"><strong>Nama</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%">
                <input type="text" name="inpnama" size="25" placeholder="Masukkan Nama Retail" required />
            </td>
        </tr>
        <tr>
            <td width="18%"><strong>No. Hp / Telepon</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%">
                <input type="text" name="inpnohp" size="25" placeholder="Masukkan Nomor Hp / Telepon" required />
            </td>
        </tr>
        <tr>
            <td width="18%"><strong>Fax</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%">
                <input type="text" name="inpfax" size="25" placeholder="Masukkan Nomor Fax" required />
            </td>
        </tr>
        <tr>
            <td width="18%"><strong>Email</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%">
                <input type="email" name="inpemail" size="25" placeholder="Masukkan Email" required />
            </td>
        </tr>
        <tr>
            <td width="18%"><strong>Website</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%">
                <input type="text" name="inpwebsite" size="25" placeholder="Masukkan Website" required />
            </td>
        </tr>
        <tr>
            <td width="18%"><strong>Alamat</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%">
                <input type="text" name="inpalamat" size="25" placeholder="Masukkan Alamat" required />
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
        </tr>
    </table>
</form>

<?php 
# MEMBACA TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	
    $idretail = str_replace("'", "&acute;", $_POST['inpidretail']);
    $nama     = str_replace("'", "&acute;", $_POST['inpnama']);
    $nohp     = str_replace("'", "&acute;", $_POST['inpnohp']);
    $fax      = str_replace("'", "&acute;", $_POST['inpfax']);
    $email    = str_replace("'", "&acute;", $_POST['inpemail']);
    $url      = str_replace("'", "&acute;", $_POST['inpwebsite']);
    $alamat   = str_replace("'", "&acute;", $_POST['inpalamat']);

    $mySql = "INSERT INTO tb_retail (id_retail, nama, nomor, fax, email, website, alamat) VALUES ('$idretail', '$nama', '$nohp', '$fax', '$email', '$url', '$alamat')";
    $myQry = mysqli_query($mysqli, $mySql) or die ("Query salah : ".mysqli_error($mysqli));

    if($myQry == true) {
        echo "<script>alert('Berhasil!')</script>";
        echo "<meta http-equiv='refresh' content='0; url=?open=Data-Retail'>";
    }
    
}

?>