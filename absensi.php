<?php
include "koneksi.php";
if($koneksi) {
    if(isset($_POST['KaryawanID']) && isset($_POST['Tanggal']) && isset($_POST['Lokasi']) && isset($_POST['BuktiFoto'])) {
        $KaryawanID = $_POST['KaryawanID'];
        $Tanggal = $_POST['Tanggal'];
        $Lokasi = $_POST['Lokasi'];

        // Mendapatkan gambar dalam bentuk base64
        $image_base64 = $_POST['BuktiFoto'];

        // Menyimpan gambar ke folder server
        $path = 'images/'.date("d-m-y").'-'.time().'-'.rand(10000, 10000). '.jpg';
        if(file_put_contents($path, base64_decode($image_base64))) {
            $sql = "INSERT INTO data_karyawan (KaryawanID, Tanggal, Lokasi, BuktiFoto) VALUES ('$KaryawanID', '$Tanggal', '$Lokasi', '$path')";
            if(mysqli_query($koneksi, $sql)) {
                echo 'success';
            } else {
                echo 'Failed to insert to Database';
            }
        } else {
            echo 'Failed to upload image';
        }
    } else {
        echo 'Incomplete data';
    }
} else {
    echo "Database connection failed";
}
?>
