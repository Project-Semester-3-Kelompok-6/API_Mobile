<?php
require_once 'koneksi.php';

// Pastikan request yang diterima adalah metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['namaSesi'];
    $deskripsi = $_POST['deskripsi'];
    $awal = $_POST['awalSesi'];
    $akhir = $_POST['akhirSesi'];

    // Query untuk menambahkan data ke dalam tabel job
    $sql = "INSERT INTO `sesi` (`namaSesi`, `deskripsi`, `awalSesi`, `akhirSesi`) VALUES (?, ?, ?, ?);";

    // Persiapkan statement
    $stmt = $con->prepare($sql);

    // Bind parameter ke statement
    $stmt->bind_param("ssss", $nama, $deskripsi, $awal, $akhir);

    // Eksekusi statement untuk menambahkan data
    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Data berhasil ditambahkan";
        echo json_encode($response);
    } else {
        $response["success"] = false;
        $response["message"] = "Gagal menambahkan data: " . $stmt->error;
        echo json_encode($response);
    }
} else {
    $response["success"] = false;
    $response["message"] = "Metode request tidak valid";
    echo json_encode($response);
}
