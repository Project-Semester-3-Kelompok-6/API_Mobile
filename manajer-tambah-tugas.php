<?php
require_once 'koneksi.php';

// Pastikan request yang diterima adalah metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['Judul'];
    $deskripsi = $_POST['Deskripsi'];
    $devisiID = $_POST['DevisiID'];
    $karyawanID = $_POST['KaryawanID'];
    $tanggal = $_POST['Tanggal'];
    $status = $_POST['Status'];

    // Query untuk menambahkan data ke dalam tabel job
    $sql = "INSERT INTO job (Judul, Deskripsi, DevisiID, KaryawanID, Tanggal, Status, BuktiFoto) VALUES (?, ?, ?, ?, ?, ?, NULL)";

    // Persiapkan statement
    $stmt = $con->prepare($sql);

    // Bind parameter ke statement
    $stmt->bind_param("ssssss", $judul, $deskripsi, $devisiID, $karyawanID, $tanggal, $status);
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
?>
