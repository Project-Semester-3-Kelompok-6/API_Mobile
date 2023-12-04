<?php
require_once 'koneksi.php';

// Pastikan request yang diterima adalah metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['NamaDevisi'];

    // Query untuk menambahkan data ke dalam tabel devisi
    $sql = "INSERT INTO `devisi` (`NamaDevisi`) VALUES (?);";

    // Persiapkan statement
    $stmt = $con->prepare($sql);

    // Bind parameter ke statement
    $stmt->bind_param("s", $nama);

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
