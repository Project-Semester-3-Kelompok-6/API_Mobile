<?php
require_once 'koneksi.php';

if ($con) {
    if (!empty($_POST['KaryawanID']) && !empty($_POST['Tanggal']) && !empty($_POST['Status']) && !empty($_POST['Lokasi']) && !empty($_POST['image'])) {
        
        $KaryawanID = $_POST['KaryawanID'];
        $Tanggal = $_POST['Tanggal'];
        $Status = $_POST['Status'];
        $Lokasi = $_POST['Lokasi'];
        
        $path = 'images/' . date("d-m-y") . '-' . time() . '-' . rand(10000, 10000) . '.jpg';
        if (file_put_contents($path, base64_decode($_POST['image']))) {
            $sql = "INSERT INTO absensi (KaryawanID, Tanggal, Status, Lokasi, BuktiFoto) VALUES ('$KaryawanID', '$Tanggal', '$Status', '$Lokasi', '$path')";
            if (mysqli_query($con, $sql)) {
                echo 'success';
            } else {
                echo 'Failed to insert to Database';
            }
        } else {
            echo 'Failed to upload image';
        }
    } else {
        echo 'Incomplete data received';
    }
} else {
    echo "Database connection failed";
}
?>
