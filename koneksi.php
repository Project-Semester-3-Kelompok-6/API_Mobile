<?php
$hostName = "localhost";
$userName = "root";
$password = "";
$dbName = "wm_hanaasri";

$koneksi = mysqli_connect($hostName, $userName, $password, $dbName);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
