<?php
session_start();
include_once "../../library/inc.connection.php";
include_once "../../library/inc.library.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Riolo Desert</title>
  <link href="../assets/style/button.css" rel="stylesheet" type="text/css">
  <link href="../assets/style/style_admin.css" rel="stylesheet" type="text/css">
  <link href="../assets/plugins/tigra_calendar/tcal.css" rel="stylesheet" type="text/css" />

  <script src="../assets/plugins/tigra_calendar/tcal.js" type="text/javascript"></script>
  <script src="../assets/plugins/tinymce/tinymce.min.js" language="javascript" type="text/javascript"></script>

  <script type="text/javascript">
    tinymce.init({
      selector: "textarea"
    });
  </script>
  <style type="text/css">
    a {
      text-decoration: none;
    }
  </style>
</head>
<div id="wrap">

  <body>
    <table width="100%" class="table-main">
      <tr>
        <td height="103" colspan="2" align="center"><a href="?open"><img src="../assets/images/unnamed.png" width="1000"
              height="200"></a></td>
      </tr>
      <tr valign="top">
        <td width="15%" style="border-right:5px solid #DDDDDD;">
          <div style="margin:5px; padding:5px;"><?php include "menu.php";?></div>
        </td>
        <td width="69%" height="550">
          <div style="margin:5px; padding:5px;"><?php include "buka_file.php";?></div>
        </td>
      </tr>
    </table>
  </body>
</div>

</html>