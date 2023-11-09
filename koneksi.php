<?php

$hostName = "localhost";
$userName = "root";
$password = "";
$dbName = "wm_hanaasri";

$koneksi =  mysqli_connect($hostName, $userName, $password);

if(!$koneksi){
    echo "koneksi gagal";
}

/*
 * Encapsulate koneksi
class koneksi {
private $host = "localhost";
private $username = "root";
private $password = "";
private $dbname = "hanaasri";

public function getKoneksi() {
    try {
        $koneksi = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
        $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $koneksi;
} catch (PDOException $e) {
        die("Koneksi database gagal: " . $e->getMessage());
        }
    }
}
*/