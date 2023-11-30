<?php
require_once 'koneksi.php';

// Pastikan request yang diterima adalah metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $devisiID = $_POST['devisiID'];

    // Query untuk menambahkan data ke dalam tabel users
    $sql = "INSERT INTO users (Nama, Email, Password, Role, Status, DevisiID, apiKey, reset_password_otp, reset_password_created_at	) VALUES (?, ?, ?, ?, ?, ?, NULL, NULL, NULL)";

    // Persiapkan statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssi", $nama, $email, $password, $role, $status, $devisiID);

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
