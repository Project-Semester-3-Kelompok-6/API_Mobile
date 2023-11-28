<?php
$hostName = "localhost";
$userName = "root";
$password = "";
$dbName = "wm_hanaasri";

$con = mysqli_connect($hostName, $userName, $password, $dbName);

if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
