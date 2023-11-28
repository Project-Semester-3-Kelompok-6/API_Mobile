<?php
require_once 'koneksi.php';

// Pastikan request yang diterima adalah metode POST
if (!empty($_POST['nama']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']) && !empty($_POST['status']) && !empty($_POST['devisiID'])) {
    
    // Ambil data dari permintaan POST
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $devisiID = $_POST['devisiID'];

    // Query untuk menambahkan data ke dalam tabel users
    $sql = "INSERT INTO `users` (`Nama`, `Email`, `Password`, `Role`, `Status`, `DevisiID`) VALUES (?, ?, ?, ?, ?, ?)";

    // Persiapkan statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssi", $nama, $email, $password, $role, $status, $devisiID);

    // Eksekusi statement untuk menambahkan data
    if ($stmt->execute()) {
        // Jika berhasil ditambahkan
        $response["success"] = true;
        $response["message"] = "Data berhasil ditambahkan";
        echo json_encode($response);
    } else {
        // Jika terjadi kesalahan
        $response["success"] = false;
        $response["message"] = "Gagal menambahkan data";
        echo json_encode($response);
    }
} else {
    // Jika bukan metode POST atau field kosong
    $response["success"] = false;
    $response["message"] = "All fields are required";
    echo json_encode($response);
}
?>
