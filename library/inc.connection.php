<?php
$my['host']	= "localhost";
$my['user']	= "my_root";
$my['pass']	= "my_pass";
$my['dbs']	= "si_pemesanankue";

$mysqli = mysqli_connect($my['host'], $my['user'], $my['pass'], $my['dbs']);

if ($mysqli->connect_errno) {
    die('Failed Connection !' . $mysqli->connect_errno);
}